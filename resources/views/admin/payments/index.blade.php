@extends('dashboards.admin')
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
                    {{-- <button type="button" class="btn btn-primary m-2">
                        <a href="{{route('admin.manualPayment.create')}}" style="color: #fff;">
                            <i class="fa fa-arrow-left me-2"></i>Add Payment
                        </a>
                    </button> --}}
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
                    <h6 class="mb-4">Manual Transactions</h6>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">Reg. No</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Student Class </th>
                                <th scope="col">Session</th>
                                <th scope="col">Term</th>
                                <th scope="col">Amount(NGN)</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($manualPayments as $key => $receipt)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td><a href="#">{{ $receipt->student_number }}</a>
                                    </td>
                                    <td>{{ $receipt->name }}</td>
                                    <td>{{ $receipt->student_class }}</td>
                                    <td>{{ $receipt->session }}</td>
                                    <td>{{ $receipt->term }}</td>
                                    <td>{{ $receipt->amount }}</td>
                                    <td>
                                        <div class="nav-item dropdown">
                                            <a href="#" class="nav-link dropdown-toggle"
                                                data-bs-toggle="dropdown">Update</a>
                                            <div class="dropdown-menu">
                                                <a href="{{ route('admin.manualPayment.edit', $receipt) }}"
                                                    class="dropdown-item">Update Payment</a>
                                                <a href="{{ route('admin.manViewReceipt', $receipt) }}"
                                                    class="dropdown-item">View Receipt</a>
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
