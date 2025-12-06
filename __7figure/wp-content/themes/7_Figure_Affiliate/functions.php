<?php
function Theme_7_Figure_Affiliate_wp_enqueue_styles() {
    wp_enqueue_style('my-style', get_stylesheet_uri());

    wp_enqueue_style('tailwindcss', get_template_directory_uri() . '/src/output.css');
}
add_action('wp_enqueue_scripts', 'Theme_7_Figure_Affiliate_wp_enqueue_styles');

function Theme_7_Figure_Affiliate_wp_enqueue_scripts() {
    wp_enqueue_script('theme-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'Theme_7_Figure_Affiliate_wp_enqueue_scripts');

function Theme_7_Figure_Affiliate_theme_setup() {
    add_theme_support('automatic-feed-links');

    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(200, 200, true);

    add_theme_support('title-tag');

    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
    ));

    load_theme_textdomain('7-figure-affiliate', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'Theme_7_Figure_Affiliate_theme_setup');

function Theme_7_Figure_Affiliate_register_nav_menus() {
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', '7-figure-affiliate'),
        'footer' => esc_html__('Footer Menu', '7-figure-affiliate'),
    ));
}
add_action('after_setup_theme', 'Theme_7_Figure_Affiliate_register_nav_menus');

function Theme_7_Figure_Affiliate_register_affiliate_product_cpt() {
    $args = array(
        'label' => esc_html__('Affiliate Products', '7-figure-affiliate'),
        'labels' => array(
            'name' => esc_html__('Affiliate Products', '7-figure-affiliate'),
            'singular_name' => esc_html__('Product', '7-figure-affiliate'),
            'add_new_item' => esc_html__('Add New Product', '7-figure-affiliate'),
            'edit_item' => esc_html__('Edit Product', '7-figure-affiliate'),
            'view_item' => esc_html__('View Product', '7-figure-affiliate'),
            'view_items' => esc_html__('View Products', '7-figure-affiliate'),
        ),
        'description' => 'Michael Cheney affiliate marketing products',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => false,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-shopping-cart',
        'supports' => array('title', 'editor', 'author', 'excerpt', 'thumbnail', 'custom-fields'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'affiliate-product'),
        'capability_type' => 'post',
        'taxonomies' => array('affiliate_product_category'),
    );

    register_post_type('affiliate_product', $args);
}
add_action('init', 'Theme_7_Figure_Affiliate_register_affiliate_product_cpt');

function Theme_7_Figure_Affiliate_register_product_taxonomy() {
    $args = array(
        'label' => esc_html__('Product Categories', '7-figure-affiliate'),
        'labels' => array(
            'name' => esc_html__('Product Categories', '7-figure-affiliate'),
            'singular_name' => esc_html__('Product Category', '7-figure-affiliate'),
            'add_new_item' => esc_html__('Add New Category', '7-figure-affiliate'),
            'edit_item' => esc_html__('Edit Category', '7-figure-affiliate'),
        ),
        'public' => true,
        'publicly_queryable' => true,
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'product-category'),
    );

    register_taxonomy('affiliate_product_category', 'affiliate_product', $args);
}
add_action('init', 'Theme_7_Figure_Affiliate_register_product_taxonomy');

function Theme_7_Figure_Affiliate_add_products_admin_menu() {
    if (!current_user_can('manage_options')) {
        return;
    }

    add_menu_page(
        esc_html__('Products', '7-figure-affiliate'),
        esc_html__('Products', '7-figure-affiliate'),
        'manage_options',
        'products-dashboard',
        'Theme_7_Figure_Affiliate_render_products_dashboard',
        'dashicons-shopping-cart',
        20
    );

    add_submenu_page(
        'products-dashboard',
        esc_html__('Add Product', '7-figure-affiliate'),
        esc_html__('Add Product', '7-figure-affiliate'),
        'manage_options',
        'post-new.php?post_type=affiliate_product',
        ''
    );

    add_submenu_page(
        'products-dashboard',
        esc_html__('View Products', '7-figure-affiliate'),
        esc_html__('View Products', '7-figure-affiliate'),
        'manage_options',
        'edit.php?post_type=affiliate_product',
        ''
    );

    add_submenu_page(
        'products-dashboard',
        esc_html__('Product Categories', '7-figure-affiliate'),
        esc_html__('Product Categories', '7-figure-affiliate'),
        'manage_options',
        'edit-tags.php?taxonomy=affiliate_product_category&post_type=affiliate_product',
        ''
    );
}
add_action('admin_menu', 'Theme_7_Figure_Affiliate_add_products_admin_menu');

function Theme_7_Figure_Affiliate_render_products_dashboard() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Products Dashboard', '7-figure-affiliate'); ?></h1>
        <p><?php esc_html_e('Manage your affiliate marketing products for Michael Cheney.', '7-figure-affiliate'); ?></p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 20px;">
            
            <div style="background: #fff; border: 1px solid #ccc; border-radius: 5px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3><?php esc_html_e('Add New Product', '7-figure-affiliate'); ?></h3>
                <p><?php esc_html_e('Create a new affiliate product page with custom fields.', '7-figure-affiliate'); ?></p>
                <a href="<?php echo esc_url(admin_url('post-new.php?post_type=affiliate_product')); ?>" class="button button-primary">
                    <?php esc_html_e('Add New Product', '7-figure-affiliate'); ?>
                </a>
            </div>

            <div style="background: #fff; border: 1px solid #ccc; border-radius: 5px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3><?php esc_html_e('View All Products', '7-figure-affiliate'); ?></h3>
                <p><?php esc_html_e('Manage, edit, or delete existing products.', '7-figure-affiliate'); ?></p>
                <a href="<?php echo esc_url(admin_url('edit.php?post_type=affiliate_product')); ?>" class="button">
                    <?php esc_html_e('View Products', '7-figure-affiliate'); ?>
                </a>
            </div>

            <div style="background: #fff; border: 1px solid #ccc; border-radius: 5px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3><?php esc_html_e('Product Categories', '7-figure-affiliate'); ?></h3>
                <p><?php esc_html_e('Organize products into categories.', '7-figure-affiliate'); ?></p>
                <a href="<?php echo esc_url(admin_url('edit-tags.php?taxonomy=affiliate_product_category&post_type=affiliate_product')); ?>" class="button">
                    <?php esc_html_e('Manage Categories', '7-figure-affiliate'); ?>
                </a>
            </div>

        </div>

        <?php Theme_7_Figure_Affiliate_render_product_statistics(); ?>

    </div>
    <?php
}

function Theme_7_Figure_Affiliate_render_product_statistics() {
    $total_products = wp_count_posts('affiliate_product');
    $published = isset($total_products->publish) ? $total_products->publish : 0;
    $draft = isset($total_products->draft) ? $total_products->draft : 0;
    ?>
    <div style="background: #fff; border: 1px solid #ccc; border-radius: 5px; padding: 20px; margin-top: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h2><?php esc_html_e('Product Statistics', '7-figure-affiliate'); ?></h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
            <div style="text-align: center; padding: 15px; background: #f0f8ff; border-radius: 5px;">
                <div style="font-size: 28px; font-weight: bold; color: #0073aa;">
                    <?php echo esc_html($published); ?>
                </div>
                <div><?php esc_html_e('Published Products', '7-figure-affiliate'); ?></div>
            </div>
            <div style="text-align: center; padding: 15px; background: #fff3cd; border-radius: 5px;">
                <div style="font-size: 28px; font-weight: bold; color: #856404;">
                    <?php echo esc_html($draft); ?>
                </div>
                <div><?php esc_html_e('Draft Products', '7-figure-affiliate'); ?></div>
            </div>
        </div>
    </div>
    <?php
}

function Theme_7_Figure_Affiliate_add_product_meta_boxes() {
    add_meta_box(
        'product_affiliate_info',
        esc_html__('Affiliate Product Information', '7-figure-affiliate'),
        'Theme_7_Figure_Affiliate_render_affiliate_info_metabox',
        'affiliate_product',
        'normal',
        'high'
    );

    add_meta_box(
        'product_details',
        esc_html__('Product Details', '7-figure-affiliate'),
        'Theme_7_Figure_Affiliate_render_product_details_metabox',
        'affiliate_product',
        'normal',
        'high'
    );

    add_meta_box(
        'product_features_benefits',
        esc_html__('Features & Benefits', '7-figure-affiliate'),
        'Theme_7_Figure_Affiliate_render_features_benefits_metabox',
        'affiliate_product',
        'normal',
        'high'
    );

    add_meta_box(
        'product_bonuses',
        esc_html__('Bonuses', '7-figure-affiliate'),
        'Theme_7_Figure_Affiliate_render_bonuses_metabox',
        'affiliate_product',
        'normal',
        'high'
    );

    add_meta_box(
        'product_testimonials',
        esc_html__('Testimonials', '7-figure-affiliate'),
        'Theme_7_Figure_Affiliate_render_testimonials_metabox',
        'affiliate_product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'Theme_7_Figure_Affiliate_add_product_meta_boxes');

function Theme_7_Figure_Affiliate_render_affiliate_info_metabox($post) {
    wp_nonce_field('product_affiliate_nonce', 'product_affiliate_nonce');

    $affiliate_link = get_post_meta($post->ID, '_affiliate_link', true);
    $jv_page_link = get_post_meta($post->ID, '_jv_page_link', true);
    $subtitle = get_post_meta($post->ID, '_product_subtitle', true);
    $price = get_post_meta($post->ID, '_price_point', true);
    ?>
    <table class="form-table">
        <tr>
            <th scope="row"><label for="affiliate_link"><?php esc_html_e('Affiliate Link', '7-figure-affiliate'); ?></label></th>
            <td><input type="url" id="affiliate_link" name="affiliate_link" value="<?php echo esc_url($affiliate_link); ?>" class="widefat" placeholder="https://warriorplus.com/..." /></td>
        </tr>
        <tr>
            <th scope="row"><label for="jv_page_link"><?php esc_html_e('JV Page Link (Optional)', '7-figure-affiliate'); ?></label></th>
            <td><input type="url" id="jv_page_link" name="jv_page_link" value="<?php echo esc_url($jv_page_link); ?>" class="widefat" placeholder="https://..." /></td>
        </tr>
        <tr>
            <th scope="row"><label for="product_subtitle"><?php esc_html_e('Product Subtitle', '7-figure-affiliate'); ?></label></th>
            <td><input type="text" id="product_subtitle" name="product_subtitle" value="<?php echo esc_attr($subtitle); ?>" class="widefat" placeholder="Brief product tagline" /></td>
        </tr>
        <tr>
            <th scope="row"><label for="price_point"><?php esc_html_e('Price Point', '7-figure-affiliate'); ?></label></th>
            <td><input type="text" id="price_point" name="price_point" value="<?php echo esc_attr($price); ?>" class="widefat" placeholder="From $47" /></td>
        </tr>
    </table>
    <?php
}

function Theme_7_Figure_Affiliate_render_product_details_metabox($post) {
    $conversion_id = get_post_meta($post->ID, '_conversion_tracking_id', true);
    ?>
    <table class="form-table">
        <tr>
            <th scope="row"><label for="conversion_tracking_id"><?php esc_html_e('Conversion Tracking ID', '7-figure-affiliate'); ?></label></th>
            <td><input type="text" id="conversion_tracking_id" name="conversion_tracking_id" value="<?php echo esc_attr($conversion_id); ?>" class="widefat" /></td>
        </tr>
    </table>
    <?php
}

function Theme_7_Figure_Affiliate_render_features_benefits_metabox($post) {
    $features = get_post_meta($post->ID, '_key_features', true);
    $benefits = get_post_meta($post->ID, '_product_benefits', true);

    if (!is_array($features)) {
        $features = array();
    }
    if (!is_array($benefits)) {
        $benefits = array();
    }
    ?>
    <div style="margin-bottom: 20px;">
        <h4><?php esc_html_e('Key Features', '7-figure-affiliate'); ?></h4>
        <div id="features-container">
            <?php foreach ($features as $index => $feature) : ?>
                <div style="margin-bottom: 10px; display: flex; gap: 10px;">
                    <input type="text" name="features[]" value="<?php echo esc_attr($feature); ?>" class="widefat" placeholder="<?php esc_attr_e('Enter feature', '7-figure-affiliate'); ?>" />
                    <button type="button" class="button remove-feature"><?php esc_html_e('Remove', '7-figure-affiliate'); ?></button>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="button add-feature" style="margin-top: 10px;"><?php esc_html_e('Add Feature', '7-figure-affiliate'); ?></button>
    </div>

    <div>
        <h4><?php esc_html_e('Benefits', '7-figure-affiliate'); ?></h4>
        <div id="benefits-container">
            <?php foreach ($benefits as $index => $benefit) : ?>
                <div style="margin-bottom: 10px; display: flex; gap: 10px;">
                    <input type="text" name="benefits[]" value="<?php echo esc_attr($benefit); ?>" class="widefat" placeholder="<?php esc_attr_e('Enter benefit', '7-figure-affiliate'); ?>" />
                    <button type="button" class="button remove-benefit"><?php esc_html_e('Remove', '7-figure-affiliate'); ?></button>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="button add-benefit" style="margin-top: 10px;"><?php esc_html_e('Add Benefit', '7-figure-affiliate'); ?></button>
    </div>

    <script>
    jQuery(document).ready(function($) {
        $('.add-feature').on('click', function(e) {
            e.preventDefault();
            $('#features-container').append(
                '<div style="margin-bottom: 10px; display: flex; gap: 10px;">' +
                '<input type="text" name="features[]" class="widefat" placeholder="Enter feature" />' +
                '<button type="button" class="button remove-feature">Remove</button>' +
                '</div>'
            );
        });

        $(document).on('click', '.remove-feature', function(e) {
            e.preventDefault();
            $(this).closest('div').remove();
        });

        $('.add-benefit').on('click', function(e) {
            e.preventDefault();
            $('#benefits-container').append(
                '<div style="margin-bottom: 10px; display: flex; gap: 10px;">' +
                '<input type="text" name="benefits[]" class="widefat" placeholder="Enter benefit" />' +
                '<button type="button" class="button remove-benefit">Remove</button>' +
                '</div>'
            );
        });

        $(document).on('click', '.remove-benefit', function(e) {
            e.preventDefault();
            $(this).closest('div').remove();
        });
    });
    </script>
    <?php
}

function Theme_7_Figure_Affiliate_render_bonuses_metabox($post) {
    $bonuses = get_post_meta($post->ID, '_bonus_offers', true);

    if (!is_array($bonuses)) {
        $bonuses = array();
    }
    ?>
    <div>
        <p><?php esc_html_e('Add bonus offers that come with this product:', '7-figure-affiliate'); ?></p>
        <div id="bonuses-container">
            <?php foreach ($bonuses as $index => $bonus) : ?>
                <div style="margin-bottom: 10px; display: flex; gap: 10px;">
                    <input type="text" name="bonuses[]" value="<?php echo esc_attr($bonus); ?>" class="widefat" placeholder="<?php esc_attr_e('Enter bonus', '7-figure-affiliate'); ?>" />
                    <button type="button" class="button remove-bonus"><?php esc_html_e('Remove', '7-figure-affiliate'); ?></button>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="button add-bonus" style="margin-top: 10px;"><?php esc_html_e('Add Bonus', '7-figure-affiliate'); ?></button>
    </div>

    <script>
    jQuery(document).ready(function($) {
        $('.add-bonus').on('click', function(e) {
            e.preventDefault();
            $('#bonuses-container').append(
                '<div style="margin-bottom: 10px; display: flex; gap: 10px;">' +
                '<input type="text" name="bonuses[]" class="widefat" placeholder="Enter bonus" />' +
                '<button type="button" class="button remove-bonus">Remove</button>' +
                '</div>'
            );
        });

        $(document).on('click', '.remove-bonus', function(e) {
            e.preventDefault();
            $(this).closest('div').remove();
        });
    });
    </script>
    <?php
}

function Theme_7_Figure_Affiliate_render_testimonials_metabox($post) {
    $testimonials = get_post_meta($post->ID, '_testimonials', true);

    if (!is_array($testimonials)) {
        $testimonials = array();
    }
    ?>
    <div>
        <p><?php esc_html_e('Add customer testimonials for this product:', '7-figure-affiliate'); ?></p>
        <div id="testimonials-container">
            <?php foreach ($testimonials as $index => $testimonial) : ?>
                <div style="margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; border-radius: 5px;">
                    <input type="text" name="testimonial_names[]" value="<?php echo esc_attr($testimonial['name'] ?? ''); ?>" class="widefat" placeholder="<?php esc_attr_e('Testimonial Author Name', '7-figure-affiliate'); ?>" style="margin-bottom: 10px;" />
                    <textarea name="testimonial_texts[]" class="widefat" placeholder="<?php esc_attr_e('Testimonial Text', '7-figure-affiliate'); ?>" rows="3"><?php echo esc_textarea($testimonial['text'] ?? ''); ?></textarea>
                    <button type="button" class="button remove-testimonial" style="margin-top: 10px;"><?php esc_html_e('Remove', '7-figure-affiliate'); ?></button>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="button add-testimonial" style="margin-top: 10px;"><?php esc_html_e('Add Testimonial', '7-figure-affiliate'); ?></button>
    </div>

    <script>
    jQuery(document).ready(function($) {
        $('.add-testimonial').on('click', function(e) {
            e.preventDefault();
            $('#testimonials-container').append(
                '<div style="margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; border-radius: 5px;">' +
                '<input type="text" name="testimonial_names[]" class="widefat" placeholder="Testimonial Author Name" style="margin-bottom: 10px;" />' +
                '<textarea name="testimonial_texts[]" class="widefat" placeholder="Testimonial Text" rows="3"></textarea>' +
                '<button type="button" class="button remove-testimonial" style="margin-top: 10px;">Remove</button>' +
                '</div>'
            );
        });

        $(document).on('click', '.remove-testimonial', function(e) {
            e.preventDefault();
            $(this).closest('div').remove();
        });
    });
    </script>
    <?php
}

function Theme_7_Figure_Affiliate_save_product_meta($post_id) {
    if (!isset($_POST['product_affiliate_nonce']) || !wp_verify_nonce($_POST['product_affiliate_nonce'], 'product_affiliate_nonce')) {
        return;
    }

    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['affiliate_link'])) {
        update_post_meta($post_id, '_affiliate_link', esc_url_raw($_POST['affiliate_link']));
    }

    if (isset($_POST['jv_page_link'])) {
        update_post_meta($post_id, '_jv_page_link', esc_url_raw($_POST['jv_page_link']));
    }

    if (isset($_POST['product_subtitle'])) {
        update_post_meta($post_id, '_product_subtitle', sanitize_text_field($_POST['product_subtitle']));
    }

    if (isset($_POST['price_point'])) {
        update_post_meta($post_id, '_price_point', sanitize_text_field($_POST['price_point']));
    }

    if (isset($_POST['conversion_tracking_id'])) {
        update_post_meta($post_id, '_conversion_tracking_id', sanitize_text_field($_POST['conversion_tracking_id']));
    }

    if (isset($_POST['features'])) {
        $features = array_filter(array_map('sanitize_text_field', $_POST['features']));
        update_post_meta($post_id, '_key_features', $features);
    }

    if (isset($_POST['benefits'])) {
        $benefits = array_filter(array_map('sanitize_text_field', $_POST['benefits']));
        update_post_meta($post_id, '_product_benefits', $benefits);
    }

    if (isset($_POST['bonuses'])) {
        $bonuses = array_filter(array_map('sanitize_text_field', $_POST['bonuses']));
        update_post_meta($post_id, '_bonus_offers', $bonuses);
    }

    if (isset($_POST['testimonial_names']) && isset($_POST['testimonial_texts'])) {
        $names = array_map('sanitize_text_field', $_POST['testimonial_names']);
        $texts = array_map('wp_kses_post', $_POST['testimonial_texts']);
        
        $testimonials = array();
        foreach ($names as $index => $name) {
            if (!empty($name) && !empty($texts[$index])) {
                $testimonials[] = array(
                    'name' => $name,
                    'text' => $texts[$index],
                );
            }
        }
        
        update_post_meta($post_id, '_testimonials', $testimonials);
    }
}
add_action('save_post_affiliate_product', 'Theme_7_Figure_Affiliate_save_product_meta');
