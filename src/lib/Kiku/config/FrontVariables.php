<?php

class FrontVariables {
    public function __construct() {
    }

    // Global javaScript variables
    public function output_variables() {
        $vars = [
            'per_page' => $this->get_per_page(),
            'paged' => $this->get_paged(),
            'page_type' => $this->get_post_type(),
            'page_id' => $this->get_page_id(),
            'categories_exclude' => $this->get_categories_exclude(),
            'category' => $this->get_category_id(),
            'category_name' => $this->get_category_name(),
            'search' => $this->get_search_query(),
            'tag' => $this->get_tag_id(),
            'tag_name' => $this->get_tag_name(),
        ];
        $vars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);

        echo '<script>';
        echo 'var WP = '. $vars;
        echo '</script>'. PHP_EOL;
    }

    private function get_per_page() {
        if (is_singular()) {
            return null;
        }
        return (int)get_option('posts_per_page');
    }

    private function get_paged() {
        if (is_singular()) {
            return null;
        }
        $paged = (int)get_query_var('paged');
        return $paged ? $paged : 1;
    }

    private function get_post_type() {
        if (!is_singular()) {
            return null;
        }
        $page_type = get_post_type();

        if ($page_type) {
            $page_type .= 's';
        }

        return $page_type;
    }

    private function get_page_id() {
        if (!is_singular()) {
            return null;
        }
        return get_the_ID();
    }

    private function get_categories_exclude() {
        if (!is_front_page()) {
            return null;
        }
        $exclude_category = (int)get_option('kiku_exclude_category_frontpage');
        return $exclude_category ? $exclude_category : 0;
    }

    private function get_category_id() {
        if (!is_category()) {
            return null;
        }
        return get_query_var('cat');
    }

    private function get_category_name() {
        if (!is_category()) {
            return null;
        }
        return get_query_var('category_name');
    }

    private function get_search_query() {
        if (!is_search()) {
            return null;
        }
        return get_query_var('s');
    }

    private function get_tag_id() {
        if (!is_tag()) {
            return null;
        }
        return get_query_var('tag_id');
    }

    private function get_tag_name() {
        if (!is_tag()) {
            return null;
        }
        return get_query_var('tag');
    }
}

$fv = new FrontVariables();
add_action('wp_head', [$fv, 'output_variables']);