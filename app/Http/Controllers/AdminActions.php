<?php

namespace App\Http\Controllers;

use App\Models\ClassCategory;
use App\Models\Classroom;
use App\Models\Role;
use App\Models\SchoolSession;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
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
        $roles = Role::all();
        return view('admin.role', compact('roles'));
    }

    public function viewUsers()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function classCategoryIndex()
    {
        $classCategories = ClassCategory::all();
        return view('admin.classcategory.index', compact('classCategories'));
    }

    public function createclassCategory()
    {
        return view('admin.classcategory.create');
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

        return view('admin.classcategory.edit', compact('classCategory'));
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
        $classrooms = Classroom::with('classCategory')->get();

        return view('admin.classroom.index', compact('classrooms'));
    }

    public function createClassroom()
    {
        $classCategories = ClassCategory::all();
        return view('admin.classroom.create', compact('classCategories'));
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
        $category = ClassCategory::find($classroom->category_id);
        $classCategories = ClassCategory::all();
        return view('admin.classroom.edit', compact('classroom', 'classCategories', 'category'));
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
        $schoolsessions = SchoolSession::all();
        return view('admin.sessions.index', compact('schoolsessions'));
    }

    public function createschoolSession()
    {
        return view('admin.sessions.create');
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
        return view('admin.sessions.edit', compact('schoolsession'));
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
        $students = Student::all();
        return view('admin.student.index', compact('students'));
    }

    public function showStudent(Student $student)
    {
        return view('admin.student.show', compact('student'));
    }

    public function createStudent()
    {
        $classrooms = Classroom::all();
        $schoolSessions = SchoolSession::all();
        return view('admin.student.create', compact('classrooms', 'schoolSessions'));
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
        $classrooms = Classroom::all();
        $schoolSessions = SchoolSession::all();
        $currentSession = SchoolSession::find($student->current_session);

        return view('admin.student.edit', compact('student', 'classrooms', 'currentSession', 'schoolSessions'));
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
        $student->delete();
        return redirect()->route('student.index')->with('success', 'Student deleted successfully.');
    }

    public function viewClassstudents(Classroom $classroom)
    {
        $students = Student::where('class_id', $classroom->id)->get();
        return view('admin.classroom.students', compact('students', 'classroom'));
    }
}
