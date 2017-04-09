<?php

/**
 * Class SiteOrigin_Widget_Field_Autocomplete
 */
class SiteOrigin_Widget_Field_Autocomplete extends SiteOrigin_Widget_Field_Text_Input_Base {

	/**
	 * An array of post types to use in the autocomplete query.
	 *
	 * @access protected
	 * @var array
	 */
	protected $post_types;

	protected function initialize() {
		$this->placeholder = __( 'Search Content', 'so-widgets-bundle' );
	}


	/**
	 * The CSS classes to be applied to the rendered text input.
	 */
	protected function get_input_classes() {
		return array( 'widefat', 'siteorigin-widget-input', 'siteorigin-widget-autocomplete-input', 'content-text-search' );
	}

	/**
	 * The data attributes to be added to the input element.
	 */
	protected function get_input_data_attributes() {
		return array( 'post-types' => $this->post_types );
	}

	protected function render_before_field( $value, $instance ) {
		parent::render_before_field( $value, $instance );
		$post_types = ! empty( $this->post_types ) && is_array( $this->post_types ) ? implode( ',', $this->post_types ) : '';
		?>
<!--		<a href="#" class="select-content-button button button-small">--><?php //esc_html_e('Select Content', 'so-widgets-bundle') ?><!--</a>-->
		<div class="existing-content-selector">

			<ul class="posts"></ul>

			<div class="buttons">
				<a href="#" class="button-close button"><?php esc_html_e('Close', 'so-widgets-bundle') ?></a>
			</div>
		</div>
		<div class="url-input-wrapper">
		<?php
	}

	protected function render_after_field( $value, $instance ) {
		?>
		</div>
		<?php
		parent::render_after_field( $value, $instance );
	}

	function enqueue_scripts(){
		wp_enqueue_script( 'so-autocomplete-field', plugin_dir_url( __FILE__ ) . 'js/autocomplete-field' . SOW_BUNDLE_JS_SUFFIX .  '.js', array( 'jquery' ), SOW_BUNDLE_VERSION );
	}
}
