<?php
/**
 * Agrovia Team & Farmers Elementor Widget
 *
 * Displays farmer and specialist profiles with dual source capability:
 * dynamic query from `agrovia_team` CPT or custom manual repeater.
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
use Elementor\Group_Control_Box_Shadow;

class Agrovia_Team_Widget extends Widget_Base {

	/**
	 * Widget Slug
	 */
	public function get_name() {
		return 'agrovia_team';
	}

	/**
	 * Widget Title
	 */
	public function get_title() {
		return esc_html__( 'Agrovia Farmers & Team', 'agrovia-core' );
	}

	/**
	 * Widget Icon
	 */
	public function get_icon() {
		return 'eicon-person';
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
		return array( 'team', 'farmers', 'people', 'agronomist', 'profiles', 'agrovia' );
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
				'default'     => esc_html__( 'THE GROWERS & STEWARDS', 'agrovia-core' ),
				'placeholder' => esc_html__( 'e.g. THE GROWERS & STEWARDS', 'agrovia-core' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => esc_html__( 'Section Heading', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'People make sustainable agriculture possible.', 'agrovia-core' ),
				'placeholder' => esc_html__( 'Enter heading...', 'agrovia-core' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => esc_html__( 'Section Description', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Behind every harvest is a dedicated team of agronomists, soil biologists, and growers committed to regenerative stewardship.', 'agrovia-core' ),
			)
		);

		$this->end_controls_section();

		// -------------------------------------------------------------
		// Content: Data Source
		// -------------------------------------------------------------
		$this->start_controls_section(
			'section_data_source',
			array(
				'label' => esc_html__( 'Profiles Source', 'agrovia-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'data_source',
			array(
				'label'   => esc_html__( 'Source Type', 'agrovia-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'manual',
				'options' => array(
					'manual'  => esc_html__( 'Custom Repeater', 'agrovia-core' ),
					'dynamic' => esc_html__( 'Dynamic Query (agrovia_team CPT)', 'agrovia-core' ),
				),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'     => esc_html__( 'Number of Members', 'agrovia-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 4,
				'min'       => 1,
				'max'       => 12,
				'step'      => 1,
				'condition' => array(
					'data_source' => 'dynamic',
				),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'name',
			array(
				'label'   => esc_html__( 'Member Name', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Kasun Perera',
			)
		);

		$repeater->add_control(
			'role',
			array(
				'label'   => esc_html__( 'Role / Title', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Lead Crop Manager', 'agrovia-core' ),
			)
		);

		$repeater->add_control(
			'department',
			array(
				'label'   => esc_html__( 'Department', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Field Agronomy', 'agrovia-core' ),
			)
		);

		$repeater->add_control(
			'bio',
			array(
				'label'   => esc_html__( 'Short Bio', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Specializes in heritage grain varieties, crop rotation sequences, and natural pest suppression.', 'agrovia-core' ),
			)
		);

		$repeater->add_control(
			'photo',
			array(
				'label'   => esc_html__( 'Portrait Photo', 'agrovia-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'members_list',
			array(
				'label'       => esc_html__( 'Team Members', 'agrovia-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'name'       => 'Kasun Perera',
						'role'       => esc_html__( 'Lead Crop Manager', 'agrovia-core' ),
						'department' => esc_html__( 'Field Agronomy', 'agrovia-core' ),
						'bio'        => esc_html__( 'Over 14 years managing heritage grain cultivation and integrated agroforestry.', 'agrovia-core' ),
					),
					array(
						'name'       => 'Dr. Nimal Senanayake',
						'role'       => esc_html__( 'Soil Microbiologist', 'agrovia-core' ),
						'department' => esc_html__( 'Living Soil Lab', 'agrovia-core' ),
						'bio'        => esc_html__( 'Directs biological compost tea formulation and sub-surface microbial vitality tracking.', 'agrovia-core' ),
					),
					array(
						'name'       => 'Amara Jayawardena',
						'role'       => esc_html__( 'Farm Operations Director', 'agrovia-core' ),
						'department' => esc_html__( 'Ecosystem Operations', 'agrovia-core' ),
						'bio'        => esc_html__( 'Coordinates solar irrigation, rainwater retention, and closed-loop farm logistics.', 'agrovia-core' ),
					),
					array(
						'name'       => 'Dinesh Wickramasinghe',
						'role'       => esc_html__( 'AgriTech & IoT Specialist', 'agrovia-core' ),
						'department' => esc_html__( 'Smart Farming', 'agrovia-core' ),
						'bio'        => esc_html__( 'Oversees precision moisture sensor networks and microclimate satellite mapping.', 'agrovia-core' ),
					),
				),
				'title_field' => '{{{ name }}} ({{{ role }}})',
				'condition'   => array(
					'data_source' => 'manual',
				),
			)
		);

		$this->end_controls_section();

		// -------------------------------------------------------------
		// Style: Grid
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
					'{{WRAPPER}} .agrovia-team-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				),
			)
		);

		$this->add_responsive_control(
			'gap',
			array(
				'label'      => esc_html__( 'Grid Gap', 'agrovia-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px' => array(
						'min' => 12,
						'max' => 60,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 24,
				),
				'selectors'  => array(
					'{{WRAPPER}} .agrovia-team-grid' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// -------------------------------------------------------------
		// Style: Cards & Typography
		// -------------------------------------------------------------
		$this->start_controls_section(
			'section_style_cards',
			array(
				'label' => esc_html__( 'Card & Typography', 'agrovia-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'card_bg',
			array(
				'label'     => esc_html__( 'Card Background Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F8F7F2',
				'selectors' => array(
					'{{WRAPPER}} .agrovia-team-card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'name_color',
			array(
				'label'     => esc_html__( 'Name Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#18392B',
				'selectors' => array(
					'{{WRAPPER}} .agrovia-team-name' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name_typography',
				'selector' => '{{WRAPPER}} .agrovia-team-name',
			)
		);

		$this->add_control(
			'role_color',
			array(
				'label'     => esc_html__( 'Role Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#7A6048',
				'selectors' => array(
					'{{WRAPPER}} .agrovia-team-role' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render Widget Output on Frontend
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$tagline     = ! empty( $settings['tagline'] ) ? $settings['tagline'] : '';
		$heading     = ! empty( $settings['heading'] ) ? $settings['heading'] : '';
		$description = ! empty( $settings['description'] ) ? $settings['description'] : '';
		$source      = ! empty( $settings['data_source'] ) ? $settings['data_source'] : 'manual';
		?>
		<section class="agrovia-team-widget" aria-label="<?php echo esc_attr( ! empty( $heading ) ? $heading : __( 'Our Team', 'agrovia-core' ) ); ?>">
			<div class="agrovia-team-inner">
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

				<div class="agrovia-team-grid">
					<?php
					if ( 'dynamic' === $source ) {
						$count = ! empty( $settings['posts_per_page'] ) ? absint( $settings['posts_per_page'] ) : 4;
						$query = new \WP_Query(
							array(
								'post_type'      => 'agrovia_team',
								'posts_per_page' => $count,
								'post_status'    => 'publish',
							)
						);

						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								$post_id    = get_the_ID();
								$name       = get_the_title();
								$role       = get_post_meta( $post_id, '_agrovia_member_role', true );
								$excerpt    = get_the_excerpt();
								$terms      = get_the_terms( $post_id, 'team_department' );
								$department = ( ! empty( $terms ) && ! is_wp_error( $terms ) ) ? $terms[0]->name : '';
								?>
								<article class="agrovia-team-card">
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="agrovia-team-media">
											<?php the_post_thumbnail( 'medium_large', array( 'class' => 'agrovia-team-img', 'loading' => 'lazy' ) ); ?>
											<?php if ( ! empty( $department ) ) : ?>
												<span class="agrovia-team-dept-pill"><?php echo esc_html( $department ); ?></span>
											<?php endif; ?>
										</div>
									<?php endif; ?>

									<div class="agrovia-team-body">
										<h3 class="agrovia-team-name"><?php echo esc_html( $name ); ?></h3>
										<?php if ( ! empty( $role ) ) : ?>
											<div class="agrovia-team-role"><?php echo esc_html( $role ); ?></div>
										<?php endif; ?>
										<?php if ( ! empty( $excerpt ) ) : ?>
											<p class="agrovia-team-bio"><?php echo esc_html( $excerpt ); ?></p>
										<?php endif; ?>
									</div>
								</article>
								<?php
							}
							wp_reset_postdata();
						} else {
							echo '<p class="agrovia-team-empty">' . esc_html__( 'No team profiles published yet.', 'agrovia-core' ) . '</p>';
						}
					} else {
						// Manual Repeater Mode.
						$members_list = ! empty( $settings['members_list'] ) ? $settings['members_list'] : array();
						foreach ( $members_list as $member ) {
							$name  = ! empty( $member['name'] ) ? $member['name'] : '';
							$role  = ! empty( $member['role'] ) ? $member['role'] : '';
							$dept  = ! empty( $member['department'] ) ? $member['department'] : '';
							$bio   = ! empty( $member['bio'] ) ? $member['bio'] : '';
							$photo = ! empty( $member['photo']['url'] ) ? $member['photo']['url'] : '';
							?>
							<article class="agrovia-team-card">
								<?php if ( ! empty( $photo ) ) : ?>
									<div class="agrovia-team-media">
										<img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $name ); ?>" class="agrovia-team-img" loading="lazy" />
										<?php if ( ! empty( $dept ) ) : ?>
											<span class="agrovia-team-dept-pill"><?php echo esc_html( $dept ); ?></span>
										<?php endif; ?>
									</div>
								<?php endif; ?>

								<div class="agrovia-team-body">
									<h3 class="agrovia-team-name"><?php echo esc_html( $name ); ?></h3>
									<?php if ( ! empty( $role ) ) : ?>
										<div class="agrovia-team-role"><?php echo esc_html( $role ); ?></div>
									<?php endif; ?>
									<?php if ( ! empty( $bio ) ) : ?>
										<p class="agrovia-team-bio"><?php echo esc_html( $bio ); ?></p>
									<?php endif; ?>
								</div>
							</article>
							<?php
						}
					}
					?>
				</div>
			</div>
		</section>
		<?php
	}
}
