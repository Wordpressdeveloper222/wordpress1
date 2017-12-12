<form action="<?php echo home_url(); ?>/" class="searchform" method="get">
	<button class="search-button"><i class="icon-search"></i></button>
	<input type="text" name="s" value="<?php _e('Search', MAHA_TEXT_DOMAIN); ?>" onfocus="if(this.value=='<?php _e('Search', MAHA_TEXT_DOMAIN); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Search', MAHA_TEXT_DOMAIN); ?>';" autocomplete="off" />
</form>