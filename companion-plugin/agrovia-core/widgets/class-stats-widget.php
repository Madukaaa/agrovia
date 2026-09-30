<?php
/**
 * Agrovia Stats / Impact Counters Elementor Widget
 *
 * Displays high-impact metrics (Acres Farmed, Water Savings, Trees Planted, Waste Reduction).
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
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Agrovia_Stats_Widget extends Widget_Base {

	/**
	 * Widget Slug
	 */
	public function get_name() {
		return 'agrovia_stats';
	}

	/**
	 * Widget Title
	 */
	public function get_title() {
		return esc_html__( 'Agrovia Impact Stats', 'agrovia-core' );
	}

	/**
	 * Widget Icon
	 */
	public function get_icon() {
		return 'eicon-counter';
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
		return array( 'stats', 'counter', 'impact', 'numbers', 'agriculture', 'agrovia' );
	}

	/**
	 * Register Widget Controls
	 */
	protected function register_controls() {

		// -------------------------------------------------------------
		// Content: Header (Optional)
		// -------------------------------------------------------------
		$this->start_controls_section(
			'section_header',
			array(
				'label' => esc_html__( 'Section Header', 'agrovia-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'tagline',
			array(
				'label'       => esc_html__( 'Tagline / Badge', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'MEASURABLE IMPACT', 'agrovia-core' ),
				'placeholder' => esc_html__( 'e.g. MEASURABLE IMPACT', 'agrovia-core' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => esc_html__( 'Heading', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Real Environmental Stewardship', 'agrovia-core' ),
				'placeholder' => esc_html__( 'Enter section heading...', 'agrovia-core' ),
			)
		);

		$this->end_controls_section();

		// -------------------------------------------------------------
		// Content: Stats Repeater
		// -------------------------------------------------------------
		$this->start_controls_section(
			'section_stats',
			array(
				'label' => esc_html__( 'Impact Statistics', 'agrovia-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'number',
			array(
				'label'       => esc_html__( 'Metric / Number', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '2,500+',
				'placeholder' => 'e.g. 2,500+ or 42%',
			)
		);

		$repeater->add_control(
			'label',
			array(
				'label'       => esc_html__( 'Metric Label', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'ACRES FARMED', 'agrovia-core' ),
				'placeholder' => esc_html__( 'e.g. ACRES FARMED', 'agrovia-core' ),
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'       => esc_html__( 'Context / Note', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Managed under strict organic and regenerative soil protocols.', 'agrovia-core' ),
				'placeholder' => esc_html__( 'Brief descriptive context...', 'agrovia-core' ),
			)
		);

		$this->add_control(
			'stats_list',
			array(
				'label'       => esc_html__( 'Statistics Items', 'agrovia-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'number'      => '2,500+',
						'label'       => esc_html__( 'ACRES FARMED', 'agrovia-core' ),
						'description' => esc_html__( 'Regenerative land restored to natural biological fertility.', 'agrovia-core' ),
					),
					array(
						'number'      => '42%',
						'label'       => esc_html__( 'LESS WATER USED', 'agrovia-core' ),
						'description' => esc_html__( 'Conserved via automated sub-surface drip sensors.', 'agrovia-core' ),
					),
					array(
						'number'      => '18,000+',
						'label'       => esc_html__( 'TREES PLANTED', 'agrovia-core' ),
						'description' => esc_html__( 'Native agroforestry hedgerows nurturing local pollinators.', 'agrovia-core' ),
					),
					array(
						'number'      => '65%',
						'label'       => esc_html__( 'LESS AGRI WASTE', 'agrovia-core' ),
						'description' => esc_html__( 'Diverted back into on-farm closed-loop composting.', 'agrovia-core' ),
					),
				),
				'title_field' => '{{{ label }}}: {{{ number }}}',
			)
		);

		$this->end_controls_section();

		// -------------------------------------------------------------
		// Style: Grid & Columns
		// -------------------------------------------------------------
		$this->start_controls_section(
			'section_style_grid',
			array(
				'label' => esc_html__( 'Grid Layout', 'agrovia-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'          => esc_html__( 'Columns', 'agrovia-core' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '4',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => array(
					'1' => '1 Column',
					'2' => '2 Columns',
					'3' => '3 Columns',
					'4' => '4 Columns',
				),
				'selectors'      => array(
					'{{WRAPPER}} .agrovia-stats-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				),
			)
		);

		$this->add_responsive_control(
			'gap',
			array(
				'label'      => esc_html__( 'Column Gap', 'agrovia-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 60,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 24,
				),
				'selectors'  => array(
					'{{WRAPPER}} .agrovia-stats-grid' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// -------------------------------------------------------------
		// Style: Item Typography & Colors
		// -------------------------------------------------------------
		$this->start_controls_section(
			'section_style_cards',
			array(
				'label' => esc_html__( 'Card & Typography Style', 'agrovia-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'card_bg',
			array(
				'label'     => esc_html__( 'Card Background Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F8F7F2', // Off white surface.
				'selectors' => array(
					'{{WRAPPER}} .agrovia-stat-item' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'card_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(122, 96, 72, 0.15)',
				'selectors' => array(
					'{{WRAPPER}} .agrovia-stat-item' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'number_heading',
			array(
				'label'     => esc_html__( 'Metric Number', 'agrovia-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'number_color',
			array(
				'label'     => esc_html__( 'Number Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#18392B', // Deep forest green.
				'selectors' => array(
					'{{WRAPPER}} .agrovia-stat-number' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'number_typography',
				'selector' => '{{WRAPPER}} .agrovia-stat-number',
			)
		);

		$this->add_control(
			'label_heading',
			array(
				'label'     => esc_html__( 'Metric Label', 'agrovia-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#7A6048', // Earth brown.
				'selectors' => array(
					'{{WRAPPER}} .agrovia-stat-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} .agrovia-stat-label',
			)
		);

		$this->add_control(
			'desc_color',
			array(
				'label'     => esc_html__( 'Context Description Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#5A5F58',
				'selectors' => array(
					'{{WRAPPER}} .agrovia-stat-desc' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render Widget Output on Frontend
	 */
	protected function render() {
		$settings   = $this->get_settings_for_display();
		$stats_list = ! empty( $settings['stats_list'] ) ? $settings['stats_list'] : array();

		if ( empty( $stats_list ) ) {
			return;
		}

		$tagline = ! empty( $settings['tagline'] ) ? $settings['tagline'] : '';
		$heading = ! empty( $settings['heading'] ) ? $settings['heading'] : '';
		?>
		<section class="agrovia-stats-widget" aria-label="<?php echo esc_attr( ! empty( $heading ) ? $heading : __( 'Impact Statistics', 'agrovia-core' ) ); ?>">
			<div class="agrovia-stats-inner">
				<?php if ( ! empty( $tagline ) || ! empty( $heading ) ) : ?>
					<div class="agrovia-section-header">
						<?php if ( ! empty( $tagline ) ) : ?>
							<span class="agrovia-section-eyebrow"><?php echo esc_html( $tagline ); ?></span>
						<?php endif; ?>
						<?php if ( ! empty( $heading ) ) : ?>
							<h2 class="agrovia-section-title"><?php echo esc_html( $heading ); ?></h2>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="agrovia-stats-grid">
					<?php foreach ( $stats_list as $item ) :
						$number = ! empty( $item['number'] ) ? $item['number'] : '';
						$label  = ! empty( $item['label'] ) ? $item['label'] : '';
						$desc   = ! empty( $item['description'] ) ? $item['description'] : '';
					?>
						<div class="agrovia-stat-item">
							<div class="agrovia-stat-number"><?php echo esc_html( $number ); ?></div>
							<div class="agrovia-stat-label"><?php echo esc_html( $label ); ?></div>
							<?php if ( ! empty( $desc ) ) : ?>
								<p class="agrovia-stat-desc"><?php echo esc_html( $desc ); ?></p>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
