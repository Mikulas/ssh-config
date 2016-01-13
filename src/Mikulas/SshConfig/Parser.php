<?php


namespace Mikulas\SshConfig;


class Parser
{

	const NO_SECTION = 1;
	const HOST = 2;
	const HOST_PATTERN = 3;
	const KEYWORD = 4;
	const ARGUMENTS = 5;


	/**
	 * @param TokenCollection $tokens
	 * @return mixed TODO
	 */
	public function parse(TokenCollection $tokens)
	{
		Debugger::dumpTokens($tokens);

		$state = self::NO_SECTION;
		$ts = $this->getTransitions();

		foreach ($tokens as list($value, $_, $type)) {
			switch ($type) {
				case Lexer::T_WHITESPACE:
				case Lexer::T_SEPARATOR:
					continue;
				case Lexer::T_ARGUMENT:
					if ($state === self::ARGUMENTS) {
						$this->assertState()
					}
					$this->assertState(self::HOST, $type);
			}
		}
	}


//	/**
//	 * @param TokenCollection $tokens
//	 * @return TokenCollection filtered
//	 */
//	private function removeWhitespace(TokenCollection $tokens)
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
//		return new TokenCollection($filtered);
//	}


	/**
	 * @param string $expected
	 * @param string $type
	 * @throws ConfigException
	 */
	private function assertState($expected, $type)
	{
		if ($expected !== $type) {
			throw ConfigException::createFromParser("Expected state $expected but is $type");
		}
	}

}
