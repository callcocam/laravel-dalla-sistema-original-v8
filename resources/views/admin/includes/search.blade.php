<div class="card-header">
    <form class="form-inline">
        <div class="form-row" style="width: 100%;">
            <div class="col-md-5">
                <input class="form-control" name="search" value="{{ request('search') }}"
                       id="search" type="search" placeholder="Termo de busca"
                       aria-label="Search" style="width: 100%;">
            </div>
            <div class="col-md-5 mt-3 mt-md-0">
                <select class="form-control" name="status" style="width: 100%;">
                    <option value="">==Todos==</option>
                    <option value="published"
                            @if($status == "published") selected @endif>==Ativo==
                    </option>
                    <option value="draft"
                            @if($status == "draft") selected @endif>==Inativo==
                    </option>
                </select>
            </div>
            <div class="col-md-2 mt-3 mt-md-0">
                <button class="btn btn-primary btn-block">Buscar</button>
            </div>
        </div>
    </form>
</div>
