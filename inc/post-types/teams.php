<?php

function cz_teams_post_type()
{
	register_post_type('team',
		[
			'labels' => [
				'name' => 'Team',
				'singular_name' => 'Member',
			],
			'supports' => ['title', 'excerpt', 'thumbnail', 'revisions'],
			'has_archive' => false,
			'hierarchical' => false,
			'exclude_from_search' => true,
			'public' => true,
			'menu_icon' => 'dashicons-networking',
		]
	);
}

add_action('init', 'cz_teams_post_type');

if (function_exists('acf_add_local_field_group')):
	acf_add_local_field_group([
		'key' => 'cz_team_member',
		'title' => 'Team Member',
		'fields' => [
			[
				'key' => 'position',
				'label' => 'Position',
				'name' => 'position',
				'type' => 'text'
			]
		],
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'team',
				],
			],
		],
		'menu_order' => 1,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
	]);
endif;
