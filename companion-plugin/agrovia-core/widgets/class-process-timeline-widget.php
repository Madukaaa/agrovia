<?php
/**
 * Agrovia Process Timeline Elementor Widget
 *
 * Visualizes the closed-loop agricultural cycle from Soil to Harvest and Restoration.
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

class Agrovia_Process_Timeline_Widget extends Widget_Base {

	/**
	 * Widget Slug
	 */
	public function get_name() {
		return 'agrovia_process_timeline';
	}

	/**
	 * Widget Title
	 */
	public function get_title() {
		return esc_html__( 'Agrovia Process Timeline', 'agrovia-core' );
	}

	/**
	 * Widget Icon
	 */
	public function get_icon() {
		return 'eicon-time-line';
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
		return array( 'process', 'timeline', 'cycle', 'soil', 'harvest', 'steps', 'agrovia' );
	}

	/**
	 * Register Widget Controls
	 */
	protected function register_controls() {

		// -------------------------------------------------------------
		// Content: Section Header
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
				'label'       => esc_html__( 'Tagline / Eyebrow', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'THE GROWING CYCLE', 'agrovia-core' ),
				'placeholder' => esc_html__( 'e.g. THE GROWING CYCLE', 'agrovia-core' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => esc_html__( 'Section Heading', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'From Soil to Harvest', 'agrovia-core' ),
				'placeholder' => esc_html__( 'Enter heading...', 'agrovia-core' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => esc_html__( 'Section Description', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Farming is an interconnected biological loop. Every stage is calibrated to nourish human life while rejuvenating the earth.', 'agrovia-core' ),
			)
		);

		$this->end_controls_section();

		// -------------------------------------------------------------
		// Content: Steps Repeater
		// -------------------------------------------------------------
		$this->start_controls_section(
			'section_steps',
			array(
				'label' => esc_html__( 'Timeline Steps', 'agrovia-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'step_number',
			array(
				'label'   => esc_html__( 'Step Number', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$repeater->add_control(
			'step_stage',
			array(
				'label'   => esc_html__( 'Stage Badge', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'SOIL', 'agrovia-core' ),
			)
		);

		$repeater->add_control(
			'step_title',
			array(
				'label'   => esc_html__( 'Step Title', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Healthy Soil', 'agrovia-core' ),
			)
		);

		$repeater->add_control(
			'step_desc',
			array(
				'label'   => esc_html__( 'Step Description', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Healthy crops begin beneath the surface. We use composting, cover cropping, and no-till practices to preserve microbial life.', 'agrovia-core' ),
			)
		);

		$this->add_control(
			'steps_list',
			array(
				'label'       => esc_html__( 'Steps', 'agrovia-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'step_number' => '01',
						'step_stage'  => esc_html__( 'SOIL', 'agrovia-core' ),
						'step_title'  => esc_html__( 'Healthy Soil', 'agrovia-core' ),
						'step_desc'   => esc_html__( 'Healthy crops begin beneath the surface. We use rich compost, cover crops, and microbial feeding to maintain fertile living earth.', 'agrovia-core' ),
					),
					array(
						'step_number' => '02',
						'step_stage'  => esc_html__( 'PLANT', 'agrovia-core' ),
						'step_title'  => esc_html__( 'Precision Sowing', 'agrovia-core' ),
						'step_desc'   => esc_html__( 'Non-GMO heritage varieties are selected and sown based on microclimate sensors, soil moisture data, and seasonal sunlight.', 'agrovia-core' ),
					),
					array(
						'step_number' => '03',
						'step_stage'  => esc_html__( 'GROW', 'agrovia-core' ),
						'step_title'  => esc_html__( 'Ecological Growth', 'agrovia-core' ),
						'step_desc'   => esc_html__( 'Solar-powered drip irrigation delivers calibrated hydration directly to plant root zones without runoff or waste.', 'agrovia-core' ),
					),
					array(
						'step_number' => '04',
						'step_stage'  => esc_html__( 'HARVEST', 'agrovia-core' ),
						'step_title'  => esc_html__( 'Gentle Harvest', 'agrovia-core' ),
						'step_desc'   => esc_html__( 'Crops are hand-harvested at peak nutritional ripeness in the early morning dew to preserve flavor and freshness.', 'agrovia-core' ),
					),
					array(
						'step_number' => '05',
						'step_stage'  => esc_html__( 'RESTORE', 'agrovia-core' ),
						'step_title'  => esc_html__( 'Closed-Loop Renewal', 'agrovia-core' ),
						'step_desc'   => esc_html__( 'Harvest residues are returned to on-farm composting beds, recharging soil nutrients for the next growing season.', 'agrovia-core' ),
					),
				),
				'title_field' => '{{{ step_number }}} — {{{ step_stage }}}: {{{ step_title }}}',
			)
		);

		$this->end_controls_section();

		// -------------------------------------------------------------
		// Style: Step Styling
		// -------------------------------------------------------------
		$this->start_controls_section(
			'section_style_steps',
			array(
				'label' => esc_html__( 'Step Aesthetics', 'agrovia-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'step_badge_bg',
			array(
				'label'     => esc_html__( 'Stage Badge Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2C4A36', // Dark moss.
				'selectors' => array(
					'{{WRAPPER}} .agrovia-step-badge' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'step_number_color',
			array(
				'label'     => esc_html__( 'Number Accent Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#7A6048', // Earth brown.
				'selectors' => array(
					'{{WRAPPER}} .agrovia-step-number' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'step_title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#18392B',
				'selectors' => array(
					'{{WRAPPER}} .agrovia-step-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .agrovia-step-title',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render Widget Output on Frontend
	 */
	protected function render() {
		$settings   = $this->get_settings_for_display();
		$steps_list = ! empty( $settings['steps_list'] ) ? $settings['steps_list'] : array();

		if ( empty( $steps_list ) ) {
			return;
		}

		$tagline     = ! empty( $settings['tagline'] ) ? $settings['tagline'] : '';
		$heading     = ! empty( $settings['heading'] ) ? $settings['heading'] : '';
		$description = ! empty( $settings['description'] ) ? $settings['description'] : '';
		?>
		<section class="agrovia-process-widget" aria-label="<?php echo esc_attr( ! empty( $heading ) ? $heading : __( 'Agricultural Process', 'agrovia-core' ) ); ?>">
			<div class="agrovia-process-inner">
				<?php if ( ! empty( $tagline ) || ! empty( $heading ) || ! empty( $description ) ) : ?>
					<div class="agrovia-section-header">
						<?php if ( ! empty( $tagline ) ) : ?>
							<span class="agrovia-section-eyebrow"><?php echo esc_html( $tagline ); ?></span>
						<?php endif; ?>
						<?php if ( ! empty( $heading ) ) : ?>
							<h2 class="agrovia-section-title"><?php echo esc_html( $heading ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $description ) ) : ?>
							<p class="agrovia-section-desc"><?php echo esc_html( $description ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="agrovia-timeline-track">
					<div class="agrovia-timeline-line" aria-hidden="true"></div>

					<div class="agrovia-timeline-steps">
						<?php foreach ( $steps_list as $step ) :
							$num   = ! empty( $step['step_number'] ) ? $step['step_number'] : '';
							$stage = ! empty( $step['step_stage'] ) ? $step['step_stage'] : '';
							$title = ! empty( $step['step_title'] ) ? $step['step_title'] : '';
							$desc  = ! empty( $step['step_desc'] ) ? $step['step_desc'] : '';
						?>
							<div class="agrovia-timeline-step">
								<div class="agrovia-step-marker">
									<span class="agrovia-step-number"><?php echo esc_html( $num ); ?></span>
									<span class="agrovia-step-badge"><?php echo esc_html( $stage ); ?></span>
								</div>
								<div class="agrovia-step-card">
									<?php if ( ! empty( $title ) ) : ?>
										<h3 class="agrovia-step-title"><?php echo esc_html( $title ); ?></h3>
									<?php endif; ?>
									<?php if ( ! empty( $desc ) ) : ?>
										<p class="agrovia-step-desc"><?php echo esc_html( $desc ); ?></p>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
