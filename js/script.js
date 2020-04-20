// Window Load
$(window).on('load', function () {
    $('.nav-item').each(function (i) {
        setTimeout(function () {
            $('.nav-item').eq(i).addClass('muncul')
        }, 300 * i);
    })
    $('.pendaftaran .judul').addClass('muncul')
    $('.pengurus .judul').addClass('muncul')
    $('.jadwal .judul').addClass('muncul')
})

// Page Scroll
$('.pageScroll').on('click', function (e) {
    const tujuan = $(this).attr('href')
    const elementTujuan = $(tujuan)

    $('html').animate({
        scrollTop: elementTujuan.offset().top - 50
    }, 750, 'easeInOutExpo')

    e.preventDefault()
})