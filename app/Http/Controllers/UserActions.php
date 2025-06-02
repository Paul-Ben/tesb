<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\FeeSetup;
use App\Models\Guardian;
use App\Models\Registration;
use App\Models\Teacher;

use App\Models\Result;
use App\Models\ResultAffectiveDevelopment;
use App\Models\SchoolSession;
use App\Models\Student;
use App\Models\Term;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserActions extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
        $this->middleware('role:User'); // Restrict access to specific roles
    }

    public function guardianForm()
    {
        $authUser = Auth::user();
        return view('users.guardian.create', compact('authUser'));
    }

    public function storeGuardian(Request $request)
    {
        $authUser = Auth::user();
        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:15',
            'guardian_email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'nationality' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
            'stateoforigin' => 'nullable|string|max:255',
            'lga' => 'nullable|string|max:255',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('guardians', 'public');
        } else {
            $imagePath = null;
        }

        // Create the guardian
        Guardian::create([
            'user_id' => $authUser->id,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
            'guardian_email' => $request->guardian_email,
            'address' => $request->address,
            'nationality' => $request->nationality,
            'image' => $imagePath,
            'stateoforigin' => $request->stateoforigin,
            'lga' => $request->lga,
        ]);

        $notification = array(
            'message' => 'Guardian information saved successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('user.dashboard')->with($notification);
    }

    public function getGuardianStudents()
    {
        $authUser = Auth::user();
        $guardian = Guardian::where('user_id', $authUser->id)->first();
        $students = $guardian->students;
        if ($students) {

            return view('users.guardian.students', compact('students', 'authUser', 'guardian'));
        } else {
            return redirect()->back()->with([
                'message' => 'No student information found.',
                'alert-type' => 'error'
            ]);
        }
    }
    public function showStudent(Student $student)
    {
        $authUser = Auth::user();
        $guardian = Guardian::where('user_id', $authUser->id)->first();
        return view('users.guardian.student', compact('student', 'authUser', 'guardian'));
    }

    public function getResults(Student $student, Result $result)
    {
        $authUser = auth()->user();
        $guardian = Guardian::where('user_id', $authUser->id)->first();
        $results = Result::where('student_id', $student->id)->get();
        if (!$results) {
            return redirect()->back()->with([
                'message' => 'No result found for this student.',
                'alert-type' => 'error',
            ]);
        }
        return view('users.result.index', compact('student', 'results', 'authUser', 'guardian'));
    }

    public function singleResultView(Student $student, Result $result)
    {
        $student = Student::where('id', $result->student_id)->first();

        $checkPayment = $student->transactions()
            ->where('term', $result->term)
            ->where('session', $result->session)
            ->where('student_class', $result->class)
            ->first();

        if (!$checkPayment) {
            return redirect()->back()->with([
                'message' => 'You need to pay your fees before you can view the result.',
                'alert-type' => 'error',
            ]);
        }
        $student = Student::where('id', $result->student_id)->first();
        $age = Carbon::parse($student->date_of_birth)->age;
        $affectiveDevelopment = ResultAffectiveDevelopment::where('result_id', $result->id)->get();
        $table1 = $affectiveDevelopment->take(4);
        $table2 = $affectiveDevelopment->slice(4);

        $classroom = Classroom::with('classCategory')->find($student->class_id);
        $classCategoryName = $classroom->classCategory->name;

        // Define a dynamic mapping between class categories and views
        $categoryViews = [
            'Kindergarten' => 'users.result.show',
            'Primary' => 'users.result.showPrimary',
            'Junior Secondary School' => 'users.result.showJss',
            'Senior Secondary School' => 'users.result.showSs',
        ];

        // Check if the class category exists in the mapping
        if (array_key_exists($classCategoryName, $categoryViews)) {
            return view($categoryViews[$classCategoryName], compact('student', 'result', 'table1', 'table2', 'age'));
        }
        return redirect()->back()->with([
            'message' => 'Classroom category not recognized.',
            'alert-type' => 'error',
        ]);
        // return view('users.result.show', compact('student', 'result', 'table1', 'table2', 'age'));
    }

    public function feeIndex(Student $student)
    {
        
        $authUser = Auth::user();
        $guardian = Guardian::where('user_id', $authUser->id)->first();
        $fees = FeeSetup::where('status', 'active')
        ->where('classroom_id', $student->class_id)
        ->get();
        
        if (!$fees) {
            return redirect()->back()->with([
                'message' => 'No fee setup found.',
                'alert-type' => 'error',
            ]);
        }
        $activeTerm = Term::where('status', 'active')->first();
        if (!$activeTerm) {
            return redirect()->back()->with([
                'message' => 'No active term found.',
                'alert-type' => 'error',
            ]);
        }


        return view('users.fee.index', compact('student', 'activeTerm', 'authUser', 'guardian', 'fees'));
    }

    public function initialize(Request $request)
    {
        // Validate request before processing
        $validated = $request->validate([
            'guardian_email' => 'required|email',
            'student_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'term' => 'required|string|max:255',
            'term_id' => 'required|exists:terms,id',
            'student_class' => 'required|string|max:255',
            'student_number' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:20',
            'session' => 'required|string|max:255',
            'student_id' => 'required|exists:students,id'
        ]);

        // Check for existing registration with more precise query
        $existingRegistration = Transaction::where([
            'student_id' => $validated['student_id'],
            'term_id' => $validated['term_id'],
            'session_id' => $request->session_id,
            'amount' => $request->amount,
            'paymentStatus' => 'successful' // Only check successful payments
        ])->exists();

        if ($existingRegistration) {
            return redirect()->back()->with([
                'message' => 'You have already paid for this pay item this term.',
                'alert-type' => 'error',
            ]);
        }

        DB::beginTransaction();

        try {
            $authUser = Auth::user();
            $txRef = 'TESB-' . time() . '-' . Str::random(8); // More unique reference

            // Create registration record
            $registration = Registration::create([
                'name' => $validated['student_name'],
                'email' => $validated['guardian_email'],
                'student_number' => $validated['student_number'],
                'amount' => $validated['amount'],
                'student_class' => $validated['student_class'],
                'student_id' => $validated['student_id'],
                'paymentStatus' => 'pending',
                'guardian_name' => $authUser->name,
                'phone_number' => $validated['guardian_phone'],
                'term' => $validated['term'],
                'term_id' => $validated['term_id'],
                'session' => $validated['session'],
                'session_id' => $request->session_id,
                'tx_ref' => $txRef
            ]);

            // Initialize payment
            $secretKey = config('app.flutterwave.secret_key');
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $secretKey,
                'Content-Type' => 'application/json',
            ])->timeout(60)
            ->retry(3, 1000)
            ->post('https://api.flutterwave.com/v3/payments', [
                'tx_ref' => $txRef,
                'amount' => $validated['amount'],
                'currency' => 'NGN',
                'redirect_url' => route('payment.callback'),
                'payment_options' => 'card,mobilemoneyghana,ussd',
                'customer' => [
                    'email' => $validated['guardian_email'],
                    'phone_number' => $validated['guardian_phone'],
                    'name' => $validated['student_name'],
                ],
                'customizations' => [
                    'title' => 'TesB Academy Payment',
                    'description' => 'Payment for TesB Academy User Charges',
                    'logo' => asset('frontend/images/logo.png'), // paul change to use logo online from website
                ],
            ]);

            $responseData = $response->json();

            if (!$response->successful() || $responseData['status'] !== 'success') {
                throw new \Exception($responseData['message'] ?? 'Payment initiation failed');
            }

            DB::commit();

            return redirect()->away($responseData['data']['link']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment Error: ' . $e->getMessage(), [
                'student_id' => $request->student_id,
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with([
                'error' => 'Payment processing failed: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    public function paymentCallback(Request $request)
    {
        $txRef = $request->tx_ref;
        $status = $request->status;
        $trxID = $request->transaction_id;

        $payment = Registration::where('tx_ref', $txRef)->first();
        if (!$payment) {
            return redirect()->route('home')->with('error', 'Transaction not found.');
        }
        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . env('FLW_SECRET_KEY'), // Use Flutterwave Secret Key
        //     'Content-Type' => 'application/json',
        // ])->get("https://api.flutterwave.com/v3/transactions/{$txRef}/verify")->json();


        // if ($response['status'] === 'success' && $response['data']['status'] === 'successful')
        if ($status == 'successful') {
            $trxn = Transaction::create([
                'name' => $payment->name,
                'email' => $payment->email,
                'student_number' => $payment->student_number,
                'amount' => $payment->amount,
                'paymentStatus' => $status,
                'phone_number' => $payment->phone_number,
                'guardian_name' => $payment->guardian_name,
                'term' => $payment->term,
                'session' => $payment->session,
                'student_class' => $payment->student_class,
                'student_id' => $payment->student_id,
                'session_id' => $payment->session_id,
                'term_id' => $payment->term_id,
                'tx_ref' => $txRef,
                'txr_id' => $trxID
            ]);
            $payment->update(['paymentStatus' => 'successful']);
            return redirect()->route('home')->with('success', 'Payment successful!');
        }

        $payment->update(['paymentStatus' => 'failed']);
        return redirect()->route('home')->with('error', 'Payment failed.');
    }

    public function generateReceipt(Student $student)
    {
        $authUser = Auth::user();
        $guardian = Guardian::where('user_id', $authUser->id)->first();
        $receipts = $student->transactions()->where('paymentStatus', 'successful')->get();

        if ($receipts->isEmpty()) {
            return redirect()->back()->with([
                'message' => 'No receipt found for this student.',
                'alert-type' => 'error',
            ]);
        }
        return view('users.fee.receipts', compact('student', 'receipts', 'authUser', 'guardian'));
    }

    public function viewReceipt(Transaction $receipt)
    {
        $authUser = Auth::user();
        return view('users.fee.showReceipt', compact('receipt', 'authUser'));
    }
}
// In this code, we have added the following functionalities:
// 1. **Guardian Form**: A form for guardians to fill out their information.
// 2. **Store Guardian**: A method to store the guardian's information in the database.
// 3. **Get Guardian Students**: A method to retrieve and display the students associated with a guardian.
// 4. **Show Student**: A method to display a specific student's information.
// 5. **Get Results**: A method to retrieve and display the results of a specific student.
// 6. **Single Result View**: A method to view a specific result for a student.
// 7. **Fee Index**: A method to display the fee setup for a specific student.
// 8. **Initialize Payment**: A method to initiate a payment for a specific student.
// 9. **Payment Callback**: A method to handle the payment callback from the payment gateway.
// 10. **Generate Receipt**: A method to generate a receipt for a specific student.