<?php
/*
Template Name: MUSIC TEMPLATE
*/

get_header()
?>

<main class="main">

	<section class="music">
		<div class="music__container container">
			<?php
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => -1,
			);

			$query = new WP_Query($args);

			if ($query->have_posts()) :
				$count = 0;

				while ($query->have_posts()) : $query->the_post();

					if ($count % 4 == 0) {
						echo '<div class="music__row">';
					}

					$thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
					$title = get_the_title();
					$youtube = get_field('link_to_youtube');
					$spotify = get_field('link_to_spotify');

			?>
					<div class="music__track">
						<img src="<?php echo esc_url($thumbnail); ?>" alt="Track" class="music__track-image">
						<h2 class="music__track-title"><?php echo esc_html($title); ?></h2>
						<div class="music__track-item">
							<?php if ($youtube) : ?>
								<a href="<?php echo esc_url($youtube); ?>" class="music__track-link" target="_blank">YOUTUBE</a>
							<?php endif; ?>
							<?php if ($spotify) : ?>
								<a href="<?php echo esc_url($spotify); ?>" class="music__track-link" target="_blank">SPOTIFY</a>
							<?php endif; ?>
						</div>
					</div>
			<?php

					$count++;

					if ($count % 4 == 0) {
						echo '</div>';
					}

				endwhile;
				if ($count % 4 != 0) {
					echo '</div>';
				}

				wp_reset_postdata();

			else :
				echo '<p>No tracks found</p>';
			endif;
			?>
		</div>
	</section>


</main>

<?php get_footer() ?>