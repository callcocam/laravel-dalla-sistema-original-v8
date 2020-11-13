

@push('scripts')
<script src="{{ asset('_dist/admin/js/plugins/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.alert-confirm').on('click', function (e) {

            swal({
                title: "<?=__('Are you sure?')?>",
                text: "<?=__('You won\'t be able to revert this!')?>",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0CC27E',
                cancelButtonColor: '#FF586B',
                confirmButtonText: "<?=__('Yes, delete it!')?>",
                cancelButtonText: "<?=__('No, cancel!')?>",
                confirmButtonClass: 'btn btn-success mr-5',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then( ()=> {
                $.ajax({
                    url:$(this).attr('href'),
                    type:'delete',
                    dataType:'json',
                    success:function (data) {

                        window.location.reload()

                    }
                })
            });
            return e.preventDefault();
        });
    });
</script>
@endpush
@push('styles')
    <link href="{{ asset('_dist/admin/css/plugins/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush
