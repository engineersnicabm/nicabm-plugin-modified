<?php
/**
 * Class Test_Dependencies
 *
 * @package NICABM_Utility_Core
 */

/**
 * Test plugin dependencies.
 */
class Test_Dependencies extends WP_UnitTestCase {

	/**
	 * Set up.
	 */
	public function setUp() {
		parent::setUp();

		\NICABM\Utility\load_admin_files();

		$cmb_init = \CMB2_Bootstrap_230::initiate();
		$cmb_init->include_cmb();
	}

	/**
	 * Tear down.
	 */
	public function tearDown() {
		parent::tearDown();
	}

	/**
	 * Plugin constants are defined.
	 */
	public function test_are_constants_defined() {
		$this->assertTrue( defined( 'NICABM_UTILITY_DIR' ) );
		$this->assertTrue( defined( 'NICABM_UTILITY_CONFIG_DIR' ) );
		$this->assertTrue( defined( 'NICABM_UTILITY_VIEWS_DIR' ) );
		$this->assertTrue( defined( 'NICABM_UTILITY_FILE' ) );
		$this->assertTrue( defined( 'NICABM_UTILITY_URL' ) );
	}

	/**
	 * Composer autoloader exists.
	 */
	public function test_composer_autoload_exists() {
		$this->assertTrue( file_exists( dirname( __DIR__ ) . '/vendor/autoload.php' ) );
	}

	/**
	 * CMB2 is loaded.
	 */
	public function test_is_cmb2_loaded() {
		$this->assertTrue( function_exists( 'new_cmb2_box' ) );
	}
}
