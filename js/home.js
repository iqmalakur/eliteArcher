// Parallax
$(window).on('load', function() {
    let wScroll = $(this).scrollTop()
    let href = window.location.href.split("/")
    let tujuan = href.slice(-1)[0]
    
    if (tujuan != "index.php" && tujuan == "#contact") {
        $('html').animate({
            scrollTop: $(tujuan).offset().top - 100
        }, 200, 'easeInOutExpo')
    }

    $('.colinfo').each(function (i) {
        setTimeout(function () {
            $('.colinfo').eq(i).addClass('muncul')
        }, 300 * i);
    })

    if (wScroll > $('section.info').offset().top - 400) {
        $('nav.navbar').addClass('bg-dark')
        $('section.info .judul').addClass('muncul')
        $('section.info .pkiri').addClass('muncul')
        $('section.info .pkanan').addClass('muncul')
    }

    if (wScroll > $('section.gallery').offset().top - 300) {
        $('section.gallery .judul').addClass('muncul')
        $('.figure').each(function (i) {
            setTimeout(function () {
                $('.figure').eq(i).addClass('muncul')
            }, 300 * i);
        })
    }

    $('.bItem').each(function (i) {
        setTimeout(function () {
            $('.bItem').eq(i).addClass('muncul')
        }, 300 * i);
    })

    if (wScroll > $('section.contact').offset().top - 300) {
        $('section.contact .judul').addClass('muncul')
        $('section.contact .col-lg-4').addClass('muncul')
        $('section.contact .col-lg-6').addClass('muncul')
    }
})

$(window).scroll(function () {
    let wScroll = $(this).scrollTop()

    // Jumbotron
    $('.jumbotron h1').css({
        'transform': 'translate(0,' + (wScroll / 5) + '%)'
    })

    $('.jumbotron a').css({
        'transform': 'translate(0,' + (wScroll / 5.2) + '%)'
    })

    if (wScroll > $('section.info').offset().top - 400){
        $('nav.navbar').addClass('bg-dark')
        $('section.info .judul').addClass('muncul')
        $('section.info .pkiri').addClass('muncul')
        $('section.info .pkanan').addClass('muncul')
    } else if (wScroll <= $('section.info').offset().top - 400) {
        $('nav.navbar').removeClass('bg-dark')
        $('section.info .judul').removeClass('muncul')
        $('section.info .pkiri').removeClass('muncul')
        $('section.info .pkanan').removeClass('muncul')
    }

    if (wScroll > $('section.gallery').offset().top - 300) {
        $('section.gallery .judul').addClass('muncul')
        $('.figure').each(function (i) {
            setTimeout(function () {
                $('.figure').eq(i).addClass('muncul')
            }, 300 * i);
        })
    } else if (wScroll <= $('section.gallery').offset().top - 500) {
        $('section.gallery .judul').removeClass('muncul')
        $('.figure').removeClass('muncul')
    }

    if (wScroll > $('section.berita').offset().top - 300) {
        $('section.berita .judul').addClass('muncul')
        $('.bItem').each(function (i) {
            setTimeout(function () {
                $('.bItem').eq(i).addClass('muncul')
            }, 300 * i);
        })
    } else if (wScroll <= $('section.berita').offset().top - 500) {
        $('section.berita .judul').removeClass('muncul')
        $('.bItem').each(function (i) {
            setTimeout(function () {
                $('.bItem').eq(i).removeClass('muncul')
            }, 300 * i);
        })
    }

    if (wScroll > $('section.contact').offset().top - 300) {
        $('section.contact .judul').addClass('muncul')
        $('section.contact .col-lg-4').addClass('muncul')
        $('section.contact .col-lg-6').addClass('muncul')
    } else if (wScroll <= $('section.contact').offset().top - 500) {
        $('section.contact .judul').removeClass('muncul')
        $('section.contact .col-lg-4').removeClass('muncul')
        $('section.contact .col-lg-6').removeClass('muncul')
    }
})

// Gallery
$('.figure').on('click', function() {
    $('.galleryfocus').css({
        "opacity" : "1",
        "display" : "flex",
        "z-index" : "99"
    })
    $('.galleryfocus img')[0].src = this.children[0].src
})

$('.galleryfocus').on('click', function() {
    $('.galleryfocus').css({
        "opacity": "0",
        "display": "none",
        "z-index": "-99"
    })
    $('.galleryfocus img')[0].src = ""
})