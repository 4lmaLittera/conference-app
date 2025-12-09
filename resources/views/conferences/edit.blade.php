<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('conferences.edit_title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-neutral-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('conferences.update', $conference) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @include('conferences._form')

                        <div class="flex items-center justify-between mt-8 pt-5 border-t" style="border-color: var(--notion-border);">
                            <a href="{{ route('conferences.index') }}" 
                               class="px-4 py-2 rounded-md transition-colors text-sm font-medium"
                               style="color: var(--notion-text-secondary);"
                               onmouseover="this.style.backgroundColor='var(--notion-hover)'" 
                               onmouseout="this.style.backgroundColor='transparent'">
                                ← {{ __('conferences.back') }}
                            </a>
                            <button type="submit" class="notion-button-primary">
                                {{ __('conferences.save') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
