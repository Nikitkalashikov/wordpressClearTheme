<?php
    /*
    * Template Name: Контакты
    */

    get_header();
?>
    <div class="page page-contacts">
        <div class="container">
            <h1><?php esc_html_e('Contacts', 'kalashnikof');?></h1>
            <div class="content">
                <?php echo get_the_content();?>
            </div>
        </div>
    </div>
<?php
    get_footer();
?>