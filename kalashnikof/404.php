<?php get_header();?>
	<section class="page page-error-404 page-not-found">
		<div class="page__head">
			<div class="container">
				<h1 class="block-focus__title"><?php echo esc_html_e('Хм, похоже такой страницы не существует', 'kalashnikof');?></h1>
				<p class="block-focus__desc"><?php echo esc_html_e('Возможно вы не правильно указали адрес страницы или её больше не существует.', 'kalashnikof');?></p>
			</div>
		</div>
		<div class="container">
			<div class="content">
				<h2><?php echo esc_html_e('Воспользуйтесь поиском, кто ищет, тот всегда находит', 'kalashnikof');?></h2>
				<div class="search-block search-block_full">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</section>
<?php get_footer();