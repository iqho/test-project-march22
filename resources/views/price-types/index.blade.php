@extends('layouts.master')

@section('title', 'All Price Types | Test Project March 2022')

@section('content')
    <div class="card mt-2 w-100 w-lg-50">
        <div class="card-header"><h3>All Price Type</h3></div>
        <div class="card-body">

            <div class="row">
                <div class="col-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show p-2 m-3" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Price Type Name</th>
                                    <th style="text-align:right; padding-right:50px">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php $i = 1; @endphp

                                @foreach ($priceTypes as $ptype)
                                <tr>
                                    <td class="align-middle">{{ $i++ }}</td>
                                    <td class="align-middle">{{ $ptype->name }}</td>
                                    <td style="max-width: 150px; text-align:right">
                                        <div class="btn-group" role="group">
                                            <a class="btn btn-primary me-1" href="{{ route('price-type.edit', $ptype->id) }}">Edit</a>

                                            <form action="{{ route('price-type.destroy', $ptype->id) }}" method="DELETE">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-block">Delete</button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div> <!-- Close Responsive Table -->
                </div>
            </div> <!-- Close Table Row -->
            
        </div>
    </div>
@endsection
