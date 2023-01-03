<?php
/**
 * This trait to make a class singleton.
 *
 * @package DevKabir\Plugin
 * @since   1.0.0
 */

namespace DevKabir\Plugin;

use Exception;
use RuntimeException;

/**
 * Singleton Trait.
 *
 * @since 1.0.0
 */
trait Singleton {
	/**
	 * Holder for all instances of Singleton
	 *
	 * @var   array Collection of instances.
	 * @since 1.0.0
	 */
	protected static $instances = array();

	/**
	 * To return new or existing Singleton instance of the class from which it is called.
	 * As it sets to final it can't be overridden.
	 *
	 * @return self Singleton instance of the class.
	 * @since  1.0.0
	 */
	final public static function get_instance() {

		/**
		 * Returns name of the class the static method is called in.
		 */
		$called_class = static::class;
		$arguments    = func_get_args();

		if ( ! isset( static::$instances[ $called_class ] ) ) {

			static::$instances[ $called_class ] = new $called_class( ...$arguments );

		}

		return static::$instances[ $called_class ];

	}

	/**
	 * Final clone method to prevent cloning of the instance of the
	 * *Singleton* instance.
	 *
	 * @return void
	 * @throws Exception
	 * @since  1.0.0
	 */
	final public function __clone() {
		throw new RuntimeException( __( 'Serializing instances of this class is forbidden.' ) );
	}

	/**
	 * Final wakeup method to prevent serializing of the *Singleton*
	 * instance.
	 *
	 * @return void
	 * @since  1.0.0
	 */
	final public function __wakeup() {
		throw new RuntimeException( __( 'Serializing instances of this class is forbidden.' ) );
	}
}
