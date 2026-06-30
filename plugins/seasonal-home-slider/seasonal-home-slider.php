<?php
/**
 * Plugin Name: Seasonal Home Slider
 * Description: Automatically swaps the Avada/Fusion home slider by season.
 * Version: 1.3.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return current season using fixed meteorological seasons.
 */
if (!function_exists('shs_get_current_season')) {
    function shs_get_current_season() {
        $month = (int) current_time('n');

        if (in_array($month, array(3, 4, 5), true)) {
            return 'spring';
        }

        if (in_array($month, array(6, 7, 8), true)) {
            return 'summer';
        }

        if (in_array($month, array(9, 10, 11), true)) {
            return 'fall';
        }

        return 'winter';
    }
}

/**
 * Map seasons to Avada/Fusion Slider names.
 *
 * These names must exactly match the slider names in Avada.
 */
if (!function_exists('shs_get_seasonal_slider_name')) {
    function shs_get_seasonal_slider_name() {
        $season = shs_get_current_season();

        $slider_names = array(
            'spring' => 'home-spring',
            'summer' => 'home-summer',
            'fall'   => 'home-fall',
            'winter' => 'home-winter',
        );

        return isset($slider_names[$season]) ? $slider_names[$season] : 'home';
    }
}

/**
 * Build a shortcode string from tag + attributes.
 */
if (!function_exists('shs_build_shortcode')) {
    function shs_build_shortcode($tag, $attrs) {
        $parts = array();

        if (is_array($attrs)) {
            foreach ($attrs as $key => $value) {
                // Numeric shortcode attributes are rare here, but preserve them safely.
                if (is_numeric($key)) {
                    $parts[] = esc_attr($value);
                } else {
                    $parts[] = sanitize_key($key) . '="' . esc_attr($value) . '"';
                }
            }
        }

        return '[' . $tag . ' ' . implode(' ', $parts) . ']';
    }
}

/**
 * Intercept Avada/Fusion Slider shortcodes before they render.
 *
 * This only changes sliders named exactly "home".
 */
if (!function_exists('shs_intercept_avada_slider_shortcode')) {
    function shs_intercept_avada_slider_shortcode($return, $tag, $attr, $m) {
        static $already_swapping = false;

        if ($already_swapping) {
            return $return;
        }

        $supported_tags = array(
            'fusion_slider',
            'fusionslider',
            'fusion_fusionslider',
        );

        if (!in_array($tag, $supported_tags, true)) {
            return $return;
        }

        if (!is_array($attr)) {
            return $return;
        }

        if (!isset($attr['name'])) {
            return $return;
        }

        if (trim($attr['name']) !== 'home') {
            return $return;
        }

        $attr['name'] = shs_get_seasonal_slider_name();

        $shortcode = shs_build_shortcode($tag, $attr);

        $already_swapping = true;
        $output = do_shortcode($shortcode);
        $already_swapping = false;

        return $output;
    }
}

add_filter('pre_do_shortcode_tag', 'shs_intercept_avada_slider_shortcode', 10, 4);