@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6">
    <h1 class="text-3xl font-bold text-center">Welcome to the Photo Gallery</h1>
    <p class="text-center mt-2 text-gray-600">Easily upload, view, and manage your photos.</p>

    @auth
    <!-- Upload Form -->
    <div class="mt-6">
        <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-4 max-w-md mx-auto">
            @csrf
            <input type="text" name="title" placeholder="Photo Title" class="border p-2 rounded" required>
            <input type="file" name="photo" class="border p-2 rounded" required>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Upload Photo</button>
        </form>
    </div>
    @endauth

    <!-- Photo Gallery -->
    <div class="grid grid-cols-3 gap-4 mt-10">
        @foreach($photos as $photo)
        <div class="relative group">
            <img src="{{ asset('storage/' . $photo->file_path) }}" alt="{{ $photo->title }}" class="rounded shadow">
            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
                <form action="{{ route('photos.destroy', $photo) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection