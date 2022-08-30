<?php
define("ROOT", dirname(__DIR__));
define("PROJECT_ROOT_PATH", ROOT . '/');

require ROOT . '/vendor/autoload.php';
require_once PROJECT_ROOT_PATH . "inc/config.php";

use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(ROOT . '/.env');
$dotenv->load(ROOT . '/.env', ROOT . '/.env.dev');
