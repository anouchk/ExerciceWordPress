<?php
/**
 * General repeater class
 *
 * @package llorix-one-lite
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Class Llorix_One_Lite_General_Repeater
 */
class Llorix_One_Lite_General_Repeater extends WP_Customize_Control {

	/**
	 * Id
	 *
	 * @var integer $id id
	 */
	public $id;


	/**
	 * Box title
	 *
	 * @var string $boxtitle Box title
	 */
	private $boxtitle = array();

	/**
	 * Add field label
	 *
	 * @var array $add_field_label Field lavel
	 */
	private $add_field_label = array();

	/**
	 * Control for image
	 *
	 * @var bool $llorix_one_lite_image_control Control for image
	 */
	private $llorix_one_lite_image_control = false;

	/**
	 * Control for icon
	 *
	 * @var bool $llorix_one_lite_icon_control Control for icon
	 */
	private $llorix_one_lite_icon_control = false;

	/**
	 * Control for title
	 *
	 * @var bool $llorix_one_lite_title_control Control for title
	 */
	private $llorix_one_lite_title_control = false;

	/**
	 * Control for subtitle
	 *
	 * @var bool $llorix_one_lite_subtitle_control Control for subtitle
	 */
	private $llorix_one_lite_subtitle_control = false;

	/**
	 * Control for text
	 *
	 * @var bool $llorix_one_lite_text_control Control for text
	 */
	private $llorix_one_lite_text_control = false;

	/**
	 * Control for link
	 *
	 * @var bool $llorix_one_lite_link_control Control for link
	 */
	private $llorix_one_lite_link_control = false;

	/**
	 * Control for shortcode
	 *
	 * @var bool $llorix_one_lite_shortcode_control Control for shortcode
	 */
	private $llorix_one_lite_shortcode_control = false;

	/**
	 * Control for repeater
	 *
	 * @var bool $llorix_one_lite_socials_repeater_control Control for repeater
	 */
	private $llorix_one_lite_socials_repeater_control = false;

	/**
	 * Icon container.
	 *
	 * @var string $llorix_one_lite_icon_container Icon container.
	 */
	private $llorix_one_lite_icon_container = '';

	/**
	 * Class constructor
	 *
	 * @param string  $manager Manager.
	 * @param integer $id Id.
	 * @param array   $args Array of parameters.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		/*Get options from customizer.php*/
		$this->add_field_label = esc_html__( 'Add new field', 'llorix-one-lite' );
		if ( ! empty( $args['add_field_label'] ) ) {
			$this->add_field_label = $args['add_field_label'];
		}

		$this->boxtitle   = esc_html__( 'Cusomizer Repeater','llorix-one-lite' );
		if ( ! empty( $args['item_name'] ) ) {
			$this->boxtitle = $args['item_name'];
		} elseif ( ! empty( $this->label ) ) {
			$this->boxtitle = $this->label;
		}

		if ( ! empty( $args['llorix_one_lite_image_control'] ) ) {
			$this->llorix_one_lite_image_control = $args['llorix_one_lite_image_control'];
		}

		if ( ! empty( $args['llorix_one_lite_icon_control'] ) ) {
			$this->llorix_one_lite_icon_control = $args['llorix_one_lite_icon_control'];
		}

		if ( ! empty( $args['llorix_one_lite_title_control'] ) ) {
			$this->llorix_one_lite_title_control = $args['llorix_one_lite_title_control'];
		}

		if ( ! empty( $args['llorix_one_lite_subtitle_control'] ) ) {
			$this->llorix_one_lite_subtitle_control = $args['llorix_one_lite_subtitle_control'];
		}

		if ( ! empty( $args['llorix_one_lite_text_control'] ) ) {
			$this->llorix_one_lite_text_control = $args['llorix_one_lite_text_control'];
		}

		if ( ! empty( $args['llorix_one_lite_link_control'] ) ) {
			$this->llorix_one_lite_link_control = $args['llorix_one_lite_link_control'];
		}

		if ( ! empty( $args['llorix_one_lite_shortcode_control'] ) ) {
			$this->llorix_one_lite_shortcode_control = $args['llorix_one_lite_shortcode_control'];
		}

		if ( ! empty( $args['llorix_one_lite_socials_repeater_control'] ) ) {
			$this->llorix_one_lite_socials_repeater_control = $args['llorix_one_lite_socials_repeater_control'];
		}

		if ( ! empty( $id ) ) {
			$this->id = $id;
		}

		if ( file_exists( get_template_directory() . '/inc/customizer-repeater/inc/icons.php' ) ) {
			$this->llorix_one_lite_icon_container = 'inc/customizer-repeater/inc/icons';
		}
	}

	/**
	 * Enqueue scripts
	 */
	public function enqueue() {

		wp_enqueue_style( 'llorix-one-lite-font-awesome', llorix_one_lite_get_file( '/css/font-awesome.min.css' ),'4.7' );

		wp_enqueue_style( 'llorix-one-lite-admin-stylesheet', llorix_one_lite_get_file( '/inc/customizer-repeater/css/admin-style.css' ),'1.0.0' );

		wp_enqueue_script( 'llorix-one-lite-script', llorix_one_lite_get_file( '/inc/customizer-repeater/js/customizer_repeater.js' ), array( 'jquery', 'jquery-ui-draggable' ), '1.0.1', true );

		wp_enqueue_script( 'llorix-one-lite-fontawesome-iconpicker', llorix_one_lite_get_file( '/inc/customizer-repeater/js/fontawesome-iconpicker.min.js' ), array( 'jquery' ), '1.0.0', true );

		wp_enqueue_style( 'llorix-one-lite-fontawesome-iconpicker-script', llorix_one_lite_get_file( '/inc/customizer-repeater/css/fontawesome-iconpicker.min.css' ) );
	}

	/**
	 * Render function
	 */
	public function render_content() {
		$repeater_content = $this->value();
		$values = array();
		if ( ! empty( $repeater_content ) ) {
			$values = $repeater_content;
		} else {
			if ( ! empty( $this->setting->default ) ) {
				$values = $this->setting->default;
			}
		} ?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<div class="customizer-repeater-general-control-repeater customizer-repeater-general-control-droppable">
			<?php
			if ( ! llorix_one_lite_general_repeater_is_empty( $values ) ) {
				$valuse_decoded = json_decode( $values );

				$this->iterate_array( $valuse_decoded ); ?>
				<input type="hidden"
					   id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php $this->link(); ?>
					   class="customizer-repeater-colector"
					   value="<?php echo esc_textarea( json_encode( $valuse_decoded ) ); ?>"/>
				<?php
			} else {
				$this->iterate_array(); ?>
				<input type="hidden"
					   id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php $this->link(); ?>
					   class="customizer-repeater-colector"/>
				<?php
			} ?>
			</div>
		<button type="button" class="button add_field customizer-repeater-new-field">
			<?php echo esc_html( $this->add_field_label ); ?>
		</button>
		<?php
	}

	/**
	 * Iterate through array to display boxes/
	 *
	 * @param array $array Control input.
	 */
	private function iterate_array( $array = array() ) {
		/*Counter that helps checking if the box is first and should have the delete button disabled*/
		$it = 0;
		if ( ! empty( $array ) ) {
			foreach ( $array as $icon ) { ?>
				<div class="customizer-repeater-general-control-repeater-container customizer-repeater-draggable">
					<div class="customizer-repeater-customize-control-title">
						<?php echo esc_html( $this->boxtitle ) ?>
					</div>
					<div class="customizer-repeater-box-content-hidden">
						<?php
						$choice = '';
						$image_url = '';
						$icon_value = '';
						$title = '';
						$subtitle = '';
						$text = '';
						$link = '';
						$shortcode = '';
						$repeater = '';

						if ( ! empty( $icon->id ) ) {
							$id = $icon->id;
						}
						if ( ! empty( $icon->choice ) ) {
							$choice = $icon->choice;
						}
						if ( ! empty( $icon->image_url ) ) {
							$image_url = $icon->image_url;
						}
						if ( ! empty( $icon->icon_value ) ) {
							$icon_value = $icon->icon_value;
						}
						if ( ! empty( $icon->title ) ) {
							$title = $icon->title;
						}
						if ( ! empty( $icon->subtitle ) ) {
							$subtitle = $icon->subtitle;
						}
						if ( ! empty( $icon->text ) ) {
							$text = $icon->text;
						}
						if ( ! empty( $icon->link ) ) {
							$link = $icon->link;
						}
						if ( ! empty( $icon->shortcode ) ) {
							$shortcode = $icon->shortcode;
						}

						if ( ! empty( $icon->social_repeater ) ) {
							$repeater = $icon->social_repeater;
						}

						if ( $this->llorix_one_lite_image_control == true && $this->llorix_one_lite_icon_control == true ) {
							$this->icon_type_choice( $choice );
						}
						if ( $this->llorix_one_lite_image_control == true ) {
							$this->image_control( $image_url, $choice );
						}
						if ( $this->llorix_one_lite_icon_control == true ) {
							$this->icon_picker_control( $icon_value, $choice );
						}
						if ( $this->llorix_one_lite_title_control == true ) {
							$this->input_control(array(
								'label' => apply_filters( 'repeater_input_labels_filter', esc_html__( 'Title','llorix-one-lite' ), $this->id, 'llorix_one_lite_title_control' ),
								'class' => 'customizer-repeater-title-control',
								'type'  => apply_filters( 'repeater_input_types_filter', '', $this->id, 'llorix_one_lite_title_control' ),
							), $title);
						}
						if ( $this->llorix_one_lite_subtitle_control == true ) {
							$this->input_control(array(
								'label' => apply_filters( 'repeater_input_labels_filter', esc_html__( 'Subtitle','llorix-one-lite' ), $this->id, 'llorix_one_lite_subtitle_control' ),
								'class' => 'customizer-repeater-subtitle-control',
								'type'  => apply_filters( 'repeater_input_types_filter', '', $this->id, 'llorix_one_lite_subtitle_control' ),
							), $subtitle);
						}
						if ( $this->llorix_one_lite_text_control == true ) {
							$this->input_control(array(
								'label' => apply_filters( 'repeater_input_labels_filter', esc_html__( 'Text','llorix-one-lite' ), $this->id, 'llorix_one_lite_text_control' ),
								'class' => 'customizer-repeater-text-control',
								'type'  => apply_filters( 'repeater_input_types_filter', 'textarea', $this->id, 'llorix_one_lite_text_control' ),
							), $text);
						}
						if ( $this->llorix_one_lite_link_control ) {
							$this->input_control(array(
								'label' => apply_filters( 'repeater_input_labels_filter', esc_html__( 'Link','llorix-one-lite' ), $this->id, 'llorix_one_lite_link_control' ),
								'class' => 'customizer-repeater-link-control',
								'sanitize_callback' => 'esc_url_raw',
								'type'  => apply_filters( 'repeater_input_types_filter', '', $this->id, 'llorix_one_lite_link_control' ),
							), $link);
						}
						if ( $this->llorix_one_lite_shortcode_control == true ) {
							$this->input_control(array(
								'label' => apply_filters( 'repeater_input_labels_filter', esc_html__( 'Shortcode','llorix-one-lite' ), $this->id, 'llorix_one_lite_shortcode_control' ),
								'class' => 'customizer-repeater-shortcode-control',
								'type'  => apply_filters( 'repeater_input_types_filter', '', $this->id, 'llorix_one_lite_shortcode_control' ),
							), $shortcode);
						}
						if ( $this->llorix_one_lite_socials_repeater_control == true ) {
							$this->repeater_control( $repeater );
						} ?>

						<input type="hidden" class="social-repeater-box-id" value="<?php if ( ! empty( $id ) ) {
							echo esc_attr( $id );
} ?>">
						<button type="button" class="social-repeater-general-control-remove-field" <?php if ( $it == 0 ) {
							echo 'style="display:none;"';
} ?>>
							<?php esc_html_e( 'Delete field', 'llorix-one-lite' ); ?>
						</button>

					</div>
				</div>

				<?php
				$it++;
			}// End foreach().
		} else { ?>
			<div class="customizer-repeater-general-control-repeater-container">
				<div class="customizer-repeater-customize-control-title">
					<?php echo esc_html( $this->boxtitle ); ?>
				</div>
				<div class="customizer-repeater-box-content-hidden">
					<?php
					if ( $this->llorix_one_lite_image_control == true && $this->llorix_one_lite_icon_control == true ) {
						$this->icon_type_choice();
					}
					if ( $this->llorix_one_lite_image_control == true ) {
						$this->image_control();
					}
					if ( $this->llorix_one_lite_icon_control == true ) {
						$this->icon_picker_control();
					}
					if ( $this->llorix_one_lite_title_control == true ) {
						$this->input_control( array(
							'label' => apply_filters( 'repeater_input_labels_filter', esc_html__( 'Title','llorix-one-lite' ), $this->id, 'llorix_one_lite_title_control' ),
							'class' => 'customizer-repeater-title-control',
							'type'  => apply_filters( 'repeater_input_types_filter', '', $this->id, 'llorix_one_lite_title_control' ),
						) );
					}
					if ( $this->llorix_one_lite_subtitle_control == true ) {
						$this->input_control( array(
							'label' => apply_filters( 'repeater_input_labels_filter', esc_html__( 'Subtitle','llorix-one-lite' ), $this->id, 'llorix_one_lite_subtitle_control' ),
							'class' => 'customizer-repeater-subtitle-control',
							'type'  => apply_filters( 'repeater_input_types_filter', '', $this->id, 'llorix_one_lite_subtitle_control' ),
						) );
					}
					if ( $this->llorix_one_lite_text_control == true ) {
						$this->input_control( array(
							'label' => apply_filters( 'repeater_input_labels_filter', esc_html__( 'Text','llorix-one-lite' ), $this->id, 'llorix_one_lite_text_control' ),
							'class' => 'customizer-repeater-text-control',
							'type'  => apply_filters( 'repeater_input_types_filter', 'textarea', $this->id, 'llorix_one_lite_text_control' ),
						) );
					}
					if ( $this->llorix_one_lite_link_control == true ) {
						$this->input_control( array(
							'label' => apply_filters( 'repeater_input_labels_filter', esc_html__( 'Link','llorix-one-lite' ), $this->id, 'llorix_one_lite_link_control' ),
							'class' => 'customizer-repeater-link-control',
							'type'  => apply_filters( 'repeater_input_types_filter', '', $this->id, 'llorix_one_lite_link_control' ),
						) );
					}
					if ( $this->llorix_one_lite_shortcode_control == true ) {
						$this->input_control( array(
							'label' => apply_filters( 'repeater_input_labels_filter', esc_html__( 'Shortcode','llorix-one-lite' ), $this->id, 'llorix_one_lite_shortcode_control' ),
							'class' => 'customizer-repeater-shortcode-control',
							'type'  => apply_filters( 'repeater_input_types_filter', '', $this->id, 'llorix_one_lite_shortcode_control' ),
						) );
					}
					if ( $this->llorix_one_lite_socials_repeater_control == true ) {
						$this->repeater_control();
					} ?>
					<input type="hidden" class="social-repeater-box-id">
					<button type="button" class="social-repeater-general-control-remove-field button" style="display:none;">
						<?php esc_html_e( 'Delete field', 'llorix-one-lite' ); ?>
					</button>
				</div>
			</div>
			<?php
		}// End if().
	}

	/**
	 * Function to display inputs
	 *
	 * @param array  $options Input options.
	 * @param string $value Input value.
	 */
	private function input_control( $options, $value = '' ) {
	?>
		<span class="customize-control-title"><?php echo esc_html( $options['label'] ); ?></span>
		<?php
		if ( ! empty( $options['type'] ) ) {
			switch ( $options['type'] ) {
				case 'textarea':?>
					<textarea class="<?php echo esc_attr( $options['class'] ); ?>" placeholder="<?php echo esc_attr( $options['label'] ); ?>"><?php echo ( ! empty( $options['sanitize_callback'] ) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr( $value ) ); ?></textarea>
					<?php
					break;
			}
		} else { ?>
			<input type="text" value="<?php echo ( ! empty( $options['sanitize_callback'] ) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr( $value ) ); ?>" class="<?php echo esc_attr( $options['class'] ); ?>" placeholder="<?php echo esc_attr( $options['label'] ); ?>"/>
			<?php
		}
	}

	/**
	 * Function to display iconpicker.
	 *
	 * @param string $value Input value.
	 * @param string $show Show or hide this input.
	 */
	private function icon_picker_control( $value = '', $show = '' ) {
	?>
		<div class="social-repeater-general-control-icon" <?php if ( $show === 'llorix_one_lite_image' || $show === 'llorix_one_lite_none' ) { echo 'style="display:none;"'; } ?>>
			<span class="customize-control-title">
				<?php esc_html_e( 'Icon','llorix-one-lite' ); ?>
			</span>
			<span class="description customize-control-description">
				<?php
				/* translators: %s is link to FontAwesome */
				printf( esc_html__( 'Note: Some icons may not be displayed here. You can see the full list of icons at %s', 'llorix-one-lite' ),
	                /* translators: %s is link label*/
					sprintf( '<a href="http://fontawesome.io/icons/" rel="nofollow">%s</a>',
						esc_html__( 'FontAwesome', 'llorix-one-lite' )
					)
				); ?>
			</span>
			<div class="input-group icp-container">
				<input data-placement="bottomRight" class="icp icp-auto" value="<?php if ( ! empty( $value ) ) { echo esc_attr( $value );} ?>" type="text">
				<span class="input-group-addon">
					<i class="fa <?php echo esc_attr( $value ); ?>"></i>
				</span>
			</div>
			<?php get_template_part( $this->llorix_one_lite_icon_container ); ?>
		</div>
		<?php
	}

	/**
	 * Input control for images
	 *
	 * @param string $value Input value.
	 * @param string $show Display image control.
	 */
	private function image_control( $value = '', $show = '' ) {
	?>
		<div class="customizer-repeater-image-control" <?php if ( $show === 'llorix_one_lite_icon' || $show === 'llorix_one_lite_none' ) { echo 'style="display:none;"'; } ?>>
			<span class="customize-control-title">
				<?php esc_html_e( 'Image','llorix-one-lite' )?>
			</span>
			<input type="text" class="widefat custom-media-url" value="<?php echo esc_attr( $value ); ?>">
			<input type="button" class="button button-secondary customizer-repeater-custom-media-button" value="<?php esc_attr_e( 'Upload Image','llorix-one-lite' ); ?>" />
		</div>
		<?php
	}

	/**
	 * If both image and icon controls are enabled display a dropdown to chose between
	 * those two
	 *
	 * @param string $value Dropdown value.
	 */
	private function icon_type_choice( $value = 'llorix_one_lite_icon' ) {
	?>
		<span class="customize-control-title">
			<?php esc_html_e( 'Image type','llorix-one-lite' );?>
		</span>
		<select class="customizer-repeater-image-choice">
			<option value="llorix_one_lite_icon" <?php selected( $value,'llorix_one_lite_icon' );?>><?php esc_html_e( 'Icon','llorix-one-lite' ); ?></option>
			<option value="llorix_one_lite_image" <?php selected( $value,'llorix_one_lite_image' );?>><?php esc_html_e( 'Image','llorix-one-lite' ); ?></option>
			<option value="llorix_one_lite_none" <?php selected( $value,'llorix_one_lite_none' );?>><?php esc_html_e( 'None','llorix-one-lite' ); ?></option>
		</select>
		<?php
	}

	/**
	 * Function to display social repeater control.
	 *
	 * @param string $value Input value.
	 */
	private function repeater_control( $value = '' ) {
		$social_repeater = array();
		$show_del        = 0; ?>
		<span class="customize-control-title"><?php esc_html_e( 'Social icons', 'llorix-one-lite' ); ?></span>
		<?php
		if ( ! empty( $value ) ) {
			$social_repeater = json_decode( html_entity_decode( $value ), true );
		}
		if ( ( count( $social_repeater ) == 1 && '' === $social_repeater[0] ) || empty( $social_repeater ) ) { ?>
			<div class="customizer-repeater-social-repeater">
				<div class="customizer-repeater-social-repeater-container">
					<div class="customizer-repeater-rc input-group icp-container">
						<input data-placement="bottomRight" class="icp icp-auto" value="<?php if ( ! empty( $value ) ) { echo esc_attr( $value ); } ?>" type="text">
						<span class="input-group-addon"></span>
					</div>
					<?php get_template_part( $this->llorix_one_lite_icon_container ); ?>
					<input type="text" class="customizer-repeater-social-repeater-link"
					       placeholder="<?php esc_attr_e( 'Link', 'llorix-one-lite' ); ?>">
					<input type="hidden" class="customizer-repeater-social-repeater-id" value="">
					<button class="social-repeater-remove-social-item" style="display:none">
						<?php esc_html_e( 'Remove Icon', 'llorix-one-lite' ); ?>
					</button>
				</div>
				<input type="hidden" id="social-repeater-socials-repeater-colector" class="social-repeater-socials-repeater-colector" value=""/>
			</div>
			<button class="social-repeater-add-social-item button-secondary"><?php esc_html_e( 'Add icon', 'llorix-one-lite' ); ?></button>
			<?php
		} else { ?>
			<div class="customizer-repeater-social-repeater">
				<?php
				foreach ( $social_repeater as $social_icon ) {
					$show_del ++; ?>
					<div class="customizer-repeater-social-repeater-container">
						<div class="customizer-repeater-rc input-group icp-container">
							<input data-placement="bottomRight" class="icp icp-auto" value="<?php if ( ! empty( $social_icon['icon'] ) ) { echo esc_attr( $social_icon['icon'] ); } ?>" type="text">
							<span class="input-group-addon"><i class="fa <?php echo esc_attr( $social_icon['icon'] ); ?>"></i></span>
						</div>
						<?php get_template_part( $this->llorix_one_lite_icon_container ); ?>
						<input type="text" class="customizer-repeater-social-repeater-link"
						       placeholder="<?php esc_html_e( 'Link', 'llorix-one-lite' ); ?>"
						       value="<?php if ( ! empty( $social_icon['link'] ) ) {
									echo esc_url( $social_icon['link'] );
} ?>">
						<input type="hidden" class="customizer-repeater-social-repeater-id"
						       value="<?php if ( ! empty( $social_icon['id'] ) ) {
									echo esc_attr( $social_icon['id'] );
} ?>">
						<button class="social-repeater-remove-social-item"
						        style="<?php if ( $show_del == 1 ) {
							        echo 'display:none';
} ?>"><?php esc_html_e( 'Remove Icon', 'llorix-one-lite' ); ?></button>
					</div>
					<?php
				} ?>
				<input type="hidden" id="social-repeater-socials-repeater-colector"
				       class="social-repeater-socials-repeater-colector"
				       value="<?php echo esc_textarea( html_entity_decode( $value ) ); ?>" />
			</div>
			<button class="social-repeater-add-social-item button-secondary"><?php esc_html_e( 'Add icon', 'llorix-one-lite' ); ?></button>
			<?php
		}// End if().
	}
}
