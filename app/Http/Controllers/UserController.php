<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show registered users
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    // Show edit form
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $isEditingSelf = (int) $request->user()->getKey() === (int) $user->getKey();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->getKey()),
                Rule::unique('students', 'email')->ignore($user->student_id),
            ],
        ];

         
        $rules['role'] = $isEditingSelf
            ? ['prohibited']
            : ['required', Rule::in(['user', 'admin'])];

        $data = $request->validate($rules);

        if ($isEditingSelf) {
            $data['role'] = $user->role;
        }

        $isBeingPromoted = $data['role'] === 'admin' && $user->role !== 'admin';

        if ($isBeingPromoted && User::where('role', 'admin')->count() >= 3) {
            return back()
                ->withInput()
                ->withErrors(['role' => 'Only three administrators are allowed in the system.']);
        }

        $user->update($data);

        // A linked account's login email must stay aligned with its
        // administrator-approved student record.
        if ($user->student) {
            $user->student->update(['email' => $data['email']]);
        }

        if ($isBeingPromoted) {
            // The database session driver lets us invalidate every active session
            // for this user. They must sign in again to receive admin access.
            DB::table('sessions')->where('user_id', $user->getKey())->delete();
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', $isBeingPromoted
                ? 'User promoted to admin and signed out. They must log in again.'
                : 'User updated successfully.');
    }

    // Delete user
    public function destroy(User $user)
    {
    
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
