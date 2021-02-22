<div>
    @if($this->products)
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4 mb-4">
                        <div class="card-header">
                            <form class="form-inline">
                                <div class="form-row" style="width: 100%;">
                                    <div class="col-sm-12 col-md-9">
                                        <input wire:model="search" class="form-control" type="search" placeholder="Termo de busca" style="width: 100%;">
                                    </div>
                                    <div class="col-sm-12 col-md-3 mt-3 mt-md-0">
                                        <select wire:model="status" class="form-control" name="status" style="width: 100%;">
                                            <option value="">==Todos==</option>
                                            <option value="published"
                                                    @if($status == "published") selected @endif>==Ativo==
                                            </option>
                                            <option value="draft"
                                                    @if($status == "draft") selected @endif>==Inativo==
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4 mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col" width="150">Estoque atual</th>
                                        <th scope="col" width="150">Novo Estoque</th>
                                        <th scope="col" width="100">#</th>
                                    </tr>
                                    </thead>
                                    <tbody id="names">
                                    <!-- --------------------------- tr1 -------------------------------------------->
                                    @if($this->products->count())
                                        @foreach($this->products as $row)
                                            <tr>
                                                <td scope="row">{{ $row->name }}</td>
                                                <td scope="row">{{ $row->stock }}</td>
                                                <td scope="row"><input wire:model.lazy="stoque.{{$row->id}}" class="form-control" type="number"></td>
                                                <td scope="row">
                                                    <button class="btn btn-warning btn-block" type="button" wire:click="update({{$row}})">Atualizar</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">Nemhuma ocorrência encontarda ):</td>
                                        </tr>
                                    @endif
                                    <!--  end of table row 3 -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-12">
                {{ $this->products->links('pagination::bootstrap-4') }}
            </div>
        </div>
        @else
            <div class="row">
                <div class="col-12">
                    @include("admin.includes.empty", [
                           'back' =>'admin.products.index',
                       ])
                </div>
            </div>
        @endif
</div>
