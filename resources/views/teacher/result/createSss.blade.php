@extends('dashboards.teacher')
@section('content')
    <script type="importmap">
    {
      "imports": {
        "uuid": "https://jspm.dev/uuid"
      }
    }
  </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script type="module">
        import { v4 as uuidv4 } from 'uuid';
    
        document.addEventListener('DOMContentLoaded', () => {
            // Get subjects passed from Laravel controller
            const subjects = @json($subjects);
            
            // Generate subject options HTML
            const subjectOptions = subjects.map(subject => 
                `<option value="${subject.name}">${subject.name}</option>`
            ).join('');
    
            const addSubjectButton = document.getElementById('addSubject');
            const subjectTableBody = document.querySelector('.academic-performance tbody');
            const uploadButton = document.getElementById('uploadButton');
            const fileInput = document.getElementById('fileInput');
    
            addSubjectButton.addEventListener('click', () => {
                const newRowId = uuidv4();
                const newRow = document.createElement('tr');
                newRow.setAttribute('data-subject-id', newRowId);
                newRow.innerHTML = `
                    <td>
                        <select name="subject[]" class="form-control subject-select" required>
                            <option value="">Select Subject</option>
                            ${subjectOptions}
                        </select>
                    </td>
                    <td><input type="number" name="ca[]" class="form-control ca-input" max="40" min="0"></td>
                    <td><input type="number" name="exam[]" class="form-control exam-input" max="60" min="0"></td>
                    <td><span class="total">0</span></td>
                    <td><input type="number" name="lowest_in_class[]" class="form-control"></td>
                     <td><input type="number" name="highest_in_class[]" class="form-control"></td>
                    <td><input type="number" name="position[]" class="form-control"></td>
                    <td><span class="grade">F</span></td>
                    <td><input type="text" name="remark[]" class="form-control remark-input"></td>
                    <td><button type="button" class="remove-subject btn btn-danger">Remove</button></td>
                `;
                subjectTableBody.appendChild(newRow);
    
                // Add event listeners for the new row
                const removeButton = newRow.querySelector('.remove-subject');
                removeButton.addEventListener('click', () => {
                    newRow.remove();
                });
    
                const caInput = newRow.querySelector('.ca-input');
                const examInput = newRow.querySelector('.exam-input');
                
                const calculateTotalAndGrade = () => {
                    const ca = parseInt(caInput.value) || 0;
                    const exam = parseInt(examInput.value) || 0;
                    const total = ca + exam;
                    newRow.querySelector('.total').textContent = total;
    
                    let grade = '';
                    if (total >= 90) grade = 'A';
                    else if (total >= 70) grade = 'B';
                    else if (total >= 60) grade = 'C';
                    else if (total >= 50) grade = 'D';
                    else grade = 'F';
                    
                    newRow.querySelector('.grade').textContent = grade;
                };
    
                caInput.addEventListener('input', calculateTotalAndGrade);
                examInput.addEventListener('input', calculateTotalAndGrade);
            });
    
            // Event delegation for existing rows
            subjectTableBody.addEventListener('input', function(e) {
                if (e.target.classList.contains('ca-input') || e.target.classList.contains('exam-input')) {
                    const row = e.target.closest('tr');
                    const ca = parseInt(row.querySelector('.ca-input').value) || 0;
                    const exam = parseInt(row.querySelector('.exam-input').value) || 0;
                    const total = ca + exam;
                    row.querySelector('.total').textContent = total;
    
                    let grade = '';
                    if (total >= 90) grade = 'A';
                    else if (total >= 70) grade = 'B';
                    else if (total >= 60) grade = 'C';
                    else if (total >= 50) grade = 'D';
                    else grade = 'F';
                    
                    row.querySelector('.grade').textContent = grade;
                }
            });
    
            uploadButton.addEventListener('click', () => {
                fileInput.click();
            });
    
            fileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    alert('File uploaded: ' + file.name);
                }
            });
        });
    </script>
    <div class="bg-light">
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

        <form action="{{ route('results.store', $student) }}" method="post">
            @csrf
            <div class="report-card container w-4/5 max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 mt-5">
                <header class="report-header row justify-content-between align-items-center mb-4">
                    <div class="school-info col-md-4">
                        <p><strong>STUDENT NO.:</strong> <input type="text" name="student_number"
                                value="{{ $student->std_number }}" placeholder="Student Number" class="form-control" readonly></p>
                        <input type="text" name="student_id" value="{{ $student->id }}" hidden>
                        <p><strong>STATE:</strong> <input type="text" value="{{ $student->stateoforigin }}"
                                placeholder="State" class="form-control" readonly></p>
                    </div>
                    <div class="student-info col-md-4">
                        <p><strong>STUDENT'S NAME:</strong> <input type="text" name="student_name"
                                value="{{ $student->first_name . ' ' . $student->last_name }}" placeholder="Student Name"
                                class="form-control" readonly></p>
                        <p><strong>CLASS:</strong> <input type="text" name="class"
                                value="{{ $student->classroom->name }}" placeholder="Class" class="form-control" readonly>
                                <input type="text" name="classCategory" value="{{$student->classroom->classCategory->name}}" hidden></p>
                    </div>
                    <div class="term-info col-md-4">
                        <p><strong>TERM:</strong> <input type="text" name="term"
                                value="{{ Str::ucfirst($term->name) }}" placeholder="Term" class="form-control" readonly></p>
                        <p><strong>SESSION:</strong> <input type="text" name="session"
                                value="{{ $term->schoolSession->sessionName }}" placeholder="Session" class="form-control" readonly>
                        </p>
                    </div>
                </header>

                <section class="attendance mb-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="border p-2">No. of Times School Opened</th>
                                <th class="border p-2">No. of Times Present</th>
                                <th class="border p-2">No. of Times Absent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border p-2"><input type="number" name="school_opened" class="form-control" required required min="1" pattern="[1-9]\d*" inputmode="numeric"></td>
                                <td class="border p-2"><input type="number" name="times_present" class="form-control" required></td>
                                <td class="border p-2"><input type="number" name="times_absent" class="form-control" required></td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section class="academic-performance mb-4">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th class="border p-2">SUBJECT</th>
                                <th class="border p-2">C.A. (30%)</th>
                                <th class="border p-2">EXAM (70%)</th>
                                <th class="border p-2">TOTAL (100%)</th>
                                <th class="border p-2">LOWEST IN CLASS</th>
                                <th class="border p-2">HIGHEST IN CLASS</th>
                                <th class="border p-2">POSITION</th>
                                <th class="border p-2">GRADE</th>
                                <th class="border p-2">SUBJECT TEACHER'S REMARK</th>
                                <th class="border p-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-subject-id="1">
                                {{-- <td><input type="text" name="subject[]" class="form-control subject-input"></td> --}}
                                <td>
                                    <select name="subject[]" class="form-control subject-select">
                                        <option value="">Select Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->name }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" name="ca[]" class="form-control ca-input" max="30"></td>
                                <td><input type="number" name="exam[]" class="form-control exam-input" max="70">
                                </td>
                                <td><span class="total"></span></td>
                                <td><input type="number" name="lowest_in_class[]" class="form-control"></td>
                                <td><input type="number" name="highest_in_class[]" class="form-control"></td>
                                <td><input type="number" name="position[]" class="form-control"></td>
                                <td><span class="grade"></span></td>
                                <td><input type="text" name="remark[]" class="form-control remark-input"></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" id="addSubject" class="btn btn-primary">Add Subject</button>
                </section>

                <section class="affective-development mb-4">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th class="border p-2">AFFECTIVE DEVELOPMENT</th>
                                <th class="border p-2">RATING</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border p-2">Punctuality</td>
                                <td class="border p-2"><input type="text" name="punctuality" class="form-control"></td>
                            </tr>
                            <tr>
                                <td class="border p-2">Neatness</td>
                                <td class="border p-2"><input type="text" name="neatness" class="form-control"></td>
                            </tr>
                            <tr>
                                <td class="border p-2">Attentiveness</td>
                                <td class="border p-2"><input type="text" name="attentiveness" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td class="border p-2">Participation in Class Activities</td>
                                <td class="border p-2"><input type="text" name="participation" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td class="border p-2">Obedience</td>
                                <td class="border p-2"><input type="text" name="obedience" class="form-control"></td>
                            </tr>
                            <tr>
                                <td class="border p-2">Honesty</td>
                                <td class="border p-2"><input type="text" name="honesty" class="form-control"></td>
                            </tr>
                            <tr>
                                <td class="border p-2">Relationship with Others</td>
                                <td class="border p-2"><input type="text" name="relationship" class="form-control">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section class="grading-key mb-4">
                    <p><strong>GRADING KEY:</strong></p>
                    <ul>
                        <li>90-100 = A (Excellent)</li>
                        <li>70-79 = B (Good)</li>
                        <li>60-69 = C (Credit)</li>
                        <li>50-59 = D (Pass)</li>
                        <li>0-49 = F (Fail)</li>
                    </ul>
                </section>

                <footer class="report-footer row justify-content-between align-items-start">
                    <div class="teacher-remark col-md-6">
                        <p><strong>TEACHER'S REMARK:</strong></p>
                        <textarea name="teacher_remark" class="form-control"></textarea>
                    </div>
                    <div class="principal-signature col-md-6">
                        <p><strong>PRINCIPAL'S SIGNATURE:</strong> <input type="text" name="principal_signature"
                                placeholder="Signature" class="form-control"></p>
                        <p><strong>DATE:</strong> <input type="date" name="date" class="form-control"></p>
                    </div>
                </footer>

                <div class="mt-4">
                    <button type="submit" id="uploadButton" class="btn btn-success">Upload Result</button>
                    {{-- <input type="file" id="fileInput" style="display:none"> --}}
                </div>
            </div>
        </form>
    </div>
@endsection
