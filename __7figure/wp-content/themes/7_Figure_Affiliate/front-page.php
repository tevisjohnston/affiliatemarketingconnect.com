<?php
/**
 * Front Page Template
 * 7 Figure Affiliate Theme
 */

get_header();
?>

<div class="site-content">
    
    <!-- Hero Section -->
    <section class="hero-section bg-gradient-to-r from-slate-900 to-slate-700 text-white py-20 px-6">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">
                <?php bloginfo('name'); ?>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-slate-200">
                Discover Michael Cheney's Proven 7-Figure Affiliate Marketing Systems
            </p>
            
            <!-- Lead Magnet CTA -->
            <div class="lead-magnet-cta bg-slate-800 rounded-lg p-8 max-w-2xl mx-auto">
                <h3 class="text-2xl font-bold mb-4">Get the Step-by-Step Blueprint to $5k/Month</h3>
                <form class="flex flex-col sm:flex-row gap-4">
                    <input type="text" placeholder="Name" class="flex-1 px-4 py-3 rounded text-dark" required>
                    <input type="email" placeholder="Email address" class="flex-1 px-4 py-3 rounded text-dark" required>
                    <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-6 py-3 rounded transition">
                        Blueprint to $5k/Month
                    </button>
                </form>
                <p class="text-sm text-slate-300 mt-3">Unsubscribe anytime. No spam ever.</p>
            </div>
        </div>
    </section>

    <!-- About Michael Cheney Section -->
    <section class="about-section py-16 px-6 bg-white">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-4xl font-bold mb-6 text-slate-900">Meet Michael Cheney</h2>
                <p class="text-lg text-slate-700 mb-4">
                    Michael Cheney is a proven 7-figure affiliate marketer and digital entrepreneur who has helped thousands build successful online businesses. With over a decade of experience in affiliate marketing, Michael has generated over $50M+ in affiliate commissions.
                </p>
                <p class="text-lg text-slate-700 mb-6">
                    His proven systems and strategies have been tested in real-world conditions and have generated consistent results for students from all backgrounds and experience levels.
                </p>
                <a href="<?php echo esc_url(home_url('/about-michael')); ?>" class="inline-block bg-slate-900 hover:bg-slate-800 text-white font-bold px-6 py-3 rounded transition">
                    Learn More About Michael
                </a>
            </div>
            <div class="about-image">
                <?php
                // Check if a featured image exists for the about section
                $about_page = get_page_by_path('about-michael');
                if ($about_page && has_post_thumbnail($about_page->ID)) {
                    echo wp_get_attachment_image(get_post_thumbnail_id($about_page->ID), 'large', false, array('class' => 'rounded-lg shadow-lg'));
                } else {
                    echo '<div class="bg-slate-200 rounded-lg p-8 text-center"><p class="text-slate-500">Michael Cheney Photo</p></div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="featured-products py-16 px-6 bg-slate-50">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold mb-12 text-center text-slate-900">Featured Products</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php
                $featured = new WP_Query(array(
                    'post_type' => 'affiliate_product',
                    'posts_per_page' => 3,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));

                if ($featured->have_posts()) {
                    while ($featured->have_posts()) {
                        $featured->the_post();
                        $affiliate_link = get_post_meta(get_the_ID(), '_affiliate_link', true);
                        $price = get_post_meta(get_the_ID(), '_price_point', true);
                        $subtitle = get_post_meta(get_the_ID(), '_product_subtitle', true);
                        ?>
                        <div class="product-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="product-image">
                                    <?php the_post_thumbnail('large', array('class' => 'w-full h-64 object-cover')); ?>
                                </div>
                            <?php } ?>
                            
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2 text-slate-900"><?php the_title(); ?></h3>
                                <?php if ($subtitle) { ?>
                                    <p class="text-sm text-amber-600 font-semibold mb-3"><?php echo esc_html($subtitle); ?></p>
                                <?php } ?>
                                
                                <p class="text-slate-600 mb-4 line-clamp-3"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                
                                <?php if ($price) { ?>
                                    <p class="text-lg font-bold text-slate-900 mb-4"><?php echo esc_html($price); ?></p>
                                <?php } ?>
                                
                                <div class="flex gap-3">
                                    <a href="<?php the_permalink(); ?>" class="flex-1 text-center bg-slate-900 hover:bg-slate-800 text-white font-bold px-4 py-2 rounded transition">
                                        Learn More
                                    </a>
                                    <?php if ($affiliate_link) { ?>
                                        <a href="<?php echo esc_url($affiliate_link); ?>" target="_blank" rel="noopener noreferrer" class="flex-1 text-center bg-amber-500 hover:bg-amber-600 text-white font-bold px-4 py-2 rounded transition">
                                            View Offer
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                }
                ?>
            </div>

            <div class="text-center mt-12">
                <a href="<?php echo esc_url(home_url('/products')); ?>" class="inline-block bg-slate-900 hover:bg-slate-800 text-white font-bold px-8 py-3 rounded transition">
                    See All Products
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials py-16 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold mb-12 text-center text-slate-900">Success Stories</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="testimonial bg-slate-50 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-amber-500">★★★★★</div>
                    </div>
                    <p class="text-slate-700 mb-4 italic">"This system completely transformed my online business. I went from struggling to make $100/month to generating consistent 5-figure months."</p>
                    <p class="font-bold text-slate-900">Sarah Johnson</p>
                </div>

                <div class="testimonial bg-slate-50 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-amber-500">★★★★★</div>
                    </div>
                    <p class="text-slate-700 mb-4 italic">"Michael's strategies are pure gold. The step-by-step approach made it easy to implement and see results quickly."</p>
                    <p class="font-bold text-slate-900">Mike Rodriguez</p>
                </div>

                <div class="testimonial bg-slate-50 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-amber-500">★★★★★</div>
                    </div>
                    <p class="text-slate-700 mb-4 italic">"I've tried many programs, but this is the first one that actually works. The support and community are incredible."</p>
                    <p class="font-bold text-slate-900">Jessica Lee</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section bg-gradient-to-r from-slate-900 to-slate-700 text-white py-16 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold mb-6">Ready to Start Your 7-Figure Journey?</h2>
            <p class="text-xl mb-8 text-slate-200">
                Join thousands of entrepreneurs who have transformed their income with Michael Cheney's proven systems.
            </p>
            <a href="<?php echo esc_url(home_url('/products')); ?>" class="inline-block bg-amber-500 hover:bg-amber-600 text-white font-bold px-8 py-4 rounded text-lg transition">
                Explore Products Now
            </a>
        </div>
    </section>

</div>

<?php get_footer(); ?>
