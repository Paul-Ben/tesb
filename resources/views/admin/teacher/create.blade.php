@extends('layouts.admin.dashboard')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data" class="max-w-full mx-auto">
                        @csrf
                        <!-- Student Data -->
                        <h2 class="text-lg font-bold mb-5">Student Data</h2>
                        <div class="grid grid-cols-3 gap-6">
                            <div class="mb-5">
                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                                <input type="text" id="first_name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="First Name" required />
                            </div>
                            <div class="mb-5">
                                <label for="middle_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Name</label>
                                <input type="text" id="middle_name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Middle Name" />
                            </div>
                            <div class="mb-5">
                                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                                <input type="text" id="last_name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Last Name" required />
                            </div>
                            <div class="mb-5">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student Email</label>
                                <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="email@email.com" required />
                            </div>
                            <div class="mb-5">
                                <label for="date_of_birth" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Birth</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                            </div>
                            <div class="mb-5">
                                <label for="passport" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Passport</label>
                                <input type="file" id="passport" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
                            </div>
                            <div class="mb-5">
                                <label for="class_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student Class</label>
                                <select name="class_id" id="class_id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
                                    <option value="">Select a Class</option>
                                </select>
                            </div>
                        </div>
    
                        <!-- Guardian Data -->
                        <h2 class="text-lg font-bold mb-5 mt-8">Guardian Data</h2>
                        <div class="grid grid-cols-3 gap-6">
                            <div class="mb-5">
                                <label for="guardian_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guardian Name</label>
                                <input type="text" id="guardian_name" name="guardian_name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Guardian Name" />
                            </div>
                            <div class="mb-5">
                                <label for="guardian_phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guardian Phone</label>
                                <input type="text" id="guardian_phone" name="guardian_phone" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="080 ********" />
                            </div>
                            <div class="mb-5">
                                <label for="guardian_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guardian Email</label>
                                <input type="email" id="guardian_email" name="guardian_email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="guardian@email.com" />
                            </div>
                            <div class="mb-5 col-span-2">
                                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guardian Address</label>
                                <textarea name="address" id="address" cols="30" rows="3" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"></textarea>
                            </div>
                        </div>
    
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
