<?php

namespace CallStaticMethods;

class Foo
{

	public static function test()
	{

	}

	protected static function baz()
	{

	}

	public function loremIpsum()
	{

	}

}

class Bar extends Foo
{

	public static function test()
	{
		Foo::test();
		Foo::baz();
		parent::test();
		parent::baz();
		Foo::bar(); // nonexistent
		self::bar(); // nonexistent
		parent::bar(); // nonexistent
		Foo::loremIpsum(); // instance
	}

	public function loremIpsum()
	{
		parent::loremIpsum();
	}

}

class Ipsum
{

	public static function ipsumTest()
	{
		parent::lorem(); // does not have a parent
		Foo::test();
		Foo::test(1);
		Foo::baz(); // protected and not from a parent
	}

}

class ClassWithConstructor
{

	public function __construct($foo)
	{

	}

}

class CheckConstructor extends ClassWithConstructor
{

	public function __construct()
	{
		parent::__construct();
	}

}
