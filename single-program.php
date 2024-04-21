<?php
get_header();
while (have_posts()) {
    the_post();
    pageBanner();
    ?>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program') ?>">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    All Programs
                </a>
                <span class="metabox__main">
                    <?php the_title(); ?>
                </span>
            </p>
        </div>
        <div class="generic-content"><?php the_field('main_body_content'); ?></div>
        <?php
        $relatedProfessors = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => 'professor',
            'orderby' => 'title', // 指定自定义排序字段
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'related_programs',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID() . '"'
                )
            )
        ));


        if ($relatedProfessors->have_posts()) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professors</h2>';
            echo '<ul class="professor-cards">';
            while ($relatedProfessors->have_posts()) {
                $relatedProfessors->the_post(); ?>
                <li class="professor-card__list-item">
                    <a class="professor-card" href="<?php the_permalink(); ?>">
                        <img alt="" class="professor-card_image" src="<?php the_post_thumbnail_url('professorLandscape'); ?>">
                        <span class="professor-card__name"><?php the_title() ?></span>
                    </a>
                </li>
            <?php }
            echo '</ul>';
        }


        wp_reset_postdata(); // 重置查询时的劫持对象，恢复页面原有数据，这样使用the_ID()之类的方法就可以获取页面的数据，而不是上一个查询数据


        $today = date('Ymd');
        $homepageEvents = new WP_Query(array(
            'posts_per_page' => 2,
            'post_type' => 'event',
            'meta_key' => 'event_date', // 指定自定义排序字段
            'orderby' => 'meta_value_num', // 设置自定义排序值 meta_value -> 字符串、 meta_value_num -> 数值
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'numeric'
                ),
                array(
                    'key' => 'related_programs',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID() . '"'
                )
            )
        ));

        if ($homepageEvents->have_posts()) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">Upcomming ' . get_the_title() . ' Events</h2>';
            while ($homepageEvents->have_posts()) {
                $homepageEvents->the_post();
                get_template_part('template-parts/content-event');
            }
        }

        wp_reset_postdata();
        $relatedCampuses = get_field('related_campus');

        if($relatedCampuses) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">' . get_the_title() . ' is Available At These Campuses:</h2>';

            echo '<ul class="min-list link-list">';
            foreach($relatedCampuses as $campus) {?>
                    <li><a href="<?php echo get_the_permalink($campus); ?>"><?php echo get_the_title($campus) ?></a></li>
                     <?php
            }
            echo '</ul>';
        }
        ?>
    </div>

<?php }
get_footer();
?>