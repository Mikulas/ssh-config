<?php

namespace Mikulas\SshConfig;

use Nette\Utils\Strings;
use Nette\Utils\TokenIterator;
use Nette\Utils\Tokenizer;
use Nette\Utils\TokenizerException;


class Lexer
{

	const T_COMMENT = 'T_COMMENT';
	const T_KEYWORD = 'T_KEYWORD';
	const T_SEPARATOR = 'T_SEPARATOR';
	const T_ARG_QUOT = 'T_ARG_QUOT';
	const T_ARG = 'T_ARG';
	const T_NEWLINE = 'T_NEWLINE';


	/**
	 * @return Tokenizer
	 */
	public function getTokenizer()
	{
		return new Tokenizer([
			self::T_COMMENT => '^#.*?$',
			self::T_KEYWORD => '^\w+',
			self::T_SEPARATOR => '(?:[ \t]+|[ \t]*=[ \t]*)',
			self::T_ARG_QUOT => '"[^"]*"',
			self::T_ARG => '\S+',
			self::T_NEWLINE => '\n',
		], 'm');
	}


	/**
	 * @param string $config
	 * @return TokenIterator tokens
	 * @throws ConfigException
	 */
	public function lex($config)
	{
		$normalized = Strings::normalize($config);

		// remove meaningless leading spacing to simplify T_KEYWORD
		$simplified = Strings::replace($normalized, '~^\s+~m', '');

		try {
			$tokens = $this->getTokenizer()->tokenize($simplified);
			return new TokenIterator($tokens);

		} catch (TokenizerException $e) {
			throw ConfigException::createFromLexerException($e);
		}
	}

}
