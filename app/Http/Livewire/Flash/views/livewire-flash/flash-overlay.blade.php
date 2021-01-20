<div>
    @if($shown)
        <div class="col-md-12 position-fixed" style="top: 0;left: 0;right: 0;z-index: 2000">
            <div class="alert alert-card alert-{{ $styles['overly-bg-color'] }} {{ $styles['overlay-bg-opacity'] }} text-center" role="alert">
                {!! $message['message'] !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" wire:click="dismiss">×</span>
                </button>
            </div>
        </div>
    @endif
</div>

