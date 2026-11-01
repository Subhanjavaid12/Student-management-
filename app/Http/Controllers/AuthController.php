<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class AuthController extends Controller
{
    public function create()
    {
        $this->refreshCaptcha(request());

        return view('auth.login');
    }

    public function refreshCaptcha(Request $request)
    {
        $characters = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
        $captcha = '';

        for ($i = 0; $i < 3; $i++) {
            $captcha .= $characters[random_int(0, strlen($characters) - 1)];
        }

        $request->session()->put('login_captcha', $captcha);

        if ($request->expectsJson()) {
            return response()->json(['captcha' => $captcha]);
        }

        return $captcha;
    }

    public function store(Request $request)
    {
        $request->validate([
            'captcha' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($request) {
                    $expected = $request->session()->pull('login_captcha');

                    if (! is_string($expected) || ! hash_equals($expected, trim($value))) {
                        $fail('The captcha is incorrect. Please enter the new captcha shown.');
                    }
                },
            ],
        ]);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['email' => 'The provided credentials are incorrect.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();
        return redirect()->intended(route('dashboard'));
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
        ]);
        $student = Student::query()
            ->whereRaw('LOWER(email) = ?', [Str::lower($data['email'])])
            ->whereDoesntHave('user')
            ->first();

        if (! $student) {
            return back()->withInput()->withErrors([
                'email' => 'This email is not pre-authorized for registration.
                 Please contact an admin.',
            ]);
        }
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'student_id' => $student->id,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('user.dashboard');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            $status = Password::sendResetLink(
                $request->only('email')
            );
        } catch (TransportExceptionInterface $exception) {
            report($exception);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Password reset email could not be sent right now. Please try again later or contact an administrator.',
                ]);
        }

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'If an account exists for that email address,
             a password reset link has been sent.')
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email', ''),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Your password has been reset. 
            Please sign in with your new password.');
        }

        return back()->withErrors(['email' => __($status)])->withInput();
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
