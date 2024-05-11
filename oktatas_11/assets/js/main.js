(function($) {
    $(document).ready(function() {
        $('button').on('click', function() {
            if ($(this).parent().hasClass('login-form')) {
                $.post("http://oktatas.local", {
                    email: $('input[name="email"]').val(),
                    password: $('input[name="password"]').val(),
                    action: 'login'
                }).done(function(response) {
                    const responseData = JSON.parse(response);

                    if (responseData.success === true) {
                        window.location.replace('/');
                    }
                });
            } else {
                const urlParams = new URLSearchParams(window.location.search);
   
                $.post("http://oktatas.local", {
                    message: $('textarea').val(),
                    action: 'new-message',
                    user_to: urlParams.get('sender_id')

                }).done(function(response) {
                    console.log(response);
                });
            }
        });

        setInterval(function() {
            if (user && user.id) {
                $.get("http://oktatas.local/messages/" + user.id, {
                    message: $('textarea').val()
                }).done(function(response) {
                    if (response) {
                        const $messages = $(response);
                        $('.messages-wrapper').html($messages.html());
                    }
                });
            }
        }, 1000);
    });
})(jQuery);
