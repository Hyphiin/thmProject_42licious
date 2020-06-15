$('.recipe-container .recipe-preview-container').slice(0,3).show();

$('#show-more').on('click', function() {
    $('.recipe-container .recipe-preview-container:hidden').slice(0,3).slideDown();
    if($('.recipe-container .recipe-preview-container:hidden').length === 0) {
        $('#show-more').fadeOut();
    }
});