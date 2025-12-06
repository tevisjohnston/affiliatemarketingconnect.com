<?php
/**
 * Blog Home Template
 * 7 Figure Affiliate Theme
 */

get_header();
?>

<div class="site-content">
    
    <!-- Hero Section -->
    <section class="blog-hero bg-gradient-to-r from-slate-900 to-slate-700 text-white py-16 px-6 mb-12">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-5xl font-bold mb-4"><?php esc_html_e('7 Figure Insider', '7-figure-affiliate'); ?></h1>
            <p class="text-xl text-slate-200">
                <?php esc_html_e('Exclusive strategies, insider tactics, and proven systems from Michael Cheney\'s 7-figure affiliate marketing empire.', '7-figure-affiliate'); ?>
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Blog Posts -->
            <div class="lg:col-span-2">
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        ?>
                        <article class="blog-post bg-white rounded-lg shadow-md overflow-hidden mb-8 hover:shadow-lg transition">
                            
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="post-thumbnail h-64 overflow-hidden">
                                    <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                                        <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover')); ?>
                                    </a>
                                </div>
                            <?php } ?>
                            
                            <div class="p-6">
                                <h2 class="text-2xl font-bold mb-2">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-amber-500 transition">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                
                                <div class="flex items-center gap-4 text-sm text-slate-600 mb-4">
                                    <span><?php echo esc_html(get_the_date()); ?></span>
                                    <span>•</span>
                                    <span><?php esc_html_e('By', '7-figure-affiliate'); ?> <span class="font-semibold"><?php the_author(); ?></span></span>
                                </div>
                                
                                <div class="text-slate-700 mb-4">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="inline-block text-amber-500 hover:text-amber-600 font-semibold transition">
                                    <?php esc_html_e('Continue Reading →', '7-figure-affiliate'); ?>
                                </a>
                            </div>
                        </article>
                        <?php
                    }
                    
                    // Pagination
                    the_posts_pagination(array(
                        'prev_text' => esc_html__('← Previous', '7-figure-affiliate'),
                        'next_text' => esc_html__('Next →', '7-figure-affiliate'),
                    ));
                    
                } else {
                    echo '<p class="text-center text-slate-600">' . esc_html__('No posts found.', '7-figure-affiliate') . '</p>';
                }
                ?>
            </div>
            
            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                
                <!-- Email Signup -->
                <div class="bg-slate-900 text-white p-6 rounded-lg mb-8">
                    <h3 class="text-lg font-bold mb-4"><?php esc_html_e('7 Figure Insider Secrets', '7-figure-affiliate'); ?></h3>
                    <p class="text-sm text-slate-300 mb-4">
                        <?php esc_html_e('Get Michael\'s exclusive strategies that generated over $50 Million in affiliate commissions.', '7-figure-affiliate'); ?>
                    </p>
                    <form class="space-y-3">
                        <input type="email" placeholder="<?php esc_attr_e('Enter your email', '7-figure-affiliate'); ?>" class="w-full px-3 py-2 rounded text-slate-900" required>
                        <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 rounded transition">
                            <?php esc_html_e('Get My Secrets', '7-figure-affiliate'); ?>
                        </button>
                    </form>
                    <p class="text-xs text-slate-400 mt-3">
                        <?php esc_html_e('No spam. Unsubscribe anytime.', '7-figure-affiliate'); ?>
                    </p>
                </div>

                <!-- Featured Products -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <h3 class="text-lg font-bold mb-4 text-slate-900"><?php esc_html_e('Hot This Week', '7-figure-affiliate'); ?></h3>
                    
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
                            $price = get_post_meta(get_the_ID(), '_price_point', true);
                            $affiliate_link = get_post_meta(get_the_ID(), '_affiliate_link', true);
                            ?>
                            <div class="mb-4 pb-4 border-b border-slate-200 last:mb-0 last:pb-0 last:border-b-0">
                                <h4 class="font-bold text-slate-900 mb-2">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-amber-500 transition">
                                        <?php the_title(); ?>
                                    </a>
                                </h4>
                                <?php if ($price) { ?>
                                    <p class="text-amber-600 font-semibold text-sm mb-2"><?php echo esc_html($price); ?></p>
                                <?php } ?>
                                <?php if ($affiliate_link) { ?>
                                    <a href="<?php echo esc_url($affiliate_link); ?>" target="_blank" rel="noopener noreferrer" class="text-xs text-amber-500 hover:text-amber-600 transition font-semibold">
                                        <?php esc_html_e('View Offer →', '7-figure-affiliate'); ?>
                                    </a>
                                <?php } ?>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                    }
                    ?>
                </div>

            </aside>

        </div>
    </div>

</div>

<?php get_footer(); ?>
