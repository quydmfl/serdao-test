<?php

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Bridge\PhpUnit\DeprecationErrorHandler;

require dirname(__DIR__).'/vendor/autoload.php';

if (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

if ($_SERVER['APP_DEBUG']) {
    umask(0000);
}

if (class_exists(DeprecationErrorHandler::class)) {
    DeprecationErrorHandler::register();
}
