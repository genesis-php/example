<?php

class FooService {

	public function bar()
	{
		return 'baz';
	}

}

// create and return Nette DIC
$container = new stdClass();
$container->fooService = new FooService();
return $container;