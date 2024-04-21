<?php

get_header();

while (have_posts()) {
    the_post();
    pageBanner();
    ?>


    <div class="container container--narrow page-section">
        <?php
        $theParent = wp_get_post_parent_id(get_the_ID());
        if ($theParent) { ?>
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); ?>"><i
                                class="fa fa-home" aria-hidden="true"></i> Back
                        to <?php echo get_the_title($theParent); ?></a> <span
                            class="metabox__main"><?php echo the_title(); ?></span></p>
            </div>
            <?php
        }
        ?>

        <?php
        $testArray = get_pages(array( // 获取内存中该page的子级page
            'child_of' => get_the_ID()
        ));
        // 判断是否有子集文章
        if ($theParent or $testArray) { ?>
            <div class="page-links">
                <h2 class="page-links__title"><a
                            href="<?php echo get_permalink($theParent) ?>"><?php echo get_the_title($theParent) ?></a>
                </h2>
                <ul class="min-list">

                    <?php
                    if ($theParent) { // 如果存在父级，获取父ID
                        $findChildrenOf = $theParent;
                    } else { // 如果不存在父级，则自身就为父级，获自身ID
                        $findChildrenOf = get_the_ID();
                    }

                    wp_list_pages(array( // 陈列子级文章相关信息
                        'title_li' => NULL, // 不要标题
                        'child_of' => $findChildrenOf, // 传入父级id
                        'sort_column' => 'menu_order' // 排序方式
                    )) ?>
                    <!--            <li class="current_page_item"><a href="#">Our History</a></li>-->
                    <!--            <li><a href="#">Our Goals</a></li>-->
                </ul>
            </div>
        <?php } ?>

        <div class="generic-content">
            <?php the_content(); ?>
        </div>

    </div>

<?php }

get_footer();

?>