<?php
session_start();

if (!isset($_SESSION['round'])) {
    $_SESSION['round'] = 0;
}

$questions = [
    'Melyik szám kissebb mint 5?',
    'Melyik virágnév tartalmaz T betűt?',
    'A kék színhez melyik színárnyalat áll a legközelebb?'
];
$answers = [
    ['choices' => [4, 5, 33, 11], 'answer' => 1],
    ['choices' => ['Rózsa', 'Ibolya', 'Jázmin', 'Muskátli'], 'answer' => 4],
    ['choices' => ['Piros', 'Lila', 'Türkíz', 'Sárga'], 'answer' => 3],
];

echo '<form method="POST">';
foreach ($questions as $key => $question) {
    if (!isRound($key)) {
        continue;
    }

    echo '<div style="padding: 10px 5px 10px 5px;">';
    echo '<div>';
    echo $question;
    echo '</div>';

    foreach (array_shift($answers) as $answerKey => $choices) {
        if ($answerKey !== 'choices') {
            continue;
        }
        
        foreach ($choices as $choice) {
            echo '<label>';
            echo $choice;
            echo sprintf('<input type="radio" name="answer" value="%s" />', $choice);
            echo '</label>';
        }
    }
    echo '</div>';
}
echo '<input type="submit" value="Beküldés" />';
echo '</form>';

function dd($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

function checkAnswer(array $answer) {
    global $answers;
    $solution = $answers[getRound()]['answer'];

    if ($answer['answer'] == $solution) {
        return true;
    }
}

function isRound(int $roundNumber) {
    return $_SESSION['round'] === $roundNumber;
}

function getRound() {
    return $_SESSION['round'];
}

function advanceRound() {
    $_SESSION['round'] += 1;
}

if (!empty($_POST)) {
    if (checkAnswer($_POST)) {
        advanceRound();
    }
    header('Location: /');
    exit();
}