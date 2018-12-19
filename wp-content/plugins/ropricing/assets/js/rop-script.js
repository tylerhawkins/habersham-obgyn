!(function($) {
	"use strict";

	var ro_pricing = {
		init: function() {
			/* Checkout */
			$('[data-post-pricing]').on( 'click', this.checkout );

			/* Process Checkout */
			$('[data-rop-checkout]').on( 'click', this.process );
		},
		checkout: function( e ){

			/* START Mess */
			var $sticker = $.roSticker('Loading...', 'loading');
			/* END Mess */

			var post_id = $(this).data('post-pricing'),
				data = 'post_id='+post_id,
				task = 'rop_checkout';

			$.ajax({
				type:		'POST',
				url:		rop_object.ajax_url,
				data: 		data+'&action='+task,
				success:	function( result ) {
					var obj = JSON.parse(result);
					window.location.href = obj.redirect;

					/* START Mess */
					$sticker.data({mess: 'Success.', status: 'success'}).trigger('update')
					setTimeout(function(){
						$sticker.trigger('close');
					}, 1000)
                    return false;
					/* END Mess */
				}
			})
		},
		process: function( e ){

			/* START Mess */
			var $sticker = $.roSticker('Loading...', 'loading');
			/* END Mess */

			var data = '',
				task = 'rop_process_checkout';

			$.ajax({
				type:		'POST',
				url:		rop_object.ajax_url,
				data: 		data+'&action='+task,
				success:	function( result ) {
					var obj = JSON.parse(result);
					if(obj.result == 'success' && obj.redirect!=''){
						window.location.href = obj.redirect;
						return false;
					}else{
						/*show error*/
						var html = '<div class="rop-table-error"><div class="alert alert-warning" role="alert"><ul>';
							html+='<li>'+obj.result+'</li>';
						html+='</ul></div></div>';
						$( "div.rop-checkout" ).prepend( html );
						$sticker.trigger('close');
						return false;
					}

					/* START Mess */
					$sticker.data({mess: 'Success.', status: 'success'}).trigger('update')
					setTimeout(function(){
						$sticker.trigger('close');
					}, 1000)
					/* END Mess */
				}
			})
		},
	}
	$(function() {
		ro_pricing.init();
	})
})(jQuery)
