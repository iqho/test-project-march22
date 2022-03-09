@extends('layouts.master')
@section('title', 'Add New Product | Test Project March 2022')
@section('content')
<div class="row">
    <div class="col-12 py-2"><h2>Add New Product</h1></div>
        @if ($errors->any())
            <div class="alert alert-danger p-1 m-0">
                <ul class="g-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 w-50">
                <label for="title" class="form-label">Product Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Product Title" value="{{ old('title') }}" required>
            </div>
            <div class="mb-3 w-50">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3 w-50">
                <label for="image" class="form-label">Product Image</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>
            <div class="col-md-12 mb-2">
                <img id="preview-image-before-upload" src="{{ asset('assets/images/image-not-available.jpg') }}"
                    alt="preview image" style="max-height: 95px; max-width:100px">
            </div>
            <div class="mb-3 form-check w-50">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked"> Is Active </label>
            </div>
            <select class="form-select mb-3" name="category_id" required>
                <option selected>Please Select Post Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
              <div class="row mb-3">
                    <div class="col-4">
                        <label for="regular_price" class="form-label">Regular Price</label>
                        <input type="number" class="form-control" name="regular_price" id="regular_price" placeholder="Regular Price"
                            value="{{ old('regular_price') }}" required>
                    </div>
                    <div class="col-4">
                        <label for="wholesale_price" class="form-label">Wholesale Price ( Optional )</label>
                        <input type="number" class="form-control" name="wholesale_price" id="wholesale_price" placeholder="Wholesale Price">
                    </div>
                    <div class="col-4">
                        <label for="active_date" class="form-label">Offer Price Start From ( Optional )</label>
                        <input type="date" class="form-control" name="wholesale_active_date" value="{{ date('Y-m-d') }}" id="wholesale_active_date">
                    </div>
                </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Add New Product</button>
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
