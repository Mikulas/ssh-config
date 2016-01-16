<?php

namespace Mikulas\Tests\SshConfig;

use Mikulas\SshConfig\SshConfig;
use Mikulas\Tests\TestCase;
use Tester\Assert;

$dic = require_once __DIR__ . '/../../bootstrap.php';


class SshConfigTest extends TestCase
{

	public function getParsed($fixture)
	{
		$sshConfig = new SshConfig();
		return $sshConfig->parse($this->getFixture("config-{$fixture}.txt"));
	}


	public function testSimple()
	{
		$parsed = $this->getParsed('simple');
	}


	public function testFirstValueUsed()
	{
		$parsed = $this->getParsed('first');
		Assert::equal([
			'smile' => [
				'host' => 'smile',
				'user' => 'alpha',
				'port' => '7022',
			],
		], $parsed);
	}

}

(new SshConfigTest($dic))->run();
