autosize(document.getElementsByClassName("autosizes"));

$('.porn-nav-item').hover(
    function () {
        $(this).find('.porn-header__submenu-sub').stop(true, true).slideDown(500);
    },
    function () {
        $(this).find('.porn-header__submenu-sub').stop(true, false).slideUp(500);
    });

$(document).ready(function () {
    $(".lightgallery").lightGallery({
        share: false
    });

    $("#lightgallery").lightGallery({
        share: false
    });

    $('#top').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        return false;
    })
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


$(document).on('input', '#login', function () {
    $('.warning').remove();
    valid('#login', 5, 32, login_pattern, 'Некорректный формат логина');
});
$(document).on('input', '#password', function () {
    $('.warning').remove();
    valid('#password', 8, 48);
});

$(document).on('input', '#code', function () {
    $('.warning').remove();
    valid('#code', 4, 4);
});

$(document).on('input', '#name', function () {
    $('.warning').remove();
    valid('#name', 4, 32);
});
$(document).on('input', '#surname', function () {
    $('.warning').remove();
    valid('#surname', 4, 32);
});
$(document).on('input', '#email', function () {
    $('.warning').remove();
    valid('#email', 5, 64, email_pattern, 'Некорректный формат электронная почта');
});
$(document).on('input', '#password', function () {
    $('.warning').remove();
    valid('#password', 8, 48);

});
$(document).on('input', '#password_confirm', function () {
    $('.warning').remove();
    valid('#password_confirm', 8, 48);


});

$(document).on('input', '#url', function () {
    $('.warning').remove();
    valid('#url', 4, 128);


});
$(document).on('input', '#namec', function () {
    $('.warning').remove();
    valid('#namec', 4, 128);


});



$(document).on('click', '.win_fixed-exit', function () {
    $('.win__fixed').fadeOut();
    $('.win__fixed').remove();
    $('body').css({
        "overflow": "auto"
    });

});

$(document).on('click', '#photos', function () {
    warning = 0;
    $('.warning').remove();
    $('.response-form').stop(true, true).fadeOut();

    var name = valid('#name', 4, 128);
    var desc = valid('#desc', 4, 1024);
    var img =  $('#img').val();
    var pre =  $('#pre').val();
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
            console.log(data);

            if (data[0] == true) {
                $('.response-form').html('<div class="done-img">Фотографии добавлены.</div>');
                $('.response-form').fadeIn();
            } else {
                $('.response-form').text(data[1]);
                $('.response-form').fadeIn();
            }
        }

        function Before() {
            //TODO анимация загрузки
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
            dataType: 'html',
            data: {
                namec: namec,
                url: url
            },
            success: Success,
            beforeSend: Before
        });

        function Success(data) {
            console.log(data);

            if (data[0] == true) {
                $('.response-form').html('<div class="done-img">Категория <b>"' + $('#namec').val() + '"</b> добавлена.</div>');
                $('.response-form').fadeIn();
            } else {
                $('.response-form').text(data[1]);
                $('.response-form').fadeIn();
            }
        }

        function Before() {
            //TODO анимация загрузки
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
            console.log(data);

            if (data[0] == true) {
                $('.response-form').html('<div class="done-img">История добавлена.</div>');
                $('.response-form').fadeIn();
            } else {
                $('.response-form').text(data[1]);
                $('.response-form').fadeIn();
            }
        }

        function Before() {
            //TODO анимация загрузки
        }
    }
});

$(document).on('click', '#video', function () {
    warning = 0;
    $('.warning').remove();
    $('.response-form').stop(true, true).fadeOut();

    var namec = valid('#namec', 4, 128);
    var url = valid('#url', 4, 128);
    var cats =  $('#cats').val();
    var desc =  $('#desc').val(); 
    var urlv =  $('#urlv').val(); 

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
            console.log(data);

            if (data[0] == true) {
                $('.response-form').html('<div class="done-img">Видео добавлено.</div>');
                $('.response-form').fadeIn();
            } else {
                $('.response-form').text(data[1]);
                $('.response-form').fadeIn();
            }
        }

        function Before() {
            //TODO анимация загрузки
        }
    }
});

$(document).on('click', '#auth', function () {
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
            console.log(data);

            if (data[0] == true) {
                document.location = '/';
            } else {
                $('.response-form').text(data[1]);
                $('.response-form').fadeIn();
            }
        }

        function Before() {
            //TODO анимация загрузки
        }
    }
});

$(document).on('click', '#activation', function () {
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
            console.log(data);

            if (data[0] == true) {
                document.location = '/';
            } else {
                $('.response-form').text(data[1]);
                $('.response-form').fadeIn();
            }
        }

        function Before() {
        }
    }
});


$(document).on('click', '#likerecord', function () {

    var id_record = $(this).attr('id_record');
    var id_group = $(this).attr('id_group');

    $.ajax({
        url: '/ajax/likerecord',
        type: 'post',
        dataType: 'html',
        data: {
            id_record: id_record,
            id_group: id_group
        },
        success: Success,
        beforeSend: Before
    });

    function Success(data) {
        console.log(data);

    }

    function Before() {
    }

});


$(document).on('click', '#reg', function () {
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
            console.log(data);

            if (data[0] == true) {
                document.location = '/reg/activation';
            } else {
                $('.response-form').text(data[1]);
                $('.response-form').fadeIn();
            }
        }

        function Before() {}
    }
});

$(document).on('click', '.bt-st', function () {

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