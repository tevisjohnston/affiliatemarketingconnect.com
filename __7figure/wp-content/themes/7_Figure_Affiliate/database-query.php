<?php
/**
 * Database Query Helper
 * Access at: http://localhost:8888/7figure.affiliatemarketconnect.com/wp-content/themes/7_Figure_Affiliate/database-query.php
 */

// Load WordPress
require_once('../../../wp-load.php');

// Security check
if (!current_user_can('manage_options')) {
    wp_die('Access denied. Please log in as an administrator.');
}

global $wpdb;

?>
<!DOCTYPE html>
<html>
<head>
    <title>7 Figure Affiliate - Database Analysis</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 5px; }
        h1 { color: #333; border-bottom: 3px solid #f59e0b; padding-bottom: 10px; }
        h2 { color: #555; margin-top: 30px; border-bottom: 2px solid #ddd; padding-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        th { background: #f3f4f6; font-weight: bold; }
        tr:hover { background: #f9fafb; }
        .stat-box { display: inline-block; background: #f0f9ff; border: 2px solid #0284c7; border-radius: 5px; padding: 15px; margin: 10px 10px 10px 0; }
        .stat-number { font-size: 24px; font-weight: bold; color: #0284c7; }
        .stat-label { color: #666; font-size: 12px; }
        .section { background: #f9fafb; padding: 15px; border-radius: 5px; margin: 20px 0; }
        code { background: #f3f4f6; padding: 2px 6px; border-radius: 3px; font-family: monospace; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🗄️ 7 Figure Affiliate - Database Analysis</h1>

        <!-- Database Statistics -->
        <section class="section">
            <h2>Database Statistics</h2>
            <?php
            $db_name = DB_NAME;
            $db_user = DB_USER;
            $table_prefix = $wpdb->prefix;

            echo "<div class='stat-box'>";
            echo "<div class='stat-number'>" . esc_html($db_name) . "</div>";
            echo "<div class='stat-label'>Database Name</div>";
            echo "</div>";

            echo "<div class='stat-box'>";
            echo "<div class='stat-number'>" . esc_html($db_user) . "</div>";
            echo "<div class='stat-label'>Database User</div>";
            echo "</div>";

            echo "<div class='stat-box'>";
            echo "<div class='stat-number'>" . esc_html($table_prefix) . "</div>";
            echo "<div class='stat-label'>Table Prefix</div>";
            echo "</div>";

            // Get all tables
            $tables = $wpdb->get_results("SHOW TABLES FROM " . DB_NAME);
            echo "<div class='stat-box'>";
            echo "<div class='stat-number'>" . count($tables) . "</div>";
            echo "<div class='stat-label'>Total Tables</div>";
            echo "</div>";
            ?>
        </section>

        <!-- All Tables -->
        <section class="section">
            <h2>📋 All Database Tables</h2>
            <table>
                <thead>
                    <tr>
                        <th>Table Name</th>
                        <th>Rows</th>
                        <th>Size</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($tables as $table) {
                        $table_name = array_values((array)$table)[0];
                        
                        $row_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
                        $table_status = $wpdb->get_row("SHOW TABLE STATUS WHERE Name = '$table_name'");
                        $size = $table_status ? $table_status->Data_length + $table_status->Index_length : 0;
                        $size_mb = round($size / 1024 / 1024, 2);
                        
                        echo "<tr>";
                        echo "<td><code>" . esc_html($table_name) . "</code></td>";
                        echo "<td>" . number_format($row_count) . "</td>";
                        echo "<td>" . esc_html($size_mb) . " MB</td>";
                        echo "<td>" . (strpos($table_name, 'affiliate') !== false ? '⭐ Custom' : '📌 WordPress') . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <!-- Posts Overview -->
        <section class="section">
            <h2>📝 Posts Overview</h2>
            <?php
            $total_posts = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts}");
            $published_posts = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_status = 'publish'");
            $draft_posts = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_status = 'draft'");
            $affiliate_products = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = 'affiliate_product'");

            echo "<div class='stat-box'>";
            echo "<div class='stat-number'>" . $total_posts . "</div>";
            echo "<div class='stat-label'>Total Posts</div>";
            echo "</div>";

            echo "<div class='stat-box'>";
            echo "<div class='stat-number'>" . $published_posts . "</div>";
            echo "<div class='stat-label'>Published Posts</div>";
            echo "</div>";

            echo "<div class='stat-box'>";
            echo "<div class='stat-number'>" . $draft_posts . "</div>";
            echo "<div class='stat-label'>Draft Posts</div>";
            echo "</div>";

            echo "<div class='stat-box'>";
            echo "<div class='stat-number'>" . $affiliate_products . "</div>";
            echo "<div class='stat-label'>Affiliate Products</div>";
            echo "</div>";

            // Post types breakdown
            $post_types = $wpdb->get_results("
                SELECT post_type, COUNT(*) as count 
                FROM {$wpdb->posts} 
                GROUP BY post_type 
                ORDER BY count DESC
            ");
            ?>

            <h3>Post Types Breakdown</h3>
            <table>
                <thead>
                    <tr>
                        <th>Post Type</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($post_types as $pt) {
                        echo "<tr>";
                        echo "<td><code>" . esc_html($pt->post_type) . "</code></td>";
                        echo "<td>" . $pt->count . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <!-- Affiliate Products Details -->
        <section class="section">
            <h2>🛍️ Affiliate Products Details</h2>
            <?php
            $products = $wpdb->get_results("
                SELECT ID, post_title, post_status, post_date 
                FROM {$wpdb->posts} 
                WHERE post_type = 'affiliate_product' 
                ORDER BY post_date DESC
            ");

            if (!empty($products)) {
                echo "<table>";
                echo "<thead><tr><th>Product ID</th><th>Title</th><th>Status</th><th>Published Date</th><th>Meta Fields</th></tr></thead>";
                echo "<tbody>";
                
                foreach ($products as $product) {
                    $affiliate_link = get_post_meta($product->ID, '_affiliate_link', true);
                    $price = get_post_meta($product->ID, '_price_point', true);
                    $features = get_post_meta($product->ID, '_key_features', true);
                    $features_count = is_array($features) ? count($features) : 0;
                    
                    echo "<tr>";
                    echo "<td>" . $product->ID . "</td>";
                    echo "<td>" . esc_html($product->post_title) . "</td>";
                    echo "<td>" . ucfirst($product->post_status) . "</td>";
                    echo "<td>" . esc_html(date('M d, Y', strtotime($product->post_date))) . "</td>";
                    echo "<td>";
                    echo ($affiliate_link ? "✓ Link " : "✗ Link ");
                    echo ($price ? "✓ Price " : "✗ Price ");
                    echo ($features_count > 0 ? "✓ " . $features_count . " Features" : "✗ Features");
                    echo "</td>";
                    echo "</tr>";
                }
                
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No affiliate products found. Run the import script to add products.</p>";
            }
            ?>
        </section>

        <!-- Users Overview -->
        <section class="section">
            <h2>👥 Users Overview</h2>
            <?php
            $total_users = count_users();
            $user_count = $total_users['total_users'];
            
            echo "<div class='stat-box'>";
            echo "<div class='stat-number'>" . $user_count . "</div>";
            echo "<div class='stat-label'>Total Users</div>";
            echo "</div>";

            $users = $wpdb->get_results("SELECT ID, user_login, user_email, user_registered FROM {$wpdb->users} ORDER BY ID");
            ?>

            <h3>Users List</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Registered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $user) {
                        echo "<tr>";
                        echo "<td>" . $user->ID . "</td>";
                        echo "<td>" . esc_html($user->user_login) . "</td>";
                        echo "<td>" . esc_html($user->user_email) . "</td>";
                        echo "<td>" . esc_html(date('M d, Y', strtotime($user->user_registered))) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <!-- Post Meta for Affiliate Products -->
        <section class="section">
            <h2>🔍 Product Meta Fields (Sample)</h2>
            <?php
            if (!empty($products)) {
                $sample_product = $products[0];
                $meta = get_post_meta($sample_product->ID);
                
                echo "<p><strong>Product:</strong> " . esc_html($sample_product->post_title) . " (ID: " . $sample_product->ID . ")</p>";
                echo "<table>";
                echo "<thead><tr><th>Meta Key</th><th>Value</th></tr></thead>";
                echo "<tbody>";
                
                foreach ($meta as $key => $value) {
                    if (strpos($key, '_') === 0) { // Only show private meta
                        $display_value = $value[0];
                        if (is_array($display_value)) {
                            $display_value = implode(", ", $display_value);
                        }
                        if (strlen($display_value) > 100) {
                            $display_value = substr($display_value, 0, 100) . "...";
                        }
                        echo "<tr>";
                        echo "<td><code>" . esc_html($key) . "</code></td>";
                        echo "<td>" . esc_html($display_value) . "</td>";
                        echo "</tr>";
                    }
                }
                
                echo "</tbody>";
                echo "</table>";
            }
            ?>
        </section>

        <!-- Taxonomies -->
        <section class="section">
            <h2>🏷️ Taxonomies & Categories</h2>
            <?php
            $taxonomies = $wpdb->get_results("
                SELECT t.term_id, t.name, tt.taxonomy, COUNT(tr.object_id) as post_count
                FROM {$wpdb->terms} t
                LEFT JOIN {$wpdb->term_taxonomy} tt ON t.term_id = tt.term_id
                LEFT JOIN {$wpdb->term_relationships} tr ON tt.term_taxonomy_id = tr.term_taxonomy_id
                WHERE tt.taxonomy IN ('category', 'post_tag', 'affiliate_product_category')
                GROUP BY t.term_id, t.name, tt.taxonomy
                ORDER BY tt.taxonomy, t.name
            ");

            if (!empty($taxonomies)) {
                echo "<table>";
                echo "<thead><tr><th>Taxonomy</th><th>Term</th><th>Posts</th></tr></thead>";
                echo "<tbody>";
                
                foreach ($taxonomies as $tax) {
                    echo "<tr>";
                    echo "<td><code>" . esc_html($tax->taxonomy) . "</code></td>";
                    echo "<td>" . esc_html($tax->name) . "</td>";
                    echo "<td>" . $tax->post_count . "</td>";
                    echo "</tr>";
                }
                
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No categories or tags found yet.</p>";
            }
            ?>
        </section>

        <!-- WordPress Options -->
        <section class="section">
            <h2>⚙️ WordPress Configuration</h2>
            <?php
            $options = array(
                'siteurl' => 'Site URL',
                'home' => 'Home URL',
                'blogname' => 'Blog Name',
                'blogdescription' => 'Blog Description',
                'admin_email' => 'Admin Email',
                'posts_per_page' => 'Posts Per Page',
                'show_on_front' => 'Front Page Shows',
                'page_on_front' => 'Front Page ID',
                'page_for_posts' => 'Posts Page ID',
            );

            echo "<table>";
            echo "<thead><tr><th>Option</th><th>Value</th></tr></thead>";
            echo "<tbody>";
            
            foreach ($options as $key => $label) {
                $value = get_option($key);
                echo "<tr>";
                echo "<td>" . esc_html($label) . "</td>";
                echo "<td><code>" . esc_html($value) . "</code></td>";
                echo "</tr>";
            }
            
            echo "</tbody>";
            echo "</table>";
            ?>
        </section>

        <!-- Query Helper -->
        <section class="section">
            <h2>🔧 Run Custom Query</h2>
            <form method="POST">
                <textarea name="query" rows="6" style="width: 100%; font-family: monospace; padding: 10px; border: 1px solid #ddd;" placeholder="Enter SQL query (SELECT only)..."></textarea>
                <button type="submit" style="background: #0284c7; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px;">Run Query</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['query'])) {
                $query = sanitize_text_field($_POST['query']);
                
                // Only allow SELECT queries
                if (stripos($query, 'SELECT') === 0) {
                    $results = $wpdb->get_results($query);
                    
                    echo "<h3>Query Results</h3>";
                    if (!empty($results)) {
                        echo "<table>";
                        echo "<thead><tr>";
                        foreach ((array)$results[0] as $key => $value) {
                            echo "<th>" . esc_html($key) . "</th>";
                        }
                        echo "</tr></thead>";
                        echo "<tbody>";
                        
                        foreach ($results as $row) {
                            echo "<tr>";
                            foreach ((array)$row as $value) {
                                echo "<td>" . esc_html($value) . "</td>";
                            }
                            echo "</tr>";
                        }
                        
                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "<p>No results found.</p>";
                    }
                } else {
                    echo "<p style='color: red;'>⚠️ Only SELECT queries are allowed.</p>";
                }
            }
            ?>
        </section>

    </div>
</body>
</html>
