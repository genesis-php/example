<?php

// This is sample bootstrap for build.
// Genesis automatically looks for file "bootstrap.php" in working directory.

// load your build class, if is not autoloaded
require_once __DIR__ . '/TestBuild.php';

// you may need to use services, atc.
// load bootstrap from an app -> it contains variable $container
require_once __DIR__ . '/../app/bootstrap.php';

// and we can return an Container with services -> it will be merged into services
$configContainer = new Genesis\Config\Container();
$configContainer->addService('fooService', $container->fooService);
return $configContainer;