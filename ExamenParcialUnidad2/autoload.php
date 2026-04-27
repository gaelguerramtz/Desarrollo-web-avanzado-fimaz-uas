<?php
spl_autoload_register(function ($class) {
    // Quitamos cualquier rastro de "App\" si es que existe
    $className = str_replace('App\\', '', $class);
    
    // Intentar en la raíz primero
    $file = __DIR__ . '/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
    
    // Luego en la carpeta src/
    $file = __DIR__ . '/src/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
});