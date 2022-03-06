@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12 my-2"><h2>Add New Category</h1></div>
        <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 w-50">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Category Name">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Add Category</button>
              </div>
        </form>
@endsection
