$(document).ready(function() {

    // Open Menu
    $('.toggle-menu').on('click', function() {
        
        $('aside').css('width', '220px');
        $('aside .over-lay').css('width', '100%');
    });

    // Hide Menu
    $('aside .over-lay').on('click', function() {
        $('aside').css('width', '0');
        $('aside .over-lay').css('width', '0');
    });

    $('.show-img i').on('click', function() {
        $('.show-img').fadeOut(500);
    });

    $('img').on('click', function() {
        var imgPath = $(this).attr('src');
        $('.show-img ').fadeIn(500);
        $('.show-img img').attr('src', imgPath);
    });

});