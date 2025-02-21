{{-- @extends('dashboards.admin')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session()->has('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                            role="alert">
                            <span class="font-medium">Info alert!!</span> {{ session('success') }}
                        </div>
                    @endif
                    <div>
                        <h2 class="text-lg font-bold mb-4">Class Student Information</h2>
                        <div>
                            <form action="{{ route('search-class-result') }}" method="GET" class="max-w-md mx-auto">
                                @csrf
                                <label for="default-search"
                                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <select name="search" id="default-search"
                                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Search Student, Class..." required>
                                        <option value="">Select a Class</option>
                                        @foreach ($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit"
                                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="text-right ">
                            <a href="{{ route('student.create') }}">
                                <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    <strong>+</strong> Add Student
                                </button>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="container mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Info alert!!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div>
                        <h2 class="text-lg font-bold mb-4">Class Student Information</h2>
                        <div>
                            <form action="{{ route('search-class-result') }}" method="GET" class="max-w-md mx-auto">
                                @csrf
                                <label for="default-search" class="sr-only">Search</label>
                                <div class="input-group mb-3">
                                    <select name="search" id="default-search" class="form-select" required>
                                        <option value="">Select a Class</option>
                                        @foreach ($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('student.create') }}">
                                <button type="button" class="btn btn-primary">
                                    <strong>+</strong> Add Student
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
@extends('dashboards.admin')
@section('content')
    <!-- Button Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="m-n2 d-flex justify-content-end ">
                    <button type="button" class="btn btn-primary m-2">
                        <a href="{{ route('admin.dashboard') }}" style="color: #fff;">
                            <i class="fa fa-arrow-left me-2"></i>Go Back
                        </a>
                    </button>
                    <button type="button" class="btn btn-primary m-2">
                        <a href="{{ route('student.create') }}" style="color: #fff;">
                            <i class="fa fa-plus me-2"></i>Add
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Button End -->

    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">All Students Lists</h6>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">Reg. No</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Student Class </th>
                                <th scope="col">Gender</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $key => $student)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td><a href="{{route('student.show', $student)}}">{{ $student->std_number }}</a></td>
                                    <td>{{ $student->first_name. " ".$student->last_name }}</td>
                                    <td>{{ $student->classroom->name }}</td>
                                    <td>{{ $student->gender }}</td>
                                    <td>
                                        <div class="nav-item dropdown">
                                            <a href="#" class="nav-link dropdown-toggle"
                                                data-bs-toggle="dropdown">Update</a>
                                            <div class="dropdown-menu">
                                                <a href="{{ route('student.edit', $student) }}"
                                                    class="dropdown-item">Edit</a>
                                                <form action="{{ route('classroom.delete', $student) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="4">No Data Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@endsection