<?php

namespace App;

class ExceptionHandler
{
    public function __construct()
    {
        set_exception_handler(array($this, 'handler'));
    }

    public function handler($exception)
    {
        //echo '<h4>' . get_class($exception) . '</h4></br>';
        echo '<h2>' . $exception->getMessage() . '</h2></br>';
        echo $exception->getFile() . '</b> on line <b>' . $exception->getLine() . '</b><br>';
        echo '</div>';
    }
}