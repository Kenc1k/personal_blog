@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">

                <h1 align="center" class="mb-5">Posts list</h1>

                <a href="{{ route('post.create') }}" class="btn btn-primary mb-4">Create post</a>
                <table class="table table-dark">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Category_id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Text</th>
                        <th scope="col">Image</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Update</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->category_id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->description}}</td>
                                <td>{{$post->text}}</td>
                                <td>
                                    @if ($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" width="100">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                
                                
                                <td><a href="{{ route('post.destroy', $post->id) }}" class="btn btn-danger"
                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $post->id }}').submit();">Delete</a>
                                 <form id="delete-form-{{ $post->id }}" action="{{ route('post.destroy', $post->id) }}" method="POST" style="display: none;">
                                     @csrf
                                     @method('DELETE')
                                 </form>
                             </td>
                             
                             <td><a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning">Update</a></td>
                             
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection