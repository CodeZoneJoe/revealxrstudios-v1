<?php
	$items = wp_get_nav_menu_items( 'social' );
?>
<div class="sticky-social"
	 data-controller="toggle"
	 data-toggle-class="sticky-social--active"
	 data-toggle-target="to"
	 data-toggle-on-outside-click
>
	<div class="sticky-social__button" data-action="click->toggle#toggle" >
		Contact Us
	</div>

	<div class="sticky-social__menu">
		<?php foreach($items as $item): ?>
			<?php
				$handle = get_field('social_handle', $item);
				$icon = get_field('social_icon', $item);
			?>
			<a class="sticky-social__menu-item" href="<?php echo $item->url; ?>" alt="<?php echo $item->alt; ?>">
				<?php if ($handle): ?>
					<div class="sticky-social__icon">
						<img
							src="<?php echo esc_url($icon['url']); ?>"
							alt="<?php echo esc_attr($icon['alt']); ?>"
							width="25"
							height="25"
						/>
					</div>
				<?php endif; ?>
				<div class="sticky-social__content">
					<div class="sticky-social__title">
						<?php echo $item->title; ?>
					</div>
					<?php if ($handle): ?>
						<div class="sticky-social__handle">
							<?php echo $handle; ?>
						</div>
					 <?php endif; ?>
				</div>
			</a>
		<?php endforeach; ?>
	</div>
</div>
