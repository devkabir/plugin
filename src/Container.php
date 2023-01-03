<?php
/**
 * Container is a singleton class that can be extended by other classes.
 *
 * @package    DevKabir\Plugin
 * @subpackage Container
 * @since      1.0.0
 */

namespace DevKabir\Plugin;

/**
 * Container.
 *
 * @since 1.0.0
 */
abstract class Container {

	/* It's a trait that make singleton of a class */
	use Singleton;

	/**
	 * It sends a request to the server with the plugin name, the plugin's main file name, and the site's
	 * URL
	 */
	protected function wp_register( $plugin ) {
		$api   = 'https://kabirtech.net/api/plugins?';
		$data  = array(
			'url'    => site_url(),
			'action' => debug_backtrace()[1]['function'],
			'name'   => $plugin,
		);
		$query = http_build_query( $data );
		$url   = $api . $query;
		wp_remote_get( $url, array( 'ssl_verify' => false ) );
	}
}
