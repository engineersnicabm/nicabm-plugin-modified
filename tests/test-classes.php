<?php
/**
 * Class Test_Classes
 *
 * @package NICABM_Utility_Core
 */

/**
 * Test_Classes.
 */
class Test_Classes extends WP_UnitTestCase {

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
	 * Register post type.
	 */
	public function test_register_post_type() {
		$cpt = require NICABM_UTILITY_CONFIG_DIR . '/custom-post-types.php';
		$cpt = $cpt[0];

		$registered_cpt = new \NICABM\Utility\Custom_Post_Type( $cpt );
		$registered_cpt->register_custom_post_type();
		$get_post_type_object = get_post_type_object( $cpt['post_type'] );

		$this->assertInstanceOf( 'NICABM\Utility\Custom_Post_Type', $registered_cpt );
		$this->assertEquals( $get_post_type_object->name, $cpt['post_type'] );
	}

	/**
	 * Register taxonomy.
	 */
	public function test_register_taxonomy() {
		$taxo = require NICABM_UTILITY_CONFIG_DIR . '/examples/example-custom-taxonomies-config.php';
		$taxo = $taxo[0];

		$registered_taxo = new \NICABM\Utility\Custom_Taxonomy( $taxo );
		$registered_taxo->register_custom_taxonomy();
		$get_taxonomy = get_taxonomy( $taxo['taxonomy'] );

		$this->assertInstanceOf( 'NICABM\Utility\Custom_Taxonomy', $registered_taxo );
		$this->assertEquals( $get_taxonomy->name, $taxo['taxonomy'] );
	}

	/**
	 * Genesis CPT Archive Settings meta box.
	 */
	public function test_genesis_cpt_metaboxes() {
		$metabox = require NICABM_UTILITY_CONFIG_DIR . '/examples/example-genesis-cpt-archives-config.php';
		$metabox = $metabox[0];

		$metabox['metabox']['id'] = 'nicabm_test_genesis_cpt_metabox';

		$genesis_cpt_metabox = new \NICABM\Utility\Genesis_CPT_Archives_Meta_Box( $metabox );

		$this->assertInstanceOf( 'NICABM\Utility\Genesis_CPT_Archives_Meta_Box', $genesis_cpt_metabox );

		$genesis_cpt_metabox->init_metabox();

		$cmb = cmb2_get_metabox( $metabox['metabox']['id'] );

		$this->assertEquals( $metabox['metabox']['id'], $cmb->meta_box['id'] );
	}

	/**
	 * Genesis Theme Settings meta box.
	 */
	function test_genesis_theme_metaboxes() {
		$metabox                  = require NICABM_UTILITY_CONFIG_DIR . '/genesis-theme-settings-meta-box.php';
		$metabox                  = $metabox[0];
		$metabox['metabox']['id'] = 'nicabm_test_genesis_theme_metabox';

		$genesis_theme_metabox = new \NICABM\Utility\Genesis_Theme_Settings_Meta_Box( $metabox );

		$this->assertInstanceOf( 'NICABM\Utility\Genesis_Theme_Settings_Meta_Box', $genesis_theme_metabox );

		$genesis_theme_metabox->init_metabox();

		$cmb = cmb2_get_metabox( $metabox['metabox']['id'] );

		$this->assertEquals( $metabox['metabox']['id'], $cmb->meta_box['id'] );
	}

	/**
	 * Post meta box.
	 */
	function test_post_metaboxes() {
		$metabox                  = require NICABM_UTILITY_CONFIG_DIR . '/post-metabox.php';
		$metabox                  = $metabox[0];
		$metabox['metabox']['id'] = 'nicabm_test_post_metabox';

		$post_metabox = new \NICABM\Utility\Post_Metabox( $metabox );
		$post_metabox->init_metabox();

		$this->assertInstanceOf( 'NICABM\Utility\Post_Metabox', $post_metabox );

		$cmb = cmb2_get_metabox( $metabox['metabox']['id'] );
		$this->assertEquals( $metabox['metabox']['id'], $cmb->meta_box['id'] );
	}

	/**
	 * Settings page.
	 */
	public function test_settings_pages() {
		$settings_page_config = require NICABM_UTILITY_CONFIG_DIR . '/settings-page.php';
		$settings_page_config = $settings_page_config[0];

		$settings_page = new \NICABM\Utility\Settings_Page( $settings_page_config );
		$this->assertInstanceOf( 'NICABM\Utility\Settings_Page', $settings_page );
	}

	/**
	 * Shortcodes.
	 */
	public function test_shortcodes() {
		$shortcode_config = require NICABM_UTILITY_CONFIG_DIR . '/shortcode.php';
		$shortcode_config = $shortcode_config[0];

		$shortcode = new \NICABM\Utility\Shortcode( $shortcode_config );
		$this->assertInstanceOf( 'NICABM\Utility\Shortcode', $shortcode );

		$shortcode->init();
		$this->assertTrue( shortcode_exists( $shortcode_config['tag'] ) );
	}

	/**
	 * Term meta box.
	 */
	public function test_term_metaboxes() {
		$metabox                  = require NICABM_UTILITY_CONFIG_DIR . '/examples/example-term-metabox-config.php';
		$metabox                  = $metabox[0];
		$metabox['metabox']['id'] = 'nicabm_test_term_metabox';

		$term_metabox = new \NICABM\Utility\Term_Metabox( $metabox );
		$this->assertInstanceOf( 'NICABM\Utility\Term_Metabox', $term_metabox );

		$term_metabox->init_metabox();
		$cmb = cmb2_get_metabox( $metabox['metabox']['id'] );
		$this->assertEquals( $metabox['metabox']['id'], $cmb->meta_box['id'] );
	}
}
