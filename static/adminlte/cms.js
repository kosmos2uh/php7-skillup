$(document).ready(function(){

    $(".delete-btn").bind("click", function(e){
        e.preventDefault();
        var _parentForm = $(this).parent('form');
        $('.confirm_action').bind('click', function(){
            _parentForm[0].submit();
        });
    });

    $('#modal-delete-user').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        $("#modal-delete-user-text").html(button.data('message'));
    });

});