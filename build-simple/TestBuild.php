<?php

namespace Example;


use Genesis;
use Genesis\Commands;


/**
 * @author Adam Bisek <adam.bisek@gmail.com>
 */
class TestBuild extends Genesis\Build
{

	public function runInit()
	{
		$this->log("Hello world.");

		$this->logSection('Create directories and files.');
		$command = new Commands\Filesystem\Directory();
		if(!is_dir($this->container->publicDirectory)){
			$command->create($this->container->publicDirectory, 777);
		}
		$this->log("Done.");
	}

}