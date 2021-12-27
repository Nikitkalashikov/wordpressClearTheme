<?php
    get_header();
?>
    <div class="page page-taxonomy">
        <div class="container">
            <h1><?php esc_html_e('Taxonomy', 'kalashnikof');?></h1>
            <div class="content">
                <?php echo get_the_content();?>
            </div>
        </div>
    </div>
<?php
    get_footer();