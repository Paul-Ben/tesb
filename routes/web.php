<?php

use App\Http\Controllers\AdminActions;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserActions;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/about-us', function () {
//     return view('about-us');
// })->name('about-us');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Frontend routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about-us', [FrontendController::class, 'about'])->name('about');
Route::get('/contact-us', [FrontendController::class, 'contact'])->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('superadmin')->middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'superAdmin'])->name('superadmin.dashboard');
});

Route::prefix('admin')->middleware(['auth', 'role:Admin, Teacher'])->group(function () {
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
    Route::get('/dashboard/class_subjects', [AdminActions::class, 'subjectIndex'])->name('subjects');
    Route::get('/dashboard/class_subjects/{classroom}', [AdminActions::class, 'subject_index'])->name('class.subjects');
    Route::get('/dashboard/class_subjects/{classroom}/create', [AdminActions::class, 'createSubject'])->name('subject.create');
    Route::post('/dashboard/class_subjects/{classroom}/create', [AdminActions::class, 'storeSubject'])->name('subject.store');
    Route::get('/dashboard/class_subjects/{subject}/edit', [AdminActions::class, 'editSubject'])->name('subject.edit');
    Route::put('/dashboard/class_subjects/{subject}/update', [AdminActions::class, 'updateSubject'])->name('subject.update');
    Route::delete('/dashboard/class_subjects/{subject}/delete', [AdminActions::class, 'deleteSubject'])->name('subject.delete');

    Route::get('/dashboard/teachers', [AdminActions::class, 'teacher_index'])->name('teacher.index');
    Route::get('/dashboard/teachers/create', [AdminActions::class, 'create_teacher'])->name('teacher.create');
    Route::post('/dashboard/teachers/create', [AdminActions::class, 'store_teacher'])->name('teacher.store');
    Route::get('/dashboard/teachers/{teacher}/edit', [AdminActions::class, 'edit_teacher'])->name('teacher.edit');
    Route::put('/dashboard/teachers/{teacher}/update', [AdminActions::class, 'update_teacher'])->name('teacher.update');
    Route::delete('/dashboard/teachers/{teacher}/delete', [AdminActions::class, 'delete_teacher'])->name('teacher.destroy');

    Route::get('/dashboard/term/index', [AdminActions::class, 'termIndex'])->name('term.index');
    Route::get('/dashboard/term/create', [AdminActions::class, 'createTerm'])->name('term.create');
    Route::post('/dashboard/term/create', [AdminActions::class, 'storeTerm'])->name('term.store');
    Route::get('/dashboard/term/{term}/edit', [AdminActions::class, 'editTerm'])->name('term.edit');
    Route::put('/dashboard/term/{term}/update', [AdminActions::class, 'updateTerm'])->name('term.update');
    Route::delete('/dashboard/term/{term}/delete', [AdminActions::class, 'deleteTerm'])->name('term.delete');
    Route::get('/dashboard/fee-setup', [AdminActions::class, 'feeIndex'])->name('adminFee.setup');
    Route::get('/dashboard/fee-setup/create', [AdminActions::class, 'createFee'])->name('fee.create');
    Route::post('/dashboard/feeSetup/create', [AdminActions::class, 'storeFee'])->name('fee.store');
    Route::get('/dashboard/fee-setup/{fee}/edit', [AdminActions::class, 'editFee'])->name('fee.edit');
    Route::put('/dashboard/fee-setup/{fee}/update', [AdminActions::class, 'updateFee'])->name('fee.update');
    Route::delete('/dashboard/fee-setup/{fee}/delete', [AdminActions::class, 'deleteFee'])->name('fee.delete');
});

Route::prefix('teacher')->middleware(['auth', 'role:Teacher'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'teacher'])->name('teacher.dashboard');
    Route::get('/dashboard/classrooms', [TeacherController::class, 'teacher_classes'])->name('teacher.classroom');
    Route::get('/dashboard/class_students/{classroom}', [TeacherController::class, 'viewClassstudents'])->name('teacher.students');
    Route::get('/dashboard/students/{student}/show', [TeacherController::class, 'showStudent'])->name('teacher.show_student');
    Route::get('/dashboard/class_subjects', [TeacherController::class, 'subject_index'])->name('teacher.subjects');
    Route::get('/dashboard/result/index', [TeacherController::class, 'resultIndex'])->name('result.index');
    Route::get('/dashboard/result/search', [TeacherController::class, 'searchStudentForResult'])->name('search.result');
    Route::get('/dashboard/result/{student}/create', [TeacherController::class, "createResult"])->name('create.result');
    Route::post('/results/store', [ResultController::class, 'store'])->name('results.store');
    Route::get('/dashboard/student/{student}/result', [ResultController::class, 'viewResult'])->name('view.result');
    Route::get('/dashboard/student/{student}/resultlist', [ResultController::class, 'getResults'])->name('get.results');
    Route::get('/dashboard/student/result/{result}/result', [ResultController::class, 'singleResultView'])->name('single.result');
    Route::get('/dashboard/promote-students/{classroom}', [TeacherController::class, 'promoteStudents'])->name('promote.students');
    Route::put('/dashboard/promote-student', [TeacherController::class, 'promote'])->name('promote');
});

Route::prefix('user')->middleware(['auth', 'role:User'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');
    Route::get('/dashboard/guardian/form', [UserActions::class, 'guardianForm'])->name('guardian.form');
    Route::post('/dashboard/guardian/form', [UserActions::class, 'storeGuardian'])->name('guardian.store');
    Route::get('/dashboard/guardian/form/edit', [UserActions::class, 'editGuardian'])->name('guardian.edit');
    Route::put('/dashboard/guardian/form/update', [UserActions::class, 'updateGuardian'])->name('guardian.update');
    Route::get('/dashboard/guardian/students', [UserActions::class, 'getGuardianStudents'])->name('guardian.students');
    Route::get('/dashboard/guardian/students/{student}/show', [UserActions::class, 'showStudent'])->name('guardian.show_student');
    Route::get('/dashboard/guardian/students/{student}/result', [UserActions::class, 'viewResult'])->name('guardian.view.result');
    Route::get('/dashboard/guardian/students/{student}/resultlist', [UserActions::class, 'getResults'])->name('guardian.get.results');
    Route::get('/dashboard/guardian/students/result/{result}/result', [UserActions::class, 'singleResultView'])->name('guardian.single.result');
    Route::get('/dashboard/{student}/fee-form', [UserActions::class, 'feeIndex'])->name('fee.index');
    Route::get('/callback', [UserActions::class, 'paymentCallback'])->name('payment.callback');
    Route::post('/dashboard/pay/fees', [UserActions::class, 'initialize'])->name('pay.fee');
});

require __DIR__ . '/auth.php';
