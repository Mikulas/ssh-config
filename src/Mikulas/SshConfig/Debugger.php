<?php


namespace Mikulas\SshConfig;


/**
 * @internal
 */
class Debugger
{

	public static function dumpTokens(TokenCollection $tokens)
	{
		foreach ($tokens as list($value, $_, $type)) {
			$typeFmt = str_pad($type, 15, ' ', STR_PAD_LEFT);
			echo "$typeFmt:  $value\n";
		}
	}

}
