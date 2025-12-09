<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $conference->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-neutral-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    
                    <!-- Page Title -->
                    <h1 class="text-3xl font-bold mb-6" style="color: var(--notion-text-primary);">
                        {{ $conference->title }}
                    </h1>

                    <!-- Metadata Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <!-- Date Card -->
                        <div class="notion-card">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded" style="background-color: var(--notion-hover);">
                                    <svg class="w-5 h-5" style="color: var(--notion-text-secondary);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium" style="color: var(--notion-text-tertiary);">{{ __('conferences.date') }}</p>
                                    <p class="text-sm font-semibold" style="color: var(--notion-text-primary);">{{ $conference->date }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Location Card -->
                        <div class="notion-card">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded" style="background-color: var(--notion-hover);">
                                    <svg class="w-5 h-5" style="color: var(--notion-text-secondary);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-medium" style="color: var(--notion-text-tertiary);">{{ __('conferences.address') }}</p>
                                    <p class="text-sm font-semibold truncate" style="color: var(--notion-text-primary);">{{ $conference->address }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Participants Card -->
                        <div class="notion-card">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded" style="background-color: var(--notion-hover);">
                                    <svg class="w-5 h-5" style="color: var(--notion-text-secondary);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium" style="color: var(--notion-text-tertiary);">{{ __('conferences.participants') }}</p>
                                    <p class="text-sm font-semibold" style="color: var(--notion-text-primary);">{{ $conference->participants }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="mb-8">
                        <h3 class="text-sm font-semibold mb-3" style="color: var(--notion-text-tertiary);">{{ __('conferences.description') }}</h3>
                        <div class="notion-card">
                            <p class="whitespace-pre-line leading-relaxed" style="color: var(--notion-text-primary);">{{ $conference->description }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between pt-5 border-t" style="border-color: var(--notion-border);">
                        <a href="{{ route('conferences.index') }}" 
                           class="px-4 py-2 rounded-md transition-colors text-sm font-medium"
                           style="color: var(--notion-text-secondary);"
                           onmouseover="this.style.backgroundColor='var(--notion-hover)'" 
                           onmouseout="this.style.backgroundColor='transparent'">
                            ← {{ __('conferences.back') }}
                        </a>

                        @auth
                            <div class="flex items-center gap-2">
                                <a href="{{ route('conferences.edit', $conference) }}" class="notion-button-primary">
                                    {{ __('conferences.edit') }}
                                </a>
                                
                                <form action="{{ route('conferences.destroy', $conference) }}" method="POST" class="delete-form inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this.closest('form'))" 
                                            class="px-4 py-2 rounded-md transition-colors text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                                        {{ __('conferences.delete') }}
                                    </button>
                                </form>
                            </div>
                        @endauth
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(form) {
            Swal.fire({
                title: '{{ __('conferences.confirm_delete') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '{{ __('conferences.delete') }}',
                cancelButtonText: '{{ __('conferences.cancel') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
</x-app-layout>
