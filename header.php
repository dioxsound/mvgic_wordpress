<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div class="background">
		<video autoplay muted loop playsinline class="background-video">
			<source src="<?php the_field("animated_background", 'option') ?>">
		</video>
	</div>

	<header class="header">
		<div class="container header__container">
			<a href="/" class="header__logo logo">
				<img src="<?php echo get_field("logo_image", 'option')["url"] ?>" alt="<?php echo get_field("logo_image", 'option')["alt"] ?>">
			</a>
			<nav class="nav header__menu">
				<ul class="header__menu-list">
					<li class="header__menu-item">
						<button class="header__menu-button button" type="button">Play</button>
					</li>
					<li class="header__menu-item">
						<button class="header__menu-button header__menu-button--contacts" type="button">Contacts</button>
						<div class="header__submenu">
							<button class="header__submenu-button button" type="button">Close</button>

							<?php
							if (have_rows('submenu_links-repeater', 'option')):
								while (have_rows('submenu_links-repeater', 'option')) : the_row();
							?>

							<a href="<?php echo get_sub_field('link')['url'] ?>" rel ="nofollow" target="_blank"><?php echo get_sub_field('link')['title'] ?></a>

							<?php
								endwhile;
							else :
							endif;
							?>

							<p>Email for collaborations:</p>
							<a href="mailto:<?php the_field('link_email', 'option') ?>"><?php the_field('link_email', 'option') ?></a>
						</div>
					</li>
					<li class="header__menu-item">
						<a href="#" class="header__menu-link">Music</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>