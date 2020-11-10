<btn-delete-component event="{{ sprintf("form-%s", $row->id) }}">
    <form ref="form" action="{{ route($route,$row->id) }}" method="POST">
        @csrf
        @method("DELETE")
    </form>
</btn-delete-component>
