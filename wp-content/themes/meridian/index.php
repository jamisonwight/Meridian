<?php 
    get_header();

    $insight_id;
?>

<!-- Breadcrumbs -->
<div class="grid-container module breadcrumbs" id="breadcrumbs-0">
    <div class="wrapper">
        <div class="grid-x ">
            <div class="cell">
                <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                    }
                ?>
            </div>
        </div>
    </div>
</div>


<!-- Insights -->
<div class="grid-container module insights insights-single">
    <div class="wrapper inner-grid">
        <div class="grid-x">

            <div class="cell category-dropdown">
                <!-- Select Categories -->
                <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
                    <div class="select-container">
                        <?php
                            $args = array(
                                'show_option_none' => __( 'Categories', 'textdomain' ),
                                'show_count'       => 0 ,
                                'orderby'          => 'name',
                                'echo'             => 0,
                            );
                        ?>

                        <?php $select  = wp_dropdown_categories( $args ); ?>
                        <?php $replace = "<select$1 onchange='return this.form.submit()'>"; ?>
                        <?php $select  = preg_replace( '#<select([^>]*)>#', $replace, $select ); ?>

                        <?php echo $select; ?>

                        <noscript>
                            <input type="submit" value="View" />
                        </noscript>
                    </div>
                </form>
            </div>

            <div class="cell small-10 small-offset-1 post-container">
                <div class="grid-x grid-margin-x">
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php $insight_id = get_the_ID(); ?>

                    <div class="cell post-single">
                        <div class="post-single-container">
                        
                            <!-- Featured Image -->
                            <?php if (!empty(get_field('header_image'))) : ?>
                                <div class="featured-image">
                                    <img src="<?php the_field('header_image'); ?>" alt="<?php the_title(); ?> Image">
                                </div>
                            <?php else : ?>
                                <?php
                                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                                    if ( ! empty( $large_image_url[0] ) ): ?>
                                        <div class="featured-image">
                                            <img src="<?php echo $large_image_url[0]; ?>" alt="<?php the_title(); ?> Image">
                                        </div>       
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="content">
                                <!-- Title -->
                                <h3 class="heading-2 text-blue-dark"><?php the_title(); ?></h3>
                                <hr>
                                <?php the_content(); ?>
                            </div>
                            
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
            </div>

        </div>
    </div>

    <div class="bullseye">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bullseye-orange-alt.svg" alt="Bullseye Orange">
    </div>
</div>


<!-- Explore Additional Insights -->
<div class="grid-container additional-insights"> 
    <div class="wrapper inner-grid">

        <div class="grid-x">
            <div class="cell small-10 small-offset-1 content">
                <div class="content-container">
                    <h2 class="heading-2 text-blue-dark">Explore additional insights.</h2>
                    <hr>
                </div>
            </div>
        </div>

        <div class="grid-x content-container">
           <div class="cell medium-10 medium-offset-1 additional-posts">
                <div class="grid-x align-center">
                <?php 
                        $args = array("post_type" => "occhio_insights", 'numberposts' => -1, 'orderby' => 'rand', 'post__not_in' => array( $insight_id,));
                        $insightsQuery = get_posts( $args );                                 
                    ?>

                    <?php foreach ( $insightsQuery as $q ) : $id = $q->ID;
                        $permalink = get_permalink($id);
                        $title = get_the_title($id);
                        $featured_image = get_the_post_thumbnail_url($q, 'full');
                        $post_type_string = strval($q->post_type);
                        $featured_post_label = get_post_type_object($post_type_string)->labels->singular_name;
                    ?>

                    <div class="cell large-4 additional-post">
                        <a href="<?php echo $permalink; ?>">
                            <div class="featured-image">
                                <img src="<?php echo $featured_image; ?>" alt="Featured Image">
                            </div>

                            <div class="content">
                                <h4 class="heading-3"><?php echo $title; ?></h4>
                            </div>

                            <div class="btn-container">
                                <a class="btn-alt" href="<?php echo $permalink; ?>">Read Article</a>
                            </div>
                        </a>
                    </div>
                        
                    <?php endforeach; ?>                            
                </div>

                <div class="grid-x load-more-container">
                    <div class="cell btn-container">
                        <button class="btn-alt load-more" id="load-more">More Articles</button>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>


<!-- Contact Module -->
<div class="grid-container module split-content-callout-single"
    id="split-content-callout-single-0"> 
    <div class="wrapper inner-grid-medium">
        <div class="grid-x content-container">

            <div class="cell large-6 content">
                <h2 class="heading-2">A Recruiting Partner You Can Trust</h2>
                <hr>
                <p>Go beyond a great hire and find a true recruiting partner to 
                fill your next critical position with confidence. We value our clients 
                and would love to build a long-term relationship with your organization.</p>
            </div>

            <div class="cell large-6 callout-links">
                <div class="btn-container">
                    <a class="btn-default" data-text="Contact Us" href="<?php echo bloginfo('url'); ?>/contact-us"><span>Contact Us</span></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>