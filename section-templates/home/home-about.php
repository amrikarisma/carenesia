<section class="about">
    <div class="about-header">
        <h2><?php echo get_field('who_we_are')['title'] ?? ''; ?></h2>
        <div class="tagline">
            <p><?php echo get_field('who_we_are')['tagline'] ?? ''; ?></p>
        </div>
    </div>
    <div class="wrap-list-about">
        <div class="container">
            <div class="row">
                <?php foreach (get_field('banner')['item'] ?? [] as $banner) : ?>

                    <div class="col-md-4 mb-4">
                        <div class="wrap-about-image">
                            <img src="https://goodwish.qodeinteractive.com/elementor/wp-content/uploads/2017/03/h1-img-4.jpg" alt="">
                        </div>
                        <div class="wrap-about-text">
                            <h2>Places To Get Lost</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit hendrerit faucibus. Suspendisse hendrerit turpis dui, eget ultricies erat consequat ut. Sed ac velit iaculis, condimentum neqlu.</p>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>