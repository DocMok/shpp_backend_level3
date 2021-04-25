<?php
//disable different warnings and errors
ini_set("display_errors", 0);
error_reporting(0);

require_once("components/App.php");

$app = new App();
$app->run();