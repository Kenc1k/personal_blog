@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">

                <h1 align="center" class="mb-5">Categories list</h1>

                <a href="{{ route('category.create') }}" class="btn btn-primary mb-4">Create category</a>
                <table class="table table-dark">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Update</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td><a href="{{ route('category.destroy', $category->id) }}" class="btn btn-danger"
                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $category->id }}').submit();">Delete</a>
                                 <form id="delete-form-{{ $category->id }}" action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: none;">
                                     @csrf
                                     @method('DELETE')
                                 </form>
                             </td>
                             
                             <td><a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning">Update</a></td>
                             
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection