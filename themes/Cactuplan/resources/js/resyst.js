$(document).ready(function () {
    $('#form-group-podnikatele input[name="company"]').on('change keyup', function () {
        setRequired($('#form-group-podnikatele input[name="dni"]'), $(this).val().length > 0);
    });
});

function setRequired(item, required) {
    if (required) {
        item.attr('required', true);
        item.parents('.form-group').find('.form-control-comment').text('povinné');
    } else {
        item.removeAttr('required');​​​​​
        item.parents('.form-group').find('.form-control-comment').text('nepovinné');
    }
}
