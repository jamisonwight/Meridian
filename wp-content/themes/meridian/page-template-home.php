<?php /** Template Name: Home */?>

<?php get_header();?>

<div class="grid-container full page-y-offset">
    <div class="wrapper">
        <div class="grid-x">

            <div class="cell hero">
                <img src="<?php echo get_field('hero_background');?>" alt="Hero Background" class="background">

                <div class="content">
                    <div class="content-container">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/white-wave.svg" alt="White wave">
                        <h1 class="heading-1"><?php echo get_field('hero_heading');?></h1>
                    </div>
                </div>
            </div>

            <div class="cell about">
                <img class="wave" src="<?php echo get_template_directory_uri(); ?>/assets/images/wave-brown.svg" alt="Brown Wave">
                <div class="content-container">
                    <div class="description"><?php echo get_field('about_description');?></div>
                </div>
                <div class="meridian-circle">
                    <?php echo file_get_contents(get_template_directory_uri().'/assets/images/meridian-circle.svg'); ?>
                </div>
            </div>


            <div class="cell our-wines">
                <div class="wrapper inner-grid-medium">
                    <span class="title heading-1 with-divider">Our Wines</span>

                    <div class="grid-x wines">
                        <?php
                        $wines = get_field('wines');

                        if ($wines): $i = 0;?>
                            <?php foreach ($wines as $wine):
                                $i++;
                                $permalink = get_permalink($wine->ID);
                                $wine_title = get_field('name', $wine->ID);
                                $wine_year = 'Vint '.get_field('vintage_year', $wine->ID);
                                $featured_image = get_the_post_thumbnail_url($wine, 'full');
                            ?>
                            <div class="cell large-4 wine wine-<?php echo $i; ?>">
                                <a href="#" class="permalink-wrapper modal-trigger">

                                    <div class="featured-image">
                                        <img src="<?php echo $featured_image; ?>" alt="Featured Image">
                                    </div>

                                    <div class="content">
                                        <h4 class="heading-3"><?php echo $wine_title; ?></h4>
<!--                                        <span class="heading-4">--><?php //echo $wine_year; ?><!--</span>-->
                                    </div>

                                    <div class="btn-container">
                                        <button class="btn-default"> View Details</button>
                                    </div>
                                </a>
                            </div>
                            <?php endforeach;?>
                        <?php endif;?>
                    </div>
                </div>
            </div>

            <div class="wine-detail-modals">
            <?php
                $winesModal = get_field('wines');

                if ($winesModal): $i = 0; ?>
                    <?php foreach ($winesModal as $wine):
                        $i++;
                        $permalink = get_permalink($wine->ID);
                        $wine_title = get_field('name', $wine->ID);
                        $wine_year = 'Vint '.get_field('vintage_year', $wine->ID);
                        $wine_state = get_field('state', $wine->ID);
                        $wine_tasting_note_heading = get_field('tasting_note_heading', $wine->ID);
                        $featured_image = get_the_post_thumbnail_url($wine, 'full');
                        $description_winemaking = get_field('winemaking_notes', $wine->ID);
                        $description_tasting_notes = get_field('tasting_notes', $wine->ID);
                        $pdf = get_field('pdf', $wine->ID);
                        $theme_color = get_field('theme_color', $wine->ID);
                    ?>
                    <div class="wine-modal wine-modal-<?php echo $i; ?> theme-<?php echo $theme_color; ?>">
                    
                        <div class="featured-image">
                            <img class="image" src="<?php echo $featured_image; ?>" alt="Featured Image">
                            <img src="<?php echo get_template_directory_uri().'/assets/images/wave-'.$theme_color.'.svg'; ?>" alt="Wave Image" class="wave">
                        </div>

                        <div class="content-container">

                            <div class="modal-close"></div>

                            <div class="title">
                                <h4 class="heading-2"><?php echo $wine_title; ?></h4>
                                <span class="heading-4" role="heading"><?php echo $wine_tasting_note_heading; ?></span>
                            </div>

                            <div class="description winemaking-notes">
                                <span class="heading-6">Winemaking Notes</span>
                                <?php echo $description_winemaking; ?>
                            </div>

                            <div class="description tasting-notes">
                                <span class="heading-6">Tasting Notes</span>
                                <?php echo $description_tasting_notes; ?>
                            </div>

                            <div class="btn-container">
                                <a href="<?php echo $pdf; ?>"><button class="btn-default"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download PDF</button></a>
                            </div>
                        </div>

                    </div>
                    <?php endforeach;?>
                <?php endif;?>
            </div>


            <!-- <div class="cell where-to-buy">
                <h2 class="heading-1 with-divider">Where To Buy</h2>

                <div class="wrapper">
                    <iframe src=“https://www.vtinfo.com/PF/product_finder.asp?custID=TWG&theme=bs-paper&category8=FOUNDERS ESTATE” width=“100%” height=“800” frameborder=“0" scrolling=“no” allow=“geolocation;“></iframe>
                </div>
            </div> -->

        </div>
    </div>
</div>

<?php get_footer();?>