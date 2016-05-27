<?php
/*
Template Name: Season Banding Summary
*/

get_header(); 
$speciesList = array(
'SSHA',
'YBCU',
'BBCU',
'RTHU',
'RBWO',
'DOWO',
'HAWO',
'EAWP',
'YBFL',
'ACFL',
'TRFL',
'LEFL',
'EAPH',
'GCFL',
'EAKI',
'BHVI',
'WAVI',
'PHVI',
'REVI',
'BLJA',
'TRES',
'BARS',
'BCCH',
'RBNU',
'WBNU',
'CARW',
'HOWR',
'BGGN',
'RCKI',
'VEER',
'GCTH',
'SWTH',
'HETH',
'WOTH',
'AMRO',
'GRCA',
'BRTH',
'CEDW',
'OVEN',
'WEWA',
'NOWA',
'BWWA',
'BAWW',
'PROW',
'TEWA',
'OCWA',
'NAWA',
'CONW',
'MOWA',
'KEWA',
'COYE',
'HOWA',
'AMRE',
'CMWA',
'CERW',
'NOPA',
'MAWA',
'BBWA',
'BLBW',
'YEWA',
'CSWA',
'BLPW',
'BTBW',
'YPWA',
'PIWA',
'MYWA',
'YTWA',
'PRAW',
'BTNW',
'CAWA',
'WIWA',
'YBCH',
'EATO',
'CHSP',
'FISP',
'SAVS',
'SESP',
'SOSP',
'LISP',
'SWSP',
'WTSP',
'WCSP',
'SCJU',
'SUTA',
'SCTA',
'NOCA',
'RBGR',
'INBU',
'RWBL',
'COGR',
'BHCO',
'OROR',
'BAOR',
'PUFI',
'AMGO');
$speciesTotal = array();
$dateTotal = array();
$seasonSummaryMatrix = array(array());
$dateIndex = 0;
$grandTotal = 0;
?>

    <div id="primary" class="content-area">
        <section class="top-nav">
            <a class="nav-back" href="<?php echo get_stylesheet_directory_uri(); ?>/daily-reports-spring-2016">Daily Reports</a>
        </section>        
        <main id="main" class="site-main summary-table" role="main">

    <?php 
    //Populate the matrix with the banding totals & calculate the daily, species, and grand totals
    $archive_query = new WP_Query('showposts=50');
    if ( $archive_query->have_posts() ): ?>
        <h1>Spring 2016 Banding Summary</h1>
        <?php while ($archive_query->have_posts()) : $archive_query->the_post(); 
        $recordDateString = get_field('date');
            $seasonSummaryMatrix[0][$dateIndex] = substr($recordDateString,0,6);
            for ($speciesIndex = 1; $speciesIndex <= count($speciesList); $speciesIndex++ ) :
                if ( have_rows ('daily_list')) :
                    while( have_rows('daily_list') ) : the_row(); 
                        if ( ($speciesList[$speciesIndex] == get_sub_field('four-letter_code') && ( get_sub_field('banded') ) ) ) :
                            $seasonSummaryMatrix[$speciesIndex][$dateIndex] = get_sub_field('banded');
                            $speciesTotal[$speciesIndex] = $speciesTotal[$speciesIndex] + get_sub_field('banded');
                            $dateTotal[$dateIndex] = $dateTotal[$dateIndex] + get_sub_field('banded');
                            $grandTotal = $grandTotal + get_sub_field('banded');
                        endif;
                    endwhile;
                endif;
            endfor;
        $dateIndex++;
        endwhile; 
    endif; ?>

    <?php
    //Write out the header row
    echo "<div><table><tr><td>Species</td>";
    for ($col = $dateIndex-1; $col >= 0; $col--) {
        echo "<td>" . $seasonSummaryMatrix[0][$col] . "</td>";
    }
    echo "<td>Total</td></tr>";
    //Write out a row for each species banded so far in the season
for ($row = 1; $row <= count($speciesList); $row++) {
    if ( $speciesTotal[$row] > 0) :
    echo "<tr><td>" . $speciesList[$row] . "</td>";
    for ($col = $dateIndex-1; $col >= 0; $col--) {
    echo "<td>".$seasonSummaryMatrix[$row][$col]."</td>";
  }
  echo "<td>" . $speciesTotal[$row] . "</td></tr>";
  endif;
}
//write out a row showing the daily totals and grand total
echo "<tr><td>Totals:</td>";
    for ($col = $dateIndex-1; $col >= 0; $col--) {
        if ($dateTotal[$col] > 0) :
            echo "<td>" . $dateTotal[$col] . "</td>";
        else :
            echo "<td>0</td>";
        endif;
}
echo "<td>" . $grandTotal . "</td></tr></table></div>";
?>

        </main><!-- #main -->
        <section class="bottom-nav">
            <a class="nav-back" href="<?php echo get_stylesheet_directory_uri(); ?>/daily-reports-spring-2016">Daily Reports</a>
        </section>

    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
