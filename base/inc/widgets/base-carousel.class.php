<?php

abstract class SiteOrigin_Widget_Base_Carousel extends SiteOrigin_Widget {

	/**
	 * Register all the frontend scripts and styles for the base carousel.
	 */
	function initialize() {
		$this->register_frontend_scripts(
			array(
				array(
					'slick',
					plugin_dir_url( SOW_BUNDLE_BASE_FILE ) . 'js/lib/slick' . SOW_BUNDLE_JS_SUFFIX . '.js',
					array( 'jquery' ),
					'1.8.1'
				),
				array(
					'sow-carousel',
					plugin_dir_url( SOW_BUNDLE_BASE_FILE ) . 'js/carousel' . SOW_BUNDLE_JS_SUFFIX . '.js',
					array( 'jquery', 'slick' ),
					SOW_BUNDLE_VERSION,
					true
				),
			)
		);

		$this->register_frontend_styles(
			array(
				array(
					'slick',
					plugin_dir_url( SOW_BUNDLE_BASE_FILE ) . 'css/lib/slick.css',
					array(),
					'1.8.1'
				),
				array(
					'sow-carousel',
					plugin_dir_url( SOW_BUNDLE_BASE_FILE ) . 'css/carousel/style.css',
				),
			)
		);

	}

	function get_breakpoints() {
		return apply_filters(
			'siteorigin_widgets_carousel_breakpoints',
			array(
				'tablet_landscape' => 1366,
				'tablet_portrait'  => 1025,
				'mobile'           => 480,
			)
		);
	}

	function responsive_form_fields() {
		$breakpoints = $this->get_breakpoints();

		return array(
			'type' => 'section',
			'label' => __( 'Responsive', 'so-widgets-bundle' ),
			'hide' => true,
			'fields' => array(
				'desktop' => array(
					'type' => 'section',
					'label' => __( 'Desktop', 'so-widgets-bundle' ),
					'hide' => true,
					'fields' => array(
						'slides_to_scroll' => array(
							'type' => 'number',
							'label' => __( 'Slides to scroll', 'so-widgets-bundle' ),
							'description' => __( 'Set the number of slides to scroll per navigation click or swipe on desktop.', 'so-widgets-bundle' ),
							'default' => 1,
						),
					),
				),
				'tablet' => array(
					'type' => 'section',
					'label' => __( 'Tablet', 'so-widgets-bundle' ),
					'hide' => true,
					'fields' => array(
						'landscape' => array(
							'type' => 'section',
							'label' => __( 'Landscape', 'so-widgets-bundle' ),
							'hide' => true,
							'fields' => array(
								'breakpoint' => array(
									'type' => 'number',
									'label' => __( 'Breakpoint', 'so-widgets-bundle' ),
									'default' => $breakpoints['tablet_landscape'],
								),
								'slides_to_scroll' => array(
									'type' => 'number',
									'label' => __( 'Slides to scroll', 'so-widgets-bundle' ),
									'description' => __( 'Set the number of slides to scroll per navigation click or swipe on tablet devices.', 'so-widgets-bundle' ),
									'default' => 2,
								),
							),
						),
						'portrait' => array(
							'type' => 'section',
							'label' => __( 'Portrait', 'so-widgets-bundle' ),
							'hide' => true,
							'fields' => array(
								'breakpoint' => array(
									'type' => 'number',
									'label' => __( 'Breakpoint', 'so-widgets-bundle' ),
									'default' => $breakpoints['tablet_portrait'],
								),
								'slides_to_scroll' => array(
									'type' => 'number',
									'label' => __( 'Slides to scroll', 'so-widgets-bundle' ),
									'description' => __( 'Set the number of slides to scroll per navigation click or swipe on tablet devices.', 'so-widgets-bundle' ),
									'default' => 2,
								),
							),
						),
					),
				),
				'mobile' => array(
					'type' => 'section',
					'label' => __( 'Mobile', 'so-widgets-bundle' ),
					'hide' => true,
					'fields' => array(
						'breakpoint' => array(
							'type' => 'number',
							'label' => __( 'Breakpoint', 'so-widgets-bundle' ),
							'default' => $breakpoints['mobile'],
						),
						'slides_to_scroll' => array(
							'type' => 'number',
							'label' => __( 'Slides to scroll', 'so-widgets-bundle' ),
							'description' => __( ' Set the number of slides to scroll per navigation click or swipe on mobile devices.', 'so-widgets-bundle' ),
							'default' => 1,
						),
					),
				),
			),
		);
	}

	function responsive_template_variables( $responsive, $encode = true ) {
		$responsive = array(
			'desktop_slides' => ! empty ( $responsive['desktop']['slides_to_scroll'] ) ? $responsive['desktop']['slides_to_scroll'] : 1,
			'tablet_portrait_slides' => ! empty ( $responsive['tablet']['portrait']['slides_to_scroll'] ) ? $responsive['tablet']['portrait']['slides_to_scroll'] : 2,
			'tablet_portrait_breakpoint' => ! empty ( $responsive['tablet']['portrait']['breakpoint'] ) ? $responsive['tablet']['portrait']['breakpoint'] : $breakpoints['tablet_portrait'],
			'tablet_landscape_slides' => ! empty ( $responsive['tablet']['landscape']['slides_to_scroll'] ) ? $responsive['tablet']['landscape']['slides_to_scroll'] : 2,
			'tablet_landscape_breakpoint' => ! empty ( $responsive['tablet']['landscape']['breakpoint'] ) ? $responsive['tablet']['landscape']['breakpoint'] : $breakpoints['tablet_landscape'],
			'mobile_breakpoint' => ! empty ( $responsive['mobile']['breakpoint'] ) ? $responsive['mobile']['breakpoint'] : $breakpoints['mobile'],
			'mobile_slides' => ! empty ( $responsive['mobile']['slides_to_scroll'] ) ? $responsive['mobile']['slides_to_scroll'] : 1,
		);

		return $encode ? json_encode( $responsive ) : $responsive;
	}

	function render_template( $settings ) {
		include plugin_dir_path( __FILE__ ) . 'tpl/carousel.php';
	}

}
