<?php
/**
 * Agrovia Approach Cards Elementor Widget
 *
 * Editorial showcase of sustainable farming pillars (Regenerative, Water Smart, Biodiversity, Circular).
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

class Agrovia_Approach_Cards_Widget extends Widget_Base {

	/**
	 * Widget Slug
	 */
	public function get_name() {
		return 'agrovia_approach_cards';
	}

	/**
	 * Widget Title
	 */
	public function get_title() {
		return esc_html__( 'Agrovia Approach Cards', 'agrovia-core' );
	}

	/**
	 * Widget Icon
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
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
		return array( 'approach', 'pillars', 'cards', 'sustainability', 'agrovia', 'grid' );
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
				'default'     => esc_html__( 'OUR APPROACH', 'agrovia-core' ),
				'placeholder' => esc_html__( 'e.g. OUR APPROACH', 'agrovia-core' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => esc_html__( 'Section Heading', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'A different way to grow.', 'agrovia-core' ),
				'placeholder' => esc_html__( 'Enter heading...', 'agrovia-core' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => esc_html__( 'Section Description', 'agrovia-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'We restore ecological harmony through regenerative practices designed to feed communities while sustaining our living soil.', 'agrovia-core' ),
			)
		);

		$this->end_controls_section();

		// -------------------------------------------------------------
		// Content: Pillars Repeater
		// -------------------------------------------------------------
		$this->start_controls_section(
			'section_cards',
			array(
				'label' => esc_html__( 'Approach Cards', 'agrovia-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'card_number',
			array(
				'label'   => esc_html__( 'Pillar Number', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01',
			)
		);

		$repeater->add_control(
			'card_tag',
			array(
				'label'   => esc_html__( 'Category / Subtitle', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'SOIL HEALTH', 'agrovia-core' ),
			)
		);

		$repeater->add_control(
			'card_title',
			array(
				'label'   => esc_html__( 'Pillar Title', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Regenerative', 'agrovia-core' ),
			)
		);

		$repeater->add_control(
			'card_desc',
			array(
				'label'   => esc_html__( 'Description', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'We focus on restoring soil biological health and maintaining productive farmland for future generations.', 'agrovia-core' ),
			)
		);

		$repeater->add_control(
			'card_link_text',
			array(
				'label'   => esc_html__( 'Link Label', 'agrovia-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Explore Method', 'agrovia-core' ),
			)
		);

		$repeater->add_control(
			'card_link',
			array(
				'label'       => esc_html__( 'Card Link', 'agrovia-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com/practices/regenerative',
				'default'     => array(
					'url' => '#',
				),
			)
		);

		$this->add_control(
			'cards_list',
			array(
				'label'       => esc_html__( 'Cards', 'agrovia-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'card_number'    => '01',
						'card_tag'       => esc_html__( 'SOIL HEALTH', 'agrovia-core' ),
						'card_title'     => esc_html__( 'Regenerative', 'agrovia-core' ),
						'card_desc'      => esc_html__( 'We focus on restoring soil health and biological activity to maintain fertile farmland for generations.', 'agrovia-core' ),
						'card_link_text' => esc_html__( 'Explore Method', 'agrovia-core' ),
					),
					array(
						'card_number'    => '02',
						'card_tag'       => esc_html__( 'WATER MANAGEMENT', 'agrovia-core' ),
						'card_title'     => esc_html__( 'Water Smart', 'agrovia-core' ),
						'card_desc'      => esc_html__( 'Precision drip sensors and rainwater harvesting reduce unnecessary water consumption by over 40%.', 'agrovia-core' ),
						'card_link_text' => esc_html__( 'Explore Method', 'agrovia-core' ),
					),
					array(
						'card_number'    => '03',
						'card_tag'       => esc_html__( 'ECOSYSTEM RESTORATION', 'agrovia-core' ),
						'card_title'     => esc_html__( 'Biodiversity', 'agrovia-core' ),
						'card_desc'      => esc_html__( 'We create diverse agricultural landscapes where crops, pollinators, wildlife and native trees thrive together.', 'agrovia-core' ),
						'card_link_text' => esc_html__( 'Explore Method', 'agrovia-core' ),
					),
					array(
						'card_number'    => '04',
						'card_tag'       => esc_html__( 'ZERO WASTE', 'agrovia-core' ),
						'card_title'     => esc_html__( 'Circular', 'agrovia-core' ),
						'card_desc'      => esc_html__( 'Agricultural residues and organic by-products are cycled back into rich compost and renewable solar power.', 'agrovia-core' ),
						'card_link_text' => esc_html__( 'Explore Method', 'agrovia-core' ),
					),
				),
				'title_field' => '{{{ card_number }}} — {{{ card_title }}}',
			)
		);

		$this->end_controls_section();

		// -------------------------------------------------------------
		// Style: Grid
		// -------------------------------------------------------------
		$this->start_controls_section(
			'section_style_layout',
			array(
				'label' => esc_html__( 'Layout & Columns', 'agrovia-core' ),
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
					'{{WRAPPER}} .agrovia-approach-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
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
					'{{WRAPPER}} .agrovia-approach-grid' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// -------------------------------------------------------------
		// Style: Card Aesthetics
		// -------------------------------------------------------------
		$this->start_controls_section(
			'section_style_card',
			array(
				'label' => esc_html__( 'Card Aesthetics', 'agrovia-core' ),
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
					'{{WRAPPER}} .agrovia-approach-card' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .agrovia-approach-card' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'number_color',
			array(
				'label'     => esc_html__( 'Index Number Color', 'agrovia-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#7A6048', // Earth brown.
				'selectors' => array(
					'{{WRAPPER}} .agrovia-approach-number' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .agrovia-approach-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .agrovia-approach-title',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render Widget Output on Frontend
	 */
	protected function render() {
		$settings   = $this->get_settings_for_display();
		$cards_list = ! empty( $settings['cards_list'] ) ? $settings['cards_list'] : array();

		if ( empty( $cards_list ) ) {
			return;
		}

		$tagline     = ! empty( $settings['tagline'] ) ? $settings['tagline'] : '';
		$heading     = ! empty( $settings['heading'] ) ? $settings['heading'] : '';
		$description = ! empty( $settings['description'] ) ? $settings['description'] : '';
		?>
		<section class="agrovia-approach-widget" aria-label="<?php echo esc_attr( ! empty( $heading ) ? $heading : __( 'Our Approach', 'agrovia-core' ) ); ?>">
			<div class="agrovia-approach-inner">
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

				<div class="agrovia-approach-grid">
					<?php foreach ( $cards_list as $card ) :
						$num   = ! empty( $card['card_number'] ) ? $card['card_number'] : '';
						$tag   = ! empty( $card['card_tag'] ) ? $card['card_tag'] : '';
						$title = ! empty( $card['card_title'] ) ? $card['card_title'] : '';
						$desc  = ! empty( $card['card_desc'] ) ? $card['card_desc'] : '';
						$label = ! empty( $card['card_link_text'] ) ? $card['card_link_text'] : __( 'Explore →', 'agrovia-core' );
						$url   = ! empty( $card['card_link']['url'] ) ? $card['card_link']['url'] : '#';
						$ext   = ! empty( $card['card_link']['is_external'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
						$rel   = ! empty( $card['card_link']['nofollow'] ) ? ' rel="nofollow"' : '';
					?>
						<article class="agrovia-approach-card">
							<div class="agrovia-approach-card-top">
								<?php if ( ! empty( $tag ) ) : ?>
									<span class="agrovia-approach-tag"><?php echo esc_html( $tag ); ?></span>
								<?php endif; ?>
								<?php if ( ! empty( $num ) ) : ?>
									<span class="agrovia-approach-number"><?php echo esc_html( $num ); ?></span>
								<?php endif; ?>
							</div>

							<div class="agrovia-approach-card-body">
								<?php if ( ! empty( $title ) ) : ?>
									<h3 class="agrovia-approach-title"><?php echo esc_html( $title ); ?></h3>
								<?php endif; ?>
								<?php if ( ! empty( $desc ) ) : ?>
									<p class="agrovia-approach-desc"><?php echo esc_html( $desc ); ?></p>
								<?php endif; ?>
							</div>

							<div class="agrovia-approach-card-footer">
								<a href="<?php echo esc_url( $url ); ?>" class="agrovia-approach-link"<?php echo $ext . $rel; ?>>
									<span><?php echo esc_html( $label ); ?></span>
									<span class="agrovia-link-arrow" aria-hidden="true">&rarr;</span>
								</a>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}
}
