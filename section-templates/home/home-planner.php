<section class="planner">
    <div class="planner-header">
        <h2><?php echo get_field('plan')['title'] ?? ''; ?></h2>
        <div class="tagline">
            <p style="white-space: pre-wrap;"><?php echo get_field('plan')['caption'] ?? ''; ?></p>
        </div>
    </div>
    <div class="wrap-planner">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="wrap-planner-text" style="background-image: url('https://goodwish.qodeinteractive.com/elementor/wp-content/uploads/2017/03/h1-presentation-img-1.jpg')">
                        <div class="inner-text-planner">
                            <h2 class="title"><?php echo get_field('plan')['content_title'] ?? ''; ?></h2>
                            <div class="wrapper-content-planner">
                                <p><?php echo get_field('plan')['content_text'] ?? ''; ?></p>
                            </div>
                            <a class="btn btn-secondary" href="<?php echo get_field('plan')['button_url'] ?? ''; ?>"><?php echo get_field('plan')['text_button'] ?? ''; ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="home-planner owl-carousel owl-theme">
                        <?php foreach (get_field('plan')['slider'] ?? [] as $plan_slider) : ?>
                            <div class="item">
                                <img src="<?php echo $plan_slider['url']; ?>" alt="">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>