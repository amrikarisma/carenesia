<section class="donation">
    <div class="donation-header">
        <h2>Kampanye Donasi</h2>
        <div class="tagline">
            <p>Ulurkan tangan untuk mereka yang sedang membutuhkan</p>
        </div>
    </div>
    <div class="wrap-list-donation">
        <div class="container">
            <div class="row">
                <?php
                $args = array(
                    'post_type'      => 'donasi',
                    'posts_per_page' => 10,
                );
                $loop = new WP_Query($args);
                while ($loop->have_posts()) :
                    $loop->the_post();
                    if ((int)get_donation('total', $post->ID)) {
                        $persentase = number_format((((int)get_donation('total', $post->ID) ?? 0) / ((int)get_field('donation_goals') ?? 0) * 100), 2, '.', '');
                    } else {
                        $persentase = 0;
                    }

                ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <a class="list-donation-box" href="<?php the_permalink(); ?>">
                            <div class="wrap-donation-image">
                                <?php the_post_thumbnail(); ?>
                            </div>
                            <div class="wrap-donation-text">
                                <div class="category">
                                    <?php
                                    // to display categories without a link
                                    foreach ((get_the_category()) as $category) {
                                        echo $category->cat_name . ' ';
                                    }
                                    ?>
                                </div>
                                <h2><?php the_title(); ?></h2>
                                <p><?php the_excerpt(); ?></p>
                                <div class="wrap-progress-bar">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $persentase ?>%" aria-valuenow="<?php echo $persentase ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <div>Raised: <strong>Rp. <?php echo number_format(get_donation('total', $post->ID) ?? 0, 0, ',', '.'); ?></strong></div>
                                        <div>Goal: <strong>Rp. <?php echo number_format(get_field('donation_goals') ?? 0, 0, ',', '.'); ?></strong></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>

            </div>
        </div>
    </div>
</section>