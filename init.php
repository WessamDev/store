<?php
// error handling open
ini_set('display-error', 'on');
// erros report
error_reporting(E_ALL);
// connect to database file
include 'admin/connect.php';

// Front-end Routs
$inc = 'inc/';
$css = 'css/';
$js = 'js/';
$images = 'images/';
$Uploads = 'admin/uploads/img/';

// functions Files
include $inc . 'functions.php';

// Header file
include $inc . 'header.php';

// include navbar
if (!isset($nonav)) {include 'inc/navbar.php';}
