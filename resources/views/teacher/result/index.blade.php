@extends('dashboards.teacher')
@section('content')
<div class="container">
    <h1>Search Students</h1>
    <form method="GET" action="{{ route('search.result') }}">
        <div class="form-group">
            <label for="query">Search by Student Number or Name:</label>
            <input type="text" name="query" id="query" class="form-control" placeholder="Enter student number or name" value="{{ request('query') }}">
        </div>
        <div class="pt-3">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
        
    </form>


</div>
@endsection