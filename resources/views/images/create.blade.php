<!-- resources/views/images/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h2 class="mt-3">Upload Image</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- <div class="form-group">
            <label for="show-image">To be uploaded Image:</label>
            <img src="{{  }}" />
        </div> --}}
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="tag">Tag:</label>
            <input type="text" name="tag" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Upload</button>
    </form>
@endsection
