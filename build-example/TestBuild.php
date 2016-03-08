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
		$this->testEnvironment();
		$this->prepareFilesAndDirs();
		$this->installDependencies();
		//$this->installNpm(); // uncomment if you have npm
		//$this->executeGulpTask(); // uncomment if you have npm
		//$this->compileLess(); // uncomment if you have lessc
	}


	public function runTests()
	{
		$this->logSection('Run PHP Unit');
		$command = new Commands\PHPUnit();
		$command->execute($this->container->workingDirectory, $this->container->phpUnit['target'], $this->container->phpUnit);
	}


	private function testEnvironment()
	{
		$this->logSection('Test programs');
		$command = new Commands\Test\Programs();
		$command->execute($this->container->testPrograms);
		$this->logSection('Test PHP');
		$command = new Commands\Test\Php();
		$command->execute($this->container->testPhp);
		$this->logSection('Test NodeJs');
		$command = new Commands\Test\NodeJs();
		$command->execute($this->container->testNodejs['version']);

		// using fooService assigned in bootstrap.php
		$this->logSection('Test App FooService service');
		$this->log($this->container->fooService->bar());
	}


	private function prepareFilesAndDirs()
	{
		$this->logSection('Create directories and files.');
		$command = new Commands\Filesystem\Directory();
		if(!is_dir($this->container->publicDirectory)){
			$command->create($this->container->publicDirectory, 777);
		}
		$command->clean($this->container->publicDirectory);

		foreach ($this->container->directoriesToCreate as $directory => $chmod) {
			$command = new Commands\Filesystem\Directory();
			$command->create($directory, $chmod);
		}
		foreach ($this->container->symlinksToCreate as $target => $link) {
			$command = new Commands\Filesystem\Symlink();
			$command->create($target, $link);
		}
		foreach ($this->container->filesToCopy as $source => $destination) {
			$command = new Commands\Filesystem\File();
			$command->copy($source, $destination);
		}
		$this->log("Directories and files created.");
	}


	private function installDependencies()
	{
		$this->logSection('Install dependencies');
		$command = new Commands\Exec();
		$command->execute("composer install --working-dir {$this->container->projectDirectory}");
	}


	private function installNpm()
	{
		$this->logSection('Install NPM');
		$command = new Commands\NodeJs();
		$command->installPackages($this->container->publicDirectory);
	}


	private function executeGulpTask()
	{
		$this->logSection('Run Gulp');
		$command = new Commands\Assets\Gulp();
		$command->run($this->container->publicDirectory, 'test');
	}


	private function compileLess()
	{
		$this->logSection('Compile LESS');
		$command = new Commands\Assets\Less();
		$command->compile($this->container->lessFiles);
	}

}