<?php

namespace Mikulas\Tests;


class TestCase extends \Tester\TestCase
{

	/**
	 * @param string $name
	 * @return string content
	 */
	protected function getFixture($name)
	{
		return file_get_contents(__DIR__ . "/../fixtures/$name");
	}

}
