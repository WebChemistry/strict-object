<?php declare(strict_types = 1);

namespace WebChemistry;

use Kdyby\StrictObjects\Scream;

trait StrictObject {

	use Scream {
		Scream::__get as private screamGet;
		Scream::__set as private screamSet;
		Scream::__call as private screamCall;
		Scream::__isset as private screamIsset;
		Scream::__callStatic as private screamCallStatic;
		Scream::__unset as private screamUnset;
	}

	/**
	 * Call to undefined method.
	 *
	 * @param string $name method name
	 * @param array $args arguments
	 * @return mixed
	 */
	public function __call(string $name, array $args) {
		$this->screamCall($name, $args);
	}

	/**
	 * Call to undefined static method.
	 *
	 * @param string $name method name (in lower case!)
	 * @param array $args arguments
	 * @return mixed
	 */
	public static function __callStatic(string $name, array $args) {
		self::screamCallStatic($name, $args);
	}

	/**
	 * Returns property value. Do not call directly.
	 *
	 * @param string $name property name
	 * @return mixed
	 */
	public function &__get(string $name) {
		$this->screamGet($name);
	}

	/**
	 * Sets value of a property. Do not call directly.
	 *
	 * @param string $name property name
	 * @param mixed $value property value
	 */
	public function __set(string $name, $value): void {
		$this->screamSet($name, $value);
	}

	/**
	 * Is property defined?
	 *
	 * @param string $name property name
	 * @return bool
	 */
	public function __isset(string $name): bool {
		$this->screamIsset($name);

		return false;
	}

	/**
	 * Access to undeclared property.
	 *
	 * @param string $name property name
	 */
	public function __unset(string $name): void {
		$this->screamUnset($name);
	}

}
