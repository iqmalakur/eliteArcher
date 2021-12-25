// Window Load
$(window).on('load', function () {
    $('.nav-item').each(function (i) {
        setTimeout(function () {
            $('.nav-item').eq(i).addClass('muncul')
        }, 300 * i);
    })
    $('.pendaftaran .judul').addClass('muncul')
    $('.pengurus .judul').addClass('muncul')
    $('#jadwal .judul').addClass('muncul')
    $('.jadwal .judul').addClass('muncul')
    $('.anggota .judul').addClass('muncul')
    $('.gallery.container .judul').addClass('muncul')
    $('.berita.container .judul').addClass('muncul')
    $('.admin.container .judul').addClass('muncul')
})

// Konfirmasi Penghapusan
$('a.hapus').on("click", function() {
    let pesan = $(this).data('hapus')
    return confirm(pesan)
})

// Search
$('#cariAnggota').on('input', function(){
    const table = document.querySelector('.tabledata')
    ajaxhal('../ajax/cariAnggota.php?keyword=' + this.value, table)
})

$('#cariPengurus').on('input', function(){
    const table = document.querySelector('.tabledata')
    ajaxhal('../ajax/cariPengurus.php?keyword=' + this.value, table)
})

$('#cariGallery').on('input', function(){
    const table = document.querySelector('.tabledata')
    ajaxhal('../ajax/cariGallery.php?keyword=' + this.value, table)
})

$('#cariBerita').on('input', function(){
    const table = document.querySelector('.tabledata')
    ajaxhal('../ajax/cariBerita.php?keyword=' + this.value, table)
})

// Page Scroll
$('.pageScroll').on('click', function (e) {
    const tujuan = $(this).attr('href')
    const elementTujuan = $(tujuan)

    $('html').animate({
        scrollTop: elementTujuan.offset().top - 50
    }, 1000, 'easeInOutExpo')

    e.preventDefault()
})

// Ajax
function ajaxinput(address, element) {
    let xhr = new XMLHttpRequest()
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            element.value = xhr.responseText
        }
    }

    xhr.open("GET", address, true)
    xhr.send()
}

function ajaxhal(address, container) {
    let xhr = new XMLHttpRequest()
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            container.innerHTML = xhr.responseText
        }
    }

    xhr.open("GET", address, true)
    xhr.send()
}

// Pendaftaran
$('#kelas').on("input", function() {
    harga = document.querySelector("#harga")
    addons = document.querySelector("#addons")
    ajaxinput("../ajax/kelas.php?id=" + this.value + "&addons=" + addons.value, harga)
})

$('#addons').on('input', function () {
    harga = document.querySelector("#harga")

    if (this.value == "false") {
        hargatotal = eval(harga.value + '+ 150000')
        harga.value = hargatotal
        this.value = "true"
    }
    else{
        hargatotal = eval(harga.value + '- 150000')
        harga.value = hargatotal
        this.value = "false"
    }
})

// Kepengurusan
$('button.badge').on('click', function () {
    const detail = $(this).parent()[0].children[2]
    const img = $(this.children)[0]
    const allDetail = document.querySelectorAll("div.detail")
    const allImg = document.querySelectorAll("button.badge img")

    if (detail.classList.contains("noHide")) {
        detail.classList.remove('noHide')
        img.classList.remove('aktif')
    }
    else {
        allDetail.forEach(function (dtl) {
            dtl.classList.remove('noHide')
        })

        allImg.forEach(function (gbr) {
            gbr.classList.remove('aktif')
        })

        detail.classList.add('noHide')
        img.classList.add('aktif')
    }
})

// Admin - Anggota
$("button.btnUbah.ubahAnggota").on("click", function() {
    const container = $(".dataform")[0]
    const id = $(this).data('id')

    $("#judulModal").html("Ubah Data Anggota")
    $(".modal-footer button[type=submit]").html("Ubah Data")
    $(".modal-footer button[type=submit]")[0].name = "ubah"

    ajaxhal("../ajax/ubahmember.php?id=" + id, container)
    $.ajax({
        url: '../ajax/valuemember.php',
        data: { id: id },
        method: 'post',
        dataType: 'json',
        success: function (data) {
            $('#idn').val(data.idn)
            $('#kelas').val(data.kelas)
            $('#harga').val(data.harga)
            $('#status').val(data.status)
            if (data.addons == "true") {
                $('#addons').val("true")
                $('#addons')[0].checked = true
            }
            else {
                $('#addons').val("false")
                $('#addons')[0].checked = false
            }
        }
    })
})

$("button.tambahdata").on("click", function () {
    const container = $(".dataform")[0]

    $("#judulModal").html("Tambah Data Anggota")
    $(".modal-footer button[type=submit]").html("Tambah Data")
    $(".modal-footer button[type=submit]")[0].name = "daftar"
    $('#addons').val("false")
    $('#addons')[0].checked = false

    ajaxhal("../ajax/tambahmember.php", container);
})

// Admin - Gallery
$('.custom-file input[type=file]').on("input", function() {
    $('.custom-file label')[0].innerHTML = this.value
})

$('tbody tr td img').on('click', function () {
    $('.imgfocus').css({
        "opacity": "1",
        "display": "flex",
        "z-index": "99"
    })
    $('.imgfocus img')[0].src = this.src
})

$('.imgfocus').on('click', function () {
    $('.imgfocus').css({
        "opacity": "0",
        "display": "none",
        "z-index": "-99"
    })
    $('.imgfocus img')[0].src = ""
})

$("button.btnUbah.ubahGallery").on("click", function () {
    const id = $(this).data('id')

    $("#judulModal").html("Ubah Data Gallery")
    $(".modal-footer button[type=submit]").html("Ubah Data")
    $(".modal-footer button[type=submit]")[0].name = "ubah"

    $.ajax({
        url: '../ajax/ubahgallery.php',
        data: { id: id },
        method: 'post',
        dataType: 'json',
        success: function (data) {
            $('#id').val(data.idgallery)
            $('#caption').val(data.caption)
            $('label.custom-file-label')[0].innerHTML = data.gambar
            $('#inputfile')[0].required = false
        }
    })
})

$("button.tambahGallery").on("click", function () {
    $("#judulModal").html("Tambah Data Gallery")
    $(".modal-footer button[type=submit]").html("Tambah Data")
    $(".modal-footer button[type=submit]")[0].name = "tambah"
    $('#id').val(null)
    $('#caption').val(null)
    $('label.custom-file-label')[0].innerHTML = "Choose file"
    $('#inputfile')[0].required = true
})

// Admin - Berita
$("button.btnUbah.ubahBerita").on("click", function () {
    const id = $(this).data('id')

    $("#judulModal").html("Ubah Data Berita")
    $(".modal-footer button[type=submit]").html("Ubah Data")
    $(".modal-footer button[type=submit]")[0].name = "ubah"

    $.ajax({
        url: '../ajax/ubahberita.php',
        data: { id: id },
        method: 'post',
        dataType: 'json',
        success: function (data) {
            $('#id').val(data.idberita)
            $('#judul').val(data.judul)
            $('#konten').val(data.konten)
            $('label.custom-file-label')[0].innerHTML = data.gambar
            $('#inputfile')[0].required = false
        }
    })
})

$("button.tambahBerita").on("click", function () {
    const berita = document.querySelector(".formdata")

    $("#judulModal").html("Tambah Data Berita")
    $(".modal-footer button[type=submit]").html("Tambah Data")
    $(".modal-footer button[type=submit]")[0].name = "tambah"

    ajaxhal("../ajax/tambahdata.php", berita)
    $('label.custom-file-label')[0].innerHTML = "Choose file"
    $('#inputfile')[0].required = true
})

// Admin - Jadwal
$("button.btnUbah.ubahJadwal").on("click", function () {
    const id = $(this).data('id')

    $("#judulModal").html("Ubah Data Jadwal")
    $(".modal-footer button[type=submit]").html("Ubah Data")
    $(".modal-footer button[type=submit]")[0].name = "ubah"

    $.ajax({
        url: '../ajax/ubahjadwal.php',
        data: { id: id },
        method: 'post',
        dataType: 'json',
        success: function (data) {
            $('#id').val(data.idjadwal)
            $('#kelas').val(data.idkelas)
            $('#pelatih').val(data.idpengurus)
            $('#hari').val(data.hari)
            $('#type').val(data.type)
            $('#mulai').val(data.mulai)
            $('#selesai').val(data.selesai)
            if (data.tgl != "0000-00-00") {
                $('#tgl').val(data.tgl)
                $('#tgl')[0].readOnly = false
                $('#tgl')[0].required = true
            }
            else{
                $('#tgl')[0].readOnly = true
                $('#tgl')[0].required = false
            }
        }
    })
})

$("button.tambahJadwal").on("click", function () {
    $("#judulModal").html("Tambah Data Jadwal")
    $(".modal-footer button[type=submit]").html("Tambah Data")
    $(".modal-footer button[type=submit]")[0].name = "tambah"

    $('#kelas').val($('#kelas option')[0].value)
    $('#pelatih').val($('#pelatih option')[0].value)
    $('#hari').val($('#hari option')[0].value)
    $('#type').val($('#type option')[0].value)
    $('#tgl').val(null)
    $('#mulai').val('08:00')
    $('#selesai').val('10:00')
    $('#tgl')[0].readOnly = true
    $('#tgl')[0].required = false
})

$('#type').on('input', function() {
    if (this.value == 'Perlombaan' || this.value == 'Latihan Nasional') {
        $('#tgl')[0].readOnly = false
        $('#tgl')[0].required = true
    }
    else{
        $('#tgl')[0].readOnly = true
        $('#tgl')[0].required = false
    }
})

// Admin - Pengurus
$("button.btnUbah.ubahPengurus").on("click", function () {
    const id = $(this).data('id')
    const container = document.querySelector('#formdata')

    $("#judulModal").html("Ubah Data Pengurus")
    $(".modal-footer button[type=submit]").html("Ubah Data")
    $(".modal-footer button[type=submit]")[0].name = "ubah"

    ajaxhal("../ajax/ubahPengurus.php?id=" + id, container)
    $.ajax({
        url: '../ajax/valPengurus.php',
        data: { id: id },
        method: 'post',
        dataType: 'json',
        success: function (data) {
            $('#jabatan').val(data.jabatan)
            $('label.custom-file-label')[0].innerHTML = data.foto
        }
    })
})

$("button.tambahPengurus").on("click", function () {
    const container = document.querySelector('#formdata')

    $("#judulModal").html("Tambah Data Pengurus")
    $(".modal-footer button[type=submit]").html("Tambah Data")
    $(".modal-footer button[type=submit]")[0].name = "tambah"

    ajaxhal("../ajax/tambahPengurus.php", container)
    $('#jabatan').val("Pelatih")
    $('label.custom-file-label')[0].innerHTML = "Choose file"
})