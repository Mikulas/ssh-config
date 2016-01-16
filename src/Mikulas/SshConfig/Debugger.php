<?php

namespace Mikulas\SshConfig;

use Nette\Utils\TokenIterator;


/**
 * @internal
 */
class Debugger
{

	public static function dumpTokens(TokenIterator $tokens)
	{
		$position = $tokens->position;
		while ($token = $tokens->nextToken()) {
			list($value, $_, $type) = $token;
			$typeFmt = str_pad($type, 15, ' ', STR_PAD_LEFT);
//			$value = trim($value);
			echo "$typeFmt: ▷{$value}◁\n";
		}
		$tokens->position = $position;
	}

}
