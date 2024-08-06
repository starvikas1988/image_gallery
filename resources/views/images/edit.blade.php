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
      {{-- <?php // dd($image); ?> --}}
    <form action="{{ route('images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="current_image">Current Image</label>
            <img id="currentImage" src="{{ asset('storage/' . $image->image_url) }}" alt="Current Image" style="display: block; width: 200px; height: auto;"/>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
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
    <script>
        function previewImage(event) {
            var reader1 = new FileReader();
            reader1.onload = function(){
                var output = document.getElementById('imagePreview');
                output.src = reader1.result;
                output.style.display = 'block';
            };
            reader1.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
