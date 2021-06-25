<section class="fullwidth-counter" style="background-image: url('https://goodwish.qodeinteractive.com/elementor/wp-content/uploads/2017/03/h1-parallax-2.jpg');
    min-height: 0px;
    height: auto;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <?php foreach (get_field('counter_section') ?? [] as $counter) : ?>
                <div class="col-md-6 col-lg-3">
                    <div class="wrap-counter">
                        <div class="count"><?php echo $counter['value']; ?></div>
                        <div class="note"><?php echo $counter['name']; ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>