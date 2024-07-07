<!-- resources/views/images/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h2 class="mt-3">{{ $image->title }}</h2>
    <img src="{{ asset('storage/' . $image->image_url) }}" class="img-fluid" alt="{{ $image->title }}">
    <p class="mt-3">{{ $image->description }}</p>
    <p class="text-muted">Tag: {{ $image->tag }}</p>
    <a href="{{ route('images.index') }}" class="btn btn-primary">Back to Gallery</a>
@endsection
