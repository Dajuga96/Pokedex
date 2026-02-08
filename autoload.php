<?php

spl_autoload_register(function ($clase) {
    $paths = ['controllers/', 'models/'];
    foreach ($paths as $path) {
        $file = __DIR__ . "/" . $path . $clase . ".php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

?>