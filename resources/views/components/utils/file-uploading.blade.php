<div
    x-data="{ isUploading: false, progress: 0 }"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
>
    {{ $slot }}

    <!-- Progress Bar -->
    <div x-show="isUploading"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="w-full bg-sky-200 rounded-full mt-2 overflow-hidden">
            <div
                class="bg-sky-600 text-xs font-medium text-sky-50 text-center p-0.5 leading-none rounded-full"
                :style="`width: ${progress}%;`" x-text="`${progress}%`">
            </div>
        </div>
    </div>
</div>
