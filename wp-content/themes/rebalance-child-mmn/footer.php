<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rebalance child mmn
 */
?>

			<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="site-info">
					<div class="rss-feed">
						<!-- mmn: RSS link-->
						<a href="https://www.mmmnmnm.com/rss"></a>
					</div>
					<br>
					<!-- See parent template for original footer code, which was mentioning WordPress and the Rebalance theme -->
					<a href="https://www.mmmnmnm.com/impressum">Impresszum &amp; Kontakt</a> <br>
					<a href="https://www.mmmnmnm.com/cookies">Sütik/Cookies</a> <br>
				</div><!-- .site-info -->
			</footer><!-- #colophon -->

		</div><!-- .col-width -->
	</div><!-- #content -->

</div><!-- #page -->

<?php wp_footer(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js">
</script>

<script src="//widget.mixcloud.com/media/js/widgetApi.js" type="text/javascript"></script>

<script src="//widget.mixcloud.com/media/js/footerWidgetApi.js" async>
{"feed": "/mmmnmnm/" }
</script>

<script async defer src="<?php echo get_stylesheet_directory_uri(); ?>/custom-scripts.js">
</script>

</body>
</html>
