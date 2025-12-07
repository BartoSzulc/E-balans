<?php

/**
 * Post Filtering Setup
 */

namespace App\Setup;

class PostFilterSetup
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Initialize the class.
     *
     * @return void
     */
    public function init()
    {
        // Register AJAX handlers
        add_action('wp_ajax_load_posts', [$this, 'load_posts']);
        add_action('wp_ajax_nopriv_load_posts', [$this, 'load_posts']);
        
        // Add ajax data to window object
        add_action('wp_head', [$this, 'add_ajax_data']);
    }

    /**
     * Add AJAX data to window object
     * This is a better approach for Sage 11 with Vite
     * 
     * @return void
     */
    public function add_ajax_data()
    {
        echo '<script type="text/javascript">
            window.post_filter_ajax = {
                ajax_url: "' . admin_url('admin-ajax.php') . '",
                nonce: "' . wp_create_nonce('post_filter_nonce') . '"
            };
        </script>';
    }

    /**
     * AJAX handler for loading posts with pagination
     *
     * @return void
     */
    public function load_posts()
    {
        // Prevent any output before our JSON response
        ob_start();
        
        // Verify nonce for security
        if (!check_ajax_referer('post_filter_nonce', 'nonce', false)) {
            $response = [
                'success' => false,
                'message' => 'Security check failed',
            ];
            
            ob_end_clean(); // Clear any output
            wp_send_json($response);
            exit;
        }

        $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
        $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
        $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 15;
        
        // Build query arguments
        $args = [
            'post_type' => 'post',
            'posts_per_page' => $posts_per_page,
            'paged' => $paged,
            'orderby' => 'date',
            'order' => 'DESC',
        ];
        
        // Add category query if category is selected
        if (!empty($category) && $category !== 'all') {
            $args['category_name'] = $category;
        }
        
        try {
            // Run the query with pagination
            $posts_query = new \WP_Query($args);
            
            // Set the global $wp_query to our custom query for pagination
            global $wp_query;
            $temp_query = $wp_query;
            $wp_query = $posts_query;
            
            $response = [
                'success' => true,
                'html' => '',
                'found_posts' => $posts_query->found_posts,
                'max_num_pages' => $posts_query->max_num_pages,
                'current_page' => $paged,
            ];
            
            if ($posts_query->have_posts()) {
                $html_content = '';
                
                while ($posts_query->have_posts()) {
                    $posts_query->the_post();
                    // Capture output to prevent errors
                    ob_start();
                    echo view('partials.post-card')->render();
                    $html_content .= ob_get_clean();
                }
                
                $response['html'] = $html_content;
                $response['post_count'] = $posts_query->post_count;
                
                // Generate pagination HTML with appropriate class for JavaScript
                ob_start();
                
                // Add custom classes to make pagination links work with our JS
                add_filter('page_navi_class', function($class) {
                    return 'pagination js-pagination';
                });
                
                add_filter('page_navi_page_link', function($link) {
                    return preg_replace('/href="([^"]+)"/', 'href="$1" class="page-link"', $link);
                });
                
                // Generate pagination
                page_navi();
                
                $pagination_html = ob_get_clean();
                $response['pagination'] = $pagination_html;
            } else {
                $response['html'] = '<div class="text-center col-span-full"><p>Brak postów w tej kategorii.</p></div>';
                $response['pagination'] = '';
            }
            
            // Restore the original query
            $wp_query = $temp_query;
            wp_reset_postdata();
            
            // Clear any output and send the response
            ob_end_clean();
            wp_send_json($response);
        } catch (\Exception $e) {
            ob_end_clean();
            wp_send_json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ]);
        }
        
        exit; // Ensure the script stops here
    }

    /**
     * Helper function to get all categories for filter buttons
     *
     * @param bool $hide_empty Whether to hide empty categories
     * @return array
     */
    public static function get_categories_for_filter($hide_empty = true)
    {
        $categories = get_categories([
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => $hide_empty,
        ]);
        
        return $categories;
    }
}