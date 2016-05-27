<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package AIMS
 */

get_header(); 
$banded_total = 0;
$retrap_total = 0;
$return_total = 0;
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() ); ?>

			<?php if(have_rows('daily_list')): ?>
				<h3>Banding list for <?php echo get_field('date'); ?></h3>
				<table class="daily-list">
					<tr>
						<th>Species</th>
						<th>Code</th>
						<th>Banded</th>
						<th>Retrap**</th>
						<th>Return**</th>
					</tr>
					

						<?php while ( have_rows ('daily_list') ) : the_row(); 
							$banded = get_sub_field('banded');
							$banded_total = $banded_total + $banded; 
							$retrap = get_sub_field('retrap');
							$retrap_total = $retrap_total + $retrap;
							$return = get_sub_field('return');
							$return_total = $return_total + $return;
							?>
							<tr>
								<td><?php the_sub_field('species'); ?></td>
								<td><?php the_sub_field('four-letter_code'); ?></td>
								<td><?php the_sub_field('banded'); ?></td>
								<td><?php the_sub_field('retrap'); ?></td>
								<td><?php the_sub_field('return'); ?></td>
							</tr>

						<?php endwhile; ?>
						<tr>
							<td><strong>Totals:</strong></td>
							<td></td>
							<?php if ( $banded_total != 0 ) : ?>
								<td><strong><?php echo $banded_total; ?></strong></td>
							<?php else : ?>
								<td></td>
							<?php endif;
							if ($retrap_total != 0 ) : ?>
								<td><strong><?php echo $retrap_total; ?></strong></td>
							<?php else : ?>
								<td></td>
							<?php endif;
							if ($return_total != 0 ) : ?>
								<td><strong><?php echo $return_total; ?></strong></td>
							<?php else : ?>
								<td></td>
							<?php endif; ?>
						</tr>
				</table>
				<p class="footnote">**Retraps and Returns are birds that are already banded. Retraps were banded earlier in the current season while returns were banded in a previous season.</p>
				<?php else: ?>
					<h3>No birds were banded today!</h3>
			<?php endif; 

		endwhile;  // End of the loop.

		the_post_navigation(); ?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
