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

                <div class="col-md-12 mb-2">
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
                </div>

                @foreach ($product->productPrices as $row)

                @if ($row->price)

                <div class="row prices g-0">

                    @if ($loop->first)

                        <div class="row g-0 d-flex align-items-end">
                            <div class="col-md-3 col-12 g-0" style="padding-right:5px!important">
                                <label for="price_type_id" class="form-label">Product Price Type</label>
                            </div>

                            <div class="col-md-3 col-12 g-0" style="padding-right:5px!important">
                                <label for="price" class="form-label">Price</label>
                            </div>

                            <div class="col-md-4 col-12 g-0" style="padding-right:5px!important">
                                <label for="active_date" class="form-label">Price Active From</label>
                            </div>

                            <div class="col-md-2 col-12 d-flex align-items-end g-0">
                                <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus"
                                        aria-hidden="true"></span> Add More</a>
                            </div>
                        </div>

                    @endif

                    <input type="hidden" value="{{ $row->id }}" name="product_price_id[]" />

                    <div class="col-md-3 col-12 g-0" style="margin-top:5px!important; padding-right:5px!important">

                        <select class="form-select" name="price_type_id[]" id="price_type_id">
                            <option value="{{ $row->priceType->id }}" selected>{{ $row->priceType->name }}</option>
                            @foreach ($price_types as $ptype)
                            <option value="{{ $ptype->id }}">{{ $ptype->name }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="col-md-3 col-12 g-0" style="margin-top:5px!important; padding-right:5px!important">
                        <input type="number" min="0" class="form-control" name="price[]" id="price" placeholder="Price"
                                value="{{ $row->price }}">
                    </div>

                    <div class="col-md-4 col-12 g-0" style="margin-top:5px!important; padding-right:5px!important">
                        <input type="date" class="form-control" name="active_date[]" value="{{ $row->active_date }}"
                            id="active_date">
                    </div>

                    <div class="col-md-2 col-12 d-flex align-items-end g-0" style="margin-top:5px!important;">
                        <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove"
                                aria-hidden="true"></span> Remove</a>
                    </div>


                </div>

                @else

                {{-- <div class="row prices g-0">

                    <div class="col-md-3 col-12 g-0" style="padding-right:5px!important">
                        <label for="price_type_id" class="form-label">Product Price Type</label>

                        <select class="form-select" name="price_type_id[]" id="price_type_id">
                            <option value="" selected>Select Price Type</option>
                            @foreach ($price_types as $ptype)
                            <option value="{{ $ptype->id }}">{{ $ptype->name }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="col-md-3 col-12 g-0" style="padding-right:5px!important">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" min="0" class="form-control" name="price[]" id="price" placeholder="Price"
                                value="{{ old('price[]') }}">
                    </div>

                    <div class="col-md-4 col-12 g-0" style="padding-right:5px!important">
                        <label for="active_date" class="form-label">Price Active From</label>
                        <input type="date" class="form-control" name="active_date[]" value="{{ date('Y-m-d') }}"
                            id="active_date">
                    </div>

                    <div class="col-md-2 col-12 d-flex align-items-end g-0">
                        <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus"
                                aria-hidden="true"></span> Add More</a>
                    </div>

                </div> --}}

                @endif

                @endforeach



                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>

            </form>

            <!-- For Add New Input Row -->
            <div class="row pricesCopy" style="display: none;">

                <div class="col-md-3 col-12 g-0" style="padding-right:5px!important">

                    <select class="form-select" name="price_type_id[]" id="price_type_id">
                        <option value="" selected>Select Price Type</option>
                        @foreach ($price_types as $ptype)
                        <option value="{{ $ptype->id }}">{{ $ptype->name }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="col-md-3 col-12 g-0" style="padding-right:5px!important">
                    <input type="number" min="0" class="form-control" name="price[]" id="price" placeholder="Price"
                            value="{{ old('price[]') }}">
                </div>

                <div class="col-md-4 col-12 g-0" style="padding-right:5px!important">
                    <input type="date" class="form-control" name="active_date[]" value="{{ date('Y-m-d') }}"
                        id="active_date">
                </div>

                <div class="col-md-2 col-12 d-flex align-items-end g-0">
                    <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove"
                            aria-hidden="true"></span> Remove</a>
                </div>

            </div>


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

                // Hide Message After 5 Sec
                $("#successMessage").delay(5000).slideUp(300);

                //add more fields group
                $(".addMore").click(function(){
                        var fieldHTML='<div class="row prices g-0" style="margin-top:5px!important">'
                        +$(".pricesCopy").html()+'</div>';
                        $('body').find('.prices:last').after(fieldHTML);
                    });

                //remove fields group
                $("body").on("click",".remove",function(){
                        $(this).parents(".prices").remove();
                    });

            });
        </script>
@endsection
