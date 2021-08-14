<?php
declare(strict_types=1);

if (!file_exists('vendor/autoload.php')) {
    throw new RuntimeException('File vendor/autoload.php not found');
}

require __DIR__ . '/../vendor/autoload.php';

$application = new Mlozynskyy\Application();
$application->init()->run();
