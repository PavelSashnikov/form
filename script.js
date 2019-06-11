    //if cookie exist
var cookie = document.cookie.split('=');
if (cookie.length > 1) {
    $('body').html('Hello, ' + cookie[1] + '<br><a href = "/exit.php">Выйти</a>');
}

$(document).ready(function () {
    $('button').attr('disabled', false);

    //submit login
    $('#log-form').submit(function (event) {
        event.preventDefault();
        var form = $(this);

        $.ajax({
            cache: false,
            type: form.attr('method'),
            url: form.attr('action'),
            dataType: 'json',
            data: form.serialize()
        }).done(function (res) {                         //check user  
            if (!res == '') {                                        //wrong
                $('#login-error').html(res);
            } else {
                var userName = $('input[name="login"]').val();      //success
                $('body').html('Hello, ' + userName + '<br><a href = "/exit.php">Выйти</a>');
            }
        }).fail(function () {
            alert('UPS...');


        })
    });

    //submit signup
    $('#sign-form').submit(function (event) {
        event.preventDefault();
        var form = $(this);

        $.ajax({
            cache: false,
            type: form.attr('method'),
            url: form.attr('action'),
            dataType: 'json',
            data: form.serialize()
        }).done(function (res) {                         //check user  
            if (res.length > 0) {
                $.each(res, function(_key, el) {        //wrong
                    $('#signup-error').append('<li>' + el + '</li>')
                })
            } else {                                    //success
                $('body').html('<a href = "/index.html">Вы успешно зарегистрировались, войдите чтобы продолжить</a>');
            }
        }).fail(function () {
            alert('UPS...');


        })
    });

});