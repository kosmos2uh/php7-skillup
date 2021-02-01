$(document).ready(function(){

    $(".delete-btn").bind("click", function(e){
        e.preventDefault();
        var _parentForm = $(this).parent('form');
        $('.confirm_action').bind('click', function(){
            _parentForm[0].submit();
        });
    });

    $('#modal-delete-item').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        $("#modal-delete-item-text").html(button.data('message'));
    });

    $(".custom-file-input").change(function(e){
        var label = $("+.custom-file-label", this);
        var files = e.target.files;
        var files_names = '';
        for (var i = 0; i < files.length; i++) {
            files_names += (files_names !== '' ? ', ' : '') + files[i].name;
        }
        label.text(files_names);
    });

    $('#summernote').summernote({
        height: 200
    });

    $('.select2').select2();

    flash_messages.forEach(function (el) {
        switch (el.type) {
            case 'info' : toastr.info(el.text); break;
            case 'success' : toastr.success(el.text); break;
            case 'error' : toastr.error(el.text); break;
            case 'warning' : toastr.warning(el.text); break;
        }
    });

});