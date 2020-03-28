// Parallax
$(window).on('load', function () {
    $('.pKiri').addClass('pMuncul')
    $('.pKanan').addClass('pMuncul')
})

$(window).scroll(function () {
    let wScroll = $(this).scrollTop()
    let nav = document.querySelector('.navbar')

    // Jumbotron
    $('.jumbotron h1').css({
        'transform': 'translate(0,' + (wScroll / 0.8) + '%)'
    })

    $('.jumbotron p').css({
        'transform': 'translate(0,' + (wScroll / 0.4) + '%)'
    })

    $('.jumbotron a').css({
        'transform': 'translate(0,' + (wScroll / 1) + '%)'
    })

    // Gallery
    if (wScroll > ($('.gallery').offset().top - 250)) {
        $('.gallery .thumbnail').each(function (i) {
            setTimeout(function () {
                $('.gallery .thumbnail').eq(i).addClass('muncul')
            }, 300 * i);
        })
    }
})