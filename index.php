<?php

spl_autoload_extensions('.php');

spl_autoload_register(function($class_name) {
    $class_path = join([__DIR__, 'src' , $class_name . '.php'], DIRECTORY_SEPARATOR);

    if (file_exists($class_path)){
        include_once $class_path;
    }
});

require_once(join(['src', 'routes', 'Routes.php'], DIRECTORY_SEPARATOR));
