autosize(document.getElementsByClassName("autosizes"));
$('.porn-nav-item').hover(function() {
    $(this).find('.porn-header__submenu-sub').stop(true, true).slideDown(500);
}, function() {
    $(this).find('.porn-header__submenu-sub').stop(true, false).slideUp(500);
});
$(document).ready(function() {
    $(".lightgallery").lightGallery({
        share: false
    });
    $("#lightgallery").lightGallery({
        share: false
    });
    $('#top').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        return false;
    })
});

$(document).on('click', '#wincategory', function () {
    $.ajax({
        url: '/ajax/wincategory',
        type: 'POST',
        dataType: 'HTML',
        success: Success,
        beforeSend: Before
    });

    function Success(data) {
        $('body').append(data).css({
            "overflow": "hidden"
        })
        $('.owner-load').fadeIn();
        $('.loads-all').fadeOut();
    }

    function Before() {
        $('.loads-all').fadeIn();
    }
});
$(document).on('click', '#winload', function () {
    $.ajax({
        url: '/ajax/winloadimg',
        type: 'POST',
        dataType: 'HTML',
        success: Success,
        beforeSend: Before

    });

    function Success(data) {
        $('body').append(data).css({
            "overflow": "hidden"
        })
        $('.owner-load').fadeIn();
        $('.loads-all').fadeOut();
    }

    function Before() {
        $('.loads-all').fadeIn();
    }

});
$(document).on('click', '#winvideo', function () {
    $.ajax({
        url: '/ajax/winvideo',
        type: 'POST',
        dataType: 'HTML',
        success: Success,
        beforeSend: Before
    });

    function Success(data) {
        $('body').append(data).css({
            "overflow": "hidden"
        })
        $('.owner-load').fadeIn();
        $('.loads-all').fadeOut();
    }

    function Before() {
        $('.loads-all').fadeIn();
    }
});
$(document).on('click', '#wincomics', function () {
    $.ajax({
        url: '/ajax/wincomics',
        type: 'POST',
        dataType: 'HTML',
        success: Success,
        beforeSend: Before
    });

    function Success(data) {
        $('body').append(data).css({
            "overflow": "hidden"
        })
        $('.owner-load').fadeIn();
        $('.loads-all').fadeOut();
    }

    function Before() {
        $('.loads-all').fadeIn();
    }
});
$(document).on('click', '#winmemes', function () {
    $.ajax({
        url: '/ajax/winmemes',
        type: 'POST',
        dataType: 'HTML',
        success: Success,
        beforeSend: Before
    });

    function Success(data) {
        $('body').append(data).css({
            "overflow": "hidden"
        })
        $('.owner-load').fadeIn();
    }

    function Before() {
        $('.loads-all').fadeIn();
    }
});

$(document).on('change', '#imgfilecategory', function () {
    $.each(this.files, function (i, file) {
        sendFile(file, '/ajax/category', 'img');
    });
});
$(document).on('change', '#imgfilevideo', function () {
    $.each(this.files, function (i, file) {
        sendFile(file, '/ajax/video', 'video');
    });
});
$(document).on('change', '#imgload', function () {
    $.each(this.files, function (i, file) {
        sendFile(file, '/ajax/img', 'imgs');
    });
});
$(document).on('change', '#imgloadcom', function () {
    $.each(this.files, function (i, file) {
        sendFile(file, '/ajax/comics', 'imgs');
    });
});
$(document).on('change', '#imgmemes', function () {
    $.each(this.files, function (i, file) {
        sendFile(file, '/ajax/memes', 'memes');
    });
});

function sendFile(file, url, type) {
    var xhr = new XMLHttpRequest();
    var fd = new FormData();
    xhr.upload.onprogress = function (event) {
        var progress = Math.floor((event.loaded / event.total) * 90);
        $('.position-load').fadeIn();
        $('.position-load').width(progress + '%');
    }
    xhr.open("POST", url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var data = JSON.parse((xhr.responseText));
            if (data[0] == true) {
                if (type == "imgs") {
                    $('#img').val($('#img').val() + data[1] + ';');
                } else if (type == "memes") {
                    $('#img').val($('#img').val() + data[1]);
                } else {
                    $('.owner-load').fadeOut();
                    $('.owner-drag').fadeIn();
                    $('#target').attr('src', data[1]);
                    targetStart(type);
                }
            }
        }
    };
    fd.append('response', file);
    xhr.send(fd);
}

function targetStart(type) {
    var x1, y1, x2, y2, crop = 'image/cat/';
    var jcrop_api;
    var he = $("#target").height();
    var wi = $("#target").width();
    if (type == 'video') crop = 'image/video/';
    $('#target').Jcrop({
        onChange: showCoords,
        onSelect: showCoords,
        bgColor: 'black',
        bgOpacity: .4,
        setSelect: [he, he, 0, 0],
        minSize: [90, 90],
        aspectRatio: 1 / 1
    }, function () {
        jcrop_api = this;
    });
    $('#release').click(function (e) {
        release();
    });

    function showCoords(c) {
        x1 = c.x;
        $('#x1').val(c.x);
        y1 = c.y;
        $('#y1').val(c.y);
        x2 = c.x2;
        $('#x2').val(c.x2);
        y2 = c.y2;
        $('#y2').val(c.y2);
        $('#w').val(c.w);
        $('#h').val(c.h);
        if (c.w > 0 && c.h > 0) {
            $('#crop').fadeIn();
        } else {
            $('#crop').fadeOut();
        }
    }

    function release() {
        jcrop_api.release();
    }
    $(document).on('click', '#crop', function (e) {
        var img = $('#target').attr('src');
        img = 'http://dirty.com' + img;
        var he = $("#target").height();
        var wi = $("#target").width();
        $.post('/ajax/resize', {
            'x1': x1,
            'x2': x2,
            'y1': y1,
            'y2': y2,
            'img': img,
            'crop': crop,
            'he': he,
            'wi': wi,
            'type': type
        }, function (file) {
            $('.win__fixed').fadeOut();
            $('.win__fixed').remove();
            $('body').css({
                "overflow": "auto"
            });
            $('#url').val(file);
        });
    });
}


$(document).on('click', '#memes', function () {
    warning = 0;
    $('.warning').remove();
    $('.response-form').stop(true, true).fadeOut();
    var name = $('#name').val();
    var img = $('#img').val();
    if (warning == 0) {
        $.ajax({
            url: '/ajax/imemes',
            type: 'post',
            dataType: 'json',
            data: {
                name: name,
                img: img
            },
            success: Success,
            beforeSend: Before
        });

        function Success(data) {
            if (data[0] == true) {
                $('.response-form').html('<div class="done-img">Фотографии добавлены.</div>');
                $('.response-form').fadeIn();
            } else {
                $('.response-form').text(data[1]);
                $('.response-form').fadeIn();
            }
            $('.loads-all').fadeOut();
        }

        function Before() {
            $('.loads-all').fadeIn();
        }
    }
});
$(document).on('click', '#comics', function () {
    warning = 0;
    $('.warning').remove();
    $('.response-form').stop(true, true).fadeOut();
    var name = valid('#name', 4, 128);
    var desc = valid('#desc', 4, 1024);
    var img = $('#img').val();
    var pre = $('#pre').val();
    if (warning == 0) {
        $.ajax({
            url: '/ajax/icomics',
            type: 'post',
            dataType: 'json',
            data: {
                name: name,
                desc: desc,
                img: img,
                pre: pre
            },
            success: Success,
            beforeSend: Before
        });

        function Success(data) {
            if (data[0] == true) {
                $('.response-form').html('<div class="done-img">Фотографии добавлены.</div>');
                $('.response-form').fadeIn();
            } else {
                $('.response-form').text(data[1]);
                $('.response-form').fadeIn();
            }
            $('.loads-all').fadeOut();
        }

        function Before() {
            $('.loads-all').fadeIn();
        }
    }
});
$(document).on('click', '#photos', function () {
    warning = 0;
    $('.warning').remove();
    $('.response-form').stop(true, true).fadeOut();
    var name = valid('#name', 4, 128);
    var desc = valid('#desc', 4, 1024);
    var img = $('#img').val();
    var pre = $('#pre').val();
    if (warning == 0) {
        $.ajax({
            url: '/ajax/iphotos',
            type: 'post',
            dataType: 'json',
            data: {
                name: name,
                desc: desc,
                img: img,
                pre: pre
            },
            success: Success,
            beforeSend: Before
        });

        function Success(data) {
            if (data[0] == true) {
                $('.response-form').html('<div class="done-img">Фотографии добавлены.</div>');
                $('.response-form').fadeIn();
            } else {
                $('.response-form').text(data[1]);
                $('.response-form').fadeIn();
            }
            $('.loads-all').fadeOut();
        }

        function Before() {
            $('.loads-all').fadeIn();
        }
    }
});
$(document).on('click', '#category', function () {
    warning = 0;
    $('.warning').remove();
    $('.response-form').stop(true, true).fadeOut();
    var namec = valid('#namec', 4, 128);
    var url = valid('#url', 4, 128);
    if (warning == 0) {
        $.ajax({
            url: '/ajax/icategory',
            type: 'post',
            dataType: 'json',
            data: {
                namec: namec,
                url: url
            },
            success: Success,
            beforeSend: Before
        });

        function Success(data) {
            if (data[0] == true) {
                $('.response-form').html('<div class="done-img">Категория <b>"' + $('#namec').val() + '"</b> добавлена.</div>');
                $('.response-form').fadeIn();
            } else {
                $('.response-form').text(data[1]);
                $('.response-form').fadeIn();
            }
            $('.loads-all').fadeOut();
        }

        function Before() {
            $('.loads-all').fadeIn();
        }
    }
});
$(document).on('click', '#stories', function () {
    warning = 0;
    $('.warning').remove();
    $('.response-form').stop(true, true).fadeOut();
    var name = valid('#name', 4, 128);
    var story = valid('#story', 4, 10000);
    if (warning == 0) {
        $.ajax({
            url: '/ajax/ihistory',
            type: 'post',
            dataType: 'json',
            data: {
                name: name,
                story: story
            },
            success: Success,
            beforeSend: Before
        });

        function Success(data) {
            if (data[0] == true) {
                $('.response-form').html('<div class="done-img">История добавлена.</div>');
                $('.response-form').fadeIn();
            } else {
                $('.response-form').text(data[1]);
                $('.response-form').fadeIn();
            }
            $('.loads-all').fadeOut();
        }

        function Before() {
            $('.loads-all').fadeIn();
        }
    }
});
$(document).on('click', '#video', function () {
    warning = 0;
    $('.warning').remove();
    $('.response-form').stop(true, true).fadeOut();
    var namec = valid('#namec', 4, 128);
    var url = valid('#url', 4, 128);
    var cats = $('#cats').val();
    var desc = $('#desc').val();
    var urlv = $('#urlv').val();
    if (warning == 0) {
        $.ajax({
            url: '/ajax/ivideo',
            type: 'post',
            dataType: 'json',
            data: {
                namec: namec,
                url: url,
                cats: cats,
                desc: desc,
                urlv: urlv
            },
            success: Success,
            beforeSend: Before
        });

        function Success(data) {
            if (data[0] == true) {
                $('.response-form').html('<div class="done-img">Видео добавлено.</div>');
                $('.response-form').fadeIn();
            } else {
                $('.response-form').text(data[1]);
                $('.response-form').fadeIn();
            }
            $('.loads-all').fadeOut();
        }

        function Before() {
            $('.loads-all').fadeIn();
        }
    }
});

function valid(selector, min, max, pattern, texterror) {
    if ($(selector).val().length == 0) {
        warning++;
        $(selector).after("<div class='warning'>Вы не заполнили поле</div>");
        $(selector).css({
            borderBottom: '2px solid #9c27b0'
        });
    } else if ($(selector).val().length < min) {
        warning++;
        $(selector).after("<div class='warning'>Не менее " + min + " символов</div>");
        $(selector).css({
            borderBottom: '2px solid #9c27b0'
        });
    } else if ($(selector).val().length > max) {
        warning++;
        $(selector).after("<div class='warning'>Не более " + max + " символов</div>");
        $(selector).css({
            borderBottom: '2px solid #9c27b0'
        });
    } else if (pattern !== undefined) {
        if (!pattern.test($(selector).val())) {
            warning++;
            $(selector).after("<div class='warning'>" + texterror + "</div>");
            $(selector).css({
                borderBottom: '2px solid #9c27b0'
            });
        } else {
            $(selector).css({
                border: '1px solid rgb(236, 232, 232)'
            });
            return $(selector).val();
        }
    } else {
        $(selector).css({
            border: '1px solid rgb(236, 232, 232)'
        });
        return $(selector).val();
    }
}
$(document).on('click', '.win_fixed-exit', function () {
    $('.win__fixed').fadeOut();
    $('.win__fixed').remove();
    $('body').css({
        "overflow": "auto"
    });
});
$('.input_box textarea').on("input", function () {
    if ($(this).val().length > 0) {
        $(this).css({
            "padding": "14px 8px 2px 8px"
        });
        $(this).prev(".input_placeholder").css({
            "transform": "scale(.83333) translateY(-12px)"
        });
    } else {
        $(this).prev(".input_placeholder").css({
            "transform": "none"
        });
        $(this).css({
            "padding": "8px 8px 9px 8px"
        });
    }
});
$('.input_box input').on("input", function () {
    if ($(this).val().length > 0) {
        $(this).css({
            "padding": "14px 8px 2px 8px"
        });
        $(this).prev(".input_placeholder").css({
            "transform": "scale(.83333) translateY(-12px)"
        });
    } else {
        $(this).prev(".input_placeholder").css({
            "transform": "none"
        });
        $(this).css({
            "padding": "8px 8px 9px 8px"
        });
    }
});

var email_pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
var login_pattern = /^[a-zA-Z][a-zA-Z0-9-_\.]{2,20}$/s
var warning = 0;

function valid(selector, min, max, pattern, texterror) {
    if ($(selector).val().length == 0) {
        warning++;
        $(selector).after("<div class='warning'>Вы не заполнили поле</div>");
        $(selector).css({
            borderBottom: '2px solid #9c27b0'
        });
    } else if ($(selector).val().length < min) {
        warning++;
        $(selector).after("<div class='warning'>Не менее " + min + " символов</div>");
        $(selector).css({
            borderBottom: '2px solid #9c27b0'
        });
    } else if ($(selector).val().length > max) {
        warning++;
        $(selector).after("<div class='warning'>Не более " + max + " символов</div>");
        $(selector).css({
            borderBottom: '2px solid #9c27b0'
        });
    } else if (pattern !== undefined) {
        if (!pattern.test($(selector).val())) {
            warning++;
            $(selector).after("<div class='warning'>" + texterror + "</div>");
            $(selector).css({
                borderBottom: '2px solid #9c27b0'
            });
        } else {
            $(selector).css({
                border: '1px solid rgb(236, 232, 232)'
            });
            return $(selector).val();
        }
    } else {
        $(selector).css({
            border: '1px solid rgb(236, 232, 232)'
        });
        return $(selector).val();
    }
}
$(document).on('input', '#login', function() {
    $('.warning').remove();
    valid('#login', 5, 32, login_pattern, 'Некорректный формат логина');
});
$(document).on('input', '#password', function() {
    $('.warning').remove();
    valid('#password', 8, 48);
});
$(document).on('input', '#code', function() {
    $('.warning').remove();
    valid('#code', 4, 4);
});
$(document).on('input', '#name', function() {
    $('.warning').remove();
    valid('#name', 4, 32);
});
$(document).on('input', '#surname', function() {
    $('.warning').remove();
    valid('#surname', 4, 32);
});
$(document).on('input', '#email', function() {
    $('.warning').remove();
    valid('#email', 5, 64, email_pattern, 'Некорректный формат электронная почта');
});
$(document).on('input', '#password', function() {
    $('.warning').remove();
    valid('#password', 8, 48);
});
$(document).on('input', '#password_confirm', function() {
    $('.warning').remove();
    valid('#password_confirm', 8, 48);
});
$(document).on('input', '#url', function() {
    $('.warning').remove();
    valid('#url', 4, 128);
});
$(document).on('input', '#namec', function() {
    $('.warning').remove();
    valid('#namec', 4, 512);
});


$(document).on('click', '#auth', function() {
    warning = 0;
    $('.warning').remove();
    $('.response-form').stop(true, true).fadeOut();
    var login = valid('#login', 5, 32, login_pattern, 'Некорректный формат логина');
    var password = valid('#password', 8, 48);
    if (warning == 0) {
        $.ajax({
            url: '/ajax/auth',
            type: 'post',
            dataType: 'json',
            data: {
                login: login,
                password: password
            },
            success: Success,
            beforeSend: Before
        });

        function Success(data) {
            if (data[0] == true) {
                document.location = '/';
            } else {
                $('.response-form').text(data[1]);
                $('.response-form').fadeIn();
            }
            $('.loads-all').fadeOut();
        }

        function Before() {
            $('.loads-all').fadeIn();
        }
    }
});
$(document).on('click', '#activation', function() {
    warning = 0;
    $('.warning').remove();
    $('.response-form').stop(true, true).fadeOut();
    var code = valid('#code', 4, 4);
    if (warning == 0) {
        $.ajax({
            url: '/ajax/activation',
            type: 'post',
            dataType: 'json',
            data: {
                code: code
            },
            success: Success,
            beforeSend: Before
        });

        function Success(data) {
            if (data[0] == true) {
                document.location = '/';
            } else {
                $('.response-form').text(data[1]);
                $('.response-form').fadeIn();
            }
            $('.loads-all').fadeOut();
        }

        function Before() {
            $('.loads-all').fadeIn();
        }
    }
});
$(document).on('click', '#likerecord', function() {
    var id_record = $(this).attr('id_record');
    var id_group = $(this).attr('id_group');
    $.ajax({
        url: '/ajax/likerecord',
        type: 'post',
        dataType: 'json',
        data: {
            id_record: id_record,
            id_group: id_group
        },
        success: Success,
        beforeSend: Before
    });

    function Success(data) {
        $('.loads-all').fadeOut();
    }

    function Before() {
        $('.loads-all').fadeIn();
    }
});
$(document).on('click', '#reg', function() {
    warning = 0;
    $('.warning').remove();
    $('.response-form').stop(true, true).fadeOut();
    var name = valid('#name', 4, 32);
    var surname = valid('#surname', 4, 32);
    var email = valid('#email', 5, 64, email_pattern, 'Некорректный формат электронная почта');
    var login = valid('#login', 5, 32, login_pattern, 'Некорректный формат логина');
    valid('#password', 8, 48);
    valid('#password_confirm', 8, 48);
    if ($('#password').val() !== $('#password_confirm').val()) {
        warning++;
        $('#password').after("<div class='warning'>Пароли не совпадают</div>");
        $('#password').css({
            border: '2px solid #E91E63'
        });
        $('#password_confirm').after("<div class='warning'>Пароли не совпадают</div>");
        $('#password_confirm').css({
            border: '2px solid #E91E63'
        });
    } else {
        $('#password_confirm').css({
            border: '1px solid rgb(236, 232, 232)'
        });
        $('#password').css({
            border: '1px solid rgb(236, 232, 232)'
        });
        var password_confirm = $('#password_confirm').val();
        var password = $('#password').val();
    }
    if (warning == 0) {
        $.ajax({
            url: '/ajax/reg',
            type: 'post',
            dataType: 'json',
            data: {
                name: name,
                surname: surname,
                email: email,
                login: login,
                password: password,
                password_confirm: password_confirm
            },
            success: Success,
            beforeSend: Before
        });

        function Success(data) {
            if (data[0] == true) {
                document.location = '/reg/activation';
            } else {
                $('.response-form').text(data[1]);
                $('.response-form').fadeIn();
            }
            $('.loads-all').fadeOut();
        }

        function Before() {
            $('.loads-all').fadeIn();
        }
    }
});
$(document).on('click', '.bt-st', function() {
    if ($(this).parent().parent().find('.porn-category-bottom').hasClass('opens')) {
        $(this).parent().parent().find('.porn-category-bottom').removeClass("opens");
        $(this).text('Окрыть полностью');
    } else {
        $(this).parent().parent().find('.porn-category-bottom').addClass("opens");
        $(this).text('Закрыть');
    }
    var id = $(this).parent().parent().parent().attr('id');
    var target = document.getElementById(id);
    $('html, body').animate({
        scrollTop: $(target).offset().top - 62
    }, 1000);
});
$('.input_box textarea').on("input", function() {
    if ($(this).val().length > 0) {
        $(this).css({
            "padding": "14px 8px 2px 8px"
        });
        $(this).prev(".input_placeholder").css({
            "transform": "scale(.83333) translateY(-12px)"
        });
    } else {
        $(this).prev(".input_placeholder").css({
            "transform": "none"
        });
        $(this).css({
            "padding": "8px 8px 9px 8px"
        });
    }
});
$('.input_box input').on("input", function() {
    if ($(this).val().length > 0) {
        $(this).css({
            "padding": "14px 8px 2px 8px"
        });
        $(this).prev(".input_placeholder").css({
            "transform": "scale(.83333) translateY(-12px)"
        });
    } else {
        $(this).prev(".input_placeholder").css({
            "transform": "none"
        });
        $(this).css({
            "padding": "8px 8px 9px 8px"
        });
    }
});