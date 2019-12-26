$(document).ready(function () {

    $('label.form-check-label').click(function () {
        let pathname = removeParametrs();
        pathname += '/checked';
        let id = $(this).data('id');
        let _csrf = $('#_csrf').val();
        let completed = $(this).prev('.form-check-input').val();
        if(completed === '1'){
            completed = 0;
        }else {
            completed = 1;
        }
        console.log(pathname);
        console.log(id);
        console.log(completed);

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: pathname,
            data: {'id': id, '_csrf': _csrf, 'completed': completed},
            success: function (data) {
                console.log('success');
                console.log(data);
                showMessage(data.message_success, true);
            },
            error: function (data) {
                console.log('error');
                console.log(data);
                showMessage(data.message_error, false);
            }
        });

    });

    function removeParametrs(){
        let url = window.location.href;
        let arrUrl = url.split('/');
        arrUrl.length = 4;
        console.log(arrUrl);
        url = arrUrl.join('/');
        return url;
    }

    $('input.btn-delete').click(function () {
        let pathname = 'delete/';
        let id = $(this).data('id');
        let _csrf = $(this).data('csrf');
        let tr = $(this).closest('tr');
        console.log(pathname);

        $.ajax({
            type: "POST",
            url: pathname,
            data: {'id': id, '_csrf': _csrf},
            success: function (data) {
                console.log('success');
                console.log(data);
                tr.remove();
            },
            error: function (data) {
                console.log('error');
                console.log(data);
            }
        });

    });


    $('input[type="checkbox"]').change(function(){
        this.value = (Number(this.checked));
    });

    function showMessage(txt, type){
        if(type) {
            $('#error-message-text').text('');
            $('#success-message-text').text(txt);
            $('#success-message').removeClass('d-none');
            $('#error-message').addClass('d-none');
        }else{
            $('#error-message-text').text(txt);
            $('#success-message-text').text('');
            $('#error-message').removeClass('d-none');
            $('#error-message').addClass('d-none');
        }
    }


    if($('#url').is(":visible")){
        bootstrapValidate('#url', 'url:Please enter a valid URL!')
    }

    if($('#name').is(":visible")){
        bootstrapValidate('#name', 'alphanum:Please only enter alphanumeric characters!');
    }
    if($('#email').is(":visible")) {
        bootstrapValidate(
            '#email',
            'email:Enter a valid E-Mail Address!'
        );
    }

});

