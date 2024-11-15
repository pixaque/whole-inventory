<?php
/**
 * Main class
 *
 * @package wp-wer_pk-blocks
 */

namespace WP_WER_PK_Blocks;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class WP_wer_pk_Blocks
 */
class WP_WER_PK_Blocks {

	/**
	 * WP_wer_pk_Blocks instance.
	 *
	 * @var WP_wer_pk_Blocks
	 */
	protected static $instance = null;

	/**
	 * The plugin version number.
	 *
	 * @var string
	 */
	public static $version = '1.0';

	/**
	 * The plugin token.
	 *
	 * @var string
	 */
	public $token = 'wp-wer_pk-blocks';

	/**
	 * The plugin assets directory.
	 *
	 * @var string
	 */
	public $assets_dir;

	/**
	 * The plugin assets URL.
	 *
	 * @var string
	 */
	public $assets_url;

	/**
	 * The plugin languages directory.
	 *
	 * @var string
	 */
	public $languages_dir;

	/**
	 * The full path to the plugin languages directory.
	 *
	 * @var string
	 */
	public $languages_dir_full;

	/**
	 * WP_wer_pk_Blocks constructor.
	 */
	public function __construct() {
		//$this->init_plugin_environment();
		$this->includes();
		$this->init_hooks();
		Settings::init( $this->assets_dir, $this->assets_url );
	}

	/**
	 * Initializes plugin environment variables
	 */
	public function init_plugin_environment() {
		// Load plugin environment variables
		//$this->assets_dir = WP_wer_pk_BLOCKS_ABSPATH . 'build/';
		//$this->assets_url = esc_url( trailingslashit( plugins_url( '/build/', WP_WER_PK_PLUGIN_FILE ) ) );

		$this->assets_dir = get_stylesheet_directory_uri();
		//$this->assets_url = $this->assets_dir . '/inc/wp-wer_pk-blocks/build/';
		$this->assets_url = $this->assets_dir . '/build/';

		//echo $this->assets_url;
		
		$this->languages_dir = dirname( plugin_basename( WP_WER_PK_PLUGIN_FILE ) ) . '/languages/';
		$this->languages_dir_full = plugin_dir_path( WP_WER_PK_PLUGIN_FILE ) . 'languages/';

	}

	/**
	 * Include required core files.
	 */
	public function includes() {
		// Load plugin class files
		//require_once plugin_dir_path( __file__ ) . '/main/class-main.php';
		//require_once plugin_dir_path( __file__ ) . '/settings/class-settings.php';
		//require_once plugin_dir_path( __file__ ) . '/projects/class-projects.php';
	}



	/**
	 * Main WP_wer_pk_Blocks Instance
	 * Ensures only one instance of WP_wer_pk_Blocks is loaded or can be loaded.
	 *
	 * @return WP_wer_pk_Blocks Plugin instance
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Cloning is forbidden.
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'wp-wer_pk-blocks' ), esc_attr( self::$version ) );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'wp-wer_pk-blocks' ), esc_attr( self::$version ) );
	}

	/**
	 * Checks plugin version.
	 *
	 * This check is done on all requests and runs if the versions do not match.
	 */
	public function check_version() {
		if ( defined( 'IFRAME_REQUEST' ) ) {
			return;
		}

		$transient_name = 'wp_wer_pk_blocks_version';

		$old_version = get_transient( $transient_name );
		if ( false === $old_version ) {
			$old_version = get_option( $this->token . '_version' );
			set_transient( $transient_name, $old_version, 5 * MINUTE_IN_SECONDS );
		}
		$new_version = self::$version;
		if ( $old_version !== $new_version ) {
			$this->log_version_number();
			delete_transient( $transient_name );

			/**
			 * Fires when a new version of the plugin is used for the first time.
			 *
			 * @since 2.0.1
			 *
			 * @param string $new_version New version number.
			 * @param string $old_version Old version number.
			 */
			do_action( $this->token . '_updated', $new_version, $old_version );
		}
	}

	/**
	 * Sets the current plugin version number in database.
	 */
	protected function log_version_number() {
		delete_option( $this->token . '_version' );
		update_option( $this->token . '_version', self::$version );
	}
}
