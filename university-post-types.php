<?php

// mu-plugins: wp必开插件文件包

function university_post_types()
{
    //    Campus post type
    register_post_type('campus', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array('slug' => 'campuses'),
        'has_archive' => true,
        'public' => true, // 显示posts
        'labels' => array(
            'name' => 'Campuses', // 自定义名称
            'add_new_item' => 'Add New Campus',
            'edit_item' => 'Edit Campus',
            'all_items' => 'All Campuses',
            'singular_name' => 'Campus'
        ),
        'menu_icon' => 'dashicons-location-alt' // 自定义icon
    ));
//    event post type
    register_post_type('event', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array('slug' => 'events'),
        'has_archive' => true,
        'public' => true, // 显示posts
        'labels' => array(
            'name' => 'Events', // 自定义名称
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        ),
        'menu_icon' => 'dashicons-calendar' // 自定义icon
    ));

//    Program Post Type
    register_post_type('program', array(
        'show_in_rest' => true,
        'supports' => array('title'),
        'rewrite' => array('slug' => 'programs'),
        'has_archive' => true,
        'public' => true, // 显示posts
        'labels' => array(
            'name' => 'Programs', // 自定义名称
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program'
        ),
        'menu_icon' => 'dashicons-awards' // 自定义icon
    ));

//    Professor Post Type
    register_post_type('professor', array(
        'show_in_rest' => true, // 可以用rest api进行检索 但需要 siteUrl/wp-json/wp/v2/professor url才能获取数据
        'supports' => array('title', 'editor', 'thumbnail'),
        'public' => true, // 显示posts
        'labels' => array(
            'name' => 'Professors', // 自定义名称
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professors',
            'singular_name' => 'Professor'
        ),
        'menu_icon' => 'dashicons-welcome-learn-more' // 自定义icon
    ));
}

add_action('init', 'university_post_types');