<?php

add_action('rest_api_init', 'universityLikeRoutes');

function universityLikeRoutes() {
    register_rest_route('university/v1', 'manageLike', array(
        'methods' => 'POST',
        'callback' => 'createLike'
    ));

    register_rest_route('university/v1', 'manageLike', array(
       'methods' => 'DELETE',
       'callback' => 'deleteLike'
    ));
}

function createLike($data) {
    $professor = sanitize_text_field($data['professorId']); // sanitize_text_field 安全函数，防止XSS攻击

    wp_insert_post(array(
        'post_type' => 'like',
        'post_status' => 'publish',
        'post_title' => '2nd PHP Test',
        'meta_input' => array(
            'liked_professor_id' => $professor
        )
    ));
}

function deleteLike() {

}