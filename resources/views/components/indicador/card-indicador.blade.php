<div class="text-sm pt-4 w-full">
    <div class="flex items-start">
        <svg class="mr-2 text-stone-400 flex-shrink-0" viewBox="0 0 16 16" width="16" height="16" fill="currentColor">
            <path fill-rule="evenodd"
                  d="M1.5 1.75a.75.75 0 00-1.5 0v12.5c0 .414.336.75.75.75h14.5a.75.75 0 000-1.5H1.5V1.75zm14.28 2.53a.75.75 0 00-1.06-1.06L10 7.94 7.53 5.47a.75.75 0 00-1.06 0L3.22 8.72a.75.75 0 001.06 1.06L7 7.06l2.47 2.47a.75.75 0 001.06 0l5.25-5.25z"></path>
        </svg>
        <div class="flex-col flex-1 space-y-2">

            <a href="{{ $href }}" class="font-bold hover:text-sky-700 text-sky-600 hover:underline">
                {{ $codigo }}
            </a>

            <p class="text-gray-600">
                {{ $objetivo }}
            </p>

            <ul class="flex flex-wrap gap-2 text-xs">
                <li>
                    <x-utils.badge class="bg-zinc-100 text-zinc-600">
                        Medición: {{ $medicion }}
                    </x-utils.badge>
                </li>
                <li>
                    <x-utils.badge class="bg-zinc-100 text-zinc-600">
                        Reporte: {{ $reporte }}
                    </x-utils.badge>
                </li>
            </ul>
        </div>
    </div>
</div>
