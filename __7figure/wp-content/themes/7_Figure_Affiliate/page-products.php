<?php
/**
 * Products Page Template
 * 7 Figure Affiliate Theme
 */

get_header();
?>

<div class="site-content">
    
    <!-- Hero Section -->
    <section class="page-hero bg-gradient-to-r from-slate-900 to-slate-700 text-white py-16 px-6">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-5xl md:text-6xl font-bold"><?php the_title(); ?></h1>
            <p class="text-xl text-slate-200 mt-4">Explore Michael Cheney's complete collection of proven affiliate marketing systems</p>
        </div>
    </section>

    <!-- Products Grid Section -->
    <section class="products-section py-16 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            
            <?php
            $products = new WP_Query(array(
                'post_type' => 'affiliate_product',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ));

            if ($products->have_posts()) {
                echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">';
                
                while ($products->have_posts()) {
                    $products->the_post();
                    $affiliate_link = get_post_meta(get_the_ID(), '_affiliate_link', true);
                    $price = get_post_meta(get_the_ID(), '_price_point', true);
                    $subtitle = get_post_meta(get_the_ID(), '_product_subtitle', true);
                    $features = get_post_meta(get_the_ID(), '_key_features', true);
                    ?>
                    
                    <div class="product-card bg-white border border-slate-200 rounded-lg shadow-md hover:shadow-lg transition overflow-hidden">
                        
                        <?php if (has_post_thumbnail()) { ?>
                            <div class="product-image h-64 overflow-hidden bg-slate-100">
                                <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover')); ?>
                            </div>
                        <?php } else { ?>
                            <div class="product-image h-64 bg-slate-200 flex items-center justify-center">
                                <span class="text-slate-400"><?php esc_html_e('Product Image', '7-figure-affiliate'); ?></span>
                            </div>
                        <?php } ?>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-slate-900 mb-2"><?php the_title(); ?></h3>
                            
                            <?php if ($subtitle) { ?>
                                <p class="text-sm text-amber-600 font-semibold mb-3"><?php echo esc_html($subtitle); ?></p>
                            <?php } ?>
                            
                            <?php if ($price) { ?>
                                <p class="text-lg font-bold text-slate-900 mb-4"><?php echo esc_html($price); ?></p>
                            <?php } ?>
                            
                            <p class="text-slate-600 mb-4 text-sm line-clamp-3"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            
                            <?php if (!empty($features) && is_array($features)) { ?>
                                <div class="mb-4">
                                    <p class="text-sm font-semibold text-slate-700 mb-2"><?php esc_html_e('Includes:', '7-figure-affiliate'); ?></p>
                                    <ul class="text-sm text-slate-600 space-y-1">
                                        <?php 
                                        $features_to_show = array_slice($features, 0, 3);
                                        foreach ($features_to_show as $feature) {
                                            echo '<li class="flex items-start"><span class="text-amber-500 mr-2">✓</span><span>' . esc_html($feature) . '</span></li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            <?php } ?>
                            
                            <div class="flex gap-3 mt-6">
                                <a href="<?php the_permalink(); ?>" class="flex-1 text-center bg-slate-900 hover:bg-slate-800 text-white font-bold py-2 rounded transition text-sm">
                                    <?php esc_html_e('Details', '7-figure-affiliate'); ?>
                                </a>
                                <?php if ($affiliate_link) { ?>
                                    <a href="<?php echo esc_url($affiliate_link); ?>" target="_blank" rel="noopener noreferrer" class="flex-1 text-center bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 rounded transition text-sm">
                                        <?php esc_html_e('View Offer', '7-figure-affiliate'); ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                }
                
                echo '</div>';
                wp_reset_postdata();
            } else {
                echo '<p class="text-center text-slate-600">' . esc_html__('No products found.', '7-figure-affiliate') . '</p>';
            }
            ?>

        </div>
    </section>

</div>

<?php get_footer(); ?>
