<div class="col-12">
    <div class="not-found-wrap text-center">
        <p class="text-36 subheading mb-3">{{ __('Opa!') }}</p>
        <p class="mb-5 text-muted text-18">{{ __('Nenhum registro foi encontrado!!') }}</p>
        @isset($back)
            <a class="btn btn-lg btn-danger btn-rounded" href="{{ $back }}"><i class="fa fa-reply"></i> {{ __('Retornar Para A Lista') }}</a>
        @endisset
        @isset($url)
            <a class="btn btn-lg btn-primary btn-rounded" href="{{ $url }}"><i class="fa fa-plus"></i> {{ __('Cadastrar Novo') }}</a>
        @else
            <a class="btn btn-lg btn-primary btn-rounded" href="{{ route('admin.admin.index') }}"><i class="fa fa-plus"></i> {{ __('Voltar para a pagina inicial') }}</a>
        @endisset
    </div>
</div>
