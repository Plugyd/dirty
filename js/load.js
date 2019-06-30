$(document).on('click', '#wincategory', function () {
    $.ajax({
        url: '/ajax/wincategory',
        type: 'POST',
        dataType: 'HTML',
        success: Success
    });

    function Success(data) {
        $('body').append(data).css({
            "overflow": "hidden"
        })
        $('.owner-load').fadeIn();
    }
});


$(document).on('click', '#winvideo', function () {
    $.ajax({
        url: '/ajax/winvideo',
        type: 'POST',
        dataType: 'HTML',
        success: Success
    });

    function Success(data) {
        $('body').append(data).css({
            "overflow": "hidden"
        })
        $('.owner-load').fadeIn();
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


function sendFile(file, url, type) {
    var xhr = new XMLHttpRequest();
    var fd = new FormData();

    xhr.upload.onprogress = function (event) {
        var progress = Math.floor((event.loaded / event.total) * 90);
        $('.position-load').show();
        $('.position-load').width(progress + '%');
    }

    xhr.open("POST", url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var data = JSON.parse((xhr.responseText));
            if (data[0] == true) {
                $('.owner-load').hide();
                $('.owner-drag').show();
                $('#target').attr('src', data[1]);

                targetStart(type);
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
            $('#crop').show();
        } else {
            $('#crop').hide();
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