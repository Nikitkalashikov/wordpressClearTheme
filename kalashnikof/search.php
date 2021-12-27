<?php 
    get_header();

    $s_query = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $_GET["s"]);
?>
     <div class="page page-front">
        <div class="container">
            <h1><?php esc_html_e('Search:', 'kalashnikof');?><?php echo $s_query;?></h1>
            <div class="search">
                <form role="search" method="get" class="search-form" action="/">
                    <input type="search" id="search-form-1" class="search-form__field" placeholder="<?php echo !empty($s_query)?$s_query:'Поиск по сайту';?>" value="<?php echo $s_query;?>" name="s">
                    <button type="submit" class="button">
                        <?php esc_html_e('Search:', 'kalashnikof');?>
                    </button>
                </form>
            </div>
            <div class="search-result">
                <div class="container">
                    <h2><?php esc_html_e('Search results:', 'kalashnikof');?></h2>
                    <?php  if ( have_posts() ) : while ( have_posts() ) : the_post();  ?>
                        <div class="search-result">		
                            <a href="<?php the_permalink(); ?>">
                                <span class="subtitle"><?php the_title();?></span>
                                <?php if ( !empty(get_the_excerpt()) ):?>
                                    <p>
                                        <?php the_excerpt(); ?>
                                    </p>
                                <?php endif; ?>
                            </a>
                        </div>        
                    <?php endwhile; else: ?>
                        <div class="search-result">		
                            <p><?php esc_html_e('Nothing found', 'kalashnikof');?></p>	
                        </div>
                    <?php endif; ?>	
                </div>
            </div>
        </div>
    </div>
<?php 
    get_footer();
