<?php
/*
Template Name: Schedule Page Template
*/

get_header(); 

//Pulls the season info from WP record
$seasonStartDate = get_field('season_start_date'); //Must be formatted YYYYMMDD
$seasonEndDate = get_field('season_end_date');  
$seasonName = get_field('season_name'); 
$nextSeasonName = get_field('next_season_label');
//End population of dates

//this array controls the order names are listed in
$roleLoopArray=array('Bander','Bandaide','MARS'); 

//these variable control whether the new volunteer and MARS messages print at the bottom of the page
$new_found = false; 
$mars_found = false; 

$seasonDatesArray = createDateRangeArray($seasonStartDate,$seasonEndDate);
$seasonStartDay = getStartDay($seasonStartDate); //0=Sunday -> 6=Saturday

$scheduleDetailsArray = array(); //The array that will hold volunteer names for each day in the season
$arrayIndex = 0;
foreach ( $seasonDatesArray as $seasonDate) :
    $scheduleDetailsArray[$arrayIndex] = '<span>' . $seasonDate . '</span>';
    $arrayIndex++;
endforeach;
?>


    <div id="primary" class="content-area">
        <section class="top-nav">
            <a class="nav-forward" href="<?php echo get_stylesheet_directory_uri(); ?>/volunteer-checklist">Volunteer Checklist</a>
        </section>
       <main id="main" class="site-main banding-schedule" role="main">
 
            <h1><?php wp_title(''); ?></h1>
            <?php 
            //$wp_query = new WP_Query( array( 'post_type' => 'add_staff_to_sched', 'nopaging' => true ) );

            $wp_query = new WP_Query( array(
                'post_type' => 'add_staff_to_sched',
                'nopaging' => true,
                'meta_query' => array(
                    'start_date_clause' => array(
                        'key' => 'start_date',
                        'compare' => 'EXISTS',
                    ), 
                ),
                'orderby' => array(
                    'start_date_clause' => 'ASC',
            ) ) );


            //Checks if there are any volunteers scheduled and, if not, returns an appropriate message 
                if ( !( $wp_query->have_posts() ) ): ?>
                    <h3>The <?php echo $seasonName; ?> season has ended -- check back in the <?php echo $nextSeasonName; ?>!</h3>

                <?php else: 

                    foreach ( $roleLoopArray as $role ) :
                    // Populates volunteer names into the array of dates 

                            while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
                                $arrayIndex = 0;
                                if ( !($dateUpdated) || ($dateUpdated < get_the_date() ) ) :
                                    echo get_the_date();
                                    echo $dateUpdated;
                                    $dateUpdated = get_the_date();
                                endif;
                                $personStartDate = get_field('start_date');
                                $personEndDate = get_field('end_date');
                                $personDatesArray = createDateRangeArray($personStartDate,$personEndDate);
                                    if ($role == get_field('role') ) :
                                        $personStartDate = get_field('start_date');
                                        $personEndDate = get_field('end_date');
                                        $personDatesArray = createDateRangeArray($personStartDate,$personEndDate);
                                        foreach ( $seasonDatesArray as $seasonDate ) :
                                            foreach ( $personDatesArray as $personDate ) :
                                                if ( $seasonDate == $personDate ) :
                                                    $name = get_the_title();
                                                    if(have_rows('specify_tentative_dates')): 
                                                        while(have_rows('specify_tentative_dates')): 
                                                            the_row();

                                                            if ( get_sub_field('tentative_date') == $personDate ) : 
                                                                $name = $name . '?';
                                                            endif;
                                                        endwhile;
                                                    endif;

                                                    if ( (get_field('new_volunteer') == 'Yes') && (strpos($name,'*') == false )) :
                                                        $name .= '*';
                                                        $new_found = true;
                                                    endif;
                                                    if ( ($role == "MARS") && (strpos($name,'(M)') == false )) :
                                                        $name .= ' (M)';
                                                        $mars_found = true;
                                                    endif;
                                                    $scheduleDetailsArray[$arrayIndex] .= '<span>' . $name . '</span>';
                                                endif;
                                            endforeach;
                                            $arrayIndex++;
                                        endforeach;
                                    endif;
                            endwhile; 
                    endforeach; 

                    /* Adds header row for calendar */ 
                    ?>
                    <table> 
                        <col class="column-one">
                        <col class="column-two">
                        <col class="column-three">
                        <col class="column-four">
                        <col class="column-five">
                        <col class="column-six">
                        <col class="column-seven">
 
                        <tr class="header-row long-day">
                            <td>Sunday</td>
                            <td>Monday</td>
                            <td>Tuesday</td>
                            <td>Wednesday</td>
                            <td>Thursday</td>
                            <td>Friday</td>
                            <td>Saturday</td>
                        </tr>
                        <tr class="header-row short-day">
                            <td>Sun</td>
                            <td>Mon</td>
                            <td>Tue</td>
                            <td>Wed</td>
                            <td>Thu</td>
                            <td>Fri</td>
                            <td>Sat</td>
                        </tr>

                    <?php 

                    /* Adds empty cells for days before the first day of the season */

                    $weekCounter = 1;
                    if ($seasonStartDay > 0) :
                        for ($dayIndex=0; $dayIndex<$seasonStartDay; $dayIndex++) : ?>
                            <td></td>
                            <?php $weekCounter++;
                        endfor;
                    endif;
                    /* Writes out the schedule */
                    foreach ($scheduleDetailsArray as $dateDetails) : 
                        if ($weekCounter %7 == 1) : ?>
                                <tr><td><?php echo $dateDetails; ?></td>
                        <?php elseif ($weekCounter %7 == 0) : ?>
                                <td><?php echo $dateDetails; ?></td></tr>
                        <?php else : ?>
                                <td><?php echo $dateDetails; ?></td>
                        <?php endif;
                        $weekCounter++;
                    endforeach;
                        
                    if ($weekCounter %7 != 0) : ?>
                        </tr></table>
                    <?php else : ?>
                        </table>
                    <?php endif; ?>

                    <div class="after-schedule-content">
                        <p class="date-updated">Last updated: <?php echo $dateUpdated ?></p>
                        <?php if ($new_found): ?>
                            <p>* refers to new assistants to the station.  Please help them feel welcome.</p>
                        <?php endif;
                        if ($mars_found): ?>
                            <p>(M) refers to students running the Mobile Avian Recording Studio trailer (MARS).</p>
                    </div>
            <?php 
                    endif;
            endif;
        ?>



        </main><!-- #main -->
            <section class="bottom-nav">
                <a class="nav-forward" href="<?php echo get_stylesheet_directory_uri(); ?>/volunteer-checklist">Volunteer Checklist</a>
            </section>
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
