<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\ClassCategory;
use App\Models\Classroom;
use App\Models\FeeSetup;
use App\Models\Guardian;
use App\Models\ManualPayments;
use App\Models\Registration;
use App\Models\Role;
use App\Models\SchoolSession;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Term;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminActions extends Controller
{
    /**
     * Apply middleware to enforce role-based authorization.
     */
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
        $this->middleware('role:Admin'); // Restrict access to specific roles
    }

    public function index()
    {
        // $studentCount = Student::count();
        return view('admin.index');
    }

    public function viewRoles()
    {
        $authUser = Auth::user();
        $roles = Role::all();
        return view('admin.role', compact('roles', 'authUser'));
    }

    public function viewUsers()
    {
        $authUser = Auth::user();
        $users = User::whereNotIn('role_id', [3, 2, 4])->get();
        return view('admin.user.index', compact('users', 'authUser'));
    }

    public function createUser()
    {
        $authUser = Auth::user();
        $roles = Role::whereIn('id', [1,2])->get();
        return view('admin.user.create', compact('roles', 'authUser'));
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|min:6'
        ]);
        $validated['password'] = bcrypt($validated['password']);
        $createdUser = User::create($validated);
        $getRole = $createdUser->role;
        if ($getRole->name == 'Admin') {
            Admin::create([
                'user_id' => $createdUser->id,
            ]);
        }

        Log::info('User created successfully');
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function editUser(User $user)
    {
        $authUser = Auth::user();
        $roles = Role::where('id', 1)->get();
        return view('admin.user.edit', compact('user', 'roles', 'authUser'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            // 'password' => 'nullable|min:6'
        ]);
        if ($request->password != $user->password) {
            $validated['password'] = bcrypt($validated['password']);
        }
        $user->update($validated);
        Log::info('User updated successfully');
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        Log::info('User deleted successfully');
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function classCategoryIndex()
    {
        $authUser = Auth::user();
        $classCategories = ClassCategory::all();
        return view('admin.classcategory.index', compact('classCategories', 'authUser'));
    }

    public function createclassCategory()
    {
        $authUser = Auth::user();
        return view('admin.classcategory.create', compact('authUser'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'abbreviation' => 'required'
        ]);
        ClassCategory::create($validated);
        Log::info('Class Category created successfully');
        return redirect()->route('category.index')->with('success', 'Class Category created successfully');
    }

    public function editclassCategory(Request $request, ClassCategory $classCategory)
    {
        $authUser = Auth::user();
        return view('admin.classcategory.edit', compact('classCategory', 'authUser'));
    }

    public function updateclassCategory(Request $request, ClassCategory $classCategory)
    {
        $validated = $request->validate([
            'name' => 'required',
            'abbreviation' => 'required'
        ]);
        $classCategory->update($validated);
        Log::info('Class Category updated successfully');
        return redirect()->route('category.index')->with('success', 'Class Category updated successfully');
    }

    public function destroyclassCategory(ClassCategory $classCategory)
    {
        $classCategory->delete();
        Log::info('Class Category deleted successfully');
        return redirect()->route('category.index')->with('success', 'Class Category deleted successfully');
    }

    public function classroomIndex()
    {
        $authUser = Auth::user();
        $classrooms = Classroom::with('classCategory', 'teacher')->get();
        // $classrooms = Classroom::with('classCategory')->paginate(10);
        // $teachers = Teacher::all();
        // dd($classrooms);
        return view('admin.classroom.index', compact('classrooms', 'authUser'));
    }

    public function createClassroom()
    {
        $authUser = Auth::user();
        $classCategories = ClassCategory::all();
        $teachers = Teacher::all();
        return view('admin.classroom.create', compact('classCategories', 'authUser', 'teachers'));
    }

    public function storeClassroom(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'teacher_id' => 'required',
        ]);
        Classroom::create($validated);
        Log::info('Classroom created successfully');
        return redirect()->route('classroom.index')->with('success', 'Classroom created successfully');
    }

    public function editClassroom(Classroom $classroom)
    {
        $authUser = Auth::user();
        $category = ClassCategory::find($classroom->category_id);
        $classCategories = ClassCategory::all();
        $teachers = Teacher::all();
        return view('admin.classroom.edit', compact('classroom', 'classCategories', 'category', 'authUser', 'teachers'));
    }

    public function updateClassroom(Request $request, Classroom $classroom)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'teacher_id' => 'required'
        ]);
        $classroom->update($validated);
        Log::info('Classroom updated successfully');
        return redirect()->route('classroom.index')->with('success', 'Classroom updated successfully');
    }

    public function deleteClassroom(Classroom $classroom)
    {
        $classroom->delete();
        Log::info('Classroom deleted successfully');
        return redirect()->route('classroom.index')->with('success', 'Classroom deleted successfully');
    }


    /**Session operations */
    public function schoolSessionIndex()
    {
        $authUser = Auth::user();
        $schoolsessions = SchoolSession::all();
        return view('admin.sessions.index', compact('schoolsessions', 'authUser'));
    }

    public function createschoolSession()
    {
        $authUser = Auth::user();
        return view('admin.sessions.create', compact('authUser'));
    }

    public function storeschoolSession(Request $request)
    {
        $validated = $request->validate([
            'sessionName' => 'required',
            'status' => 'required'
        ]);
        $staus = $validated['status'] == 'active' ? 1 : 0;
        SchoolSession::create([
            'sessionName' => $validated['sessionName'],
            'status' => $validated['status'],

        ]);
        Log::info('Session created successfully');
        $notification = array(
            'message' => 'Session created successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('session.index')->with($notification);
    }

    public function editschoolSession(SchoolSession $schoolsession)
    {
        $authUser = Auth::user();
        return view('admin.sessions.edit', compact('schoolsession', 'authUser'));
    }
    public function updateschoolSession(Request $request, SchoolSession $schoolsession)
    {
        $validated = $request->validate([
            'sessionName' => 'required',
            'status' => 'required'
        ]);
        $staus = $validated['status'] == 'active' ? 1 : 0;
        $schoolsession->update([
            'sessionName' => $validated['sessionName'],
            'status' => $validated['status'],
        ]);
        Log::info('Session updated successfully');
        return redirect()->route('session.index')->with('success', 'Session updated successfully');
    }
    public function deleteschoolSession(SchoolSession $schoolsession)
    {
        $schoolsession->delete();
        Log::info('Session deleted successfully');
        return redirect()->route('session.index')->with('success', 'Session deleted successfully');
    }
    public function termIndex()
    {
        $authUser = Auth::user();
        $terms = Term::with('schoolSession')->get();
        $sessions = schoolSession::all();
        return view('admin.term.index', compact('terms', 'sessions', 'authUser'));
    }
    public function createTerm(Request $request)
    {
        $authUser = Auth::user();
        $sessions = SchoolSession::where('status', 'active')->get();
        // dd($sessions);
        return view('admin.term.create', compact('sessions', 'authUser'));
    }
    public function storeTerm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'session_id' => 'required|exists:school_sessions,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ]);

        Term::create([
            'name' => $request->name,
            'session_id' => $request->session_id,
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
            'status' => $request->status,
        ]);
        $notification = array(
            'message' => 'Term created successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('term.index')->with($notification);
    }
    public function editTerm(Term $term)
    {
        $authUser = Auth::user();
        $sessions = SchoolSession::all();
        return view('admin.term.edit', compact('term', 'sessions', 'authUser'));
    }
    public function updateTerm(Request $request, Term $term)
    {
        $request->validate([
            'name' => 'required',
            'session_id' => 'required|exists:school_sessions,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ]);

        $term->update([
            'name' => $request->name,
            'session_id' => $request->session_id,
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
            'status' => $request->status,
        ]);
        $notification = array(
            'message' => 'Term updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('term.index')->with($notification);
    }
    public function deleteTerm(Term $term)
    {
        $term->delete();
        $notification = array(
            'message' => 'Term deleted successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('term.index')->with($notification);
    }


    public function studentIndex()
    {
        $authUser = Auth::user();
        $students = Student::all();
        return view('admin.student.index', compact('students', 'authUser'));
    }

    public function showStudent(Student $student)
    {
        $authUser = Auth::user();
        return view('admin.student.show', compact('student', 'authUser'));
    }

    public function createStudent()
    {
        $authUser = Auth::user();
        $classrooms = Classroom::all();
        $guardians = Guardian::all();
        $schoolSessions = SchoolSession::all();
        return view('admin.student.create', compact('classrooms', 'schoolSessions', 'authUser', 'guardians'));
    }

    public function storeStudent(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'middle_name' => 'string|nullable',
            'last_name' => 'required',
            'std_number' => 'required|unique:students',
            'date_of_birth' => 'required|date',
            'nationality' => 'required',
            'stateoforigin' => 'required',
            'lga' => 'required',
            'genotype' => 'required',
            'bgroup' => 'required',
            'guardian_id' => 'required|exists:guardians,id',
            'class_id' => 'required|exists:classrooms,id',
            'current_session' => 'required|exists:school_sessions,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $filePath = $request->file('image');
            $filename = time() . '_' . $filePath->getClientOriginalName();
            $image = $filePath->move(public_path('images/'), $filename);
            $file = $request->merge(['file_path' => $filename]);
        }


        // Create the student record
        Student::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'std_number' => $request->std_number,
            'date_of_birth' => $request->date_of_birth,
            'nationality' => $request->nationality,
            'stateoforigin' => $request->stateoforigin,
            'lga' => $request->lga,
            'gender' => $request->gender,
            'genotype' => $request->genotype,
            'bgroup' => $request->bgroup,
            'guardian_id' => $request->guardian_id,
            'class_id' => $request->class_id,
            'current_session' => $request->current_session,
            'image' => $filename ?? null, // Save the image path in the database
        ]);


        return redirect()->route('student.index')->with('success', 'Student created successfully.');
    }

    public function editStudent(Student $student)
    {
        $authUser = Auth::user();
        $studentguardian = Guardian::find($student->guardian_id);
        $classrooms = Classroom::all();
        $schoolSessions = SchoolSession::all();
        $currentSession = SchoolSession::find($student->current_session);

        return view('admin.student.edit', compact('student', 'studentguardian', 'classrooms', 'currentSession', 'schoolSessions', 'authUser'));
    }

    public function updateStudent(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required',
            'middle_name' => 'string|nullable',
            'last_name' => 'required',
            'std_number' => 'required|unique:students,std_number,' . $student->id,
            'date_of_birth' => 'required|date',
            'nationality' => 'required',
            'stateoforigin' => 'required',
            'lga' => 'required',
            'gender' => 'required',
            'genotype' => 'required',
            'bgroup' => 'required',
            'class_id' => 'required|exists:classrooms,id',
            'current_session' => 'required|exists:school_sessions,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $student->image; // Keep existing image by default

        // Only process image if a new one was uploaded
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($student->image && file_exists(public_path('images/' . $student->image))) {
                unlink(public_path('images/' . $student->image));
            }

            // Store new image
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/'), $filename);
            $imagePath = $filename;
        }
        $student->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'std_number' => $request->std_number,
            'date_of_birth' => $request->date_of_birth,
            'nationality' => $request->nationality,
            'stateoforigin' => $request->stateoforigin,
            'lga' => $request->lga,
            'gender' => $request->gender,
            'genotype' => $request->genotype,
            'bgroup' => $request->bgroup,
            'class_id' => $request->class_id,
            'current_session' => $request->current_session,
            'image' => $filename ?? $student->image, // Save the image path in the database
        ]);
        return redirect()->route('student.index')->with('success', 'Student updated successfully.');
    }

    public function deleteStudent(Student $student)
    {
        if ($student->image && file_exists(public_path('images/' . $student->image))) {
            unlink(public_path('images/' . $student->image));
        }
        $student->delete();
        return redirect()->route('student.index')->with('success', 'Student deleted successfully.');
    }

    public function viewClassstudents(Classroom $classroom)
    {
        $authUser = Auth::user();
        $students = Student::where('class_id', $classroom->id)->get();
        return view('admin.classroom.students', compact('students', 'classroom', 'authUser'));
    }

    public function guardianForm(Request $request, User $user)
    {
        $authUser = Auth::user();
        return view('users.guardian.create', compact('authUser'));
    }

    public function subjectIndex()
    {
        $authUser = Auth::user();
        $subjects = Subject::all();
        return view('admin.subject.allIndex', compact('subjects', 'authUser'));
    }
    public function subject_index(Classroom $classroom)
    {
        $authUser = Auth::user();
        $subjects = Subject::where('classroom_id', $classroom->id)->get();
        return view('admin.subject.index', compact('subjects', 'classroom', 'authUser'));
    }

    public function createSubject(Classroom $classroom)
    {
        $authUser = Auth::user();
        $classrooms = Classroom::all();
        $teachers = Teacher::all();
        return view('admin.subject.create', compact('classroom', 'authUser', 'teachers'));
    }
    public function storeSubject(Request $request, Classroom $classroom)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'teacher_id' => 'required'
            // 'classroom_id' => 'required|exists:classrooms,id',
        ]);

        Subject::create([
            'name' => $request->name,
            'classroom_id' => $classroom->id,
            'code' => $request->code,
            'teacher_id' => $request->teacher_id,
        ]);
        $notification = array(
            'message' => 'Subject created successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('class.subjects', $classroom)->with($notification);
    }

    public function editSubject(Subject $subject)
    {
        $authUser = Auth::user();
        return view('admin.subject.edit', compact('subject', 'authUser'));
    }
    public function updateSubject(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);

        $subject->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);
        $notification = array(
            'message' => 'Subject updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('class.subjects', $subject->classroom)->with($notification);
    }

    public function teacher_index()
    {
        $authUser = Auth::user();
        $teachers = Teacher::all();
        return view('admin.teacher.index', compact('teachers', 'authUser'));
    }

    public function create_teacher()
    {
        $authUser = Auth::user();
        return view('admin.teacher.create', compact('authUser'));
    }

    // public function store_teacher(Request $request)
    // {
    //     $teacher = $request->validate([
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'middle_name' => 'string|nullable',
    //         'email' => 'required|email|unique:teachers',
    //         'date_of_birth' => 'required|date',
    //         'phone_number' => 'required',
    //         'address' => 'required',
    //         'qualification' => 'string|nullable',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->first_name." ".$request->last_name,
    //         'email' => $request->email,
    //         'password' => Hash::make('Teacher@123'),
    //         'role_id' => 4,
    //     ]);

    //     event(new Registered($user));

    //     $teacher['user_id'] = $user->id;

    //     Teacher::create($teacher);


    //     $notification = array(
    //         'message' => 'Teacher created successfully.',
    //         'alert-type' => 'success'
    //         );

    //     return redirect()->route('teacher.index')->with($notification);
    // }
    public function store_teacher(Request $request)
    {
        // Validate input with proper unique check for users table
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email', // Check uniqueness in users table
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'qualification' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            // Create user with validated data
            $user = User::create([
                'name' => "{$validated['first_name']} {$validated['last_name']}",
                'email' => $validated['email'],
                'password' => Hash::make('Teacher@123'),
                'role_id' => 4, // Ensure this matches your roles configuration
            ]);

            // Create teacher profile
            Teacher::create([
                'user_id' => $user->id,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'middle_name' => $validated['middle_name'] ?? null,
                'email' => $validated['email'],
                'date_of_birth' => $validated['date_of_birth'],
                'phone_number' => $validated['phone_number'],
                'address' => $validated['address'],
                'qualification' => $validated['qualification'] ?? null,
            ]);

            event(new Registered($user));

            DB::commit();

            return redirect()->route('teacher.index')
                ->with('success', 'Teacher created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Teacher creation failed: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', 'Error creating teacher. Please try again.');
        }
    }
    public function edit_teacher(Teacher $teacher)
    {
        $authUser = Auth::user();
        return view('admin.teacher.edit', compact('teacher', 'authUser'));
    }

    public function update_teacher(Request $request, Teacher $teacher)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'string|nullable',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'date_of_birth' => 'required|date',
            'phone_number' => 'required',
            'address' => 'required',
            'qualification' => 'string|nullable',
        ]);

        $teacher->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'qualification' => $request->qualification,
        ]);
        return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully!');
    }
    public function delete_teacher(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully!');
    }

    public function feeIndex()
    {
        $authUser = Auth::user();
        $fees = FeeSetup::all();
        return view('admin.feesetup.index', compact('authUser', 'fees'));
    }

    public function createFee()
    {
        $authUser = Auth::user();
        $classrooms = Classroom::all();
        $terms = Term::where('status', '=', 'active')->get();
        return view('admin.feesetup.create', compact('authUser', 'terms', 'classrooms'));
    }
    public function storeFee(Request $request)
    {
       
        // Validate input with proper unique check for users table
        $request->validate([
            'name' => 'required',
            'classroom_id' => 'required|exists:classrooms,id',
            'term_id' => 'required|exists:terms,id',
            'amount' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        $feeSetup = FeeSetup::create([
            'name' => $request->name,
            'term_id' => $request->term_id,
            'classroom_id' => $request->classroom_id,
            'amount' => $request->amount,
            'status' => $request->status,
        ]);
        // Check if the fee setup was created successfully

        if (!$feeSetup) {
            $notification = array(
                'message' => 'Error creating fee setup.',
                'alert-type' => 'error'
            );
            return back()->with('error', 'Error creating fee setup. Please try again.');
        }
        return redirect()->route('adminFee.setup')->with([
            'message' => 'Fee created successfully.',
            'alert-type' => 'success'
        ]);
    }

    public function editFee(FeeSetup $fee)
    {
        $authUser = Auth::user();
        $classrooms = Classroom::all();
        $terms = Term::all();
        return view('admin.feesetup.edit', compact('fee', 'authUser', 'terms', 'classrooms'));
    }
    public function updateFee(Request $request, FeeSetup $fee)
    {
        $request->validate([
            'name' => 'required',
            'term_id' => 'required|exists:terms,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'amount' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        $fee->update([
            'name' => $request->name,
            'term_id' => $request->term_id,
            'classroom_id' => $request->classroom_id,
            'amount' => $request->amount,
            'status' => $request->status,
        ]);
        $notification = array(
            'message' => 'Fee updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('adminFee.setup')->with($notification);
    }

    public function deleteFee(FeeSetup $fee)
    {
        $fee->delete();
        $notification = array(
            'message' => 'Fee deleted successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('adminFee.setup')->with($notification);
    }

    public function paymentIndex()
    {
        $authUser = Auth::user();
        $payments = Transaction::with('student')->orderBy('id', 'desc')->get();

        return view('admin.payments.payments', compact('payments', 'authUser'));
    }
    public function paymentReceipt(Transaction $receipt)
    {
        $authUser = Auth::user();
        return view('admin.payments.receipt', compact('receipt', 'authUser'));
    }
    public function allTransactions()
    {
        $authUser = Auth::user();
        $transactions = Registration::with('student')->orderBy('id', 'desc')->get();
        return view('admin.payments.registrations', compact('transactions', 'authUser'));
    }
    public function allManualPayments()
    {
        $authUser = Auth::user();
        $manualPayments = ManualPayments::with('student')->orderBy('id', 'desc')->get();
        return view('admin.payments.index', compact('manualPayments', 'authUser'));
    }
    public function createManualPayment(Student $student)
    {
        $authUser = Auth::user();
        $guardian = $student->guardian;
        $activeTerm = Term::where('status', 'active')->first();
        $fees = FeeSetup::where('status', 'active')->get();
        return view('admin.payments.create', compact('guardian', 'student', 'activeTerm', 'fees', 'authUser'));
    }
    public function storeManualPayment(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric',
            'term_id' => 'required|exists:terms,id',
            'status' => 'required|in:paid,unpaid',
            'student_name' => 'required|string',
            'student_id' => 'required|exists:students,id',
        ]);
        $tx_ref = 'MARF_' . time() . '_' . $request->student_id;
        $txr_id = 'MATX_' . time() . '_' . $request->student_id;

        $manualPayment = ManualPayments::create([
            'student_id' => $request->student_id,
            'name' => $request->student_name,
            'phone_number' => $request->guardian_phone,
            'email' => $request->guardian_email,
            'guardian_name' => $request->guardian_name,
            'student_class' => $request->student_class,
            'student_number' => $request->student_number,
            'term' => $request->term,
            'session' => $request->session,
            'session_id' => $request->session_id,
            'amount' => $request->amount,
            'term_id' => $request->term_id,
            'payment_method' => 'manual',
            'payitem' => $request->payitem,
            'paymentStatus' => $request->status,
            'tx_ref' => $tx_ref,
            'txr_id' => $txr_id
        ]);

        if (!$manualPayment) {
            $notification = array(
                'message' => 'Error creating manual payment. Please try again.',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }
        // check if payment exists in transaction table
        $transaction = Transaction::where('tx_ref', $tx_ref)->first();

        if (!$transaction) {
            // check if payment is successful
            if ($request->status == 'paid') {
                $transaction = Transaction::create([
                    'name' => $request->student_name,
                    'email' => $request->guardian_email,
                    'student_number' => $request->student_number,
                    'amount' => $request->amount,
                    'paymentStatus' => 'successful',
                    'phone_number' => $request->guardian_phone,
                    'guardian_name' => $request->guardian_name,
                    'term' => $request->term,
                    'session' => $request->session,
                    'student_class' => $request->student_class,
                    'student_id' => $request->student_id,
                    'session_id' => $request->session_id,
                    'term_id' => $request->term_id,
                    'tx_ref' => $tx_ref,
                    'txr_id' => $txr_id
                ]);
            }
        }

        $notification = array(
            'message' => 'Manual payment created successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.manualPayments')->with($notification);
    }

    public function manPaymentReceipt(ManualPayments $receipt)
    {
        $authUser = Auth::user();
        return view('admin.payments.receipt', compact('receipt', 'authUser'));
    }

    public function editManualPayment(ManualPayments $manualPayment)
    {

        $authUser = Auth::user();
        return view('admin.payments.edit', compact('manualPayment', 'authUser'));
    }

    public function updateManualPayment(Request $request, ManualPayments $manualPayment)
    {

        $manualPaymentDetail = ManualPayments::find($manualPayment->id);
        $txRef = $manualPaymentDetail->tx_ref;
        $trxID = $manualPaymentDetail->txr_id;

        $request->validate([
            'amount' => 'required|numeric',
            'status' => 'required|in:paid,unpaid',
            'payitem' => 'required|string',
        ]);

        $manualPayment->update([
            'amount' => $request->amount,
            'payitem' => $request->payitem,
            'paymentStatus' => $request->status,
        ]);
        // check transaction table if it exists
        $transaction = Transaction::where('tx_ref', $txRef)->first();
        if ($transaction) {
            $transaction->update([
                'amount' => $request->amount,
                'paymentStatus' => $request->status,
            ]);
        } else {
            // Create a new transaction record
            $transactions = Transaction::create([
                'name' => $request->student_name,
                'email' => $request->guardian_email,
                'student_number' => $request->student_number,
                'amount' => $request->amount,
                'paymentStatus' => 'successful',
                'phone_number' => $request->guardian_phone,
                'guardian_name' => $request->guardian_name,
                'term' => $request->term,
                'session' => $request->session,
                'student_class' => $request->student_class,
                'student_id' => $request->student_id,
                'session_id' => $request->session_id,
                'term_id' => $request->term_id,
                'tx_ref' => $txRef,
                'txr_id' => $trxID
            ]);
        }

        $notification = array(
            'message' => 'Manual payment updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.manualPayments')->with($notification);
    }
    public function deleteManualPayment(ManualPayments $manualPayment)
    {
        $manualPayment->delete();
        $notification = array(
            'message' => 'Manual payment deleted successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.manualPayments')->with($notification);
    }
}
