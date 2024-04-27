<?php
function generateMaze($width, $height) {
    // Initialize a maze with all cells set as walls (true indicates a wall)
    $maze = array_fill(0, $height, array_fill(0, $width, true));

    // Ensure the entry (1, 0) and exit (height-2, width-1) are open
    $maze[1][0] = false; // Open the entry point
    $maze[$height - 2][$width - 1] = false; // Open the exit point

    // Stack for storing the maze path coordinates
    $stack = [[1, 1]]; // Start generating from coordinate (1, 1)

    // Loop through the stack while there are cells to be processed
    while (count($stack) > 0) {
        list($x, $y) = array_pop($stack); // Pop a cell from the stack
        $maze[$y][$x] = false; // Carve a passage at the current cell

        // Prepare to check all possible neighboring cells
        $neighbors = [];
        // Check the left neighbor
        if ($x > 1 && $maze[$y][$x - 2]) $neighbors[] = [$x - 2, $y, $x - 1, $y];
        // Check the right neighbor
        if ($x < $width - 2 && $maze[$y][$x + 2]) $neighbors[] = [$x + 2, $y, $x + 1, $y];
        // Check the top neighbor
        if ($y > 1 && $maze[$y - 2][$x]) $neighbors[] = [$x, $y - 2, $x, $y - 1];
        // Check the bottom neighbor
        if ($y < $height - 2 && $maze[$y + 2][$x]) $neighbors[] = [$x, $y + 2, $x, $y + 1];

        // If there are unvisited neighbors, choose one randomly
        if (count($neighbors) > 0) {
            $stack[] = [$x, $y]; // Push the current cell back on the stack
            $chosen = $neighbors[rand(0, count($neighbors) - 1)]; // Choose a random neighbor
            $maze[$chosen[3]][$chosen[2]] = false; // Remove the wall between the current cell and the chosen neighbor
            $stack[] = [$chosen[0], $chosen[1]]; // Push the chosen neighbor on the stack to continue the path
        }
    }

    return $maze; // Return the generated maze
}

// Generate a 15x15 maze
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
