<?php

// this is SAMPLE DUMMY BOOTSTRAP from an app
// it represents bootstrap in your application/framework
// here may be created an DI Container, services, etc.

class FooService {

	public function bar()
	{
		return 'baz';
	}

}

$container = new stdClass();
$container->fooService = new FooService();