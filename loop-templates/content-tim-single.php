<?php

/**
 * Single post partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
$container = get_theme_mod('understrap_container_type');

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="<?php echo esc_attr($container); ?>">

		<div class="row">
			<div class="col-md">
				<div class="wrap-featured-iamge">
					<?php echo get_the_post_thumbnail($post->ID, 'large'); ?>
				</div>

				<div class="additional-info">
					<?php if (isset(get_field('detail')['simple_description']['title'])) : ?>
						<div class="wrap-additional-info-title">
							<h3><?php echo get_field('detail')['simple_description']['title']; ?></h3>
						</div>
					<?php endif; ?>
					<?php if (isset(get_field('detail')['simple_description']['content'])) : ?>
						<div class="wrap-additional-content">
							<p><?php echo get_field('detail')['simple_description']['content']; ?></p>
						</div>
					<?php endif; ?>
					<?php foreach (get_field('detail')['progress_bar'] ?? [] as $progress_bar) : ?>
						<div class="wrapper-progress">
							<div class="progress-persentase">
								<div class="progress-title">
									<?php echo $progress_bar['text'] ?? ''; ?>
								</div>
								<h6 style="left:<?php echo $progress_bar['score'] ?? 0; ?>%"><?php echo $progress_bar['score'] ?? 0; ?>%</h6>
							</div>
							<div class="progress">
								<div style="width:<?php echo $progress_bar['score'] ?? 0; ?>%" class="progress-bar" role="progressbar" aria-valuenow="<?php echo $progress_bar['score'] ?? 0; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

			</div>
			<div class="col-md">

				<header class="entry-header">

					<?php the_title('<h2 class="entry-title">', '</h2>'); ?>
					<div class="tim-position"><?php echo get_field('detail')['from'] ?? ''; ?> – <?php echo get_field('detail')['position'] ?? ''; ?></div>

				</header><!-- .entry-header -->
				<div class="entry-content">

					<?php the_content(); ?>

					<div class="tim-contact-detail">
						<div class="wrap-title-contact-detail">
							<h3><?php echo get_field('detail')['contact_title'] ?? ''; ?></h3>
						</div>
						<div class="wrap-contact-item">
							<?php foreach (get_field('detail')['contact'] ?? [] as $contact) : ?>

								<div class="list-contact-item">
									<div class="row">
										<div class="col-4">
											<h5><?php echo $contact['key']; ?>:</h5>
										</div>
										<div class="col"><?php echo $contact['value']; ?></div>
									</div>
								</div>
							<?php endforeach; ?>

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
		<div class="<?php echo esc_attr($container); ?>">
			<div class="row">
				<?php foreach (get_field('detail')['gallery'] ?? [] as $gallery) : ?>
					<div class="col-md-4 p-4">
						<a href="<?php echo $gallery['url']; ?>" title="<?php echo $gallery['title']; ?>" data-toggle="lightbox">
							<img class="img-fluid" width="<?php echo $gallery['width']; ?>" height="<?php echo $gallery['height']; ?>" src="<?php echo $gallery['url']; ?>" alt="<?php echo $gallery['title']; ?>">
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

</article><!-- #post-## -->