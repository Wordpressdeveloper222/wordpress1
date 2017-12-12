/*
*  Flexible Content
*
*  @description: 
*  @since: 3.5.8
*  @created: 17/01/13
*/

(function($){
	
	/*
	*  Vars
	*
	*  @description: 
	*  @since: 3.6
	*  @created: 30/01/13
	*/
	
	acf.fields.flexible_content = {
		add_sortable : function(){},
		update_order : function(){},
		add_layout : function(){},
		remove_layout : function(){}
	}
	
	
	var _flex = acf.fields.flexible_content;
	
	
	/*
	*  Add Sortable
	*
	*  @description: 
	*  @since: 3.5.8
	*  @created: 17/01/13
	*/
	
	_flex.add_sortable = function( div )
	{
		
		// remove (if clone) and add sortable
		div.children('.values').children('.area').unbind('sortable').sortable({
			// items : '> .layout',
			connectWith : '.values .area',
			handle : '> .menu-item-handle',
			// placeholder: 'placeholder',
			forceHelperSize : true,
			forcePlaceholderSize : true,
			scroll : true,
			start : function (event, ui) {
			
				$(document).trigger('acf/sortable_start', ui.item);
				$(document).trigger('acf/sortable_start_flex', ui.item);
        		
   			},
   			stop : function (event, ui) {
			
				$(document).trigger('acf/sortable_stop', ui.item);
				$(document).trigger('acf/sortable_stop_flex', ui.item);
				
				// update order numbers				
				_flex.update_order( div );
   			}
		});
		
	};
	
	
	/*
	*  Update Order
	*
	*  @description: 
	*  @since: 3.5.8
	*  @created: 17/01/13
	*/
	
	_flex.update_order = function( div )
	{
		div.find('> .values .layout').each(function(i){
			// $(this).find('> .menu-item-handle .fc-layout-order').html(i+1);

			var el_area = 1;
			if ( $(this).parents('.area').hasClass('box-full') ){ el_area = 1; }
			if ( $(this).parents('.area').hasClass('box-content') ){ el_area = 2; }
			console.log( el_area );

			$(this).find('.acf-input-table .widefat.acf_input tr:first-child td input').val( el_area );
		});

	
	};
	
	
	/*
	*  Add Layout
	*
	*  @description: 
	*  @since: 3.5.8
	*  @created: 17/01/13
	*/
	
	_flex.add_layout = function( layout, div )
	{
		// vars
		var new_id = acf.helpers.uniqid(),
			new_field_html = div.find('> .clones > .layout[data-layout="' + layout + '"]').html().replace(/(=["]*[\w-\[\]]*?)(acfcloneindex)/g, '$1' + new_id),
			new_field = $('<div class="layout" data-toggle="closed" data-layout="' + layout + '"></div>').append( new_field_html );
			

		// hide no values message
		div.children('.no_value_message').hide();
		
		
		// add row
		div.children('.values').children('.area.active').append(new_field);
		
		// Set Value by Area
		var el_area = 1;
		if ( div.children('.values').find('.area.active').hasClass('box-full') ){ el_area = 1; }
		if ( div.children('.values').find('.area.active').hasClass('box-content') ){ el_area = 2; }

		div.children('.values').find('.area.active .acf-input-table .widefat.acf_input tr:first-child td input').val( el_area );
		
		
		// acf/setup_fields
		$(document).trigger('acf/setup_fields',new_field);
		
		
		// update order numbers
		_flex.update_order( div );
		
		
		// validation
		div.closest('.field').removeClass('error');
	}
	
	
	/*
	*  Remove Layout
	*
	*  @description: 
	*  @since: 3.5.8
	*  @created: 17/01/13
	*/
	
	_flex.remove_layout = function( layout )
	{
		// vars
		var div = layout.closest('.acf_flexible_content');
		var temp = $('<div style="height:' + layout.height() + 'px"></div>');
		
		
		// animate out tr
		layout.addClass('acf-remove-item');
		setTimeout(function(){
			
			layout.before(temp).remove();
			
			temp.animate({'height' : 0 }, 250, function(){
				temp.remove();
			});
		
			if( !div.children('.values').children('.layout').exists() )
			{
				div.children('.no_value_message').show();
			}
			
		}, 400);
		
	}
	
	
	/*
	*  acf/setup_fields
	*
	*  @description: 
	*  @since: 3.5.8
	*  @created: 17/01/13
	*/
	
	$(document).live('acf/setup_fields', function(e, postbox){
		
		$(postbox).find('.acf_flexible_content').each(function(){
			
			var div =  $(this);

			// sortable
			_flex.add_sortable( div );
			
			
			// set column widths
			$(div).find('.layout').each(function(){
				acf.fields.repeater.set_column_widths( $(this) );
			});
			
			
		});



		function sidebar_toggle(opt){
			if ( $('.area.box-content').length ) {

				if (opt == 'on') {
					$('.area.box-content').removeClass('sidebar-off').addClass('sidebar-on');
					$('.area-x.box-sidebar').removeClass('sidebar-off').addClass('sidebar-on');
				} else {
					$('.area.box-content').removeClass('sidebar-on').addClass('sidebar-off');
					$('.area-x.box-sidebar').removeClass('sidebar-on').addClass('sidebar-off');
				}
			}
		}

		if ( $('#acf-field-page_sidebar-page_sidebar_on').is(':checked') ) { sidebar_toggle('on'); }
		if ( $('#acf-field-page_sidebar-page_sidebar_off').is(':checked') ) { sidebar_toggle('off'); }
		
		$('#acf-field-page_sidebar-page_sidebar_on').click( function(){
			if ( $(this).is(':checked') ) {
				$(this).prop('checked', false);
				sidebar_toggle('off');
			}
			if ( !$(this).is(':checked') ) {
				$(this).prop('checked', true);
				sidebar_toggle('on');
			}
		});
		$('#acf-field-page_sidebar-page_sidebar_off').click( function(){
			if ( $(this).is(':checked') ) {
				$(this).prop('checked', false);
				sidebar_toggle('on');
			}
			if ( !$(this).is(':checked') ) {
				$(this).prop('checked', true);
				sidebar_toggle('off');
			}
		});

		$('.acf_flexible_content .values').show('fast');
		
	});


	/*
	*  Show / Hide popup
	*
	*  @description: 
	*  @since: 3.5.8
	*  @created: 17/01/13
	*/
	
	$('.acf_flexible_content .flexible-footer .add-row-end').live('click', function()
	{
		$(this).trigger('focus');
		
	}).live('focus', function()
	{
		$(this).siblings('.acf-popup').addClass('active');
		
	}).live('blur', function()
	{
		var button = $(this);
		setTimeout(function(){
			button.siblings('.acf-popup').removeClass('active');
		}, 250);
		
	});
	
	
	/*
	*  Delete Layout Button
	*
	*  @description: 
	*  @since: 3.5.8
	*  @created: 17/01/13
	*/
	
	$('.acf_flexible_content .fc-delete-layout').live('click', function(){
	
		var layout = $(this).closest('.layout');
		
		_flex.remove_layout( layout );
		
		return false;
	});
	
	
	/*
	*  Add Layout Button
	*
	*  @description: 
	*  @since: 3.5.8
	*  @created: 17/01/13
	*/
	
	$('.acf_flexible_content .acf-popup ul li a').live('click', function(){

		var layout = $(this).attr('data-layout'),
			div = $(this).closest('.acf_flexible_content');
		
		_flex.add_layout( layout, div );
		
		return false;
		
	});
	
	
	/*
	*  Hide Show Flexible Content
	*
	*  @description: 
	*  @since 3.5.2
	*  @created: 11/11/12
	*/
	
	$('.acf_flexible_content .layout .menu-item-handle').live('click', function(){
		
		// vars
		var layout = $(this).closest('.layout');
		
		
		if( layout.attr('data-toggle') == 'closed' )
		{
			layout.attr('data-toggle', 'open');
			layout.children('.acf-input-table').show();
		}
		else
		{
			layout.attr('data-toggle', 'closed');
			layout.children('.acf-input-table').hide();
		}
			
	});



	/*
	*  Custom Active Area
	*
	*  @description: 
	*  @since 3.5.2 + TM
	*  @created: 15/02/14
	*/
	
	$('.values .area').live('click', function(){
		
		$('.values .area').removeClass('active');
		$(this).addClass('active');
			
	});
	

})(jQuery);