<?php if ( ! empty( $posts ) && $posts->have_posts() ) : ?>
	<?php if ( ! empty( $instance['title'] ) ) echo $args['before_title'] . $instance['title'] . $args['after_title'] ?>
	<div class="sow-blog sow-blog-layout-alternate">
		<?php while( $posts->have_posts() ) : $posts->the_post(); ?>
			<?php $thumbnail_class = ! $settings['featured_image'] || ! has_post_thumbnail() ? 'sow-no-thumbnail' : ''; ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( "sow-blog-columns $thumbnail_class" ); ?>>
				<?php $this->post_featured_image( $settings ); ?>
				<div class="sow-blog-content-wrapper">
					<header class="entry-header">
						<?php
						the_title(
							'<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">',
							'</a></h2>'
						);
						?>
						<div class="entry-meta">
							<?php $this->post_meta( $settings ); ?>
						</div>
					</header>

					<div class="entry-content">
						<?php
							if ( $settings['content'] == 'full' ) {
								the_content();
							} else {
								$this->generate_excerpt( $settings );
							}
						?>
					</div>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
	<?php $this->paginate_links( $settings, $posts ); ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
