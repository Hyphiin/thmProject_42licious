$('.users .profil-preview').slice(0,3).show();

$('#show-more').on('click', function() {
    $('.users .profil-preview:hidden').slice(0,3).slideDown();
    if($('.users .profil-preview:hidden').length === 0) {
        $('#show-more').fadeOut();
    }
});