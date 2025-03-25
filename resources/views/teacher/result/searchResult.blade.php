@extends('dashboards.teacher')
@section('content')
<div class="container">
    <h1>Search Students</h1>
    <form method="GET" action="{{ route('result.index') }}">
        <div class="form-group">
            <label for="query">Search by Student Number or Name:</label>
            <input type="text" name="query" id="query" class="form-control" placeholder="Enter student number or name" value="{{ request('query') }}">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    @if($students->count() > 0)
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Student Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->std_number }}</td>
                        <td>{{ $student->first_name. ' '. $student->last_name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            <a href="{{route('view.result', $student)}}" class="btn btn-info btn-sm">View Details</a>
                            <a href="{{route('create.result', $student)}}" class="btn btn-success btn-sm">Add Result</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- {{ $students->links() }} --}}
    @else
        <p class="mt-4">No students found.</p>
    @endif
</div>
@endsection