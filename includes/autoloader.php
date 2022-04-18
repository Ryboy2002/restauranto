<?php

spl_autoload_register(function ($className) {
    $source = $_SERVER['DOCUMENT_ROOT'];
    $dir = $source . '/classes/';
    $extension = '.php';
    $fullPath = $dir.$className.$extension;

    if (!file_exists($fullPath)) {
       return false;
    }

   include_once $fullPath;
});

