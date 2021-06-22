<section class="donation">
    <div class="donation-header">
        <h2>Latest Causes</h2>
        <div class="tagline">
            <p>Organization set up to provide help and raise money for those in need</p>
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
                while ($loop->have_posts()) {
                    $loop->the_post();
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="wrap-donation-image">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="wrap-donation-text">
                            <div class="category"><?php the_category(); ?></div>
                            <h2><?php the_title(); ?></h2>
                            <p><?php the_excerpt(); ?></p>
                            <div class="wrap-progress-bar">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <div>Raised: <strong>Rp. 123.000</strong></div>
                                    <div>Goal: <strong>Rp. 15.000.000</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }

                ?>


            </div>
        </div>
    </div>
</section>