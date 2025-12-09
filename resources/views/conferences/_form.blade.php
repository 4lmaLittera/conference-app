<!-- Form Fields for Conference Create/Edit -->
<div class="mb-4">
    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ __('conferences.title') }}
    </label>
    <input 
        id="title" 
        type="text" 
        name="title" 
        value="{{ old('title', $conference->title ?? '') }}"
        required 
        autofocus
        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
    >
    @error('title')
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ __('conferences.date') }}
    </label>
    <input 
        id="date" 
        type="date" 
        name="date" 
        value="{{ old('date', $conference->date ?? '') }}"
        required
        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
    >
    @error('date')
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ __('conferences.address') }}
    </label>
    <input 
        id="address" 
        type="text" 
        name="address" 
        value="{{ old('address', $conference->address ?? '') }}"
        required
        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
    >
    @error('address')
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="participants" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ __('conferences.participants') }}
    </label>
    <input 
        id="participants" 
        type="number" 
        name="participants" 
        value="{{ old('participants', $conference->participants ?? '') }}"
        required
        min="0"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
    >
    @error('participants')
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ __('conferences.description') }}
    </label>
    <textarea 
        id="description" 
        name="description" 
        rows="5"
        required
        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
    >{{ old('description', $conference->description ?? '') }}</textarea>
    @error('description')
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
