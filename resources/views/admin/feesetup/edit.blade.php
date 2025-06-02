@extends('dashboards.admin')
@section('content')
    <!-- Button Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="m-n2">
                    <button type="button" class="btn btn-primary m-2">
                        <a href="{{url()->previous()}}" style="color: #fff;">
                            <i class="fa fa-arrow-left me-2"></i>Go Back
                        </a>
                    </button>
                    @if (Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ Session::get('error') }}</li>
                        </ul>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Button End -->

    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Fill All Fields Required</h6>
                    <form action="{{route('fee.update', $fee)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Fee Item Name</label>
                                <input type="text" value="{{$fee->name}}" name="name" class="form-control" required>
                            </div>
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Amount</label>
                                <input type="text" value="{{$fee->amount}}" name="amount" class="form-control" required>
                            </div>
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Term</label>
                                <select name="term_id" id="term" class="form-control" required>
                                    <option value="{{$fee->term_id}}">{{$fee->term->name}}</option>
                                    @foreach ($terms as $term)
                                        <option value="{{$term->id}}">{{Str::ucfirst($term->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Class</label>
                                <select name="classroom_id" id="term" class="form-control" required>
                                    <option value="{{$fee->classroom_id}}">{{$fee->classroom->name}}</option>
                                    @foreach ($classrooms as $classroom)
                                        <option value="{{$classroom->id}}">{{Str::ucfirst($classroom->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-xl-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="{{$fee->status}}">{{$fee->status}}</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div style="text-align: center;">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- Form End -->
@endsection
