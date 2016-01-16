<?php


namespace Mikulas\SshConfig;

use Nette\Utils\TokenIterator;


class Parser
{

	// states (denotes which tokens are expected next)
	const HOST = 'HOST';
	const KEYWORD = 'KEYWORD';
	const ARGUMENTS = 'ARGUMENTS';


	/**
	 * @param TokenIterator $tokens
	 * @return mixed TODO
	 */
	public function parse(TokenIterator $tokens)
	{
		Debugger::dumpTokens($tokens);

		$state = self::HOST;
		$hosts = [];
		$keyword = NULL;
		$currentHost = [];

		while ($token = $tokens->nextToken()) {
			list($value, $_, $type) = $token;
			$value = trim($value);

			switch ($type) {
				case Lexer::T_NEWLINE:
				case Lexer::T_SEPARATOR:
				case Lexer::T_COMMENT:
					break;
				case Lexer::T_KEYWORD:
					$keyword = strToLower($value);
					if ($keyword === 'host') {
						$this->assertState([self::HOST, self::KEYWORD], $state);
						$hosts[] = $currentHost;
						$currentHost = [];
					} else {
						$this->assertState([self::KEYWORD], $state);
					}
					$state = self::ARGUMENTS;
					break;
				case Lexer::T_ARG_QUOT:
					$value = substr($value, 1, -1);
					// intentional fall-through
				case Lexer::T_ARG:
					$this->assertState([self::ARGUMENTS], $state);
					$currentHost[$keyword] = $value;
					$state = self::KEYWORD;
					break;
			}
		}
		$hosts[] = $currentHost;

		return $hosts;
	}


//	/**
//	 * @param TokenIterator $tokens
//	 * @return TokenIterator filtered
//	 */
//	private function removeWhitespace(TokenIterator $tokens)
//	{
//		$filtered = [];
//
//		$state = self::NO_SECTION;
//		foreach ($tokens as $token) {
//			if ($token[2] === Lexer::T_WHITESPACE) {
//				if ($state !== self::KEYWORD) {
//					continue; // do not add to new collection
//				}
//				$token[2] = Lexer::T_SEPARATOR;
//			}
//			$filtered[] = $token;
//		}
//
//		return new TokenIterator($filtered);
//	}


	/**
	 * @param string|array $expected
	 * @param string $type
	 * @throws ConfigException
	 */
	private function assertState($expected, $type)
	{
		if (!is_array($expected)) {
			$expected = [$expected];
		}
		if (!in_array($type, $expected, TRUE)) {
			$expectedFmt = implode(', ', $expected);
			throw ConfigException::createFromParser("Expected state $expectedFmt but is $type");
		}
	}

}
