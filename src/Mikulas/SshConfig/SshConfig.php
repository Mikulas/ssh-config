<?php


namespace Mikulas\SshConfig;


class SshConfig
{

	/** @var Lexer */
	private $lexer;

	/** @var Parser */
	private $parser;


	public function __construct(Lexer $lexer = NULL, Parser $parser = NULL)
	{
		$this->lexer = $lexer ?: new Lexer();
		$this->parser = $parser ?: new Parser();
	}


	/**
	 * @param string $config content
	 * @return mixed TODO
	 */
	public function parse($config)
	{
		$tokens = $this->lexer->lex($config);
		return $this->parser->parse($tokens);
	}

}
