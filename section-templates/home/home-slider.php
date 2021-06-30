<div class="home-slider owl-carousel owl-theme">
    <?php foreach (get_field('big_slider')['item'] ?? [] as $slider) : ?>
        <div class="item">
            <img src="<?php echo $slider['image']['url'] ?>" alt="<?php echo $slider['image']['title'] ?? '' ?>">
            <div class="slider-wrapper-text">
                <div class="title"><?php echo $slider['title'] ?? '' ?></div>
                <div class="caption">
                    <p><?php echo $slider['caption'] ?? '' ?>
                    <p>
                </div>
                <a href="<?php echo $slider['url']; ?>" class="btn btn-outline-primary"><?php echo $slider['button_text'] ?? '' ?></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>