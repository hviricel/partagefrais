<?php
/**
 * Name: Origines WordPress Theme
 * GitHub URI: https://github.com/haroldparis/origines
 * Description: Origines template for the loop.
 * Author: Harold Paris
 * Twitter: @haroldparis
 * Author website: http://www.tribeleadr.com/
 */
?>

<?php if ( have_posts() ) : $postCount = 0; ?>

	<?php while ( have_posts() ) : the_post(); $postCount++; ?>

		<?php if ( $postCount != 1 ) : ?>

			<hr />

		<?php endif; ?>
	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="o-title-header">
				<h2 class="o-title">
					<a class="o-title-link" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'origines' ), the_title_attribute( 'echo=0' ) ) ); ?>">
						<?php the_title(); ?>
					</a>
				</h2> <!-- /.o-title -->
			</header> <!-- /.o-title-header -->

			<?php if ( is_search() || is_date() || is_tag() ) : ?>
		
			<div class="o-entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		
			<?php else : ?>
		
			<div class="o-entry-content">

				<?php if ( is_home() || is_category() ) : ?>

					<a class="o-thumbnail-link" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'origines' ), the_title_attribute( 'echo=0' ) ) ); ?>">
						<?php the_post_thumbnail('origines-thumb', array('class' => 'o-thumbnail')); ?>
					</a>

				<?php endif; ?>

				<?php the_content( __( '<span class="label label-info">Read more...</span>', 'origines' ) ); ?>
			
			</div><!-- /.o-entry-content -->
		
			<?php endif; ?>

			<footer class="o-entry-meta">
				<?php origines_entry_meta(); ?>
			</footer><!-- .entry-meta -->
			
			<div class="clearfix"></div>
		
		</article><!-- #post -->
	
	<?php endwhile; ?>
		
	<?php if ( $wp_query->max_num_pages > 1 ) : ?>

		<nav class="o-page-nav pagination pagination-centered">
			<?php
			global $wp_query;

			$big = 999999999; // need an unlikely integer

			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages,
				'type' => 'list'
			) );
			?>
		</nav><!-- /.o-page-nav -->
		
	<?php endif; ?>

<?php else : ?>

	<article id="post-0" class="post no-results not-found">

		<header class="o-title-header" class="page-header">
			<h2 class="o-title">
				<?php _e( 'Nothing Found', 'origines' ); ?>
			</h2> <!-- /.o-title -->
		</header> <!-- /.o-title-header -->

		<div id="o-content" class="o-entry-content clearfix" itemprop="MainContentofPage">
		
			<p><?php _e( 'Apologies, but no results were found.', 'origines' ); ?></p>

		</div> <!-- /#o-content -->

	</article><!-- #post-0 -->

<?php endif; ?>
