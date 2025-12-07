<?php
function page_navi($before = '', $after = '') {
    global $wp_query;
    $posts_per_page = $wp_query->get('posts_per_page');
    
    // Fallback to global settings if not set in the query
    if (!$posts_per_page || $posts_per_page < 1) {
        $posts_per_page = get_option('posts_per_page');
    }
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $numposts = $wp_query->found_posts;
    $max_page = ceil($numposts / $posts_per_page);

    if ($numposts <= $posts_per_page) {
        return;
    }

    $pages_to_show = 4;
    $pages_to_show_minus_1 = $pages_to_show - 1;
    $half_page_start = floor($pages_to_show_minus_1 / 2);
    $half_page_end = ceil($pages_to_show_minus_1 / 2);
    $start_page = $paged - $half_page_start;

    if ($start_page <= 0) {
        $start_page = 1;
    }

    $end_page = $paged + $half_page_end;
    if (($end_page - $start_page) != $pages_to_show_minus_1) {
        $end_page = $start_page + $pages_to_show_minus_1;
    }

    if ($end_page > $max_page) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = $max_page;
    }

    if ($start_page <= 0) {
        $start_page = 1;
    }

    echo $before . '<nav class="w-full col-span-full posts-navigation" aria-label="Navigation"><ul class="pagination">';

    // Previous Page
    if ($paged > 1) {
        $prev_page = $paged - 1;
        if ($prev_page > 0) {
            echo '<li class="page-item prev"><a href="' . get_pagenum_link($prev_page) . '" data-page="' . $prev_page . '" class="page-link">';
            ?>
            <div class="">
            <svg class=" size-20 lg:size-24" preserveAspectRatio="xMidYMax meet" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.5833 6.73315L8.41663 10.8998L12.5833 15.0665" stroke="#131316" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            </div>


            <?php
            echo '<span class="sr-only">Previous</span></a></li>';
        }
    }

    // Dynamic pagination based on current page
    if ($paged == 1) {
        // When on first page: 1 2 ... last
        echo '<li class="active page-item"><a class="page-link">1</a></li>';
        echo '<li class="page-item"><a href="' . get_pagenum_link(2) . '" data-page="2" class="page-link">2</a></li>';
        
        if ($max_page > 3) {
            echo '<li class="page-item ellipsis"><span class="page-link">...</span></li>';
            echo '<li class="page-item"><a href="' . get_pagenum_link($max_page) . '" data-page="' . $max_page . '" class="page-link">' . $max_page . '</a></li>';
        } elseif ($max_page == 3) {
            echo '<li class="page-item"><a href="' . get_pagenum_link(3) . '" data-page="3" class="page-link">3</a></li>';
        }
    } elseif ($paged == $max_page) {
        // When on last page: pre-pre-last pre-last ... last
        if ($max_page > 2) {
            if ($max_page > 3) {
                echo '<li class="page-item"><a href="' . get_pagenum_link($max_page - 2) . '" data-page="' . ($max_page - 2) . '" class="page-link">' . ($max_page - 2) . '</a></li>';
            }
            echo '<li class="page-item"><a href="' . get_pagenum_link($max_page - 1) . '" data-page="' . ($max_page - 1) . '" class="page-link">' . ($max_page - 1) . '</a></li>';
            
            if ($max_page > 3) {
                echo '<li class="page-item ellipsis"><span class="page-link">...</span></li>';
            }
        }
        echo '<li class="active page-item"><a class="page-link">' . $max_page . '</a></li>';
    } else {
        // Middle pages: current current+1 ... last
        echo '<li class="active page-item"><a class="page-link">' . $paged . '</a></li>';
        
        if ($paged < $max_page - 1) {
            echo '<li class="page-item"><a href="' . get_pagenum_link($paged + 1) . '" data-page="' . ($paged + 1) . '" class="page-link">' . ($paged + 1) . '</a></li>';
            echo '<li class="page-item ellipsis"><span class="page-link">...</span></li>';
            echo '<li class="page-item"><a href="' . get_pagenum_link($max_page) . '" data-page="' . $max_page . '" class="page-link">' . $max_page . '</a></li>';
        } else {
            // Special case for second-to-last page
            echo '<li class="page-item"><a href="' . get_pagenum_link($max_page) . '" data-page="' . $max_page . '" class="page-link">' . $max_page . '</a></li>';
        }
    }

    // Next Page
    if ($paged < $max_page) {
        $next_page = $paged + 1;
        echo '<li class="page-item next"><a href="' . get_pagenum_link($next_page) . '" data-page="' . $next_page . '" class="page-link">';
        ?>
            <div class="">
            <svg class="rotate-180 size-20 lg:size-24" preserveAspectRatio="xMidYMax meet" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.5833 6.73315L8.41663 10.8998L12.5833 15.0665" stroke="#131316" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

            </div>


        <?php
        echo '<span class="sr-only">Next</span></a></li>';
    }

    echo '</ul></nav>' . $after;
}

function my_custom_pagination_base() {
    global $wp_rewrite;
    $wp_rewrite->pagination_base = 'strona';
}
add_action('init', 'my_custom_pagination_base', 1);
?>