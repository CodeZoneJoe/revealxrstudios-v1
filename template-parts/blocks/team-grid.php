<?php

$query = new WP_Query(['post_type' => 'team']);
$team = $query->posts;

$classes = cz_classes(
	'team-grid'
);
?>

<div
	class="<?= $classes ?>"
	data-controller="team-grid"
>
	<?php foreach ($team as $member): ?>
		<div class="team-grid__member"
			 data-member-id="<?php echo $member->ID ?>"
			 data-team-grid-target="member"
			 data-action="click->team-grid#open"
		>
			<?php echo get_the_post_thumbnail($member, 'landscape'); ?>
			<div class="team-grid__member-bio hidden"
				 data-team-grid-taget="bio">
				<div class="team-grid__member-bio-inner">
					<div class="team-grid__close"
						 data-action="click->team-grid#close">
						<svg viewBox="0 0 111.72 111.72" xmlns="http://www.w3.org/2000/svg" class="fill-current"><path d="m111.72 12.02-12.02-12.02-43.84 43.84-43.84-43.84-12.02 12.02 43.84 43.84-43.84 43.84 12.02 12.02 43.84-43.84 43.84 43.84 12.02-12.02-43.84-43.84z"/></svg>
					</div>
					<h3 class="team-grid__member-bio-heading">
						<?php echo get_the_title($member); ?>
					</h3>
					<div class="team-grid__member-bio-position">
						<?php echo get_field('position', $member->ID); ?>
					</div>
					<div class="team-grid__member-bio-content">
						<?php echo get_the_excerpt($member); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>
