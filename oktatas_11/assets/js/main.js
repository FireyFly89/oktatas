(function($) {
    $(document).ready(function() {
        $('button').on('click', function() {
            if ($(this).parent().hasClass('login-form')) {
                $.post("http://oktatas.local", {
                    email: $('input[name="email"]').val(),
                    password: $('input[name="password"]').val(),
                    action: 'login'
                }).done(function(response) {
                    console.log(response);
                });
            } else {
                $.post("http://oktatas.local", {
                    message: $('textarea').val(),
                    action: 'new-message'
                }).done(function(response) {
                    console.log(response);
                });
            }
        });

        setInterval(function() {
            $.get("http://oktatas.local/messages/1", {
                message: $('textarea').val()
            }).done(function(response) {
                if (response) {
                    const $messages = $(response);
                    $('.messages-wrapper').html($messages.html());
                }
            });
        }, 1000);
    })
})(jQuery);
