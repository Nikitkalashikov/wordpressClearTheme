<?php
    get_header();
?>
    <div class="page page-taxonomy">
        <div class="page__head">
            <div class="container">
                <h1><?php esc_html_e('Archive example', 'kalashnikof');?></h1>
                <?php 
                    if ( function_exists('yoast_breadcrumb') ) {
                        echo '<div class="breadcrumbs banner__breadcrumbs">';
                            yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                        echo '</div>';
                    }
                ?>
            </div>
        </div>

        <div class="page__content">
            <div class="container">
                <?php 
                    $example_args = array(
                        'publish' => true,
                        'post_per_page' => -1
                    );

                    $example_query = new WP_Query( $example_args );
                        
                if ( $example_query->have_posts() ) :
                    echo '<div class="posts">';
                        while( $example_query->have_posts() ) :
                            $example_query->the_post();
                            ?>
                                <a class="post" href="<?php echo get_the_permalink(get_the_ID());?>">
                                    <p class="post__title"><?php echo get_the_title();?></p>
                                </a> 
                            <?php
                        endwhile;
                    echo '</div>';
                ?>
                    <?php
                        if ( !empty($pagination_args) ):
                    ?>
                        <div id="pagination" class="pagination">
                            <?php
                                echo paginate_links($pagination_args);
                            ?>
                        </div>
                    <?php        
                        endif;
                    ?>
                <?php 
                    else :
                        echo '<div id="post-empty" class="post-empty">';
                            echo '<p>Курсы не найдены</p>';
                        echo '</div>';
                    endif;
                ?>
            </div>
        </div>
    </div>
<?php get_footer();