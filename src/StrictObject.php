<?php

declare(strict_types=1);

namespace WebChemistry;

use Nette\MemberAccessException;
use Nette\Utils\ObjectHelpers;

trait StrictObject {

	public function __get(string $name) {
		ObjectHelpers::strictGet(get_class($this), $name);
	}

	public function __set(string $name, $value) {
		ObjectHelpers::strictSet(get_class($this), $name);
	}

	public function __call(string $name, array $arguments) {
		ObjectHelpers::strictCall(get_class($this), $name);
	}

	public function __unset(string $name) {
		$class = get_class($this);
		if (!ObjectHelpers::hasProperty($class, $name)) {
			throw new MemberAccessException("Cannot unset the property $class::\$$name.");
		}
	}

	public static function __callStatic(string $name, array $arguments) {
		ObjectHelpers::strictCall(get_called_class(), $name);
	}

}
