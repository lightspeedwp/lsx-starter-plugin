<?php
/**
 * Widget Content Part.
 * 
 * @package 	{plugin-name}
 * @category	{post-type}
 * @subpackage	widget
 */

global $disable_placeholder;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 	
 	<?php if ( '1' !== $disable_placeholder && true !== $disable_placeholder ) : ?>
		
		<div class="thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php lsx_thumbnail( 'lsx-thumbnail-wide' ); ?>
			</a>
		</div>

	<?php endif; ?>
	
	<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

	<div class="widget-content">
		<p><?php the_excerpt(); ?></p>

		<div class="view-more">
			<a href="<?php the_permalink(); ?>" class="btn btn-primary text-center"><?php esc_html_e( 'View', '{plugin-name}' ); ?></a>
		</div>	
	</div>
</article><!-- #post-## -->

<?php