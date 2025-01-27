@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold text-center text-white">Welcome to the Photo Gallery</h1>
    <p class="text-center mt-4 text-lg text-white">Upload, view, and manage your photos in one place.</p>

    @auth
    <!-- Upload Form -->
    <div class="mt-8">
        <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-4 max-w-md mx-auto bg-white shadow-md p-6 rounded-lg">
            @csrf
            <input 
                type="text" 
                name="title" 
                placeholder="Photo Title" 
                class="border p-2 rounded focus:outline-none focus:ring focus:ring-purple-300" 
                required>
            <input 
                type="file" 
                name="photo" 
                class="border p-2 rounded focus:outline-none focus:ring focus:ring-purple-300" 
                required>
            <button 
                type="submit" 
                class="bg-gradient-to-r from-purple-500 to-pink-500 text-black px-4 py-2 rounded hover:shadow-lg transition">
                Upload Photo
            </button>
        </form>
    </div>
    @endauth

    <!-- Display errors -->
    @if ($errors->any())
    <div class="mt-6 max-w-md mx-auto">
        <ul class="list-disc list-inside text-red-500 bg-red-100 p-4 rounded">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Photo Gallery -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-10">
        @forelse($photos as $photo)
        <div class="relative group bg-white shadow-md rounded overflow-hidden">
            <img 
                src="{{ asset('storage/photos' . $photo->file_path) }}" 
                alt="{{ $photo->title }}" 
                class="w-full h-48 object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
                <form action="{{ route('photos.destroy', $photo) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit" 
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @empty
        <p class="text-center text-gray-500 col-span-3">No photos found. Start uploading!</p>
        @endforelse
    </div>
</div>
@endsection
