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
	 * @var \Genesis\Commands\PhpUnit
	 * @inject
	 */
	public $phpUnit;

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


	public function runInit()
	{
		$this->testEnvironment();
		$this->runInstallNpm();
		$this->runGulpTask();
		$this->prepareFilesystem();
		$this->log('Init completed.');
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
		$this->gulp->execute('build');
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


	private function prepareFilesystem()
	{
		$this->logSection('Create directories and files.');
		$this->filesystemInit->execute();
		$this->log("Directories and files created.");
	}

}