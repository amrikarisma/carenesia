<?php
/**
 * Single post partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$container = get_theme_mod( 'understrap_container_type' );

?>


<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">
			<div class="col-md">
				<div class="wrap-featured-iamge">
					<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
				</div>

				<div class="additional-info">
					<div class="wrap-additional-info-title">
						<h3>My Skills</h3>
					</div>
					<div class="wrap-additional-content">
						<p>Alienum phaedrum torquatos nec eu, vis detraxit periculis ex, nihil expetendis in mei. Mei an pericula euripidis, hinc partem ei est. Eos ei nisl graecis, vix aperiri consequat an. Eius lorem tincidunt vix at, vel pertinax</p>
					</div>
					<div class="wrapper-progress">
						<div class="progress-persentase">
							<div class="progress-title">
							Leadership
							</div>
							<h6 style="left:98%">98%</h6>
						</div>
						<div class="progress">
							<div style="width:98%" class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
					<div class="wrapper-progress">
						<div class="progress-persentase">
							<div class="progress-title">
							Leadership
							</div>
							<h6 style="left:75%">75%</h6>
						</div>
						<div class="progress">
							<div style="width:75%" class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-md">

				<header class="entry-header">
			
					<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
					<div class="tim-position">Community and Event Fundraising Officer – Mr Charity</div>
			

			
				</header><!-- .entry-header -->
				<div class="entry-content">
			
					<?php the_content(); ?>
			
					<div class="tim-contact-detail">
						<div class="wrap-title-contact-detail"><h3>Contact details</h3></div>
						<div class="wrap-contact-item">
							<div class="list-contact-item">
								<div class="row">
									<div class="col-4"><h5>Phone:</h5></div>
									<div class="col">+ 0990 564 67967</div>
								</div>
							</div>
							<div class="list-contact-item">
								<div class="row">
									<div class="col-4"><h5>Email:</h5></div>
									<div class="col">jonna.carter@charity.com</div>
								</div>
							</div>
							<div class="list-contact-item">
								<div class="row">
									<div class="col-4"><h5>Birthday:</h5></div>
									<div class="col">September 19, 1986</div>
								</div>
							</div>
							<div class="list-contact-item">
								<div class="row">
									<div class="col-4"><h5>Location:</h5></div>
									<div class="col">London</div>
								</div>
							</div>
							<div class="list-contact-item">
								<div class="row">
									<div class="col-4"><h5>Experience:</h5></div>
									<div class="col">
										<ul style="list-style-type: none;">
											<li>PQASSO Programme</li>
											<li>PQASSO Programme</li>
											<li>Head of Volunteering</li>
											<li>PQASSO Programme</li>
											<li>PQASSO Programme</li>
											<li>PQASSO Programme</li>
											<li>PQASSO Programme</li>
											<li>PQASSO Programme</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="list-contact-item">
								<div class="row">
									<div class="col-4"></div>
									<div class="col"></div>
								</div>
							</div>
						</div>

					</div>
			
				</div><!-- .entry-content -->
			
				<footer class="entry-footer">
			
					<?php understrap_entry_footer(); ?>
			
				</footer><!-- .entry-footer -->

			</div>
		</div>
		
	</div>
	<div class="wrapper-tim-gallery">
		<div class="<?php echo esc_attr( $container ); ?>">
			<div class="row">
				<div class="col-md-4">
					<a href="#">
						<img src="https://goodwish.qodeinteractive.com/elementor/wp-content/uploads/2017/04/team-member-img-2.jpg" alt="">
					</a>
				</div>
				<div class="col-md-4">
					<a href="#">
						<img src="https://goodwish.qodeinteractive.com/elementor/wp-content/uploads/2017/04/team-member-img-3.jpg" alt="">
					</a>
				</div>
				<div class="col-md-4">
					<a href="#">
						<img src="https://goodwish.qodeinteractive.com/elementor/wp-content/uploads/2017/04/team-member-img-4.jpg" alt="">
					</a>
				</div>
			</div>
		</div>
	</div>

</article><!-- #post-## -->