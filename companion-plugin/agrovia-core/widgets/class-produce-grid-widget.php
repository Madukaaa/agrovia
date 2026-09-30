<?php
/**
 * Agrovia Produce Grid Elementor Widget
 *
 * Editorial showcase of sustainable farm harvests (Heirloom Grains, Leafy Greens, Organic Produce).
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
use Elementor\Group_Control_Image_Size;

class Agrovia_Produce_Grid_Widget extends Widget_Base {

	/**
	 * Widget Slug
	 */
	public function get_name() {
		return 'agrovia_produce_grid';
	}

	/**
	 * Widget Title
	 */
	public function get_title() {
		return esc_html__( 'Agrovia Produce Grid', 'agrovia-core' );
	}

	/**
	 * Widget Icon
	 */
	public function get_icon() {
		return 'eicon-posts-grid';
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
		return array( 'produce', 'crops', 'products', 'harvest', 'grid', 'agriculture', 'agrovia' );
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
				'default'     => esc_html__( 'OUR HARVEST', 'agrovia-core' ),
				'placeholder' => esc_html__( 'e.g. OUR HARVEST', 'agrovia-core' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => esc_html__( 'Section Heading', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'What We Grow', 'agrovia-core' ),
				'placeholder' => esc_html__( 'Enter heading...', 'agrovia-core' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => esc_html__( 'Section Description', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Cultivated through living soil biology, rainwater conservation, and non-GMO heirloom seeds.', 'agrovia-core' ),
			)
		);

		$this->end_controls_section();

		// -------------------------------------------------------------
		// Content: Produce Repeater
		// -------------------------------------------------------------
		$this->start_controls_section(
			'section_produce',
			array(
				'label' => esc_html__( 'Produce Items', 'agrovia-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'category',
			array(
				'label'   => esc_html__( 'Crop Category', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'HEIRLOOM GRAINS', 'agrovia-core' ),
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Crop Name', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Traditional Red Rice', 'agrovia-core' ),
			)
		);

		$repeater->add_control(
			'season_badge',
			array(
				'label'   => esc_html__( 'Season / Status', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Harvesting Now', 'agrovia-core' ),
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'   => esc_html__( 'Description', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Nutrient-dense ancient grain cultivated with regenerative water-management protocols.', 'agrovia-core' ),
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Produce Photo', 'agrovia-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'       => esc_html__( 'Item Link', 'agrovia-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com/products/red-rice',
				'default'     => array(
					'url' => '#',
				),
			)
		);

		$this->add_control(
			'produce_list',
			array(
				'label'       => esc_html__( 'Produce List', 'agrovia-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'category'     => esc_html__( 'HEIRLOOM GRAINS', 'agrovia-core' ),
						'title'        => esc_html__( 'Traditional Red Rice', 'agrovia-core' ),
						'season_badge' => esc_html__( 'Harvesting Now', 'agrovia-core' ),
						'description'  => esc_html__( 'Nutrient-rich heritage staple grown under natural rainfall retention systems.', 'agrovia-core' ),
					),
					array(
						'category'     => esc_html__( 'LEAFY GREENS', 'agrovia-core' ),
						'title'        => esc_html__( 'Wild Agrovia Arugula', 'agrovia-core' ),
						'season_badge' => esc_html__( 'Year-round', 'agrovia-core' ),
						'description'  => esc_html__( 'Peppery wild salad leaves nurtured with compost tea and organic mulch.', 'agrovia-core' ),
					),
					array(
						'category'     => esc_html__( 'VEGETABLES', 'agrovia-core' ),
						'title'        => esc_html__( 'Heirloom Vine Tomatoes', 'agrovia-core' ),
						'season_badge' => esc_html__( 'Summer Peak', 'agrovia-core' ),
						'description'  => esc_html__( 'Sun-ripened heritage varieties pollinated by on-farm native bee colonies.', 'agrovia-core' ),
					),
					array(
						'category'     => esc_html__( 'CULINARY HERBS', 'agrovia-core' ),
						'title'        => esc_html__( 'Sweet Genovese Basil', 'agrovia-core' ),
						'season_badge' => esc_html__( 'Fresh Weekly', 'agrovia-core' ),
						'description'  => esc_html__( 'Aromatic culinary herbs grown in integrated companion-planting rows.', 'agrovia-core' ),
					),
				),
				'title_field' => '{{{ category }}}: {{{ title }}}',
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
					'{{WRAPPER}} .agrovia-produce-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
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
					'{{WRAPPER}} .agrovia-produce-grid' => 'gap: {{SIZE}}{{UNIT}};',
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
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .agrovia-produce-card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#18392B',
				'selectors' => array(
					'{{WRAPPER}} .agrovia-produce-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .agrovia-produce-title',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render Widget Output on Frontend
	 */
	protected function render() {
		$settings     = $this->get_settings_for_display();
		$produce_list = ! empty( $settings['produce_list'] ) ? $settings['produce_list'] : array();

		if ( empty( $produce_list ) ) {
			return;
		}

		$tagline     = ! empty( $settings['tagline'] ) ? $settings['tagline'] : '';
		$heading     = ! empty( $settings['heading'] ) ? $settings['heading'] : '';
		$description = ! empty( $settings['description'] ) ? $settings['description'] : '';
		?>
		<section class="agrovia-produce-widget" aria-label="<?php echo esc_attr( ! empty( $heading ) ? $heading : __( 'Our Harvest', 'agrovia-core' ) ); ?>">
			<div class="agrovia-produce-inner">
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

				<div class="agrovia-produce-grid">
					<?php foreach ( $produce_list as $item ) :
						$cat    = ! empty( $item['category'] ) ? $item['category'] : '';
						$title  = ! empty( $item['title'] ) ? $item['title'] : '';
						$season = ! empty( $item['season_badge'] ) ? $item['season_badge'] : '';
						$desc   = ! empty( $item['description'] ) ? $item['description'] : '';
						$img    = ! empty( $item['image']['url'] ) ? $item['image']['url'] : '';
						$url    = ! empty( $item['link']['url'] ) ? $item['link']['url'] : '';
						$ext    = ! empty( $item['link']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
						$rel    = ! empty( $item['link']['nofollow'] ) ? ' rel="nofollow"' : '';
					?>
						<article class="agrovia-produce-card">
							<?php if ( ! empty( $img ) ) : ?>
								<div class="agrovia-produce-media">
									<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy" />
									<?php if ( ! empty( $season ) ) : ?>
										<span class="agrovia-season-pill"><?php echo esc_html( $season ); ?></span>
									<?php endif; ?>
								</div>
							<?php endif; ?>

							<div class="agrovia-produce-body">
								<?php if ( ! empty( $cat ) ) : ?>
									<span class="agrovia-produce-cat"><?php echo esc_html( $cat ); ?></span>
								<?php endif; ?>

								<?php if ( ! empty( $title ) ) : ?>
									<h3 class="agrovia-produce-title">
										<?php if ( ! empty( $url ) && '#' !== $url ) : ?>
											<a href="<?php echo esc_url( $url ); ?>"<?php echo $ext . $rel; ?>>
												<?php echo esc_html( $title ); ?>
											</a>
										<?php else : ?>
											<?php echo esc_html( $title ); ?>
										<?php endif; ?>
									</h3>
								<?php endif; ?>

								<?php if ( ! empty( $desc ) ) : ?>
									<p class="agrovia-produce-desc"><?php echo esc_html( $desc ); ?></p>
								<?php endif; ?>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
