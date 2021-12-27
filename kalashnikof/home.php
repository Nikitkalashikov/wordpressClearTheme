<?php
    get_header();
?>
    <div class="page page-home">
        <div class="page__head">
            <div class="container">
                <h1><?php esc_html_e('Home example', 'kalashnikof');?></h1>
                <?php 
                    if ( function_exists('yoast_breadcrumb') ) {
                        echo '<div class="breadcrumbs banner__breadcrumbs">';
                            yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
<?php 
    get_footer();