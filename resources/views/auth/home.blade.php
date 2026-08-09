<x-guest-layout>
    <nav class="flex items-center justify-between px-6 py-4 mb-6 bg-white rounded-lg shadow-sm">
        <div class="text-xl font-bold text-gray-800">
            {{ __('My Website') }}
        </div>
        <div class="space-x-4">
            @if (Route::has('login'))
            @auth
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">{{ __('Dashboard') }}</a>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-600 underline hover:text-gray-900">{{ __('Log in') }}</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="text-sm text-gray-600 underline ms-4 hover:text-gray-900">{{ __('Register') }}</a>
            @endif
            @endauth
            @endif
        </div>
    </nav>

    <div class="px-4 py-12 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">
            {{ __('Welcome to Our Platform') }}
        </h1>
        <p class="max-w-2xl mx-auto mt-4 text-xl text-gray-500">
            {{ __('This is a simple, clean, and modern home page built with Laravel Blade and Tailwind CSS.') }}
        </p>

        <div class="flex justify-center mt-8 space-x-4">
            @php $loginRoute = route('login'); @endphp
            <x-primary-button onclick="window.location='{{ $loginRoute }}'">
                {{ __('Get Started') }}
            </x-primary-button>

            <a href="#features" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                {{ __('Learn More') }}
            </a>
        </div>
    </div>

    <div id="features" class="pt-10 mt-12 border-t border-gray-200">
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-800">{{ __('Our Features') }}</h2>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="p-6 bg-white border border-gray-100 rounded-lg shadow-sm">
                <h3 class="text-lg font-bold text-indigo-600">⚡ Fast & Secure</h3>
                <p class="mt-2 text-sm text-gray-600">Built on top of Laravel Breeze to ensure top-notch security and speed.</p>
            </div>

            <div class="p-6 bg-white border border-gray-100 rounded-lg shadow-sm">
                <h3 class="text-lg font-bold text-indigo-600">🎨 Modern Design</h3>
                <p class="mt-2 text-sm text-gray-600">Styled with Tailwind CSS, making it fully responsive and beautiful on any screen.</p>
            </div>
        </div>
    </div>
</x-guest-layout>