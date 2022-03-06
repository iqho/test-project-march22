@extends('layouts.master')
@section('title', 'Update Product | Test Project March 2022')
@section('content')
<div class="row">
    <div class="col-12 py-2"><h2>Update Product</h1></div>
        @if ($errors->any())
            <div class="alert alert-danger p-1 m-0">
                <ul class="g-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 w-50">
                <label for="title" class="form-label">Product Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Product Title" value="{{ $product->title }}" required>
            </div>
            <div class="mb-3 w-50">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" required>{{ $product->description }}</textarea>
            </div>
            <div class="mb-3 w-50">
                <label for="image" class="form-label">Product Image</label>
                <input class="form-control" type="file" id="image" name="image">
                <label for="preview-image-before-upload" class="form-label">Product Image</label><br>
                <img id="preview-image-before-upload" src="{{ asset('product-images/'.$product->image) }}" alt="{{ $product->title }}" width="75" height="70">
            </div>
            <div class="mb-3 form-check w-50">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="flexCheckChecked" @if($product->is_active == 1) checked @endif>
                <label class="form-check-label" for="flexCheckChecked"> Is Active </label>
            </div>
            <label for="category_id" class="form-label">Product Category</label>
            <select class="form-select mb-3" id="category_id" name="category_id"  required>
                <option value="{{ $product->category->id }}" selected>{{ $product->category->name }}</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Update Product</button>
            </div>
        </form>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function (e) {
           $('#image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
              $('#preview-image-before-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
           });
        });
        </script>
@endsection
