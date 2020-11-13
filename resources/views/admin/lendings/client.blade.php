<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Quantidade</th>
        </tr>
        </thead>
        <tbody id="names">
        <!-- --------------------------- tr1 -------------------------------------------->
        @foreach($rows as $row)
            <tr>
                <td scope="row">{{ $row->name }}</td>
                <td scope="row">{{$row->sun()}}</td>
            </tr>
        @endforeach
        <!--  end of table row 3 -->
        </tbody>
    </table>
</div>
