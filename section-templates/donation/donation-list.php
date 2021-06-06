<section class="member">
    <div class="wrap-member-list-header">
        <div class="container">
            <?php the_title( '<h2 class="member-list-header-title">', '</h2>' ); ?>
            <div class="tagline"><?php the_content(); ?></div>
            <div class="line"></div>
        </div>
    </div>
    <div class="wrap-member-list-content">
        <div class="container">
            <div class="row">
            <?php 
                    /**
                     * Setup query to show the ‘services’ post type with ‘8’ posts.
                     * Output the title with an excerpt.
                     */
                        $args = array(  
                            'post_type' => 'donasi',
                            'post_status' => 'publish',
                            'posts_per_page' => 8, 
                            'orderby' => 'title', 
                            'order' => 'ASC', 
                        );

                        $donasi = new WP_Query( $args ); 
                            
                        while ( $donasi->have_posts() ) : $donasi->the_post();  ?>
          
                            <div class="col-md-6 col-lg-6">
                                <div class="member-item-box">
                                    <a href="#">
                                        <div class="wrap-image">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo get_the_post_thumbnail( $donasi->ID, 'large' ); ?>
                                            </a>

                                        </div>
                                        <div class="wrap-text">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title( '<h4 class="name">', '</h4>' ); ?>
                                            </a>
                                       
                                            <div class="position">
                                            <?php the_category( ', ' ); ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        <?php endwhile;

                        wp_reset_postdata(); 
                ?>
            </div>
        </div>
    </div>
</section>