@extends('layouts.master')

@section('title', 'Update Product | Test Project March 2022')

@section('content')
<div class="card mt-2 w-100 w-lg-75">

    <div class="card-header"><h2>Update Product</h1></div>

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
            <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Product Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Product Title" value="{{ $product->title }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3">{{ $product->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <input class="form-control" type="file" id="image" name="image">
                </div>

                <div class="col-md-12 mb-2">
                    <img id="preview-image-before-upload" src="@if($product->image) {{ asset('product-images/'.$product->image) }} @else {{ asset('assets/images/image-not-available.jpg') }} @endif"
                    alt="preview image" style="max-height: 95px; max-width:100px">
                </div>

                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="flexCheckChecked" @if($product->is_active == 1) checked @endif>
                    <label class="form-check-label" for="flexCheckChecked"> Is Active </label>
                </div>

                <label for="category_id" class="form-label">Product Category</label>
                <select class="form-select mb-3" id="category_id" name="category_id">
                    @if($product->category)
                    <option value="{{ $product->category->id }}" selected>{{ $product->category->name }}</option>
                    @else
                    <option value="" selected>Please Select Product Category</option>
                    @endif
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <div class="row mb-3">
                    <div class="col-md-4 col-12">
                        <label for="price_type_id" class="form-label">Product Price Type</label>
                        <select class="form-select" name="price_type_id[]" id="price_type_id">
                            <option value="" selected>Please Select Product Price Type</option>
                            @foreach ($price_types as $ptype)
                            <option value="{{ $ptype->id }}">{{ $ptype->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" min="0" class="form-control" name="price[]" id="price" placeholder="Price"
                                value="{{ old('price[]') }}">
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="active_date" class="form-label">Price Active From</label>
                        <input type="date" class="form-control" name="active_date[]" value="{{ date('Y-m-d') }}"
                            id="active_date">
                    </div>
                </div>


                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>

            </form>
        </div>
</div>
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
