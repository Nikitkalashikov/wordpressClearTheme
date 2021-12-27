</div>
<footer class="footer">   
    <div class="container">
        <div class="footer__top">
            <div class="footer__menu">
                <p class="footer__subtitle"><?php esc_html_e('Контакты', 'kalashnikof');?></p>
                <ul>
                    <li><?php echo get_option('address');?></li>
                    <li><a href="tel:<?php echo get_option('phone');?>"><?php echo get_option('phone');?></a></li>
                    <li><a href="mailto:<?php echo get_option('mail');?>"><?php echo get_option('mail');?></a></li>
                </ul>
            </div>
        </div>
        <div class="footer__middle">
            <p class="copyright">
                <?php echo date('Y');?> &copy;<?php esc_html_e('Copyright company', 'kalashnikof');?>
            </p>
            <div class="footer__contacts">
                <a href="/politika-konfidencialnosti/" class="footer__elem"><?php esc_html_e('Политика конфиденциальности', 'kalashnikof');?></a>
                <a href="/sitemap/" class="footer__elem"><?php esc_html_e('Карта сайта', 'kalashnikof');?></a>
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
            <div class="info-panel">
                <p><?php esc_html_e('Мы используем файлы cookie. Оставаясь на сайте, вы соглашаетесь с <a href="/politika-konfidencialnosti/" target="_blank">политикой конфиденциальности</a>', 'kalashnikof');?></p>
                <button class="info-panel__close"></button>
            </div>
        </div>
    </div>
</footer>
</div>
<div id="example-form" class="form form_popup">
    <div class="form__inner">
        <h3 class="form__title"><?php esc_html_e('Присоединяйтесь в качестве партнера', 'kalashnikof');?></h3>
        <p class="form__subtitle"><?php esc_html_e('Оставьте заявку, мы перезвоним в ближайшее время', 'kalashnikof');?></p>
        <?php echo do_shortcode('[example-form]');?>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>