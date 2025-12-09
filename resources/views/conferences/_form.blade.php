<!-- Form Fields for Conference Create/Edit -->
<div class="space-y-5">
    <!-- Title -->
    <div>
        <label for="title" class="notion-label">
            {{ __('conferences.title') }}
        </label>
        <input 
            id="title" 
            type="text" 
            name="title" 
            value="{{ old('title', $conference->title ?? '') }}"
            required 
            autofocus
            class="notion-input"
            placeholder="{{ __('conferences.title') }}"
        >
        @error('title')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <!-- Date and Participants Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <!-- Date -->
        <div>
            <label for="date" class="notion-label">
                {{ __('conferences.date') }}
            </label>
            <input 
                id="date" 
                type="date" 
                name="date" 
                value="{{ old('date', $conference->date ?? '') }}"
                required
                class="notion-input"
            >
            @error('date')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Participants -->
        <div>
            <label for="participants" class="notion-label">
                {{ __('conferences.participants') }}
            </label>
            <input 
                id="participants" 
                type="number" 
                name="participants" 
                value="{{ old('participants', $conference->participants ?? '') }}"
                required
                min="0"
                class="notion-input"
                placeholder="0"
            >
            @error('participants')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Address -->
    <div>
        <label for="address" class="notion-label">
            {{ __('conferences.address') }}
        </label>
        <input 
            id="address" 
            type="text" 
            name="address" 
            value="{{ old('address', $conference->address ?? '') }}"
            required
            class="notion-input"
            placeholder="{{ __('conferences.address') }}"
        >
        @error('address')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <!-- Description -->
    <div>
        <label for="description" class="notion-label">
            {{ __('conferences.description') }}
        </label>
        <textarea 
            id="description" 
            name="description" 
            rows="6"
            required
            class="notion-input resize-none"
            placeholder="{{ __('conferences.description') }}"
        >{{ old('description', $conference->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
</div>
