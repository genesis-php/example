<?php

// This is sample bootstrap for build.
// Genesis automatically looks for file "bootstrap.php" in working directory.

// load your build class, if is not autoloaded
require_once __DIR__ . '/TestBuild.php';

// you may need to use services, atc.
// load bootstrap from an app
require_once __DIR__ . '/../app/myApplicationBootstrap.php';

// optionally you can return an Container with services, etc from an app bootstrap
$configContainer = new Genesis\Config\Container();
$configContainer->fooService = $fooService;
return $configContainer;