@extends('layouts.master')

@section('title', 'Update Price Type | Test Project March 2022')

@section('content')

    <div class="card mt-2 w-100 w-lg-50">

        <div class="card-header"><h3>Update Price Type</h3></div>

        @if ($errors->any())
        <div class="alert alert-danger p-1 m-0">
            <ul class="g-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card-body">
            <form action="{{ route('price-type.update', $ptype->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 mt-1">
                    <label for="name" class="form-label">Price Type Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Price Type Name" value="{{ $ptype->name }}">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update Price Type</button>
                </div>
            </form>

        </div>

    </div>

@endsection
