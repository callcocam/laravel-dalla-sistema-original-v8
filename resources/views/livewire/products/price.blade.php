<div>
    <div class="row mb-5">
        <div class="col-md-12"><h5 class="font-weight-bold">Selecione um cliente</h5>
            <div class="form-group">
                <div class="col-md-12">
                    <select wire:model="client" class="form-control  form-control-rounded">
                        <option value="" selected="selected">=== Selecione Cliente ===</option>
                        @if($this->clients)
                            @foreach($this->clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card mt-4 mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Produto</th>
                                <th scope="col" width="150">Valor atual</th>
                                <th scope="col" width="150">Novo Valor</th>
                            </tr>
                            </thead>
                            <tbody id="names">
                            <!-- --------------------------- tr1 -------------------------------------------->
                            @if($this->prices)
                                @foreach($this->prices as $row)
                                    <tr>
                                        <td scope="row">{{ $row->product->name }}</td>
                                        <td scope="row">{{ form_read($row->price) }}</td>
                                        <td scope="row">
                                            <input wire:model="form_data.{{$row->id}}" class="form-control real" type="text"></td>

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
        <div class="col-md-12"><label class="d-block text-12 text-muted">Situação</label>
            <div class="pr-0 mb-4">
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="{{ \App\Models\Admin\Price::DRAFT }}" class="radio radio-outline-primary">
                            <input id="draft" wire:model="status" type="radio"
                                   value="{{ \App\Models\Admin\Price::DRAFT }}">
                            <span>Desabiltado</span>
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio radio-outline-primary">
                            <input id="{{ \App\Models\Admin\Price::PUBLISHD }}" wire:model="status" type="radio"
                                   value="{{ \App\Models\Admin\Price::PUBLISHD }}">
                            <span>Habilitado</span>
                            <span class="checkmark"> </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        @if($this->form_data)
            <div class="col-md-12 fixed-bottom right-0 mb-12">
                <button class="btn btn-success float-right" type="button"
                        wire:click="updatePrice()">Atualizar o valor dos produtos
                </button>
            </div>
        @endif
    </div>
</div>
