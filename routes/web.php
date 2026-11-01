<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DepartmentController;

// Department Routes 
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('departments', DepartmentController::class)->except(['index', 'show']);
    Route::get('departments', [DepartmentController::class, 'departmentRoster'])
        ->name('departments.index');
    Route::get('departments/{department}/enroll', [DepartmentController::class, 'enroll'])
        ->name('departments.enroll');
    Route::post('departments/{department}/enroll', [DepartmentController::class, 'storeEnrollment'])
        ->name('departments.enroll.store');
    Route::delete('departments/{department}/students/{student}', [DepartmentController::class, 'unenroll'])
        ->name('departments.unenroll');
});

// HOME PAGE 
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Public campus information pages use dedicated views with a shared layout.
Route::get('/portal/{page}', function (string $page) {
    abort_unless(in_array($page, [
        'academic-records', 'library', 'community', 'discovery', 'help-desk',
    ], true), 404);

    return view('portal.pages.' . $page);
})->name('portal.pages.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::get('/login/captcha', [AuthController::class, 'refreshCaptcha'])->name('login.captcha');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});
Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');

// AUTHENTICATED USERS
Route::middleware('auth')->group(function () {

    // MAIN DASHBOARD
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // ADMIN ROUTES

    Route::middleware('admin')->group(function () {

        // Admin Dashboard
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');

        // Registered-user management
        Route::get('/admin/users', [UserController::class, 'index'])
            ->name('admin.users.index');
        Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])
            ->name('admin.users.edit');
        Route::put('/admin/users/{user}', [UserController::class, 'update'])
            ->name('admin.users.update');
        Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])
            ->name('admin.users.destroy');

        // Student CRUD - ADMIN ONLY
        Route::get('/students/create', [StudentController::class, 'create'])
            ->name('students.create');
        Route::post('/students/store', [StudentController::class, 'store'])
            ->name('students.store');
        Route::get('/students/{id}/edit', [StudentController::class, 'edit'])
            ->name('students.edit');
        Route::put('/students/update/{id}', [StudentController::class, 'update'])
            ->name('students.update');
        Route::delete('/students/{id}', [StudentController::class, 'destroy'])
            ->name('students.destroy');

        // Subject management - ADMIN ONLY
        Route::get('/admin/subjects', [SubjectController::class, 'index'])
            ->name('admin.subjects.index');
        
        Route::resource('subjects', SubjectController::class)->except(['index', 'show']);

        Route::get('/subjects/{subject}/assign', [SubjectController::class, 'assign'])
            ->name('subjects.assign');

        Route::post('/subjects/{subject}/assign', [SubjectController::class, 'storeAssignment'])
            ->name('subjects.storeAssignment');
            Route::delete('/subjects/{subject}/students/{student}',
            [SubjectController::class, 'unassignSubject']
            )->name('subjects.unassign');

    });
    // Student records and files are an administrative area. Students use the
    // self-profile routes below, which never accept another student's ID.
    Route::middleware('admin')->group(function () {
    Route::get('/students', [StudentController::class, 'index'])
        ->name('students.index');
    Route::get('/students/{id}', [StudentController::class, 'show'])
        ->name('students.show');
    Route::get('/students/{student}/document', [StudentController::class, 'download'])
        ->name('students.document');
    Route::get('/students/{student}/profile-picture', [StudentController::class, 'profilePicture'])
        ->name('students.profile-picture');
    Route::get('/students/{student}/profile-picture/download', [StudentController::class, 'downloadProfilePicture'])
        ->name('students.profile-picture.download');
    });

    // Subject administration is restricted to administrators; a student's own
    // assigned subjects are shown on their personal profile.
    Route::get('/subjects', [SubjectController::class, 'index'])
        ->middleware('admin')
        ->name('subjects.index');

    // NORMAL USER DASHBOARD
    Route::get('/user/dashboard', [UserDashboardController::class, 'dashboard'])
        ->name('user.dashboard');

    Route::get('/profile', [StudentController::class, 'myProfile'])->name('profile.show');
    Route::get('/profile/edit', [StudentController::class, 'editMyProfile'])->name('profile.edit');
    Route::put('/profile', [StudentController::class, 'updateMyProfile'])->name('profile.update');
    Route::get('/profile/picture', [StudentController::class, 'myProfilePicture'])->name('profile.picture');
    Route::get('/profile/picture/download', [StudentController::class, 'downloadMyProfilePicture'])->name('profile.picture.download');
    Route::get('/profile/document', [StudentController::class, 'myDocument'])->name('profile.document');
    Route::post('/profile/document', [StudentController::class, 'updateMyDocument'])->name('profile.document.update');
    Route::delete('/profile/document', [StudentController::class, 'destroyMyDocument'])->name('profile.document.destroy');
});
