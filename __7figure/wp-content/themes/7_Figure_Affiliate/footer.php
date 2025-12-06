<?php
/**
 * Footer Template
 * 7 Figure Affiliate Theme
 */
?>
    </main><!-- #main -->

    <footer class="site-footer bg-slate-900 text-slate-300 py-16 px-6">
        <div class="max-w-7xl mx-auto">
            
            <!-- Footer Content Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                
                <!-- Brand Info -->
                <div class="footer-brand">
                    <h3 class="text-xl font-bold text-white mb-4"><?php bloginfo('name'); ?></h3>
                    <p class="text-sm mb-4">
                        <?php esc_html_e('Discover proven 7-figure affiliate marketing systems and strategies from Michael Cheney.', '7-figure-affiliate'); ?>
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="footer-links">
                    <h4 class="text-lg font-bold text-white mb-4"><?php esc_html_e('Quick Links', '7-figure-affiliate'); ?></h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-amber-400 transition"><?php esc_html_e('Home', '7-figure-affiliate'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/products')); ?>" class="hover:text-amber-400 transition"><?php esc_html_e('Products', '7-figure-affiliate'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/about-michael')); ?>" class="hover:text-amber-400 transition"><?php esc_html_e('About Michael', '7-figure-affiliate'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/blog')); ?>" class="hover:text-amber-400 transition"><?php esc_html_e('Blog', '7-figure-affiliate'); ?></a></li>
                    </ul>
                </div>

                <!-- Legal Links -->
                <div class="footer-legal">
                    <h4 class="text-lg font-bold text-white mb-4"><?php esc_html_e('Legal', '7-figure-affiliate'); ?></h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" class="hover:text-amber-400 transition"><?php esc_html_e('Privacy Policy', '7-figure-affiliate'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/terms')); ?>" class="hover:text-amber-400 transition"><?php esc_html_e('Terms of Service', '7-figure-affiliate'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/disclaimer')); ?>" class="hover:text-amber-400 transition"><?php esc_html_e('Disclaimer', '7-figure-affiliate'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/affiliate-disclosure')); ?>" class="hover:text-amber-400 transition"><?php esc_html_e('Affiliate Disclosure', '7-figure-affiliate'); ?></a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="footer-contact">
                    <h4 class="text-lg font-bold text-white mb-4"><?php esc_html_e('Contact', '7-figure-affiliate'); ?></h4>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="hover:text-amber-400 transition">
                                <?php esc_html_e('Contact Us', '7-figure-affiliate'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:<?php echo esc_attr(get_option('admin_email')); ?>" class="hover:text-amber-400 transition">
                                <?php echo esc_html(get_option('admin_email')); ?>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom border-t border-slate-700 pt-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-center md:text-left text-sm">
                    <p>
                        &copy; <?php echo esc_html(date('Y')); ?> 
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-amber-400 transition">
                            <?php bloginfo('name'); ?>
                        </a>
                        <?php esc_html_e('All Rights Reserved.', '7-figure-affiliate'); ?>
                    </p>
                    <p class="md:text-right">
                        <?php esc_html_e('A Michael Cheney Affiliate Marketing Resource', '7-figure-affiliate'); ?>
                    </p>
                </div>
            </div>

        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
