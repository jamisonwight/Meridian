<div class="title-bar hide-for-large" data-responsive-toggle="example-animated-menu" data-hide-for="large">
	<div class="menu-toggle">
		<div class="open" data-toggle>
			<div class="menu-line"></div>
			<div class="menu-line"></div>
			<div class="menu-line"></div>
		</div>
	</div>
	<a class="meridian-logo-container" href="<?php echo bloginfo('url'); ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-vert.svg" alt="Meridian Logo">
	</a>

</div>

<div class="top-bar" id="example-animated-menu" data-closable="slide-out-right fast" data-animate="slide-in-right fast slide-out-right fast" data-show-for="large">
	<div class="close hide-for-large" data-close="example-animated-menu"></div>

    <a class="meridian-logo-container" href="<?php echo bloginfo('url'); ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-vert.svg" alt="Meridian Logo">
    </a>
	
	<div class="menu-wrap">
		<?php 
			wp_nav_menu( array( 
				'menu' => 'Main'
			)); 
		?>
	</div>

</div>
