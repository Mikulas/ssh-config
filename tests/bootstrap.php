<?php

namespace Mikulas\Tests\SshConfig;

use Tester\Environment;

if (@!include __DIR__ . '/../vendor/autoload.php') {
	echo "Install Nette Tester using `composer update`\n";
	exit(1);
}

define('TEMP_DIR', __DIR__ . '/tmp');
date_default_timezone_set('Europe/Prague');

Environment::setup();

header('Content-type: text/plain');
putenv('ANSICON=TRUE');
