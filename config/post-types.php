<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Post Types
    |--------------------------------------------------------------------------
    |
    | Post types to be registered with Extended CPTs
    | <https://github.com/johnbillion/extended-cpts>
    |
    */

    'post_types' => [
        'Allergen' => [
            'menu_icon' => 'dashicons-warning', // Choose an appropriate icon for allergens
            'supports' => ['title', 'thumbnail'],
            'publicly_queryable' => false, // To make sure it's not accessible from the front end
            'show_in_nav_menus' => false, // To make sure it doesn't appear in nav menus
            'names' => [
                'singular' => __('Allergen', 'rollingdonuts'),
                'plural' => __('Allergens', 'rollingdonuts'),
                'slug' => 'allergens',
            ]
        ],
        /*'career' => [
            'menu_icon' => 'dashicons-star-filled',
            'supports' => ['title', 'editor', 'author', 'revisions', 'thumbnail'],
            'show_in_rest' => true,
            'names' => [
                'singular' => __('Career', 'rollingdonuts'),
                'plural' => __('Careers', 'rollingdonuts'),
                'slug' => 'careers',
            ]
        ], */
        'Faq' => [
            'menu_icon' => 'dashicons-star-filled',
            'supports' => ['title', 'editor', 'author', 'revisions', 'thumbnail'],
            'show_in_rest' => true,
            'names' => [
                'singular' => __('Faq', 'rollingdonuts'),
                'plural' => __('Faqs', 'rollingdonuts'),
                'slug' => 'faq',
            ]
        ],
        'Location' => [
            'menu_icon' => 'dashicons-star-filled',
            'supports' => ['title', 'editor', 'author', 'revisions', 'thumbnail'],
            'show_in_rest' => true,
            'publicly_queryable' => false, // Add this line to make it not publicly viewable
            'names' => [
                'singular' => __('Location', 'rollingdonuts'),
                'plural' => __('Locations', 'rollingdonuts'),
                'slug' => 'locations',
            ]
        ],
        'Testimonial' => [
            'menu_icon' => 'dashicons-star-filled',
            'supports' => ['title', 'editor', 'author', 'revisions', 'thumbnail'],
            'show_in_rest' => true,
            'names' => [
                'singular' => __('Testimonial', 'rollingdonuts'),
                'plural' => __('Testimonials', 'rollingdonuts'),
                'slug' => 'testimonials',
            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Taxonomies
    |--------------------------------------------------------------------------
    |
    | Taxonomies to be registered with Extended CPTs library
    | <https://github.com/johnbillion/extended-cpts>
    |
    */

    'taxonomies' => [
        'career_category' => [
            'post_types' => ['career'],
            'meta_box' => 'radio',
            'names' => [
                'singular' => __('Category', 'rollingdonuts'),
                'plural' => __('Categories', 'rollingdonuts'),
            ],
        ],
        'rd_product_type' => [
            'post_types' => ['product'],
            'meta_box' => 'dropdown',
            'names' => [
                'singular' => __('Product Type', 'rollingdonuts'),
                'plural' => __('Product Types', 'rollingdonuts'),
                'slug' => 'product-type',
            ],
        ],
    ],
];
