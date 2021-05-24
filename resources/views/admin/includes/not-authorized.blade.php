<div class="not-found-wrap text-center">
    <h1 class="text-60">422</h1>
    <p class="text-36 subheading mb-3">Não autorizado!</p>
    <p class="mb-5 text-muted text-18">Desculpe! mas você não tem autorização para realizar essa operação!!!.</p>
    @isset($url)
        <a class="btn btn-lg btn-primary btn-rounded" href="{{ $url }}">{{ __('Cadastrar Novo') }}</a>
    @else
        <a class="btn btn-lg btn-primary btn-rounded" href="{{ route('admin.admin.index') }}">{{ __('Voltar para a pagina inicial') }}</a>
    @endisset
</div>
