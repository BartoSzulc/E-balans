<?php
class Custom_Nav_Walker extends Walker_Nav_Menu {
    private $current_data_attribute = '';
    
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
    
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'menu-depth-' . $depth;  // Add depth-specific class
    
        $has_children = in_array('menu-item-has-children', $classes);
        
        // Add group class specifically to depth-1 items (submenu items)
        if ($depth == 1) {
            $classes[] = 'group';
        }
    
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
    
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
    
        if ($has_children) {
            $first_child_title = strtolower(str_replace(' ', '-', $item->title));
            $class_names .= ' data-attribute="' . esc_attr($first_child_title) . '"';
            $this->current_data_attribute = esc_attr($first_child_title);
        }
    
        $output .= $indent . '<li' . $id . $class_names .'>';  // Starting <li> tag
    
        $atts = array(
            'title'  => !empty($item->attr_title) ? $item->attr_title : '',
            'target' => !empty($item->target)     ? $item->target     : '',
            'rel'    => !empty($item->xfn)        ? $item->xfn        : '',
            'href'   => !empty($item->url)        ? $item->url        : '#',  // Use '#' for items with children
        );
    
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
    
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
    
        $item_output = $args->before;


        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . '<span>' . apply_filters('the_title', $item->title, $item->ID) . '</span>' . $args->link_after;


        $item_output .= '</a>';

        if ($has_children) {
            // Place the indicator here, but outside the <a> tag
            $item_output .= ' <span class="indicator"><svg class="size-12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M6.86603 10.5C6.48112 11.1667 5.51887 11.1667 5.13397 10.5L1.66987 4.5C1.28497 3.83333 1.7661 3 2.5359 3L9.4641 3C10.2339 3 10.715 3.83333 10.3301 4.5L6.86603 10.5Z" fill="#124797"/>
</svg>
            </span>';
        }

        // Add the indicator div for submenu items
      
    
        $item_output .= $args->after;
    
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu depth-$depth\" data-attribute=\"{$this->current_data_attribute}\">\n";
    }

    // Modify the end of the submenu to display two columns
    function end_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";

        if ($depth === 0) {
            // For top-level submenus, wrap them in a two-column layout
            $output = preg_replace('/<ul class="sub-menu/', '<ul class="sub-menu two-columns"', $output);
        }
    }
}
