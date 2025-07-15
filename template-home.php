<?php
/*
Template Name: HOME TEMPLATE
*/

get_header();
?>

<main class="main">

	<section class="hero">
		<div class="hero__container container">
			<?php
			$title = get_field('hero_title');
			$last_char = substr($title, -1);
			$rest = substr($title, 0, -1);
			?>
			<h1 class="hero__title"><?php echo $rest; ?><span><?php echo $last_char; ?></span></h1>
		</div>
	</section>

	<section class="gallery">
		<div class="gallery__container container">

			<?php
			for ($i = 1; $i <= 7; $i++) {
				$media = get_field("gallery_image_$i");
				if (!$media) continue;

				$url = $media['url'];
				$alt = $media['alt'] ?? '';
				$caption = $media['caption'] ?? '';
				$description = $media['description'] ?? '';
				$mime = $media['mime_type'] ?? '';

				echo '<figure class="gallery__item item-' . $i . '">';

				if (strpos($mime, 'image/') === 0) {
					echo '<img src="' . esc_url($url) . '" alt="' . esc_attr($alt) . '" class="gallery__image">';
					if (!empty($caption)) {
						echo '<figcaption>' . esc_html($caption) . '</figcaption>';
					}
				} elseif (strpos($mime, 'video/') === 0) {
					echo '<video class="gallery__video" autoplay loop muted playsinline>';
					echo '<source src="' . esc_url($url) . '" type="' . esc_attr($mime) . '">';
					echo '</video>';
					if (!empty($description)) {
						echo '<figcaption>' . esc_html($description) . '</figcaption>';
					}
				}

				echo '</figure>';
			}
			?>


		</div>
	</section>

</main>

<?php get_footer(); ?>