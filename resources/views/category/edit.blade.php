@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <h1>Edit Category</h1>

        <form action="{{ route('category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
@endsection
