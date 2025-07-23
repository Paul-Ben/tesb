@extends('dashboards.teacher')
@section('content')
    <!-- Button Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="m-n2 d-flex justify-content-end ">
                    <button type="button" class="btn btn-primary m-2">
                        <a href="{{ url()->previous() }}" style="color: #fff;">
                            <i class="fa fa-arrow-left me-2"></i>Go Back
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Button End -->

    <!-- Upload Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Upload Results for {{ $classroom->name }} - {{ $subject->name }}</h6>
                    
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Instructions</h5>
                            <p>Please follow these steps to upload student results:</p>
                            <ol>
                                <li>Download the template CSV file below</li>
                                <li>Fill in the CA and Exam scores for each student</li>
                                <li>Save the file and upload it using the form below</li>
                            </ol>
                            <p><strong>Note:</strong> The CSV file must contain the following columns:</p>
                            <ul>
                                <li><code>student_number</code> - The student's registration number</li>
                                <li><code>student_name</code> - Student's full name (for reference only, not processed during upload)</li>
                                <li><code>ca</code> - Continuous Assessment score</li>
                                <li><code>exam</code> - Examination score</li>
                                <li><code>highest_in_class</code> - Highest score in class for this subject (optional)</li>
                                <li><code>lowest_in_class</code> - Lowest score in class for this subject (optional)</li>
                                <li><code>position</code> - Student's position in class for this subject (optional)</li>
                                <li><code>school_opened</code> - Number of times school opened</li>
                                <li><code>times_present</code> - Number of times student was present</li>
                                <li><code>times_absent</code> - Number of times student was absent</li>
                                <li><code>teacher_remark</code> - Teacher's remark for the student</li>
                                <li><code>date</code> - Date of result (accepts formats: YYYY-MM-DD, DD/MM/YYYY, MM/DD/YYYY, DD-MM-YYYY, etc.)</li>
                                <li><code>punctuality</code> - Affective development rating for punctuality</li>
                                <li><code>neatness</code> - Affective development rating for neatness</li>
                                <li><code>attentiveness</code> - Affective development rating for attentiveness</li>
                                <li><code>participation</code> - Affective development rating for participation</li>
                                <li><code>obedience</code> - Affective development rating for obedience</li>
                                <li><code>honesty</code> - Affective development rating for honesty</li>
                                <li><code>relationship</code> - Affective development rating for relationship with others</li>
                            </ul>
                            
                            <a href="#" class="btn btn-info" id="generateTemplateBtn">Generate Template</a>
                        </div>
                    </div>

                    <div class="mt-4">
                        <form action="{{ route('results.upload.process', ['classroom' => $classroom->id, 'subject' => $subject->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="term_id" class="form-label">Term</label>
                                <select class="form-select" id="term_id" name="term_id" required>
                                    <option value="{{ $term->id }}" selected>{{ $term->name }}</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="session_id" class="form-label">Session</label>
                                <select class="form-select" id="session_id" name="session_id" required>
                                    <option value="{{ $term->schoolSession->id }}" selected>{{ $term->schoolSession->sessionName }}</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="excel_file" class="form-label">Upload Excel/CSV File</label>
                                <input class="form-control" type="file" id="excel_file" name="excel_file" accept=".xlsx,.xls,.csv" required>
                                <div class="form-text">Accepted formats: .xlsx, .xls, .csv (Excel files are recommended for better compatibility)</div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Upload and Process</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Upload Form End -->

    <!-- Template Generation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const generateTemplateBtn = document.getElementById('generateTemplateBtn');
            
            generateTemplateBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Create CSV content
                let csvContent = "student_number,student_name,ca,exam,highest_in_class,lowest_in_class,position,school_opened,times_present,times_absent,teacher_remark,date,punctuality,neatness,attentiveness,participation,obedience,honesty,relationship\n";
                
                // Add a row for each student
                @foreach($students as $student)
                    csvContent += "{{ $student->std_number }},\"{{ $student->first_name }} {{ $student->last_name }}\",0,0,0,0,0,0,0,0,,{{ date('Y-m-d') }},,,,,,,,\n";
                @endforeach
                
                // Create a Blob with the CSV content
                const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                
                // Create a download link
                const link = document.createElement("a");
                const url = URL.createObjectURL(blob);
                
                link.setAttribute("href", url);
                link.setAttribute("download", "{{ $classroom->name }}_{{ $subject->name }}_template.csv");
                link.style.visibility = 'hidden';
                
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        });
    </script>
@endsection