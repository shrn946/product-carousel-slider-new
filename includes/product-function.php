<?php
// Shortcode to display Swiper Card Carousel Product Slider Elementor
function swiper_latest_products_shortcode($atts) {
    // Shortcode attributes
    $atts = shortcode_atts(
        array(
            'category'       => '',  // Specify category slug or ID
            'posts_per_page' => -1,  // Change this value based on the number of products you want to display
        ),
        $atts,
        'swiper_latest_products'
    );

    ob_start();

    $args = array(
        'post_type'      => 'product',  // Use 'product' for WooCommerce products
        'posts_per_page' => $atts['posts_per_page'],
        'product_cat'    => $atts['category'],  // Use 'product_cat' for WooCommerce categories
    );

    $latest_products = new WP_Query($args);

    if ($latest_products->have_posts()) {
        ?>
        <section>
            <div class="swiper">
                <div class="swiper-wrapper">
                   <?php while ($latest_products->have_posts()) : $latest_products->the_post(); ?>
                        <?php
                        $product_id        = get_the_ID();
                        $swiper_class      = 'swiper-slide swiper-slide' . $product_id;

                        // Get the featured image URL
                        $featured_image_url = get_the_post_thumbnail_url($product_id, 'full');

                        // Fallback image URL
                        $fallback_image_url = wc_placeholder_img_src();

                        // Use the featured image if available, otherwise use the fallback image
                        $background_image_url = $featured_image_url ? esc_url($featured_image_url) : esc_url($fallback_image_url);
                        ?>
                        <div class="<?php echo esc_attr($swiper_class); ?>" style="background-image: url('<?php echo $background_image_url; ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;">
                            <?php
                            $product_categories = wp_get_post_terms($product_id, 'product_cat');
                            if (!empty($product_categories) && !is_wp_error($product_categories)) {
                                $category_names = array();
                                foreach ($product_categories as $category) {
                                    $category_names[] = $category->name;
                                }
                                echo '<span>' . esc_html(implode(', ', $category_names)) . '</span>';
                            }

                            // Get the product price and currency symbol
                            $product        = wc_get_product($product_id);
                            $product_price  = $product->get_price();
                            $currency_symbol = get_woocommerce_currency_symbol();
                            ?>

                            <div class="product-details">
                                <h2 class="s-title"><a style="color:#FFFFFF; text-decoration:none" href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                <span class="product-price"><?php echo esc_html($currency_symbol . $product_price); ?></span>

                                <?php
                                // Output the Add to Cart button
                                woocommerce_template_loop_add_to_cart();
                                ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-pagination"></div>
                
                <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>

            </div>
        </section>

        <?php
    }

    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('swiper_latest_products', 'swiper_latest_products_shortcode');
