<?php get_header(); ?>

<section class="hero">
	<div class="wrap">
		<h1><?php bloginfo( 'name' ); ?></h1>
		<p>Websites that turn visitors into customers.</p>
	</div>
</section>

<main class="content">
	<div class="wrap">
		<div class="card">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
			endif;
			?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
