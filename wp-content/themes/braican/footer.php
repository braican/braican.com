<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package braican
 */
?>

	</div><!-- #main -->

	<div id="project-modal">
		<div class="braica-container br-cf">
			<div id="load-project"></div>
		</div>
		
	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="braica-container">
			<div class="site-info">
				Copyright &copy; <?php echo date('Y'); ?> Nicholas Braica
			</div><!-- .site-info -->
			
			<div class="the-braica">
				<img  src="<?php echo get_template_directory_uri() . '/img/ski-circle.png'; ?>" alt="">
				<div id="social">
				    <a href="http://twitter.com/braican" target="_blank"><i class="icon-twitter-bird"></i></a>
				    <a href="http://facebook.com/braica.n" target="_blank"><i class="icon-facebook"></i></a>
				    <a href="http://linkedin.com/in/nicholasbraica" target="_blank"><i class="icon-linkedin"></i></a>
				    <a href="https://plus.google.com/+NicholasBraica/" target="_blank"><i class="icon-gplus"></i></a>
				</div>
			</div>

		</div>

	</footer><!-- #colophon -->

	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>