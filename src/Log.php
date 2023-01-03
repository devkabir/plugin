<?php
/**
 * It's a class that handles the log files.
 *
 * @package    DevKabir\Plugin
 * @subpackage Log
 * @since      1.0.0
 */

namespace DevKabir\Plugin;

/**
 * Log.
 *
 * @since 1.0.0
 */
final class Log extends Container {
	/**
	 * @var string name of the plugin
	 */
	private $name;

	/**
	 * Log
	 *
	 * @param string $name The name of the plugin.
	 */
	public function __construct( $name ) {
		$this->name = $name;
	}


	/**
	 * It's reading the log file and returning the content.
	 *
	 * @param string $type log type
	 *
	 * @return string logs
	 */
	public function read( $type ) {
		$file = $this->file( $type );

		if ( file_exists( $file ) ) {
			$contents = file_get_contents( $file );
			if ( empty( $contents ) ) {
				$log = false;
			} else {
				$log = $contents;
			}
		} else {
			$log = false;
		}

		return $log;
	}

	/**
	 * It's returning the path to the log file.
	 *
	 * @param string $type log type
	 *
	 * @return string file path depends on log type
	 */
	public function file( $type ) {
		return $this->get_dir() . '/' . $type . '.log';
	}

	/**
	 * It's returning the path to the log file.
	 * @return string path of the log directory
	 */
	public function get_dir() {

		$upload_dir  = wp_upload_dir();
		$message_dir = $upload_dir['basedir'] . '/' . $this->name . '-files/';
		if ( ! file_exists( $message_dir ) ) {
			wp_mkdir_p( $message_dir );
		}

		return $message_dir;
	}

	/**
	 * It's writing the log to a file.
	 *
	 * @param mixed $message message to write
	 *
	 */
	public function write( $type, $message ) {
		$file = $this->file( $type );
		if ( $type === 'token' ) {
			file_put_contents( $file, $message );
		} elseif ( is_array( $message ) || is_object( $message ) ) {
			error_log( date( 'Y-m-d h:i:s' ) . ' :: ' . json_encode( $message, JSON_PRETTY_PRINT ) . PHP_EOL, 3, $file );
		} else {
			error_log( date( 'Y-m-d h:i:s' ) . ' :: ' . json_encode( json_decode( $message, true ), JSON_PRETTY_PRINT ) . PHP_EOL, 3, $file );
		}

	}

	/**
	 * It's checking if the file exists.
	 *
	 * @param string $type file type
	 *
	 * @return bool
	 */
	public function has( $type ) {
		$file = $this->file( $type );

		return file_exists( $file );
	}



}
