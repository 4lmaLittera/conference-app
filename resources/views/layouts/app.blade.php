<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="background-color: var(--notion-bg-secondary);">
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <aside class="w-64 fixed inset-y-0 left-0 flex flex-col" style="background-color: var(--notion-sidebar-bg); border-right: 1px solid var(--notion-border);">
                <!-- Logo/Brand -->
                <div class="p-4">
                    <a href="{{ route('conferences.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-md transition-colors" 
                       style="color: var(--notion-text-primary);"
                       onmouseover="this.style.backgroundColor='var(--notion-bg)'" 
                       onmouseout="this.style.backgroundColor='transparent'">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="w-12 h-12 object-cover">
                        <span class="font-semibold">{{ config('app.name', 'Konferencijos') }}</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="flex-1 px-3 py-2 space-y-1">
                    <a href="{{ route('conferences.index') }}" 
                       class="flex items-center gap-2 px-3 py-2 rounded-md transition-colors"
                       style="color: var(--notion-text-primary); {{ request()->routeIs('conferences.index') ? 'background-color: var(--notion-bg);' : '' }}"
                       onmouseover="if(!this.style.backgroundColor || this.style.backgroundColor === 'transparent') this.style.backgroundColor='var(--notion-hover)'" 
                       onmouseout="if(!'{{ request()->routeIs('conferences.index') }}') this.style.backgroundColor='transparent'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span class="text-sm font-medium">{{ __('conferences.list_title') }}</span>
                    </a>

                    @auth
                        <a href="{{ route('conferences.create') }}" 
                           class="flex items-center gap-2 px-3 py-2 rounded-md transition-colors"
                           style="color: var(--notion-text-primary); {{ request()->routeIs('conferences.create') ? 'background-color: var(--notion-bg);' : '' }}"
                           onmouseover="if(!this.style.backgroundColor || this.style.backgroundColor === 'transparent') this.style.backgroundColor='var(--notion-hover)'" 
                           onmouseout="if(!'{{ request()->routeIs('conferences.create') }}') this.style.backgroundColor='transparent'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span class="text-sm font-medium">{{ __('conferences.create_new') }}</span>
                        </a>
                    @endauth
                </nav>

                <!-- User Section -->
                <div class="p-3 border-t" style="border-color: var(--notion-border);">
                    @auth
                        <div class="flex items-center justify-between px-3 py-2 rounded-md" style="background-color: var(--notion-hover);">
                            <div class="flex items-center gap-2 min-w-0">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center" style="background-color: var(--notion-accent); color: white; font-size: 12px; font-weight: 600;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="text-sm font-medium truncate" style="color: var(--notion-text-primary);">{{ Auth::user()->name }}</span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="p-1 rounded transition-colors" title="{{ __('auth.logout') }}"
                                        style="color: var(--notion-text-secondary);"
                                        onmouseover="this.style.backgroundColor='var(--notion-bg)'" 
                                        onmouseout="this.style.backgroundColor='transparent'">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center gap-2 px-3 py-2 rounded-md transition-colors"
                           style="color: var(--notion-text-primary);"
                           onmouseover="this.style.backgroundColor='var(--notion-hover)'" 
                           onmouseout="this.style.backgroundColor='transparent'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="text-sm font-medium">{{ __('auth.login') }}</span>
                        </a>
                    @endauth
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 ml-64">
                <!-- Page Header -->
                @isset($header)
                    <header class="px-8 py-6">
                        <h1 class="text-3xl font-semibold" style="color: var(--notion-text-primary);">
                            {{ $header }}
                        </h1>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="px-8 pb-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
