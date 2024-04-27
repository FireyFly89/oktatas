<?php
function generateMaze($width, $height)
{
    // Maze array filled with walls
    $maze = array_fill(0, $height, array_fill(0, $width, true));

    // Start at a random odd coordinate to ensure it's inside the grid
    $stack = [[1, 1]];

    while (count($stack) > 0) {
        list($x, $y) = array_pop($stack);
        $maze[$y][$x] = false;

        $neighbors = [];
        if ($x > 1 && $maze[$y][$x - 2]) $neighbors[] = [$x - 2, $y, $x - 1, $y];
        if ($x < $width - 2 && $maze[$y][$x + 2]) $neighbors[] = [$x + 2, $y, $x + 1, $y];
        if ($y > 1 && $maze[$y - 2][$x]) $neighbors[] = [$x, $y - 2, $x, $y - 1];
        if ($y < $height - 2 && $maze[$y + 2][$x]) $neighbors[] = [$x, $y + 2, $x, $y + 1];

        if (count($neighbors) > 0) {
            $stack[] = [$x, $y];
            $chosen = $neighbors[rand(0, count($neighbors) - 1)];
            $maze[$chosen[3]][$chosen[2]] = false;
            $stack[] = [$chosen[0], $chosen[1]];
        }
    }

    return $maze;
}

// Generate a small 15x15 maze
$maze = generateMaze(31, 31);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Maze</title>
    <style>
        .maze-container {
            position: relative;
            width: 300px;
            height: 300px;
        }

        .cell {
            width: 20px;
            height: 20px;
            position: absolute;
            background-color: #FFF;
        }

        .wall {
            background-color: #000;
        }
    </style>
</head>
<body>
<div class="maze-container">
    <?php foreach ($maze as $y => $row): ?>
        <?php foreach ($row as $x => $isWall): ?>
            <div class="cell <?php if ($isWall) echo 'wall'; ?>"
                 style="left: <?= $x * 20 ?>px; top: <?= $y * 20 ?>px;"></div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
</body>
</html>
