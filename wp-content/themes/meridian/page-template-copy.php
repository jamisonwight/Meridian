<?php /** Template Name: Copy */ ?>

<?php get_header(); ?>

<div class="grid-x copy page-y-offset">
		<div class="inner-grid-medium">
			<div class="content-container">
				<?php if (have_posts()) : 
					while (have_posts()) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>