!(function($) {
	"use strict";

	var ROP = {
		init: function() {

			/*Check all list order*/
			$("#order-checkAll").change(function () {
				$("input:checkbox").prop('checked', $(this).prop("checked"));
			});

			/*checkbox setting page*/
			$('.rop-container-setting input[type="checkbox"]').on('click',function(){
				var value = $(this).val();
				if(value==1){$(this).val(0);}
				else{$(this).val(1);}
			})

			/*List order calendar*/
			$('#orders-filter-date').datetimepicker({
				timepicker:false,
				formatDate: rop_admin_object.formatdate,
				scrollMonth: false,
				format: rop_admin_object.formatdate
			});

			/*
			**Filter orders
			*/
			$('.orders-filter-button').on('click', function(e) {
				var date = $('#orders-filter-date').datetimepicker('getValue').val(),
					url  = window.location.href.split('&date=')[0],
					str = $.param({ "date": date }),
					link = url;
				if( date != '' ){
					link = url+'&'+str;
				}
				window.location.href = link;
			});
		}
	};

	$(function() {
		ROP.init();
	})
})(jQuery)
