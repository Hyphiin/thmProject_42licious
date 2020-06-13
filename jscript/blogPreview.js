$('.blog-list .blog-preview').slice(0,3).show();

$('#show-more').on('click', function() {
    $('.blog-list .blog-preview:hidden').slice(0,3).slideDown();
    if($('.blog-list .blog-preview:hidden').length === 0) {
        $('#show-more').fadeOut();
    }
});