<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

Tester\Environment::setup();

define('TEMP_DIR', __DIR__ . '/tmp');
@mkdir(dirname(TEMP_DIR));
@mkdir(TEMP_DIR);