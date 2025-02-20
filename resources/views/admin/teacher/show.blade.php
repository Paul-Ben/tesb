@extends('layouts.admin.dashboard')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex flex-col lg:flex-row items-center space-y-8 lg:space-y-0 lg:space-x-8">
                
                <!-- Profile Section -->
                <div class="flex-shrink-0">
                    <img class="h-48 w-48 object-cover rounded-full border-4 border-blue-500" 
                         src="/path/to/student_image.jpg" 
                         alt="Student Image">
                </div>

                <!-- Student Information -->
                <div class="flex-1">
                    <div class="text-center lg:text-left">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">Student Name: John Doe</h1>
                        <p class="text-sm text-gray-500 mb-1">Date of Birth: January 1, 2005</p>
                        <p class="text-sm text-gray-500 mb-1">Email: johndoe@email.com</p>
                        <p class="text-sm text-gray-500 mb-1">Class: Grade 10</p>
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
                        <p class="text-gray-700">John</p>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Middle Name:</label>
                        <p class="text-gray-700">Michael</p>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Last Name:</label>
                        <p class="text-gray-700">Doe</p>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Email:</label>
                        <p class="text-gray-700">johndoe@email.com</p>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Date of Birth:</label>
                        <p class="text-gray-700">January 1, 2005</p>
                    </div>
                </div>

                <!-- Guardian Data -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Guardian Data</h2>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Guardian Name:</label>
                        <p class="text-gray-700">Jane Doe</p>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Guardian Phone:</label>
                        <p class="text-gray-700">123-456-7890</p>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Guardian Email:</label>
                        <p class="text-gray-700">janedoe@email.com</p>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Guardian Address:</label>
                        <p class="text-gray-700">123 Main St, City, Country</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection