Genesis example
===================================
This is an example project for [Genesis build tool](https://github.com/genesis-php/genesis)

Genesis is lightweight, smart and easy to use CLI tool, for building (mainly) PHP applications.
Usage is similar to Phing, but Genesis is much easier.
For configuration is used an .neon file, which is very similar to YAML.

This example is all about directories <code>build</code> and <code>build-simple</code>.
All other files and directories are only samples.


Getting started
---------------
Look at the example which gives you quick introduction:

1. Clone this repository or run:<br>
	<code>
	composer create-project genesis-php/example
	</code>

2. Initialize build:<br>
	<code>
	cd example && vendor/genesis-php/genesis/genesis self-init
	</code>
	directory 'build' was created, with example files

3. Run:<br>
	<code>
	build/build
	</code> default = help - list of available tasks

	<code>
	build/build mytask
	</code> run some task

	or example complex build:

	<code>
	build-example/build init
	</code> run predefined simple build from directory 'build-example'


Create you own build
---------------
[Genesis documentation](https://github.com/genesis-php/genesis)