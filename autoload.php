<?php

spl_autoload_register(function($className) {

    $file = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';


    if (file_exists($file)) {
        include $file;
    }
});


?>


