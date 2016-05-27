<?php
/*
Template Name: Volunteer Resources Template
*/

get_header(); 

?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main checklist" role="main">

            <h1>Helpful Links</h1>
            <p>Below are links to some helpful information for volunteers and students coming to Appledore:</p>
            <ul>
                <li><a href="<?php echo get_stylesheet_directory_uri(); ?>/suggested-packing-list/">Suggested packing list</a> (there is also a suggested packing list attached to the <a target="_blank" href="http://www.shoalsmarinelaboratory.org/sites/shoalsmarinelaboratory.org/files/media/pdf/VisitorForms/sml_researcher_forms_2016.pdf">SML volunteer forms</a>)</li>

                <li><a target="_blank" href="http://www.shoalsmarinelaboratory.org/boat-schedule">SML Boat Schedule</a>

                <li><a target="_blank" href="http://www.shoalsmarinelaboratory.org/getting-shoals-researchers">Parking and Directions</a> (this is a page on the SML website)</li>

                <li><a target="_blank" href="http://www.shoalsmarinelaboratory.org/sites/shoalsmarinelaboratory.org/files/media/pdf/Manuals/appledorehandbook2016_ada.pdf">Appledore Handbook</a> (this is also from the SML website; it contains comprehensive documentation of everything you need to know when you're on the island)</li>

                <li><a target="_blank" href="http://www.ndbc.noaa.gov/station_page.php?station=iosn3">Current Isles of Shoals weather conditions</a></li>

                <li><a target="_blank" href="http://www.pauljhurtado.com/US_Composite_Radar/">Bird Migration Radar Maps (Paul Hurtado's page)</a>

                <li><a target="_blank" href="https://www.sondroyo.com/pages/sml/">Appledore radar tower cams</a></li>
            </ul>


        </main><!-- #main -->
        <section class="bottom-nav">
            <a class="nav-back" href="<?php echo get_stylesheet_directory_uri(); ?>/volunteer-checklist">Volunteer Checklist</a>
        </section>

    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
