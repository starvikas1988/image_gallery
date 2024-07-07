<!-- resources/views/images/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h2 class="mt-3">Edit Image</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" class="form-control">
            <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
        </div>
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" value="{{ $image->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control">{{ $image->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="tag">Tag:</label>
            <input type="text" name="tag" class="form-control" value="{{ $image->tag }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
