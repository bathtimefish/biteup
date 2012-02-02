(function($) {
	$.fn.subwindow = function(option) {
	alert("hoge");
		var settings = $.extend({
			option: null,
			width: 400,
			height: 300,
			close: 'close'
		}, option);

		if ($('div#subwindow').length == 0) {
			$('body').append('<div id="subwindow" style="display:none;"><div id="subwindow_overlay"></div><div id="subwindow_foundation"></div></div>');

			//$('div#subwindow_overlay').live('click', function() {
			//	$.fn.subwindow.close();
			//});
			$('div#subwindow_close').live('click', function() {
				$.fn.subwindow.close();
			});

			if ($.browser.msie && $.browser.version < 7) {
				$('body').css({
					'margin': '0',
					'padding': '0',
					'height': '100%'
				});
				$('div#subwindow_overlay').css('position', 'absolute');
				$('div#subwindow_foundation').css('position', 'absolute');

				$(window).scroll(function() {
					$('div#subwindow_overlay').get(0).style.setExpression('top', '$(document).scrollTop()+"px"');
					$('div#subwindow_foundation').get(0).style.setExpression('top', '($(document).scrollTop()+$(window).height()/2)+"px"');
				});
			}
		}

		$(this).live('click', function() {
			$.fn.subwindow.open(this.getAttribute('href'), settings.option, settings.width, settings.height, this.getAttribute('title'), settings.close);

			return false;
		});

		return this;
	};

	$.fn.subwindow.open = function(url, option, width, height, title, close) {
		if (window.top == window.self) {
			$('html, body').animate({ scrollTop: 0 }, 0);
		} else {
			FB.Canvas.scrollTo(0, 0);
		}

		$('div#subwindow_foundation').html('');
		$('div#subwindow').show();

		title = title ? '<div id="subwindow_title">' + title + '</div>' : '';
		close = close ? '<div id="subwindow_close">' + close + '</div>' : '';

		var content = '';

		if (option) {
			$.ajax({
				type: 'get',
				url: url,
				async: false,
				cache: false,
				dataType: 'html',
				success: function(response)
				{
					$.each($(response).filter(option.filter), function() {
						var html = $(this).html();

						if (option.replace) {
							$.each(option.replace, function() {
								html = html.split(this.key).join(this.value);
							});
						}

						content = '<div id="subwindow_content" style="width:' + width + 'px;height:' + height + 'px;">' + html + '</div>';
					});
				}
			});
		} else {
			if (url.indexOf('?') >= 0) {
				url += '&'
			} else {
				url += '?'
			}
			url += '__subwindow=' + Math.random();

			content = '<iframe src="' + url + '" frameborder="0" width="' + width + '" height="' + height + '" id="subwindow_content" style="display:block;"></iframe>';
		}

		var margin_top = 0;
		if (window.top == window.self) {
			//margin_top = $('div#subwindow_foundation').height() / 2;
			margin_top = 250;
		} else {
			margin_top = $(document).height() / 2 - 50;
			//margin_top = 250;
		}

		$('div#subwindow_foundation').html(
			title + close + content
		).css({
			'marginTop': '-' + margin_top + 'px',
			'marginLeft': '-' + $('div#subwindow_foundation').width() / 2 + 'px'
		});
	};

	$.fn.subwindow.close = function() {
		$('div#subwindow').hide();
	};
})(jQuery);
