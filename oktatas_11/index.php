<?php
require_once "includes/Traits/UnderscoreColumns.php";
require_once "includes/DatabaseManager.php";
DatabaseManager::setTable('chat');
$messages = [];

if (!empty($_POST) && array_key_exists('message', $_POST)) {
    handleMessage($_POST);
    die();
} else {
    $dbManager = new DatabaseManager();
    $messages = DatabaseManager::read();
}
?>

<head>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    div {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    textarea {
        min-width: 500px;
        min-height: 200px;
    }
</style>

<script>
    /*window.addEventListener('load', () => {
        const message = document.getElementsByTagName("textarea")[0];
        const button = document.getElementsByTagName("button")[0];
        
        button.addEventListener('click', () => {
            console.log(message.value);

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "http://oktatas.local");
            xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
            xhr.onload = () => {
                if (xhr.readyState == 4 && xhr.status == 201) {
                    console.log(JSON.parse(xhr.responseText));
                } else {
                    console.log(`Error: ${xhr.status}`);
                }
            };
            xhr.send(JSON.stringify({
                message: message.value,
            }));

            fetch("http://oktatas.local", {
                method: "POST",
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                },
                body: JSON.stringify({
                    message: 'test',
                })
            })
            .then(function(response) { 
                console.log(response)
            });
        });
    })*/
    (function($){
        $(document).ready(function() {
            const $message = $('textarea');
            
            $('button').on('click', function() {
                $.post("http://oktatas.local", {
                    message: $message.val()
                }).done(function(response) {
                    console.log(response);
                });
            });

            setInterval(function() {
                $.get("http://oktatas.local/messages/1", {
                    message: $message.val()
                }).done(function(response) {
                    console.log(response);
                });
            }, 1000);
        });
    })(jQuery);
</script>

<div>
    <?php foreach ($messages as $message) {
        printf("<div>%s</div>", $message['message']);
    } ?>
    <div>
        <textarea name="message"></textarea>
        <button>Küldés</button>
    </div>
</div>

<?php
function handleMessage(array $data) {
    $message = $data['message'];
    $dbManager = new DatabaseManager();
    DatabaseManager::create([
        'sender_id' => 1,
        'receiver_id' => 2,
        'message' => $message,
    ]);

    echo json_encode(DatabaseManager::read());
}

function dd(mixed ...$data)
{
    echo "<pre>";
    if (count($data) > 1)  {
        foreach ($data as $output) {
            var_dump($output);
            echo "<br/>";
        }
    } else {
        var_dump(array_shift($data));
    }
    echo "</pre>";
    die();
}

function dump(mixed ...$data)
{
    echo "<pre>";
    if (count($data) > 1)  {
        foreach ($data as $output) {
            var_dump($output);
            echo "<br/>";
        }
    } else {
        var_dump(array_shift($data));
    }
    echo "</pre>";
}