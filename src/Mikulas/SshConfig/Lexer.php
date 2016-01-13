<?php

namespace Mikulas\SshConfig;

use Nette\Utils\TokenIterator;
use Nette\Utils\Tokenizer;
use Nette\Utils\TokenizerException;


class Lexer
{

	const T_COMMENT = 'T_COMMENT';
	const T_KEYWORD = 'T_KEYWORD';
	const T_SEPARATOR = 'T_SEPARATOR';
	const T_ARG = 'T_ARG';
	const T_ARG_QUOT = 'T_ARG_QUOT';
	const T_WHITESPACE = 'T_WHITESPACE';


	/**
	 * @return Tokenizer
	 */
	public function getTokenizer()
	{
		return new Tokenizer([
			self::T_COMMENT => '^#.*?$',
			self::T_KEYWORD => '^\s+\w+',
			self::T_SEPARATOR => '\s*=\s*',
			self::T_ARG => '\S+',
			self::T_ARG_QUOT => '"[^"]*"',
			self::T_WHITESPACE => '\s+',
		]);
	}


	/**
	 * @param string $config
	 * @return TokenIterator tokens
	 * @throws ConfigException
	 */
	public function lex($config)
	{
		try {
			$tokens = $this->getTokenizer()->tokenize($config);
			return new TokenIterator($tokens);
		} catch (TokenizerException $e) {
			throw ConfigException::createFromLexerException($e);
		}
	}

}
