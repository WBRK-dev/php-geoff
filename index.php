<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'vendor/autoload.php';

use Geoff\Kernel;

$kernel = Kernel::create();

$kernel->run();