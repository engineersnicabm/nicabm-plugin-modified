<?php
/**
 * Class for registering Shortcode elements.
 *
 * @package     NICABM\Utility
 * @author      Tim Jensen <tim@timjensen.us>
 * @license     GNU General Public License 2.0+
 * @link        https://nicabm.com
 * @since       0.1.0
 */

namespace NICABM\Utility;

/**
 * Class Shortcode_UI
 *
 * @package NICABM\Utility
 */
class Shortcode_UI {

	/**
	 * Shortcode tag.
	 *
	 * @var null
	 */
	protected $tag;

	/**
	 * Shortcode UI arguments.
	 *
	 * @var array
	 */
	protected $shortcode_ui_args = [];

	/**
	 * Add_Shortcode_UI constructor.
	 *
	 * @param $config
	 */
	public function __construct( $config ) {
		if ( empty( $config['tag'] ) || empty( $config['args'] ) ) {
			return false;
		}

		$this->tag  = $config['tag'];
		$this->args = $config['args'];
	}

	/**
	 * Register the shortcode UI.
	 *
	 * @return void
	 */
	public function init() {
		array_walk_recursive( $this->args, [ $this, 'escape_and_translate' ] );

		shortcode_ui_register_for_shortcode( $this->tag, $this->args );
	}

	/**
	 * Escape and translate the labels.
	 *
	 * @param mixed  $value Array value.
	 * @param string $key   Array key.
	 *
	 * @return void
	 */
	public function escape_and_translate( &$value, $key ) {
		if ( 'label' === $key || 'description' === $key ) {
			$value = esc_html__( $value, 'mildtowild-utility' );
		}
	}
}
