<?php
abstract class A{
	abstract static function getName(): string;

	public static function printName(){
		$name = static::getName();
		echo $name;
	}
}

// class B extends A{
// 	public static function getName(): string{
// 		return "class B";
// 	}
// }

// $b = new B;
// $b->printName();