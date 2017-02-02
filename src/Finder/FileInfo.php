<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Utils;

use Nette;


/**
 * @internal
 */
class FileInfo extends \SplFileInfo
{
	/** @var string */
	private $subPath;

	public function __construct(string $file, string $subPath)
	{
		parent::__construct($file);
		$this->subPath = $subPath;
	}


	/**
	 * Returns the relative directory path.
	 */
	public function getSubPath(): string
	{
		return $this->subPath;
	}


	/**
	 * Returns the relative path including file name.
	 */
	public function getSubPathname(): string
	{
		return ($this->subPath === '' ? '' : $this->subPath . DIRECTORY_SEPARATOR)
			. $this->getBasename();
	}


	/**
	 * Returns the contents of the file.
	 * @throws Nette\IOException
	 */
	public function getContents(): string
	{
		$content = @file_get_contents($this->getPathname()); // @ - error escalated to exception
		if ($content === FALSE) {
			throw new Nette\IOException(error_get_last()['message']);
		}
		return $content;
	}

}
