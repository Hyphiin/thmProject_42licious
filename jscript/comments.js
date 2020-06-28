$('.comment-list .comment').slice(0,3).show();

$('#show-more').on('click', function() {
    $('.comment-list .comment:hidden').slice(0,3).slideDown();
    if($('.comment-list .comment:hidden').length === 0) {
        $('#show-more').fadeOut();
    }
});