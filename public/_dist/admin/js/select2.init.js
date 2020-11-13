$(function() {
    $('.products').select2({
        theme: 'bootstrap4',
        language: "pt-BR",
        placeholder: "==Selecione Um produto==",
        ajax: {
            url: "produtos/find/select",
            dataType: 'json',
            data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
});
