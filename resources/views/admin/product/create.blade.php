@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12 py-2"><h2>Add New Product</h1></div>
        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 w-50">
                <label for="title" class="form-label">Product Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Product Title" required>
            </div>
            <div class="mb-3 w-50">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
            </div>
            <div class="mb-3 w-50">
                <label for="image" class="form-label">Product Image</label>
                <input class="form-control" type="file" id="image" name="image" required>
            </div>
            <div class="mb-3 form-check w-50">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked"> Is Active </label>
            </div>
            <select class="form-select mb-3" name="category_id" required>
                <option selected>Please Select Post Category</option>
                <option value="1">Book</option>
                <option value="2">Computer</option>
              </select>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Add New Product</button>
            </div>
        </form>
@endsection
