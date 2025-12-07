<?php

/**
 * Case Study Filtering Setup
 */

namespace App\Setup;

class CaseStudyFilterSetup
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
        add_action('wp_ajax_load_case_studies', [$this, 'load_case_studies']);
        add_action('wp_ajax_nopriv_load_case_studies', [$this, 'load_case_studies']);
        
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
            window.case_study_filter_ajax = {
                ajax_url: "' . admin_url('admin-ajax.php') . '",
                nonce: "' . wp_create_nonce('case_study_filter_nonce') . '"
            };
        </script>';
    }

    /**
     * AJAX handler for loading case studies with pagination
     *
     * @return void
     */
    public function load_case_studies()
    {
        // Prevent any output before our JSON response
        ob_start();
        
        // Verify nonce for security
        if (!check_ajax_referer('case_study_filter_nonce', 'nonce', false)) {
            $response = [
                'success' => false,
                'message' => 'Security check failed',
            ];
            
            ob_end_clean(); // Clear any output
            wp_send_json($response);
            exit;
        }

        $tematyka = isset($_POST['tematyka']) ? sanitize_text_field($_POST['tematyka']) : '';
        $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
        $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 4;
        
        // Build query arguments
        $args = [
            'post_type' => 'case-study',
            'posts_per_page' => $posts_per_page,
            'paged' => $paged,
            'orderby' => 'date',
            'order' => 'DESC',
        ];
        
        // Add taxonomy query if tematyka is selected
        if (!empty($tematyka) && $tematyka !== 'all') {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'tematyka',
                    'field' => 'slug',
                    'terms' => $tematyka,
                ],
            ];
        }
        
        try {
            // Run the query with pagination
            $case_studies_query = new \WP_Query($args);
            
            // Set the global $wp_query to our custom query for pagination
            global $wp_query;
            $temp_query = $wp_query;
            $wp_query = $case_studies_query;
            
            $response = [
                'success' => true,
                'html' => '',
                'found_posts' => $case_studies_query->found_posts,
                'max_num_pages' => $case_studies_query->max_num_pages,
                'current_page' => $paged,
            ];
            
            if ($case_studies_query->have_posts()) {
                $html_content = '';
                
                while ($case_studies_query->have_posts()) {
                    $case_studies_query->the_post();
                    // Capture output to prevent errors
                    ob_start();
                    echo view('partials.case-study-card')->render();
                    $html_content .= ob_get_clean();
                }
                
                $response['html'] = $html_content;
                $response['post_count'] = $case_studies_query->post_count;
                
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
                $response['html'] = '<div class="text-center col-span-full"><p>Brak case studies w tej tematyce.</p></div>';
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
     * Helper function to get all tematyka terms for filter buttons
     *
     * @param bool $hide_empty Whether to hide empty terms
     * @return array
     */
    public static function get_tematyka_for_filter($hide_empty = true)
    {
        $terms = get_terms([
            'taxonomy' => 'tematyka',
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => $hide_empty,
        ]);
        
        return is_array($terms) ? $terms : [];
    }
}