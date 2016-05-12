<?php

namespace Example;


use Genesis;
use Genesis\Commands;


/**
 * @author Adam Bisek <adam.bisek@gmail.com>
 */
class TestBuild extends Genesis\Build
{

	/**
	 * @var \Genesis\Commands\PhpUnit
	 * @inject
	 */
	public $phpUnit;

	/**
	 * @var \Genesis\Commands\Test\Programs
	 * @inject
	 */
	public $testPrograms;

	/**
	 * @var \Genesis\Commands\Test\Php
	 * @inject
	 */
	public $testPhp;

	/**
	 * @var \Genesis\Commands\Test\NodeJs
	 * @inject
	 */
	public $testNodeJs;

	/**
	 * @var \Genesis\Commands\Filesystem\Filesystem
	 * @inject
	 */
	public $filesystemInit;

	/**
	 * @var \Genesis\Commands\NodeJs\PackageInstaller
	 * @inject
	 */
	public $nodeJsPackageInstaller;

	/**
	 * @var \Genesis\Commands\Assets\Gulp
	 * @inject
	 */
	public $gulp;

	/**
	 * @var Genesis\Commands\Assets\Less
	 * @inject
	 */
	public $less;


	public function runInit()
	{
		$this->testEnvironment();
		$this->prepareFilesAndDirs();
		$this->installDependencies();
	}


	public function runTests()
	{
		$this->logSection('Run PHP Unit');
		$this->phpUnit->execute();
	}


	public function runInstallNpm()
	{
		$this->logSection('Install NPM');
		$this->nodeJsPackageInstaller->execute();
	}


	public function runGulpTask()
	{
		$this->logSection('Run Gulp');
		$this->gulp->execute('test');
	}


	public function runCompileLess()
	{
		$this->logSection('Compile LESS');
		$this->less->execute();
	}


	private function testEnvironment()
	{
		$this->logSection('Test programs');
		$this->testPrograms->execute();
		$this->logSection('Test PHP');
		$this->testPhp->execute();
		$this->logSection('Test NodeJs');
		$this->testNodeJs->execute();

		// using fooService assigned in bootstrap.php
		$this->logSection('Test App FooService service');
		$this->log($this->container->getService('fooService')->bar());
	}


	private function prepareFilesAndDirs()
	{
		$this->logSection('Create directories and files.');
		$this->filesystemInit->execute();
		$this->log("Directories and files created.");
	}


	private function installDependencies()
	{
		$this->logSection('Install dependencies');
		$projectDirectory = $this->container->getParameter('projectDirectory');
		$command = new Commands\Exec();
		$command->setCommand("composer install --working-dir $projectDirectory");
		$command->execute();
	}

}