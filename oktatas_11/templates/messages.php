<div class='messages-wrapper'>
    <?php foreach ($messages as $index => $message) :
        $userId = (int) $_SESSION['user']['id'];
        $class = 'receiver ';
        $user1 = 'right_user';
        $user2 = 'left_user';

        if ($message['sender_id'] === $userId) {
            $class = 'sender ';
        }
        ?>

        <div class='message-wrapper <?php echo $class; ?>'>
            <?php 
                if (array_key_exists($index-1, $messages) && 
                    $messages[$index-1]['sender_id'] !== $messages[$index]['sender_id'] &&
                    $messages[$index]['sender_id'] !== $userId
                ) {
                    echo "<span class='name'>$user2</span>";
                }
            ?>

            <span 
                title="<?php echo $message['created_at']; ?>" 
                class="message"
            >
                <?php echo $message['message']; ?>
            </span>

            <?php if ($index >= count($messages)-1) : ?>
                <span class="date">
                    <?php echo $message['created_at']; ?>
                </span>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>