<?php
class RO_Accordion_Widget extends RO_Widget {
	public function __construct() {
		$this->widget_cssclass    = 'ro-fancy ro-widget-accordion';
		$this->widget_description = __( 'Display a accordion on your site.', 'medipress' );
		$this->widget_id          = 'ro_accordion';
		$this->widget_name        = __( 'Accordion', 'medipress' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Accordion', 'medipress' ),
				'label' => __( 'Title', 'medipress' )
			),
			'title1'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title 1', 'medipress' )
			),			
			'content1'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Content 1', 'medipress' )
			),
			'title2'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title 2', 'medipress' )
			),			
			'content2'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Content 2', 'medipress' )
			),
			'title3'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title 3', 'medipress' )
			),			
			'content3'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Content 3', 'medipress' )
			),
			'title4'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title 4', 'medipress' )
			),			
			'content4'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Content 4', 'medipress' )
			),
			'title5'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title 5', 'medipress' )
			),			
			'content5'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Content 5', 'medipress' )
			),
			'title6'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title 6', 'medipress' )
			),			
			'content6'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Content 6', 'medipress' )
			),
			'title7'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title 7', 'medipress' )
			),			
			'content7'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Content 7', 'medipress' )
			),
			'title8'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title 8', 'medipress' )
			),			
			'content8'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Content 8', 'medipress' )
			),
			'title9'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title 9', 'medipress' )
			),			
			'content9'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Content 9', 'medipress' )
			),
			'title10'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title 10', 'medipress' )
			),			
			'content10'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Content 10', 'medipress' )
			),
			'el_class'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Extra Class', 'medipress' )
			)
		);
		parent::__construct();
		add_action('admin_enqueue_scripts', array($this, 'widget_scripts'));
	}
	public function widget_scripts() {

		wp_enqueue_script('widget_scripts', URI_PATH . '/framework/widgets/widgets.js');

	}
	public function widget( $args, $instance ) {
				
		if ( $this->get_cached_widget( $args ) )
			return;		
		global $post;
		extract( $args );
                
		$title                  = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$title1                	= sanitize_text_field( $instance['title1'] );
		$content1               = sanitize_text_field( $instance['content1'] );
		$title2                	= sanitize_text_field( $instance['title2'] );
		$content2               = sanitize_text_field( $instance['content2'] );
		$title3                	= sanitize_text_field( $instance['title3'] );
		$content3               = sanitize_text_field( $instance['content3'] );
		$title4                	= sanitize_text_field( $instance['title4'] );
		$content4               = sanitize_text_field( $instance['content4'] );
		$title5                	= sanitize_text_field( $instance['title5'] );
		$content5               = sanitize_text_field( $instance['content5'] );
		$title6                	= sanitize_text_field( $instance['title6'] );
		$content6               = sanitize_text_field( $instance['content6'] );
		$title7                	= sanitize_text_field( $instance['title7'] );
		$content7               = sanitize_text_field( $instance['content7'] );
		$title8                	= sanitize_text_field( $instance['title8'] );
		$content8               = sanitize_text_field( $instance['content8'] );
		$title9                	= sanitize_text_field( $instance['title9'] );
		$content9               = sanitize_text_field( $instance['content9'] );
		$title10                = sanitize_text_field( $instance['title10'] );
		$content10              = sanitize_text_field( $instance['content10'] );
		$el_class               = sanitize_text_field( $instance['el_class'] );
		
		// no 'class' attribute - add one with the value of width
        if (strpos($before_widget, 'class') === false) {
            $before_widget = str_replace('>', 'class="' . esc_attr($el_class) . '"', $before_widget);
        }
        // there is 'class' attribute - append width value to it
        else {
            $before_widget = str_replace('class="', 'class="' . esc_attr($el_class) . ' ', $before_widget);
        }
		
        ob_start();
		
		echo ''.$before_widget;

		if ( $title )
				echo ''.$before_title . $title . $after_title;            
		
		?>
			<div id="ro-accordion" class="panel-group">
				<?php if($title1) { ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#ro-accordion1">
									<?php echo $title1; ?>
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse in" id="ro-accordion1">
							<div class="panel-body"><?php print $content1; ?></div>
						</div>
					</div>
				<?php } ?>
				<?php if($title2) { ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="collapsed" data-toggle="collapse" href="#ro-accordion2">
									<?php echo $title2; ?>
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="ro-accordion2">
							<div class="panel-body"><?php print $content2; ?></div>
						</div>
					</div>
				<?php } ?>
				<?php if($title3) { ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="collapsed" data-toggle="collapse" href="#ro-accordion3">
									<?php echo $title3; ?>
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="ro-accordion3">
							<div class="panel-body"><?php print $content3; ?></div>
						</div>
					</div>
				<?php } ?>
				<?php if($title4) { ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="collapsed" data-toggle="collapse" href="#ro-accordion4">
									<?php echo $title4; ?>
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="ro-accordion4">
							<div class="panel-body"><?php print $content4; ?></div>
						</div>
					</div>
				<?php } ?>
				<?php if($title5) { ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="collapsed" data-toggle="collapse" href="#ro-accordion5">
									<?php echo $title5; ?>
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="ro-accordion5">
							<div class="panel-body"><?php print $content5; ?></div>
						</div>
					</div>
				<?php } ?>
				<?php if($title6) { ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="collapsed" data-toggle="collapse" href="#ro-accordion6">
									<?php echo $title6; ?>
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="ro-accordion6">
							<div class="panel-body"><?php print $content6; ?></div>
						</div>
					</div>
				<?php } ?>
				<?php if($title7) { ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="collapsed" data-toggle="collapse" href="#ro-accordion7">
									<?php echo $title7; ?>
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="ro-accordion7">
							<div class="panel-body"><?php print $content7; ?></div>
						</div>
					</div>
				<?php } ?>
				<?php if($title8) { ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="collapsed" data-toggle="collapse" href="#ro-accordion8">
									<?php echo $title8; ?>
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="ro-accordion8">
							<div class="panel-body"><?php print $content8; ?></div>
						</div>
					</div>
				<?php } ?>
				<?php if($title9) { ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="collapsed" data-toggle="collapse" href="#ro-accordion9">
									<?php echo $title9; ?>
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="ro-accordion9">
							<div class="panel-body"><?php print $content9; ?></div>
						</div>
					</div>
				<?php } ?>
				<?php if($title10) { ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="collapsed" data-toggle="collapse" href="#ro-accordion10">
									<?php echo $title10; ?>
								</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="ro-accordion10">
							<div class="panel-body"><?php print $content10; ?></div>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php 
		
		wp_reset_postdata();

		echo ''.$after_widget;
                
		$content = ob_get_clean();

		echo ''.$content;

		$this->cache_widget( $args, $content );
	}
}
/* Class RO_Fancy_List_Widget */
function register_accordion_widget() {
    register_widget('RO_Accordion_Widget');
}

add_action('widgets_init', 'register_accordion_widget');
