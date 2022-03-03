@if(\Carbon\Carbon::parse($date)->diffInSeconds(\Carbon\Carbon::now()) <= 90)
    <div class="-mt-3">
        <svg class="text-green-500 animate-pulse" fill="currentColor" viewBox="0 0 16 16" width="16" height="16">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8z"></path>
        </svg>
    </div>
@endif
