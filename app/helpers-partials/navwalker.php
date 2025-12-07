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
            $item_output .= ' <span class="indicator"><svg class="size-14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14 7C14 3.13409 10.8659 -1.36995e-07 7 -3.0598e-07C3.13409 -4.74964e-07 8.16679e-07 3.13409 6.47695e-07 7C4.7871e-07 10.8659 3.13409 14 7 14C10.8659 14 14 10.8659 14 7ZM1.16668 7C1.16668 3.77841 3.77841 1.16668 7 1.16668C10.2216 1.16668 12.8333 3.77841 12.8333 7C12.8333 10.2216 10.2216 12.8333 7 12.8333C3.77841 12.8333 1.16668 10.2216 1.16668 7Z" fill="#71849A"/>
<path d="M10.3291 6.24581C10.557 6.01801 10.557 5.64865 10.3291 5.42085C10.1013 5.19305 9.73199 5.19305 9.50419 5.42085L6.99999 7.92505L4.4958 5.42085C4.268 5.19305 3.89864 5.19305 3.67084 5.42085C3.44304 5.64865 3.44304 6.01801 3.67084 6.24581L6.58751 9.16249C6.81531 9.39029 7.18467 9.39029 7.41247 9.16249L10.3291 6.24581Z" fill="#71849A"/>
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
