<?php

namespace Mikulas\SshConfig;

use Nette\Utils\TokenizerException;


class ConfigException extends \RuntimeException
{

	/**
	 * @internal
	 * @param string     $message
	 * @param \Exception $previous
	 */
	public function __construct($message, \Exception $previous = NULL)
	{
		$prefix = 'Invalid config file syntax';
		$message = $message ? "$prefix: $message" : $prefix;
		parent::__construct($message, NULL, $previous);
	}


	/**
	 * @param TokenizerException $exception
	 * @return ConfigException
	 */
	public static function createFromLexerException(TokenizerException $exception)
	{
		return new self('', $exception);
	}


	/**
	 * @param string           $message
	 * @param \Exception       $previous
	 * @return ConfigException
	 */
	public static function createFromParser($message, \Exception $previous = NULL)
	{
		return new self($message, $previous);
	}

}
