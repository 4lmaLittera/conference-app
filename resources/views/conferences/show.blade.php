<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $conference->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="mb-6">
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('conferences.date') }}: {{ $conference->date }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('conferences.address') }}: {{ $conference->address }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('conferences.participants') }}: {{ $conference->participants }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-bold mb-2">{{ __('conferences.description') }}</h3>
                        <p class="whitespace-pre-line">{{ $conference->description }}</p>
                    </div>

                    <div class="flex items-center justify-between mt-8">
                        <a href="{{ route('conferences.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">
                            &larr; {{ __('conferences.back') }}
                        </a>

                        @auth
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('conferences.edit', $conference) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    {{ __('conferences.edit') }}
                                </a>
                                
                                <form action="{{ route('conferences.destroy', $conference) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this.closest('form'))" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
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
