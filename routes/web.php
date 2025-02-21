<?php

use App\Http\Controllers\AdminActions;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('superadmin')->middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'superAdmin'])->name('superadmin.dashboard');
});

Route::prefix('admin')->middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/dashboard/roles', [AdminActions::class, 'viewRoles'])->name('role.index');
    Route::get('/dashboard/users', [AdminActions::class, 'viewUsers'])->name('users.index');
    Route::get('/dashboard/users/create', [AdminActions::class, 'createUser'])->name('users.create');
    Route::post('/dashboard/users/create', [AdminActions::class, 'storeUser'])->name('users.store');
    Route::get('/dashboard/users/{user}/edit', [AdminActions::class, 'editUser'])->name('users.edit');
    Route::put('/dashboard/users/{user}/update', [AdminActions::class, 'updateUser'])->name('users.update');
    Route::delete('/dashboard/users/{user}/delete', [AdminActions::class, 'deleteUser'])->name('users.delete');
    
    Route::get('/dashboard/categories', [AdminActions::class, 'classCategoryIndex'])->name('category.index');
    Route::get('/dashboard/categories/create', [AdminActions::class, 'createclassCategory'])->name('category.create');
    Route::post('/dashboard/categories/create', [AdminActions::class, 'storeCategory'])->name('category.store');
    Route::get('/dashboard/categories/{classCategory}/edit', [AdminActions::class, 'editclassCategory'])->name('category.edit');
    Route::put('/dashboard/categories/{classCategory}/update', [AdminActions::class, 'updateclassCategory'])->name('category.update');
    Route::delete('/dashboard/categories/{classCategory}/delete', [AdminActions::class, 'destroyclassCategory'])->name('category.delete');

    Route::get('/dashboard/classrooms', [AdminActions::class, 'classroomIndex'])->name('classroom.index');
    Route::get('/dashboard/classrooms/create', [AdminActions::class, 'createClassroom'])->name('classroom.create');
    Route::post('/dashboard/classrooms/create', [AdminActions::class, 'storeClassroom'])->name('classroom.store');
    Route::get('/dashboard/classrooms/{classroom}/edit', [AdminActions::class, 'editClassroom'])->name('classroom.edit');
    Route::put('/dashboard/classrooms/{classroom}/update', [AdminActions::class, 'updateClassroom'])->name('classroom.update');
    Route::delete('/dashboard/classrooms/{classroom}/delete', [AdminActions::class, 'deleteClassroom'])->name('classroom.delete');

    Route::get('/dashboard/school_sessons', [AdminActions::class, 'schoolSessionIndex'])->name('session.index');
    Route::get('/dashboard/school_sessons/create', [AdminActions::class, 'createschoolSession'])->name('session.create');
    Route::post('/dashboard/school_sessons/create', [AdminActions::class, 'storeschoolSession'])->name('session.store');
    Route::get('/dashboard/school_sessons/{schoolsession}/edit', [AdminActions::class, 'editschoolSession'])->name('session.edit');
    Route::put('/dashboard/school_sessons/{schoolsession}/update', [AdminActions::class, 'updateschoolSession'])->name('session.update');
    Route::delete('/dashboard/school_sessons/{schoolsession}/delete', [AdminActions::class, 'deleteschoolSession'])->name('session.delete');

    Route::get('/dashboard/students', [AdminActions::class, 'studentIndex'])->name('student.index');
    Route::get('/dashboard/students/create', [AdminActions::class, 'createStudent'])->name('student.create');
    Route::post('/dashboard/students/create', [AdminActions::class, 'storeStudent'])->name('student.store');
    Route::get('/dashboard/students/{student}/edit', [AdminActions::class, 'editStudent'])->name('student.edit');
    Route::put('/dashboard/students/{student}/update', [AdminActions::class, 'updateStudent'])->name('student.update');
    Route::delete('/dashboard/students/{student}/delete', [AdminActions::class, 'deleteStudent'])->name('student.delete');
    Route::get('/dashboard/students/{student}/show', [AdminActions::class, 'showStudent'])->name('student.show');
    Route::get('/dashboard/class_students/{classroom}', [AdminActions::class, 'viewClassstudents'])->name('class.students');

});

Route::prefix('user')->middleware(['auth', 'role:User'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');
});

require __DIR__ . '/auth.php';
