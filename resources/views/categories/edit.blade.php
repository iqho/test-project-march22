@extends('layouts.master')
@section('title', 'Update Category | Test Project March 2022')
@section('content')
<div class="row g-0 w-50">
    <div class="col-12 my-2"><h2>Update Category</h1></div>
        @if ($errors->any())
            <div class="alert alert-danger p-1 m-0">
                <ul class="g-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 mt-1">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Category Name" value="{{ $category->name }}">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Update Category</button>
              </div>
        </form>
</div>
@endsection
