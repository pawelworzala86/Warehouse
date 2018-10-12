<?php

define('GRID_X', 12);

define('TAB', "\t");

$grid = '.row {' . PHP_EOL .
    TAB . 'margin-left: -10px;' . PHP_EOL .
    TAB . 'margin-right: -10px;' . PHP_EOL .
    TAB . 'display: block;' . PHP_EOL .
    '}' . PHP_EOL;

$grid .= '.col {' . PHP_EOL .
    TAB . 'float: left;' . PHP_EOL .
    TAB . 'padding: 0px 10px;' . PHP_EOL .
    TAB . 'box-sizing: border-box;' . PHP_EOL .
    TAB . 'min-height: 1px;' . PHP_EOL .
    TAB . 'padding-left: 10px;' . PHP_EOL .
    TAB . 'padding-right: 10px;' . PHP_EOL .
    '}' . PHP_EOL;

//.table .col
/*for ($i = 0; $i < GRID_X; $i++) {
    $left = '';
    if ($i == 0) {
        $left = 0;
    } else {
        $left = (100 / GRID_X) * (float)$i;
        $left = number_format($left, 5);
    }
    $style = '.table .col-xs-' . ($i + 1) . ' {' . PHP_EOL .
        TAB . 'width: ' . ((100 / GRID_X) * ($i + 1)) . '%;' . PHP_EOL .
        '}' . PHP_EOL;
    $grid .= $style;
}*/

//.col
for ($i = 0; $i < GRID_X; $i++) {
    $left = '';
    if ($i == 0) {
        $left = 0;
    } else {
        $left = (100 / GRID_X) * (float)$i;
        $left = number_format($left, 5);
    }
    $style = '.col-xxs-' . ($i + 1) . ' {' . PHP_EOL .
        //TAB . 'left: ' . $left . '%;' . PHP_EOL .
        TAB . 'width: ' . ((100 / GRID_X) * ($i + 1)) . '%;' . PHP_EOL .
        '}' . PHP_EOL;
    $grid .= $style;
}

$style = '@media all and (min-width: 400px) {'. PHP_EOL;
for ($i = 0; $i < GRID_X; $i++) {
    $left = '';
    if ($i == 0) {
        $left = 0;
    } else {
        $left = (100 / GRID_X) * (float)$i;
        $left = number_format($left, 5);
    }
    $style .= TAB .'.col-xs-' . ($i + 1) . ' {' . PHP_EOL .
        //TAB . 'left: ' . $left . '%;' . PHP_EOL .
        TAB .TAB . 'width: ' . ((100 / GRID_X) * ($i + 1)) . '%;' . PHP_EOL .
        TAB .'}' . PHP_EOL;
    //$grid .= $style;
}
$style .= '}'. PHP_EOL;
$grid .= $style;

$style = '@media all and (min-width: 550px) {'. PHP_EOL;
for ($i = 0; $i < GRID_X; $i++) {
    $left = '';
    if ($i == 0) {
        $left = 0;
    } else {
        $left = (100 / GRID_X) * (float)$i;
        $left = number_format($left, 5);
    }
    $style .= TAB .'.col-sm-' . ($i + 1) . ' {' . PHP_EOL .
        //TAB . 'left: ' . $left . '%;' . PHP_EOL .
        TAB .TAB . 'width: ' . ((100 / GRID_X) * ($i + 1)) . '%;' . PHP_EOL .
        TAB .'}' . PHP_EOL;
    //$grid .= $style;
}
$style .= '}'. PHP_EOL;
$grid .= $style;


file_put_contents(DIR . '/Public/Css/Partials/Grid.css', $grid);