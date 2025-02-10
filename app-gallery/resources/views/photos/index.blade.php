@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6 animate-fade-in">
    <h1 class="text-3xl font-bold text-center text-white">Photo Gallery</h1>
    <p class="text-center mt-4 text-white">Browse your photos below.</p>

    <!-- Úspěšná zpráva -->
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded my-4 max-w-md mx-auto text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Galerie fotek -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-10">
        @forelse($photos as $photo)
        <div class="relative group animate-slide-up transition-all duration-300 transform hover:scale-105">
            <img 
                src="{{ asset('storage/' . $photo->file_path) }}" 
                alt="{{ $photo->title }}" 
                class="rounded shadow w-full h-48 object-cover transition-transform duration-300 transform hover:scale-110">
            
            <!-- Overlay při hoveru -->
            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-300">
                <form action="{{ route('photos.destroy', $photo) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit" 
                        class="bg-red-500 text-white px-4 py-2 rounded hover:scale-110 transform transition-all duration-200 hover:animate-pulse">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @empty
        <p class="text-center text-gray-500 col-span-3">No photos available. Upload some to get started!</p>
        @endforelse
    </div>
</div>
@endsection
