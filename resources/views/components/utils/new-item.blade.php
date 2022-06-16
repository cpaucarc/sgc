@if(\Carbon\Carbon::parse($date)->diffInSeconds(\Carbon\Carbon::now()) <= 90)
    <div class="-mt-3" title="Nuevo elemento">
        <p class="animate-pulse">
            ✨
        </p>
    </div>
@endif
