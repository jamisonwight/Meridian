    <!-- For each module add a name for indexing -->
    <?php 
        $moduleIndex = array(
        
        );
    ?>

    <?php if( have_rows('modules') ): ?>
        <?php while ( have_rows('modules') ) : the_row(); ?>


        <?php endwhile; ?>
    <?php endif; ?>