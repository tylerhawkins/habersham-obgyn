!(function($){
	"use strict";

	/**
	* roTab
	*/
	function roTab(elem, opts) {
		this.elem = $(elem);
		this.opts = $.extend({

		}, opts);

		this.init();
	}

	roTab.prototype.init = function() {
		var $tab_label = this.elem.find('[data-ro-tab-id]');

		$tab_label.each(function() {
			$(this).on('click', function(e){
				e.preventDefault();

				var tab_id = $(this).data('ro-tab-id');
				$(this).addClass('current').siblings().removeClass('current');
				$(tab_id).addClass('current').siblings().removeClass('current');
			})
		})
	}

	$.fn.roTab = function(opts) {
		return $(this).each(function() {

			new roTab(this, opts);
		})
	}

	/**
	* roModal
	*/
	$.fn.roModal = function(opts) {
		return $(this).each(function() {

			var self = $(this);
			/* loading */
			self.on('loading', function() {
				self.addClass('loading');
			})

			/* open */
			self.on('open', function() {
				self.removeClass('loading').addClass('open');
			})

			/* close */
			self.on('close', function() {
				self.removeClass('open');
				self.find('.ro-modal-inner').html('');
			})

			/* close when click back wrapper */
			self.on('click', function(e) {
				if($(e.target).hasClass('ro-modal-wrapper'))
					self.trigger('close');
			})

			/* close when click btn close */
			self.on('click', '[data-ro-modal-close]', function(e) {
				self.trigger('close');
			})

			/* toggle */
			self.on('toggle', function() {
				if(self.hasClass('open')) {
					self.trigger('close');
				}else {
					self.trigger('open');
				}
			})

			/* callback */
			var callback = self.data('callback');
			if(callback)
				callback.call(this, self);

		})
	}

	/**
	* roSticker
	*/
	$.roSticker = function(mess, status) {
		var status_icon = {
			loading: '<i style=\'color:#FFF\' class=\'fa fa-spinner fa-spin\'></i>',
			success: '<i style=\'color:#89B353\' class="fa fa-check"></i>',
			warning: '<i style=\'color:#FFD800\' class=\'fa fa-exclamation\'></i>',
		};

		var sticker_el = $('<div>', {class: 'ro-sticker', html: status_icon[status] + ' ' + mess});
		$('body').append(sticker_el);

		/* open */
		sticker_el.addClass('zs-open');

		/* update */
		sticker_el.on('update', function() {
			var new_mess = $(this).data('mess'),
				new_status = $(this).data('status');

			$(this).html( status_icon[new_status] + ' ' + new_mess );
		})

		/* close */
		sticker_el.on('close', function() {
			$(this)
			.addClass('zs-close')
			.delay(300)
			.queue(function() {
				$(this).dequeue();
				$(this).remove();
			})
		})

		return sticker_el;
	}

	var ro_plg = {
		init: function() {
			/* tab */
			$('[data-ro-tab]').roTab();
			/* modal */
			$('.ro-modal').roModal();
		}
	};

	$(function() {
		ro_plg.init();
	})
})(jQuery)
