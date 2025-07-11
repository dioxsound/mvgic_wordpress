<?php
/*
Template Name: HOME TEMPLATE
*/

get_header()
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

			<figure class="gallery__item item-1">
				<img src="<?php echo get_field("gallery_image_1")["url"] ?>" alt="<?php echo get_field("gallery_image_1")["alt"] ?>" class="gallery__image">
				<figcaption>
					<?php echo get_field("gallery_image_1")["caption"] ?>
				</figcaption>
			</figure>

			<figure class="gallery__item item-2">
				<img src="<?php echo get_field("gallery_image_2")["url"] ?>" alt="<?php echo get_field("gallery_image_2")["alt"] ?>" class="gallery__image">
				<figcaption>
					<?php echo get_field("gallery_image_2")["caption"] ?>
				</figcaption>
			</figure>

			<figure class="gallery__item item-3">
				<img src="<?php echo get_field("gallery_image_3")["url"] ?>" alt="<?php echo get_field("gallery_image_3")["alt"] ?>" class="gallery__image">
				<figcaption>
					<?php echo get_field("gallery_image_3")["caption"] ?>
				</figcaption>
			</figure>

			<figure class="gallery__item item-4">
				<img src="<?php echo get_field("gallery_image_4")["url"] ?>" alt="<?php echo get_field("gallery_image_4")["alt"] ?>" class="gallery__image">
				<figcaption>
					<?php echo get_field("gallery_image_4")["caption"] ?>
				</figcaption>
			</figure>

			<figure class="gallery__item item-5">
				<img src="<?php echo get_field("gallery_image_5")["url"] ?>" alt="<?php echo get_field("gallery_image_5")["alt"] ?>" class="gallery__image">
				<figcaption>
					<?php echo get_field("gallery_image_5")["caption"] ?>
				</figcaption>
			</figure>

			<figure class="gallery__item item-6">
				<img src="<?php echo get_field("gallery_image_6")["url"] ?>" alt="<?php echo get_field("gallery_image_6")["alt"] ?>" class="gallery__image">
				<figcaption>
					<?php echo get_field("gallery_image_6")["caption"] ?>
				</figcaption>
			</figure>

			<figure class="gallery__item item-7">
				<img src="<?php echo get_field("gallery_image_7")["url"] ?>" alt="<?php echo get_field("gallery_image_7")["alt"] ?>" class="gallery__image">
				<figcaption>
					<?php echo get_field("gallery_image_7")["caption"] ?>
				</figcaption>
			</figure>

		</div>
	</section>

</main>

<?php get_footer() ?>