<div class="col-lg-4">
	<article <?php post_class(); ?>>
		<header>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large' , array('class' => 'img-responsive')); ?></a>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php the_category(); ?>
		</header>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
		<footer>
			<?php get_template_part('templates/entry-meta'); ?>
		</footer>
	</article>
</div>