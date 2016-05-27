<?php
/*
Template Name: Daily Report List Template
*/

get_header(); ?>

    <div id="primary" class="content-area">
       <section class="top-nav">
             <a class="nav-forward" href="<?php echo get_stylesheet_directory_uri(); ?>/season-banding-summary">Banding Summary</a>
        </section>
        <main id="main" class="site-main" role="main">

            <?php $archive_query = new WP_Query('showposts=100');
            if ( $archive_query->have_posts() ): ?>
                <h1>Daily Reports: Spring 2016</h1>
                <?php while ($archive_query->have_posts()) : $archive_query->the_post(); 
                    $tempExcerptString = get_the_excerpt(); ?>
                    <article>
                        <div class="float-container">
                            <div class="thumbnail">
                                <a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
                            </div>
                        </div>
                        <div class="float-container">
                            <div class="excerpt">
                                <span class="report-date"><a href="<?php the_permalink() ?>"><?php echo get_field('date'); ?></span></a>
                                <?php echo $tempExcerptString ?>
                                <span><a href="<?php the_permalink() ?>">Read more</a></span>
                            </div>
                        </div>
                    </article>
                <?php endwhile;
            endif;
            ?>

        </main><!-- #main -->
       <section class="bottom-nav">
             <a class="nav-forward" href="<?php echo get_stylesheet_directory_uri(); ?>/season-banding-summary">Banding Summary</a>
        </section>
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
