<?php $unique_id = esc_attr( itcomgk_unique_id( 'search-form-' ) ); ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<button type="submit" class="search-form__button">
		<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
			<path id="ic_zoom_out_24px" d="M15.15,13.692h-.768l-.272-.262a6.327,6.327,0,1,0-.68.68l.262.272v.768L18.552,20,20,18.552Zm-5.832,0a4.374,4.374,0,1,1,4.374-4.374A4.368,4.368,0,0,1,9.318,13.692Z" transform="translate(-3 -3)"/>
		</svg>
	</button>
	<input type="search" id="<?php echo $unique_id; ?>" class="search-form__field" placeholder="Поиск по сайту" value="<?php echo get_search_query(); ?>" name="s" />
</form>
