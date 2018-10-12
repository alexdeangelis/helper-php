<?php //THE SHORTENED LOOP ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>



<?php //THE LONGFORM LOOP ?>

<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); 
		//
		// Post Content here
		//
	} // end while
} // end if
?>