<div id="container" class="row ro-grid-content ro-pricing-style2">
				<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
					<?php 
						$featured = get_post_meta( get_the_ID(), 'tb_pricing_featured', true );
						$featured_class = '';
						if($featured == 'yes'){
							$featured_class = 'item-featured';
						}
					?>
					<div class="ro-pricing-item col-md-4 col-sm-6 <?php echo $featured_class; ?>" data-myorder="<?php echo get_the_ID(); ?>">
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail('medium'); } ?>
						<div class="ro-meta">
							<div class="ro-meta-header">
							<?php
								$pricing_price = get_post_meta( get_the_ID(), 'tb_pricing_price', true );
								if( $pricing_price ){
									if(function_exists('rop_price')){
										print rop_price($pricing_price);
									}else{
										echo '<div class="ro-price"><span>'.esc_html_e("$", "medipress").'</span>'.$pricing_price.'</div>';
									}
								}
								$pricing_type = get_post_meta( get_the_ID(), 'tb_pricing_type', true );
								if( $pricing_type ) echo '<div class="ro-price-type">'.$pricing_type.'</div>';
								if( $show_description ) {
									$pricing_des = get_post_meta( get_the_ID(), 'tb_pricing_description', true );
									if( $pricing_des ) echo '<div class="ro-description">'.$pricing_des.'</div>';
								}
							?>
							</div>
							<div class="ro-item-body">
								<?php
									if( $show_title ) { ?>
										<h5 class="ro-text-ellipsis"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								<?php } ?>
								<div class="ro-content">
									<?php the_content(); ?>
								</div>
							</div>
							<div class="ro-pricing-button ro-button-wraper">
								<?php
									$pricing_button = get_post_meta( get_the_ID(), 'tb_pricing_button', true );
									echo do_shortcode( '[ro_pricing post_id="'.get_the_ID().'" title="'.$pricing_button.'"]' );
								?>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php if($show_pagination){ ?>
					<nav class="pagination ro-pagination ?>" role="navigation">
						<?php
							$big = 999999999; // need an unlikely integer

							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $wp_query->max_num_pages,
								'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'medipress' ),
								'next_text' => __( '<i class="fa fa-angle-right"></i>', 'medipress' ),
							) );
						?>
					</nav>
				<?php } ?>
			</div>