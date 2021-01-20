<div class="w-100" style="position: absolute;top: 0;left: 0; right: 0;z-index: 2000">
    @if($shown)
    <div class="rounded-r-md {{ $styles['bg-color'] }} p-4 border-l-4 {{ $styles['border-color'] }} mb-3">
        <div class="flex">
            @if ($styles['icon'] ?? false)
                <div class="flex-shrink-0">
                    <p class="{{ $styles['icon-color'] }}">
                        <i class="{{ $styles['icon'] }}"></i>
                    </p>
                </div>
            @endif
            <div class="ml-3 text-sm leading-5 font-medium {{ $styles['text-color'] }}">
                {!! $message['message'] !!}
            </div>
            @if ($message['dismissable'] ?? false)
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button class="d-inline-flex rounded-sm p-1 {{ $styles['text-color'] }}" wire:click="dismiss">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif
</div>
