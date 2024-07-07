<!-- resources/views/images/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <a href="{{ route('images.create') }}" class="btn btn-primary mb-3">Upload Image</a>
        </div>
    </div>

    <div class="row">
        @foreach($images as $image)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('storage/' . $image->image_url) }}" class="card-img-top" alt="{{ $image->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $image->title }}</h5>
                        <p class="card-text">{{ $image->description }}</p>
                        <p class="card-text"><small class="text-muted">Tag: {{ $image->tag }}</small></p>
                        <a href="{{ route('images.show', $image->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('images.edit', $image->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('images.destroy', $image->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
