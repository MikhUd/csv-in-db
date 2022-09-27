<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require './vendor/autoload.php';

use MikhUd\CSVDB\Engine\App;

$app = new App();
$app->run(array_slice($argv, 1));