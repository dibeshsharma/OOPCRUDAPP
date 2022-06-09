<?php
    // Url to set the links and render the view
    $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";    
    $basename = basename($actual_link);
    $pathinfo =   pathinfo($actual_link, PATHINFO_FILENAME);
?>