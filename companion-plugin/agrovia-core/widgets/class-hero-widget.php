<?php
/**
 * Agrovia Hero Elementor Widget
 *
 * Cinematic agricultural hero with badge, dual CTA buttons, and responsive media support.
 *
 * @package AgroviaCore
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
	return;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

class Agrovia_Hero_Widget extends Widget_Base {

	/**
	 * Widget Slug
	 */
	public function get_name() {
		return 'agrovia_hero';
	}

	/**
	 * Widget Title
	 */
	public function get_title() {
		return esc_html__( 'Agrovia Hero', 'agrovia-core' );
	}

	/**
	 * Widget Icon
	 */
	public function get_icon() {
		return 'eicon-header';
	}

	/**
	 * Widget Category
	 */
	public function get_categories() {
		return array( 'agrovia-elements' );
	}

	/**
	 * Search Keywords
	 */
	public function get_keywords() {
		return array( 'hero', 'banner', 'agriculture', 'cta', 'agrovia', 'header' );
	}

	/**
	 * Register Widget Controls
	 */
	protected function register_controls() {

		// -------------------------------------------------------------
		// Content: Hero Content Section
		// -------------------------------------------------------------
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Hero Content', 'agrovia-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'badge_text',
			array(
				'label'       => esc_html__( 'Badge / Tagline', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '100% REGENERATIVE AGRICULTURE', 'agrovia-core' ),
				'placeholder' => esc_html__( 'e.g. 100% REGENERATIVE AGRICULTURE', 'agrovia-core' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Main Heading', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Growing food.\nRestoring nature.",
				'placeholder' => esc_html__( 'Enter your hero headline...', 'agrovia-core' ),
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'   => esc_html__( 'Heading HTML Tag', 'agrovia-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'div'  => 'div',
				),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => esc_html__( 'Supporting Text', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'We grow better food through farming practices that work with nature, not against it.', 'agrovia-core' ),
				'placeholder' => esc_html__( 'Enter brief description...', 'agrovia-core' ),
			)
		);

		$this->end_controls_section();

		// -------------------------------------------------------------
		// Content: Call To Actions
		// -------------------------------------------------------------
		$this->start_controls_section(
			'section_cta',
			array(
				'label' => esc_html__( 'Call To Action Buttons', 'agrovia-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_primary_btn',
			array(
				'label'        => esc_html__( 'Show Primary Button', 'agrovia-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'primary_btn_text',
			array(
				'label'     => esc_html__( 'Primary Button Text', 'agrovia-core' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Explore Our Farm', 'agrovia-core' ),
				'condition' => array(
					'show_primary_btn' => 'yes',
				),
			)
		);

		$this->add_control(
			'primary_btn_link',
			array(
				'label'       => esc_html__( 'Primary Button Link', 'agrovia-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com/farm',
				'default'     => array(
					'url' => '#',
				),
				'condition'   => array(
					'show_primary_btn' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_secondary_btn',
			array(
				'label'        => esc_html__( 'Show Secondary Button', 'agrovia-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'secondary_btn_text',
			array(
				'label'     => esc_html__( 'Secondary Button Text', 'agrovia-core' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Our Sustainability', 'agrovia-core' ),
				'condition' => array(
					'show_secondary_btn' => 'yes',
				),
			)
		);

		$this->add_control(
			'secondary_btn_link',
			array(
				'label'       => esc_html__( 'Secondary Button Link', 'agrovia-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com/sustainability',
				'default'     => array(
					'url' => '#',
				),
				'condition'   => array(
					'show_secondary_btn' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		// -------------------------------------------------------------
		// Style: Layout & Height
		// -------------------------------------------------------------
		$this->start_controls_section(
			'section_style_layout',
			array(
				'label' => esc_html__( 'Layout & Background', 'agrovia-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'min_height',
			array(
				'label'      => esc_html__( 'Minimum Height', 'agrovia-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh', 'em' ),
				'range'      => array(
					'px' => array(
						'min' => 400,
						'max' => 1200,
					),
					'vh' => array(
						'min' => 40,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'vh',
					'size' => 90,
				),
				'selectors'  => array(
					'{{WRAPPER}} .agrovia-hero-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_align',
			array(
				'label'     => esc_html__( 'Content Alignment', 'agrovia-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'agrovia-core' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'agrovia-core' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'agrovia-core' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'left',
				'selectors' => array(
					'{{WRAPPER}} .agrovia-hero-content' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .agrovia-hero-buttons' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'hero_background',
				'label'    => esc_html__( 'Background', 'agrovia-core' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .agrovia-hero-wrapper',
			)
		);

		$this->add_control(
			'overlay_color',
			array(
				'label'     => esc_html__( 'Dark Overlay Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(24, 57, 43, 0.45)', // Deep forest overlay.
				'selectors' => array(
					'{{WRAPPER}} .agrovia-hero-overlay' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		// -------------------------------------------------------------
		// Style: Typography & Colors
		// -------------------------------------------------------------
		$this->start_controls_section(
			'section_style_typography',
			array(
				'label' => esc_html__( 'Typography & Colors', 'agrovia-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'badge_heading',
			array(
				'label'     => esc_html__( 'Badge / Tagline', 'agrovia-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'badge_color',
			array(
				'label'     => esc_html__( 'Badge Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F3EEDF', // Warm cream.
				'selectors' => array(
					'{{WRAPPER}} .agrovia-hero-badge' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_heading',
			array(
				'label'     => esc_html__( 'Title', 'agrovia-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .agrovia-hero-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .agrovia-hero-title',
			)
		);

		$this->add_control(
			'desc_heading',
			array(
				'label'     => esc_html__( 'Description', 'agrovia-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => esc_html__( 'Description Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F8F7F2',
				'selectors' => array(
					'{{WRAPPER}} .agrovia-hero-description' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'selector' => '{{WRAPPER}} .agrovia-hero-description',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render Widget Output on the Frontend
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$badge_text = ! empty( $settings['badge_text'] ) ? $settings['badge_text'] : '';
		$title      = ! empty( $settings['title'] ) ? $settings['title'] : '';
		$title_tag  = ! empty( $settings['title_tag'] ) ? tag_escape( $settings['title_tag'] ) : 'h1';
		$desc       = ! empty( $settings['description'] ) ? $settings['description'] : '';

		// Format multiline titles with line breaks.
		$title_formatted = nl2br( esc_html( $title ) );
		?>
		<section class="agrovia-hero-widget" aria-label="<?php echo esc_attr( wp_strip_all_tags( $title ) ); ?>">
			<div class="agrovia-hero-wrapper">
				<div class="agrovia-hero-overlay" aria-hidden="true"></div>
				<div class="agrovia-hero-container">
					<div class="agrovia-hero-content">
						<?php if ( ! empty( $badge_text ) ) : ?>
							<span class="agrovia-hero-badge">
								<?php echo esc_html( $badge_text ); ?>
							</span>
						<?php endif; ?>

						<?php if ( ! empty( $title ) ) : ?>
							<<?php echo esc_html( $title_tag ); ?> class="agrovia-hero-title">
								<?php echo wp_kses_post( $title_formatted ); ?>
							</<?php echo esc_html( $title_tag ); ?>>
						<?php endif; ?>

						<?php if ( ! empty( $desc ) ) : ?>
							<p class="agrovia-hero-description">
								<?php echo esc_html( $desc ); ?>
							</p>
						<?php endif; ?>

						<?php if ( 'yes' === $settings['show_primary_btn'] || 'yes' === $settings['show_secondary_btn'] ) : ?>
							<div class="agrovia-hero-buttons">
								<?php if ( 'yes' === $settings['show_primary_btn'] && ! empty( $settings['primary_btn_text'] ) ) :
									$p_url = ! empty( $settings['primary_btn_link']['url'] ) ? $settings['primary_btn_link']['url'] : '#';
									$p_external = ! empty( $settings['primary_btn_link']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
									$p_nofollow = ! empty( $settings['primary_btn_link']['nofollow'] ) ? ' rel="nofollow"' : '';
								?>
									<a href="<?php echo esc_url( $p_url ); ?>" class="agrovia-btn agrovia-btn-primary"<?php echo $p_external . $p_nofollow; ?>>
										<?php echo esc_html( $settings['primary_btn_text'] ); ?>
										<span class="agrovia-btn-arrow" aria-hidden="true">&rarr;</span>
									</a>
								<?php endif; ?>

								<?php if ( 'yes' === $settings['show_secondary_btn'] && ! empty( $settings['secondary_btn_text'] ) ) :
									$s_url = ! empty( $settings['secondary_btn_link']['url'] ) ? $settings['secondary_btn_link']['url'] : '#';
									$s_external = ! empty( $settings['secondary_btn_link']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
									$s_nofollow = ! empty( $settings['secondary_btn_link']['nofollow'] ) ? ' rel="nofollow"' : '';
								?>
									<a href="<?php echo esc_url( $s_url ); ?>" class="agrovia-btn agrovia-btn-outline"<?php echo $s_external . $s_nofollow; ?>>
										<?php echo esc_html( $settings['secondary_btn_text'] ); ?>
									</a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
