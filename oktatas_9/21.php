<?php
$cards = [2, 2, 2, 2, 3, 3, 3, 3, 4, 4, 4, 4, 7, 7, 7, 7, 8, 8, 8, 8, 9, 9, 9, 9, 10, 10, 10, 10, 11, 11, 11, 11];
$acesValue = [1, 1, 1, 1];
$valuePlayer = [];
$valueDealer = [];

function cutDeck(array $randomCards): array {
    $cutIndex = cutDeck(1, count($randomCards)-1);
    $firstPart = array_slice($randomCards, 0, $cutIndex);
    $secondPart = array_slice($randomCards, $cutIndex);
    return [$firstPart, $secondPart];
}

function mergeParts(array $firstPart, array $secondPart): array {
    $mergedDeck = array_merge($secondPart, $firstPart);
        return $mergedDeck;
}

function flop(array $mergedDeck, array $cards) {
    $valuePlayer = array_slice($mergedDeck, 0, 2);
    $valueDealer = array_slice($mergedDeck, 1, 3);

    if ($valuePlayer === [11, 11] || $valueDealer === [11, 11]) {
        return true;
    } else if (($valuePlayer[0] + $valuePlayer[2]) < 16) {
        $i = 4;

        while ($cards) {
            $i >= 21;
            $i++;
        }

        return true;
    } else if (($valueDealer[1] + $valuePlayer[3]) < 16) {
        $i = 4;

        while ($cards) {
            $i >= 21;
            $i++;
        }

        return true;
    }
}

function aces($cards, $acesValue, $valuePlayer, $valueDealer): bool {
    if ($valuePlayer > 20 && in_array (11, $cards)) {
        if ($valuePlayer [11] = 1);
    }

    if ($valueDealer > 20 && in_array (11, $cards)) {
        if ($valueDealer [11] = 1);
    }

    return true;
}

function equal(array $valuePlayer, array $valueDealer, int $cardNumber): bool {
    if ($valuePlayer === $valueDealer && count($valuePlayer) < count($valueDealer)) {
        return true;
    }

    return false;
}