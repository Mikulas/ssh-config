<?php

namespace Mikulas\Tests\SshConfig;

use Mikulas\SshConfig\SshConfig;
use Mikulas\Tests\TestCase;
use Tester\Assert;

$dic = require_once __DIR__ . '/../../bootstrap.php';


class SshConfigTest extends TestCase
{

	public function testSimple()
	{
		$sshConfig = new SshConfig();
		$parsed = $sshConfig->parse($this->getFixture('config-simple.txt'));
		var_dump($parsed);
	}

}

(new SshConfigTest($dic))->run();
