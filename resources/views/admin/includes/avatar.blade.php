<div class="input-group">
    <input type="text" id="image_label" value="{{ $user->avatar }}"  class="form-control" name="avatar"
           aria-label="Image" aria-describedby="button-image" readonly>
    <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" id="button-image">{{ __('Selecione Uma Imagem') }}</button>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('_dist/admin/js/file-btn.js') }}"></script>
@endpush
