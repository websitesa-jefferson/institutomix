(function ($) {
$(document).ready(function($) {
    // Botão deletar
    $('body').on('click', '.modalDeletarButton', function() {
        var url = $(this).attr('data-url'),
            ids = $('#wsaGrid').yiiGridView('getSelectedRows');
        if (ids.length) {
            krajeeDialog.confirm('Deseja realmente deletar o(s) registro(s) ?', function (result) {
            if (result) {
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {ids: ids},
                    success: function (response) {
                        // faz reload na pagina anterior
                        $.pjax.reload({container:'#gridForm', timeout: false});
                    }
                });
            }
        });
        } else {
            krajeeDialog.alert('Nenhum registro selecionado.');
        }
    });
});
})(jQuery);
