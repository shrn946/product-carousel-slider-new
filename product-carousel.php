<?php
/**
 * Plugin Name: Best Product Carousel Slider
 * Description: A simple WordPress plugin for Swiper Product Carousel.
 * Version: 1.0
 * Author: Hassan Naqvi
 */


include_once(plugin_dir_path(__FILE__) . 'includes/product-function.php');

// Enqueue Swiper CSS and JS
function swiper_post_carousel_enqueue_scripts() {
    // Enqueue Swiper CSS
    wp_enqueue_style('swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css');

    // Enqueue custom styles
    wp_enqueue_style('swiper-custom-style', plugin_dir_url(__FILE__) . 'style.css');

    // Get the plugin directory URL
    $plugin_url = plugin_dir_url(__FILE__);

    // Enqueue Swiper JS
    wp_enqueue_script('swiper-script', $plugin_url . 'assets/swiper-bundle.js', array(), '8.4.5', true);

    // Enqueue custom script
    wp_enqueue_script('swiper-custom-script', $plugin_url . 'script.js', array('swiper-script'), '1.0', true);
}

// Hook the function to the wp_enqueue_scripts action
add_action('wp_enqueue_scripts', 'swiper_post_carousel_enqueue_scripts');

// Add admin page under Settings tab
function swiper_latest_posts_admin_menu() {
    add_options_page(
        'Swiper Latest Posts Settings',
        'Swiper Settings',
        'manage_options',
        'swiper_latest_posts_settings',
        'swiper_latest_posts_settings_page'
    );
}
add_action('admin_menu', 'swiper_latest_posts_admin_menu');


// Settings page content
function swiper_latest_posts_settings_page() {
    ?>
    <div class="wrap">
        <h1>Swiper Latest Products Settings</h1>
        <p>Welcome to the Swiper Latest Products plugin settings page. Use the shortcode <code>[swiper_latest_products]</code> to display all Products.</p>
        <p>You can customize the display using the following attributes:</p>
        <ul>
            <li><code>category="your-category-slug"</code> - to display Products from a specific category.</li>
            <li><code>posts_per_page="5"</code> - to display a specific number of Products.</li>
        </ul>
        <p>Example usage: <code>[swiper_latest_products category="product-category-slug" posts_per_page="8"]</code></p>
        
 
        <h2>Video Tutorial</h2>
        <p>Watch the video below to learn more about using the Swiper Latest Products plugin:</p>
        <!-- Add your video iframe code here -->
        <div style="max-width: 800px;">
            <!-- Replace the placeholder below with your actual video iframe code -->
            <div style="position: relative; padding-bottom: 56.25%; height: 0;">
               <iframe width="560" height="315" src="https://www.youtube.com/embed/6aYvQnGjfjI?si=1jGXLCyVGqJBShHv" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <?php
}