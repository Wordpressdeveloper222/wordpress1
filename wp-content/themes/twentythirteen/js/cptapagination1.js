function cptaajaxPagination2(pnumber,plimit){
	var nth  = pnumber;
	var lmt  = plimit;
	var ajax_url = ajax_params.ajax_url;
	var cpta = jQuery("#post").attr('data-posttype');
	jQuery.ajax({
		url		:ajax_url,
		type	:'post',
		data	:{ 'action':'sidebar','number':nth,'limit':lmt,'cptapost':cpta },
		beforeSend	: function(){
			jQuery("#cptapagination-content").html("<p style='text-align:center;'>Loading please wait...!</p>");
		},
		success :function(pvalue){alert(pvalue);
			jQuery("#cptapagination-content").html(pvalue);
		}
	});
}