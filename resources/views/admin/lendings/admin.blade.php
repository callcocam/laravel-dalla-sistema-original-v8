<div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Situação</th>
                    <th scope="col" width="200">#</th>
                </tr>
                </thead>
                <tbody id="names">
                <!-- --------------------------- tr1 -------------------------------------------->
                @foreach($rows as $row)
                    <tr>
                        <td scope="row">{{ $row->name }}</td>
                        <td scope="row"><span
                                class="badge badge-{{ check_status($row->status) }}">{{ check_status_text($row->status) }}</span>
                        </td>
                        <td scope="row">
                            @can('admin.lendings.edit')
                                <a class="btn btn-primary btn-rounded"
                                   href="{{ route('admin.lendings.edit',$row->id) }}">@include('admin.includes.icons.edit')</a>
                            @endcan
                            @can('admin.lendings.show')
                                <a class="btn btn-info btn-rounded"
                                   href="{{ route('admin.lendings.show',$row->id) }}">@include('admin.includes.icons.show')</a>
                            @endcan
                            @can('admin.lendings.destroy')
                                @include('admin.includes.icons.destroy',['row'=>$row, 'route'=>'admin.lendings.destroy'])
                            @endcan
                        </td>
                    </tr>
                @endforeach
                <!--  end of table row 3 -->
                </tbody>
            </table>
    </div>
    <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
        <div class="row">
            <div class="col-12">
                {{ $rows->render() }}
            </div>
        </div>
    </div>
