<div class="col-12">
    <div class="not-found-wrap text-center">
        <p class="text-36 subheading mb-3">{{ __('Opa!') }}</p>
        <p class="mb-5 text-muted text-18">{{ __('Nenhum registro foi encontrado!!') }}</p>
        @isset($url)
            @if(\Illuminate\Support\Facades\Route::has($url))
                @isset($back)
                    @if(\Illuminate\Support\Facades\Route::has($url))
                        @can($back)
                            <a class="btn btn-lg btn-primary btn-rounded" href="{{ route($back) }}"><i
                                    class="fa fa-plus"></i> {{ __('Cadastrar Novo') }}</a>
                        @endcan
                    @endif
                @endisset
                @isset($url)
                    @can($url)
                        <a class="btn btn-lg btn-primary btn-rounded" href="{{ route($url) }}"><i
                                class="fa fa-plus"></i> {{ __('Cadastrar Novo') }}</a>
                    @else
                        <a class="btn btn-lg btn-primary btn-rounded" href="{{ route('admin.admin.index') }}"><i
                                class="fa fa-plus"></i> {{ __('Voltar para a pagina inicial') }}</a>
                    @endcan
                @else
                    <a class="btn btn-lg btn-primary btn-rounded" href="{{ route('admin.admin.index') }}"><i
                            class="fa fa-plus"></i> {{ __('Voltar para a pagina inicial') }}</a>
                @endisset
            @else
                <a class="btn btn-lg btn-primary btn-rounded" href="{{ route('admin.admin.index') }}"><i
                        class="fa fa-plus"></i> {{ __('Voltar para a pagina inicial') }}</a>
            @endif
        @else
            <a class="btn btn-lg btn-primary btn-rounded" href="{{ route('admin.admin.index') }}"><i
                    class="fa fa-plus"></i> {{ __('Voltar para a pagina inicial') }}</a>
        @endisset
    </div>
</div>
