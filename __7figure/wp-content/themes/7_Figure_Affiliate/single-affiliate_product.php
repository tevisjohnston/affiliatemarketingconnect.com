<?php
/**
 * Single Product Template
 * 7 Figure Affiliate Theme
 */

get_header();
?>

<div class="site-content">
    
    <?php
    while (have_posts()) {
        the_post();
        $affiliate_link = get_post_meta(get_the_ID(), '_affiliate_link', true);
        $jv_page_link = get_post_meta(get_the_ID(), '_jv_page_link', true);
        $subtitle = get_post_meta(get_the_ID(), '_product_subtitle', true);
        $price = get_post_meta(get_the_ID(), '_price_point', true);
        $features = get_post_meta(get_the_ID(), '_key_features', true);
        $benefits = get_post_meta(get_the_ID(), '_product_benefits', true);
        $bonuses = get_post_meta(get_the_ID(), '_bonus_offers', true);
        $testimonials = get_post_meta(get_the_ID(), '_testimonials', true);
    ?>
    
    <!-- Hero Section -->
    <section class="product-hero bg-gradient-to-r from-slate-900 to-slate-700 text-white py-16 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl font-bold mb-4"><?php the_title(); ?></h1>
                    <?php if ($subtitle) { ?>
                        <p class="text-xl text-amber-400 mb-6"><?php echo esc_html($subtitle); ?></p>
                    <?php } ?>
                    <?php if ($price) { ?>
                        <p class="text-3xl font-bold mb-8"><?php echo esc_html($price); ?></p>
                    <?php } ?>
                    
                    <div class="flex gap-4">
                        <?php if ($affiliate_link) { ?>
                            <a href="<?php echo esc_url($affiliate_link); ?>" target="_blank" rel="noopener noreferrer" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-8 py-4 rounded transition text-lg">
                                <?php esc_html_e('Get Access Now', '7-figure-affiliate'); ?>
                            </a>
                        <?php } ?>
                        <?php if ($jv_page_link) { ?>
                            <a href="<?php echo esc_url($jv_page_link); ?>" target="_blank" rel="noopener noreferrer" class="border-2 border-white text-white hover:bg-white hover:text-slate-900 font-bold px-8 py-4 rounded transition text-lg">
                                <?php esc_html_e('JV Page', '7-figure-affiliate'); ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                
                <?php if (has_post_thumbnail()) { ?>
                    <div class="product-image rounded-lg overflow-hidden">
                        <?php the_post_thumbnail('large', array('class' => 'w-full h-auto')); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- Description Section -->
    <section class="product-description py-16 px-6 bg-white">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-6 text-slate-900"><?php esc_html_e('About This Product', '7-figure-affiliate'); ?></h2>
            <div class="prose prose-lg max-w-none text-slate-700">
                <?php the_content(); ?>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <?php if (!empty($features) && is_array($features)) { ?>
    <section class="features py-16 px-6 bg-slate-50">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-slate-900"><?php esc_html_e('Key Features', '7-figure-affiliate'); ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($features as $feature) { ?>
                    <div class="flex items-start gap-4 bg-white p-4 rounded-lg">
                        <span class="text-amber-500 text-2xl flex-shrink-0">✓</span>
                        <span class="text-slate-700"><?php echo esc_html($feature); ?></span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php } ?>

    <!-- Benefits Section -->
    <?php if (!empty($benefits) && is_array($benefits)) { ?>
    <section class="benefits py-16 px-6 bg-white">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-slate-900"><?php esc_html_e('What You\'ll Achieve', '7-figure-affiliate'); ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($benefits as $benefit) { ?>
                    <div class="bg-slate-50 p-6 rounded-lg border-l-4 border-amber-500">
                        <h3 class="font-bold text-slate-900 text-lg"><?php echo esc_html($benefit); ?></h3>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php } ?>

    <!-- Bonuses Section -->
    <?php if (!empty($bonuses) && is_array($bonuses)) { ?>
    <section class="bonuses py-16 px-6 bg-amber-50">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-slate-900"><?php esc_html_e('Included Bonuses', '7-figure-affiliate'); ?></h2>
            <div class="bg-white rounded-lg p-8 border-2 border-amber-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach ($bonuses as $bonus) { ?>
                        <div class="flex items-start gap-4">
                            <span class="text-amber-500 text-2xl flex-shrink-0">🎁</span>
                            <span class="text-slate-700"><?php echo esc_html($bonus); ?></span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <!-- Testimonials Section -->
    <?php if (!empty($testimonials) && is_array($testimonials)) { ?>
    <section class="product-testimonials py-16 px-6 bg-white">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-slate-900"><?php esc_html_e('What Users Say', '7-figure-affiliate'); ?></h2>
            <div class="space-y-6">
                <?php foreach ($testimonials as $testimonial) { ?>
                    <div class="bg-slate-50 p-6 rounded-lg border-l-4 border-amber-500">
                        <div class="flex items-center mb-3">
                            <div class="text-amber-500">★★★★★</div>
                        </div>
                        <p class="text-slate-700 italic mb-3">"<?php echo wp_kses_post($testimonial['text']); ?>"</p>
                        <p class="font-bold text-slate-900"><?php echo esc_html($testimonial['name']); ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php } ?>

    <!-- CTA Section -->
    <section class="product-cta bg-gradient-to-r from-slate-900 to-slate-700 text-white py-16 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold mb-6"><?php esc_html_e('Ready to Get Started?', '7-figure-affiliate'); ?></h2>
            <p class="text-xl text-slate-200 mb-8">
                <?php esc_html_e('Join thousands of successful entrepreneurs using this proven system.', '7-figure-affiliate'); ?>
            </p>
            <div class="flex gap-4 justify-center flex-wrap">
                <?php if ($affiliate_link) { ?>
                    <a href="<?php echo esc_url($affiliate_link); ?>" target="_blank" rel="noopener noreferrer" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-8 py-4 rounded transition text-lg">
                        <?php esc_html_e('Get Access Now', '7-figure-affiliate'); ?>
                    </a>
                <?php } ?>
                <a href="<?php echo esc_url(home_url('/products')); ?>" class="border-2 border-white text-white hover:bg-white hover:text-slate-900 font-bold px-8 py-4 rounded transition text-lg">
                    <?php esc_html_e('View Other Products', '7-figure-affiliate'); ?>
                </a>
            </div>
        </div>
    </section>

    <?php } // end while ?>

</div>

<?php get_footer(); ?>
