<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_authors-to-exclude-on-about-us-page',
		'title' => 'Authors to exclude on about us page',
		'fields' => array (
			array (
				'key' => 'field_59995e4f0d660',
				'label' => 'Exlude Authors',
				'name' => 'exclude_authors',
				'type' => 'user',
				'instructions' => 'Select the authors below you want to <stron>exclude</strong> on the About us page.',
				'role' => array (
					0 => 'all',
				),
				'field_type' => 'multi_select',
				'allow_null' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-about-us.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_sidebar-position-page',
		'title' => 'Sidebar Position - page',
		'fields' => array (
			array (
				'key' => 'field_59995b5499057',
				'label' => 'Position of the sidebar',
				'name' => 'sidebar_position',
				'type' => 'radio',
				'instructions' => 'Position the sidebar for this particular page to the left, right or do not display it at all.',
				'choices' => array (
					'right' => 'Right',
					'left' => 'Left',
					'no' => 'No sidebar',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'right',
				'layout' => 'vertical',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_sidebar-position-post',
		'title' => 'Sidebar Position - post',
		'fields' => array (
			array (
				'key' => 'field_59995f04d3ed4',
				'label' => 'Position of the sidebar',
				'name' => 'sidebar_position',
				'type' => 'radio',
				'choices' => array (
					'as_blog' => 'Default (the same as blog layout)',
					'right' => 'Right',
					'left' => 'Left',
					'no' => 'No sidebar',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'as_blog',
				'layout' => 'vertical',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
