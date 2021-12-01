<?php
if (function_exists('cz_render_acf_block')) {
	acf_register_block_type([
		'name' => 'cz-team-grid',
		'title' => 'Team Grid',
		'description' => 'A gallery that displays team members.',
		'render_callback' => cz_render_acf_block('cz-team-grid', get_template_directory() . '/template-parts/blocks/team-grid.php'),
		'category' => 'layout',
		'icon' => 'networking',
		'keywords' => ['team', 'staff'],
		'supports' => [
			'mode' => false,
		],
		'mode' => 'preview'
	]);
}
