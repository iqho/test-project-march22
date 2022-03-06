@extends('layouts.master')
@section('title', 'All Products | Test Project March 2022')
@section('content')
<div class="row g-0 w-100">
    <div class="col-12"><h2>All Products</h1></div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show p-2" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Product Title</th>
              <th>Product Description</th>
              <th class="text-center">Product Image</th>
              <th class="text-center">Active Status</th>
              <th class="text-center">Category</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
              @php
                  $i = 1;
              @endphp
              @foreach ($products as $product)
            <tr>
              <td class="align-middle text-center">{{ $i++ }}</td>
              <td class="align-middle">{{ $product->title }}</td>
              <td class="align-middle">{{ $product->description }}</td>
              <td class="align-middle text-center"><img src="{{ asset('product-images/'.$product->image) }}" alt="{{ $product->title }}" height="40" width="45"> </td>
              <td class="align-middle text-center">
                    @if ($product->is_active == 1)
                        <button class="btn btn-success">Active</button>
                    @else
                        <button class="btn btn-danger">Inactive</button>
                    @endif
              </td>
              <td class="align-middle text-center">
                  @if ($product->category->name)
                    {{ $product->category->name }}
                    @else
                    <h5>No Category Found</h5>
                  @endif

                </td>
              <td class="align-middle text-center">
                <div class="btn-group" role="group">
                <a class="btn btn-primary me-1" href="{{ route('products.edit', $product->id) }}">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-block">Delete</button>
                </form>
                </div>
            </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection
