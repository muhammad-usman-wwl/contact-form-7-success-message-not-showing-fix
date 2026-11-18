<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<section class="hero">
	<div class="wrap">
		<h1><?php the_title(); ?></h1>
		<p>Send us a message — the form below really works (after the fixes in the video).</p>
	</div>
</section>

<main class="content">
	<div class="wrap">
		<div class="card">
			<?php the_content(); ?>
		</div>
	</div>
</main>
<?php endwhile; ?>

<?php get_footer(); ?>
