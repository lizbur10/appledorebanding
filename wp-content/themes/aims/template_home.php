<?php
/*
Template Name: Custom Homepage Template
*/

get_header(); ?>

    <div id="primary" class="content-area">
            <section id='image-slider'>
                <?php $images = get_field('photo_gallery'); ?>
                <?php if( $images ): 
                    $imageCounter = 1;
                    $totalWidth = 0;
                    foreach( $images as $image ): 
                        $filename = $image['url'];
                        list($width, $height) = getimagesize($filename);
                        $newHeight = 240;
                        $newWidth = (int) round(240/$height * $width);
                        $ImageId = "galleryImage$imageCounter"; ?>
                        <div style="left: <?php echo $totalWidth; ?>px;"><img id="<?php echo $ImageId ?>" class="slides" height="<?php echo $newHeight; ?>" width="<?php echo $newWidth; ?>" src="<?php echo $image['url']; ?>"  />
                        </div>
                        <?php $imageCounter++; 
                        $totalWidth = $totalWidth + $newWidth; ?>
                   <?php endforeach; ?>
                <?php endif; ?>
               <p class="slider-caption">Photo credits: AIMS; Shoals Marine Lab/Jim Coyer</p>

            </section>


        <main id="main" class="site-main home-page" role="main">

            <section class="home-general-info">
    
                <h2>AIMS Bird Banding</h2>
                <p>The Appledore Island Migration Station (AIMS) is located on Appledore Island in the Gulf of Maine. Each spring and fall, AIMS staff &mdash; who are all volunteers and students &mdash; band birds from dawn to dusk, seven days a week, weather permitting.</p>
                <br>
            <div class="nabc-certs">
                    <ul>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i> AIMS is <a target="_blank" href="<?php echo get_stylesheet_directory_uri(); ?>/img/AIMS NABC STATION SIGN.pdf">North American Banding Council (NABC) Certified </a></li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i> Four of the banders are NABC certified at the Trainer level.</li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i> AIMS observes the <a target="_blank" href="http://www.nabanding.net/banders-code-of-ethics/">Bander's Code of Ethics</a> in all its operations.</li>
                    </ul>
                </div>
                <p>Appledore Island is also home to the <a target="_blank" href="http://www.shoalsmarinelaboratory.org/">Shoals Marine Lab</a>. SML provides hands-on educational and research programs in marine science and environmental sustainability. SML hosts the banding station and its personnel during migration seasons.</p>
            </section>

            <?php $wp_query = new WP_Query( array( 'post_type' => 'current_season', 'nopaging' => true ) );

            if ( $wp_query->have_posts() ): ?>
            <section class="home-current-season">
                <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                <h1><?php echo the_title(); ?></h1>
                    <?php the_content();
                    endwhile; ?>
                </section>
                <?php endif;
            ?>

            <?php

            $wp_query = new WP_Query( array(
                'post_type' => 'news_items',
                'nopaging' => true,
                'meta_query' => array(
                    'date_clause' => array(
                        'key' => 'date',
                        'compare' => 'EXISTS',
                    ), 
                ),
                'orderby' => array(
                    'date_clause' => 'DESC',
            ) ) );

            if ( $wp_query->have_posts() ): ?>
            <section class="home-news">
                <h2>Childe Hassam and the Isles of Shoals</h2>
                <ul>
                    <li>An exhibition featuring American impressionist painter <a target="_blank" href="http://www.pem.org/exhibitions/192-american_impressionist_childe_hassam_and_the_isles_of_shoals">Childe Hassam's paintings of Appledore Island</a> will be on view at the Peabody Essex Museum July 16 through November 6, 2016.</li> 
                    <li>PBS station UNC-TV produced <a target="_blank" href="http://video.unctv.org/video/2365710878/">a documentary about Hassam and the exhibit</a> which can be streamed on their website. The documentary features Appledore's own Hal Weeks, former Assistant Director of the Shoals Marine Lab.</li>
                </ul>
                <h2>Recent News &amp; Updates:</h2>
                    <ul>
                    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
                        $tempContentString = wp_strip_all_tags( get_the_content() ); ?>
                        <li><span class="news-date"><?php echo wp_strip_all_tags( get_field ('date' ) ); ?></span>: <?php echo $tempContentString; ?></li>
                        <?php endwhile; ?>
                    </ul>
                </section>
                <?php endif;

             ?>

            </section>

        </main><!-- #main -->
    </div><!-- #primary -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/image-slider.js"></script>
<?php
get_sidebar();
get_footer();
