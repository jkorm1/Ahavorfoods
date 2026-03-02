<?php

// This script patches the Laravel ServeCommand to fix the type conversion issue
$filePath = __DIR__ . '/vendor/laravel/framework/src/Illuminate/Foundation/Console/ServeCommand.php';

if (file_exists($filePath)) {
    $content = file_get_contents($filePath);
    
    // Find the port method and fix the type conversion issue
    $content = str_replace(
        'return $this->input->getOption(\'port\') + $offset;',
        'return (int)$this->input->getOption(\'port\') + $offset;',
        $content
    );
    
    file_put_contents($filePath, $content);
    echo "ServeCommand.php has been patched successfully.\n";
} else {
    echo "ServeCommand.php not found at expected location.\n";
}