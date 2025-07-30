<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report Card</title>
    <link rel="stylesheet" href="{{ asset('results/styles.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <style>
        /* Stamp styling - hidden by default */
        .principal-stamp {
          display: none;
          position: absolute;
          right: 20px;
          bottom: 10px;
          opacity: 0.8;
          z-index: 100;
        }
        
        .stamp-image {
          width: 120px;
          height: auto;
        }
        
        /* Make footer position relative for stamp positioning */
        .footer {
          position: relative;
          margin-top: 50px;
          padding-bottom: 50px;
        }
        
        /* Print-specific styling */
        @media print {
          .principal-stamp {
            display: block !important;
          }
          
          /* Ensure colors and backgrounds print properly */
          body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
          }
        }
      </style>
</head>

<body>
    <div class="report-card">
        <div class="header">
            <div class="school-info">
                <a href="{{url()->previous()}}">
                    <img src="{{ asset('frontend/images/home_logo.png') }}" alt="logo" width="100">
                </a>
                <div>
                    <h1>TES' B ACADEMY</h1>
                    <p>Makurdi, Benue State</p>
                    <p>Student Report Card</p>
                </div>
            </div>
            <div class="student-photo">
                <!-- Placeholder for student photo, replace with actual image if available -->
                <img src="{{ asset('images' . '/' . $student->image) }}" alt="Student Photo" width="100">
            </div>
        </div>

        <div class="student-info">
            <p><strong>Name:</strong> {{ $result->student_name }}</p>
            <p><strong>Age:</strong> {{ $age }}</p>
            <p><strong>Class:</strong> {{ $result->class }}</p>
            <p><strong>Gender:</strong> {{ $student->gender }}</p>
            <p><strong>Term:</strong> {{ $result->term }}</p>
            <p><strong>Session:</strong> {{ $result->session }}</p>
            <p><strong>Attendance:</strong> {{ round(($result->times_present / $result->school_opened) * 100) }} %</p>
            <p><strong>Date: </strong> {{ $result->date }}</p>
        </div>

        <table class="grades-table">
            <thead>
                <tr>
                    <th>Subject</th>
                    {{-- <th>Assignment (10)</th>
                    <th>1st CA (10)</th>
                    <th>2nd CA (10)</th> --}}
                    <th>Total CA (40)</th>
                    <th>Examination (60)</th>
                    <th>Total (100)</th>
                    {{-- <th>Class Average</th> --}}
                    <th>Highest in Class</th>
                    <th>Lowest in Class</th>
                    <th>Position</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($result->subjects as $subject)
                    <tr>
                        <td>{{ $subject->subject }}</td>
                        <td>{{ $subject->ca }}</td>
                        <td>{{ $subject->exam }}</td>
                        <td>{{ $subject->total }}</td>
                        {{-- <td>{{ $subject->class_average }}</td> --}}
                        <td>{{ $subject->highest_in_class }}</td>
                        <td>{{ $subject->lowest_in_class }}</td>
                        <td>{{ $subject->position }}</td>
                        <td>{{ $subject->grade }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div><h3>Skills Assessment</h3></div>
        <div class="skills-assessment">
            {{-- <h3>Skills Assessment</h3> --}}
            <table class="skills-table">
                <thead>
                    <tr>
                        <th>Area</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($table1 as $ad)
                        <tr>
                            <td>{{ $ad->category }}</td>
                            <td>{{ $ad->rating }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="skills-table">
                <thead>
                    <tr>
                        <th>Area</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($table2 as $ad)
                        <tr>
                            <td>{{ $ad->category }}</td>
                            <td>{{ $ad->rating }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="teacher-comments">
            <div class="average-score">
                <h3>Average Score</h3>
                <p>{{ number_format($result->subjects->avg('total'), 2) }}%</p>
            </div>
            <div class="remark">
                <h3>Teacher's Comments</h3>
                <p>{{ $result->teacher_remark }}</p>
            </div>
        </div>

        <div class="footer">
            <p><strong>Teacher's Signature:</strong></p>
            <p><strong>Principal's Signature:</strong>{{ $result->principal_signature }}</p>

            <div class="principal-stamp" id="principalStamp">
                <img src="{{ asset('frontend/images/stamp.jpg') }}" alt="Official Stamp" class="stamp-image">
            </div>
            <p>Date: {{ $result->date }}</p>
        </div>
    </div>
    <div class="button-container">
        <button onclick="window.print()">Print Report Card</button>
        <button id="downloadButton">Download Report Card</button>
        <a href="{{url()->previous()}}"><button>Back</button></a>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show stamp when printing
            window.addEventListener('beforeprint', function() {
                document.getElementById('principalStamp').style.display = 'block';
            });
            
            // Hide stamp after printing (for screen view)
            window.addEventListener('afterprint', function() {
                document.getElementById('principalStamp').style.display = 'none';
            });
            
            // Update download button to show stamp
            document.getElementById('downloadButton').addEventListener('click', function() {
                // Show stamp before capturing
                document.getElementById('principalStamp').style.display = 'block';
                
                // Create a new canvas
                const reportCard = document.querySelector('.report-card');
                
                html2canvas(reportCard, {
                    scale: 2,
                    logging: false,
                    useCORS: true,
                    allowTaint: true
                }).then(canvas => {
                    // Hide stamp again after capture
                    document.getElementById('principalStamp').style.display = 'none';
                    
                    // Convert the canvas to a data URL
                    const dataURL = canvas.toDataURL('image/png');
                    
                    // Create download link
                    const link = document.createElement('a');
                    link.href = dataURL;
                    link.download = 'report_card_' + new Date().toISOString().slice(0,10) + '.png';
                    
                    // Trigger download
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                });
            });
        });
    </script>
    {{-- <script>
        document.getElementById('downloadButton').addEventListener('click', function() {
            // Create a new canvas
            const reportCard = document.querySelector('.report-card');

            html2canvas(reportCard, {
                scale: 2
            }).then(canvas => { // Increase scale for better resolution
                // Convert the canvas to a data URL
                const dataURL = canvas.toDataURL('image/png');

                // Create a dummy link and set the filename
                const link = document.createElement('a');
                link.href = dataURL;
                link.download = 'report_card.png';

                // Append the link to the body, click it, and remove it
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        });
    </script> --}}
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':

                    toastr.options.timeOut = 10000;
                    toastr.info("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();
                    break;
                case 'success':

                    toastr.options.timeOut = 10000;
                    toastr.success("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'warning':

                    toastr.options.timeOut = 10000;
                    toastr.warning("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'error':

                    toastr.options.timeOut = 10000;
                    toastr.error("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
            }
        @endif
    </script>
</body>

</html>
