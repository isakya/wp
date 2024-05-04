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
    if(is_user_logged_in()) {
        $professor = sanitize_text_field($data['professorId']); // sanitize_text_field 安全函数，防止XSS攻击
        $existQuery = new WP_Query(array(
            'author' => get_current_user_id(),
            'post_type' => 'like',
            'meta_query' => array(
                array(
                    'key' => 'liked_professor_id',
                    'compare' => '=',
                    'value' => $professor
                )
            )
        ));
        if($existQuery -> found_posts == 0 AND get_post_type($professor) == 'professor') { // 仅限第一次喜欢，并且当前帖子类型为professor的才生效
            return wp_insert_post(array( // 如果插入成功，则返回ID
                'post_type' => 'like',
                'post_status' => 'publish',
                'post_title' => '2nd PHP Test',
                'meta_input' => array(
                    'liked_professor_id' => $professor
                )
            ));
        } else {
            die('Invalid professor id');
        }


    } else {
        die('Only logged in users can create a like.');
    }


}

function deleteLike($data) {
    $likeId = sanitize_text_field($data['like']);
    if(get_current_user_id() == get_post_field('post_author', $likeId) AND get_post_type($likeId) == 'like') {
        wp_delete_post($likeId, true); // true: 指跳过进入垃圾箱的步骤，直接删除
        return 'Congrats, like deleted.';
    } else {
        die('You do not have permission to delete that.');
    }
}