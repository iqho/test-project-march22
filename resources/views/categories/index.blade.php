@extends('layouts.master')
@section('title', 'All Categories | Test Project March 2022')
@section('content')
<div class="row g-0 w-50">
    <div class="col-12"><h2>All Categories</h1></div>

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
              <th>Category Name</th>
              <th style="text-align:center">Action</th>
            </tr>
          </thead>
          <tbody>
              @php
                  $i = 1;
              @endphp
              @foreach ($categories as $category)
            <tr>
              <td class="align-middle">{{ $i++ }}</td>
              <td class="align-middle">{{ $category->name }}</td>
              <td style="max-width: 150px; text-align:center">
                <div class="btn-group" role="group">
                <a class="btn btn-primary me-1" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
