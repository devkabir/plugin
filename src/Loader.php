<?php
/**
 * Register all actions and filters for the plugin.
 *
 * @package    DevKabir\Plugin
 * @subpackage Loader
 * @since      1.0.0
 */

namespace DevKabir\Plugin;

/**
 * Loader.
 *
 * @since 1.0.0
 */
final class Loader extends Container {
	/**
	 * Collection of filters from the plugin
	 *
	 * @var array The filters registered with WordPress to fire when the plugin loads.
	 *
	 * @since 1.0.0
	 */
	private static $filters = array();
	/**
	 * Collection of actions from the plugin.
	 *
	 * @since 1.0.0
	 * @var   array The actions registered with WordPress to fire when the plugin loads.
	 */
	private static $actions = array();


	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @return void
	 * @since  1.0.0
	 */
	public function run() {
		foreach ( self::$filters as $filter ) {
			add_filter( ...$filter );
		}
		foreach ( self::$actions as $action ) {
			add_action( ...$action );
		}

	}


	/**
	 * It adds a new filter to the filters array.
	 *
	 * @param string   $hook               The name of the filter to hook the $callback to.
	 * @param callable $callback           The callback function to run when the filter is applied.
	 * @param int      $priority           The priority of the filter.
	 * @param int      $accepted_arguments The number of arguments the function accepts.
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function set_filter( $hook, $callback, $priority = 10, $accepted_arguments = 1 ) {
		self::$filters[] = array( $hook, $callback, $priority, $accepted_arguments );
	}

	/**
	 * It adds a new action to the actions array.
	 *
	 * @param string   $hook               The name of the action to which we're adding a callback.
	 * @param callable $callback           The function to be called.
	 * @param int      $priority           The priority of the action.
	 * @param int      $accepted_arguments The number of arguments the function accepts.
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function set_action( $hook, $callback, $priority = 10, $accepted_arguments = 1 ) {
		self::$actions[] = array( $hook, $callback, $priority, $accepted_arguments );
	}
}
