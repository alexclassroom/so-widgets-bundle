<div class="sow-carousel-title<?php if ( ! empty( $settings['title'] ) ) echo ' has-title'; ?>">
	<?php
	if ( ! empty( $settings['title'] ) ) {
		echo $settings['args']['before_title'] . esc_html( $settings['title'] ) . $settings['args']['after_title'];
	}

	if ( $settings['navigation'] == 'title' ) {
		?>
		<div class="sow-carousel-navigation">
			<?php $this->render_navigation( 'both' ); ?>
		</div>
	<?php } ?>
</div>

<div class="sow-carousel-container">
	<?php
	if ( $settings['navigation'] == 'side' ) {
		$this->render_navigation( 'prev' );
	}
	?>
	<div class="sow-carousel-wrapper"
	     data-dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>"
	     <?php
	     foreach( $settings['attributes'] as $n => $v ) {
	     	if ( ! empty( $n ) ) {
	     		echo 'data-' . $n . '="' . esc_attr( $v ) . '" ';
	     	}
	     }
	     ?>
	>
		<div class="sow-carousel-items">
			<?php include $settings['item_template']; ?>
		</div>
	</div>

	<?php
	if ( $settings['navigation'] == 'side' ) {
		$this->render_navigation( 'next' );
	}
	?>
</div>
