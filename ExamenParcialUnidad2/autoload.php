<?php // gaelguerramartinez

spl_autoload_register(function ($class) {
    $className = str_replace('App\\', '', $class);
    
    $file = __DIR__ . '/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
    
    $file = __DIR__ . '/src/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
});