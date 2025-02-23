<?php

namespace App\Http\Controllers;

use App\Models\ClassCategory;
use App\Models\Classroom;
use App\Models\Role;
use App\Models\SchoolSession;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $users = User::whereNotIn('role_id', [3, 2])->get();
        return view('admin.user.index', compact('users', 'authUser'));
    }

    public function createUser()
    {
        $authUser = Auth::user();
        $roles = Role::all();
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
        User::create($validated);
        Log::info('User created successfully');
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function editUser(User $user)
    {
        $authUser = Auth::user();
        $roles = Role::all();
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
        $classrooms = Classroom::with('classCategory')->get();
        return view('admin.classroom.index', compact('classrooms', 'authUser'));
    }

    public function createClassroom()
    {
        $authUser = Auth::user();
        $classCategories = ClassCategory::all();
        return view('admin.classroom.create', compact('classCategories', 'authUser'));
    }

    public function storeClassroom(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'teacher_name' => 'required'
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
        return view('admin.classroom.edit', compact('classroom', 'classCategories', 'category', 'authUser'));
    }

    public function updateClassroom(Request $request, Classroom $classroom)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'teacher_name' => 'required'
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
            'termName' => 'required',
            'status' => 'required'
        ]);
        $staus = $validated['status'] == 'active' ? 1 : 0;
        SchoolSession::create([
            'sessionName' => $validated['sessionName'],
            'termName' => $validated['termName'],
            'status' => $validated['status'],
            'staus' => $staus
        ]);
        Log::info('Session created successfully');
        return redirect()->route('session.index')->with('success', 'Session created successfully');
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
            'termName' => 'required',
            'status' => 'required'
        ]);
        $staus = $validated['status'] == 'active' ? 1 : 0;
        $schoolsession->update([
            'sessionName' => $validated['sessionName'],
            'termName' => $validated['termName'],
            'status' => $validated['status'],
            'staus' => $staus
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
        $schoolSessions = SchoolSession::all();
        return view('admin.student.create', compact('classrooms', 'schoolSessions', 'authUser'));
    }

    public function storeStudent(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'std_number' => 'required|unique:students',
            'email' => 'required|email|unique:students',
            'date_of_birth' => 'required|date',
            'nationality' => 'required',
            'genotype' => 'required',
            'bgroup' => 'required',
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
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'nationality' => $request->nationality,
            'stateoforigin' => $request->stateoforigin,
            'lga' => $request->lga,
            'genotype' => $request->genotype,
            'bgroup' => $request->bgroup,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
            'guardian_email' => $request->guardian_email,
            'address' => $request->address,
            'class_id' => $request->class_id,
            'current_session' => $request->current_session,
            'image' => $filename ?? null, // Save the image path in the database
        ]);


        return redirect()->route('student.index')->with('success', 'Student created successfully.');
    }

    public function editStudent(Student $student)
    {
        $authUser = Auth::user();
        $classrooms = Classroom::all();
        $schoolSessions = SchoolSession::all();
        $currentSession = SchoolSession::find($student->current_session);

        return view('admin.student.edit', compact('student', 'classrooms', 'currentSession', 'schoolSessions', 'authUser'));
    }

    public function updateStudent(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'std_number' => 'required|unique:students,std_number,' . $student->id,
            'email' => 'required|email|unique:students,email,' . $student->id,
            'date_of_birth' => 'required|date',
            'nationality' => 'required',
            'genotype' => 'required',
            'bgroup' => 'required',
            'class_id' => 'required|exists:classrooms,id',
            'current_session' => 'required|exists:school_sessions,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($student->image && file_exists(public_path('images/' . $student->image))) {
            unlink(public_path('images/' . $student->image));
        }

        $filename = null;
        if ($request->hasFile('image')) {
            $filePath = $request->file('image');
            $filename = time() . '_' . $filePath->getClientOriginalName();
            $image = $filePath->move(public_path('images/'), $filename);
            $file = $request->merge(['file_path' => $filename]);
        }
        $student->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'std_number' => $request->std_number,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'nationality' => $request->nationality,
            'stateoforigin' => $request->stateoforigin,
            'lga' => $request->lga,
            'genotype' => $request->genotype,
            'bgroup' => $request->bgroup,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
            'guardian_email' => $request->guardian_email,
            'address' => $request->address,
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
}
