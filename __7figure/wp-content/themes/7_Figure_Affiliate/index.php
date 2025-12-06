<?php
/**
 * Main Template
 * 7 Figure Affiliate Theme
 */

get_header();
?>

<div class="site-content max-w-7xl mx-auto py-12 px-6">
    
    <?php
    if (have_posts()) {
        echo '<div class="grid grid-cols-1 gap-8">';
        
        while (have_posts()) {
            the_post();
            ?>
            <article class="post bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-2">
                    <a href="<?php the_permalink(); ?>" class="hover:text-amber-500 transition">
                        <?php the_title(); ?>
                    </a>
                </h2>
                <div class="text-slate-600 text-sm mb-4">
                    <?php 
                    printf(
                        esc_html__('Posted on %s by %s', '7-figure-affiliate'),
                        '<time>' . esc_html(get_the_date()) . '</time>',
                        '<span class="font-semibold">' . esc_html(get_the_author()) . '</span>'
                    );
                    ?>
                </div>
                
                <?php if (has_post_thumbnail()) { ?>
                    <div class="mb-4 rounded-lg overflow-hidden">
                        <?php the_post_thumbnail('large', array('class' => 'w-full h-64 object-cover')); ?>
                    </div>
                <?php } ?>
                
                <div class="prose max-w-none mb-4">
                    <?php the_excerpt(); ?>
                </div>
                
                <a href="<?php the_permalink(); ?>" class="inline-block text-amber-500 hover:text-amber-600 font-semibold transition">
                    <?php esc_html_e('Read More →', '7-figure-affiliate'); ?>
                </a>
            </article>
            <?php
        }
        
        echo '</div>';
        
        // Pagination
        the_posts_pagination(array(
            'prev_text' => esc_html__('← Previous', '7-figure-affiliate'),
            'next_text' => esc_html__('Next →', '7-figure-affiliate'),
            'before_page_number' => '<span class="page-numbers-item">',
            'after_page_number' => '</span>',
        ));
        
    } else {
        echo '<p class="text-center text-slate-600">' . esc_html__('No posts found.', '7-figure-affiliate') . '</p>';
    }
    ?>

</div>

<?php get_footer(); ?>
