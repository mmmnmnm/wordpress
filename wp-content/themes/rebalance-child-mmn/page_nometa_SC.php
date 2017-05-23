<?php /* Template Name: Page no meta with SC*/ ?>

<!-- Soundcloud dependencies for player -->
 <script src="http://d3js.org/d3.v3.min.js"></script>
 <script src="https://connect.soundcloud.com/sdk/sdk-3.1.2.js"></script>
 <script type="text/javascript" src=<?php echo esc_url( home_url( '/' ) ) . '/scripts/audioplayer.js';?>></script>

<?php
/**
 * Page template for impressum page: no meta data
 * Author: mmmnmnm, mmn
 *
 *
 *
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php
					get_template_part( 'template-parts/content', 'nometa' );
			?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
