<?php

use Elymod\Runtime\Installer;

require __DIR__ . '/../vendor/autoload.php';

$projectName = basename(getcwd());

$driver = $_SERVER['ELYMOD_DRIVER'] ?? 'vite';

Installer::install($projectName, $driver);