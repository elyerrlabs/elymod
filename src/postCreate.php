<?php

use Elymod\Installer;

/**
 * Elymod Post Create Hook
 *
 * Executed automatically after composer create-project.
 * Responsible for bootstrapping the skeleton into a working module.
 */

require __DIR__ . '/../vendor/autoload.php';

/**
 * Get project name from current directory
 */
$projectName = basename(getcwd());

/**
 * Install skeleton
 */
Installer::install($projectName);