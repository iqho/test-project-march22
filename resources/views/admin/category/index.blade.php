@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12"><h2>All Categories</h1></div>
    <div class="table-responsive w-100">
        <table class="table table-striped table-sm w-50">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Category Name</th>
            </tr>
          </thead>
          <tbody>
              @php
                  $i = 1;
              @endphp
              @foreach ($categories as $category)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $category->name }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection
