
@php
    $photos = \App\Models\Photo::all();
@endphp




<nav class="bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}" class="text-white text-2xl font-bold">
                        Photo<span class="text-yellow-300">Gallery</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="text-white hover:text-yellow-300">
                        {{ __('Home') }}
                    </x-nav-link>
                    @auth
                    <x-nav-link :href="route('photos.index')" :active="request()->routeIs('photos.index')" class="text-white hover:text-yellow-300">
                        {{ __('Gallery') }}
                    </x-nav-link>
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <!-- Authenticated User Links -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" class="text-white hover:text-yellow-300" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                @else
                    <!-- Guest Links -->
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="text-white hover:text-yellow-300">
                        {{ __('Login') }}
                    </x-nav-link>
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')" class="text-white hover:text-yellow-300">
                        {{ __('Register') }}
                    </x-nav-link>
                @endauth
            </div>
        </div>
    </div>
</nav>
