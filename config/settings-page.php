<?php
/**
 * Settings configuration.
 *
 * @package        NICABM\Utility\
 * @since          0.2.1
 * @author         Tim Jensen
 * @link           https://nicabm.com/
 * @license        GNU General Public License 2.0+
 */

namespace NICABM\Utility;

/**
 * 'capability'         (string) => The capability required for this menu to be displayed to the user.
 *                                  Defaults to 'manage-options', which is admin level capability.
 *                                  See https://codex.wordpress.org/Roles_and_Capabilities#Capabilities for a list of
 *                                  capabilities.
 * 'menu_page_type'     (string) => Use 'theme' to add our options page to the 'Appearance' menu.
 *                                  Use 'management' to add options page to the 'Tools' menu.
 *                                  Use 'options' to add our options page to the 'Settings' menu.
 *                                  Use 'menu' to add our options page to the main Admin menu.
 *                                  Use 'submenu' to add our options page as a child of another menu. Must also specify
 *                                  'menu_page_parent'.
 *                                  See https://codex.wordpress.org/Administration_Menus for a complete list of
 *                                  possibilities.
 * 'menu_page_parent'   (string) => Required if 'menu_page_type' is set to 'submenu'.
 * 'menu_page_priority' (int)    => Positions the menu.  Defaults to 10.
 * 'menu_page_icon'     (string) => Icon URL. Can use a Dashicons icon name.
 * 'menu_slug'          (string) => Unique page identifier.  This slug appears in the URL.
 * 'menu_title'         (string) => The menu title that displays in the WP Admin menu.
 * 'page_title'         (string) => Title of the options page.
 * 'option_name'        (string) => This is the unique option ID that will be saved in the database.
 * 'option_group'       (string) => Optional. Defaults to 'option_name'.
 * 'metabox_id'         (string) => Optional. A unique metabox ID.
 * 'metabox_fields'     (array)  => Optional. The CMB2 fields will appear in the options page form.
 * 'view_file'          (string) => Full path to the view file.
 */
return [
	[
		'capability'         => 'manage_options',
		'menu_page_type'     => 'options',
		'menu_page_parent'   => '',
		'menu_page_priority' => 10,
		'menu_page_icon'     => '',
		'menu_slug'          => 'nicabm-options',
		'menu_title'         => 'NICABM Site Settings',
		'page_title'         => 'NICABM Site Settings',
		'option_name'        => 'nicabm_settings',
		'option_group'       => 'nicabm_settings_group',
		'metabox_id'         => 'nicabm_settings',
		'metabox_fields'     => [
			[
				'name'       => '',
				'id'         => 'shortcodes',
				'type'       => 'group',
				'repeatable' => false,
				'options'    => [
					'group_title' => __( 'Shortcode Setup', 'nicabm-utility' ),
				],
				'fields'     => [
					[
						'name'        => 'Guarantee',
						'description' => '[nicabm-guarantee]',
						'id'          => 'guarantee',
						'type'        => 'wysiwyg',
					],
					[
						'name'        => 'Ruth Buczynski bio',
						'description' => '[nicabm-ruth-bio]',
						'id'          => 'ruth_bio',
						'type'        => 'wysiwyg',
					],
				],
			],
		],
		'view'               => NICABM_UTILITY_VIEWS_DIR . '/settings-page/admin-form.php',
	],
];
