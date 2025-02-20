@extends('layouts.admin.dashboard')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="text-right my-auto p-5">
            <a href="{{route('student.index')}}" class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Back
            </a>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex flex-col lg:flex-row items-center space-y-8 lg:space-y-0 lg:space-x-8">
                
                <!-- Profile Section -->
                <div class="flex-shrink-0">
                    <img class="h-48 w-48 object-cover rounded-full border-4 border-blue-500" 
                         src="{{asset($student->image)}}" 
                         alt="Student Image">
                </div>

                <!-- Student Information -->
                <div class="flex-1">
                    <div class="text-center lg:text-left">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">Student Name: {{$student->last_name." ".$student->middle_name." ".$student->first_name}}</h1>
                        <p class="text-sm text-gray-500 mb-1">Date of Birth: {{$student->date_of_birth}}</p>
                        <p class="text-sm text-gray-500 mb-1">Email: {{$student->email}}</p>
                        <p class="text-sm text-gray-500 mb-1">Class: {{$student->classroom->name}}</p>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="my-6 border-t border-gray-300"></div>

            <!-- Details Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <!-- Student Data -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Student Data</h2>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">First Name:</label>
                        <p class="text-gray-700">{{$student->first_name}}</p>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Middle Name:</label>
                        <p class="text-gray-700">{{$student->middle_name}}</p>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Last Name:</label>
                        <p class="text-gray-700">{{$student->last_name}}</p>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Email:</label>
                        <p class="text-gray-700">{{$student->email}}</p>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Date of Birth:</label>
                        <p class="text-gray-700">{{$student->date_of_birth}}</p>
                    </div>
                </div>

                <!-- Guardian Data -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Guardian Data</h2>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Guardian Name:</label>
                        <p class="text-gray-700">{{$student->guardian_name}}</p>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Guardian Phone:</label>
                        <p class="text-gray-700">{{$student->guardian_phone}}</p>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Guardian Email:</label>
                        <p class="text-gray-700">{{$student->guardian_email}}</p>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Guardian Address:</label>
                        <p class="text-gray-700">{{$student->address}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection