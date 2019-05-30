/*
 Tagator jQuery Plugin
 A plugin to make input elements, tag holders
 version 1.2, Aug 9th, 2016
 by Ingi P. Jacobsen

 The MIT License (MIT)

 Copyright (c) 2014 Qodio

 Permission is hereby granted, free of charge, to any person obtaining a copy of
 this software and associated documentation files (the "Software"), to deal in
 the Software without restriction, including without limitation the rights to
 use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 the Software, and to permit persons to whom the Software is furnished to do so,
 subject to the following conditions:

 The above copyright notice and this permission notice shall be included in all
 copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

(function ($) {
	$.tagator = function (source_element, options) {
		var defaults = {
			prefix:                'tagator_',
			height:                'auto',
			useDimmer:             false,
			showAllOptionsOnFocus: false,
			allowAutocompleteOnly: false,
			autocomplete:          []
		};

		var self = this;
		var selected_index = -1;
		var $source_element = $(source_element);
		var $tagator_element = null;
		var $tags_element = null;
		var $placeholder_element = null;
		var $input_element = null;
		var $textlength_element = null;
		var $options_element = null;
		var key = {
			backspace: 8,
			enter:     13,
			escape:    27,
			left:      37,
			up:        38,
			right:     39,
			down:      40,
			comma:     188
		};
		self.settings = {};


		// INITIALIZE PLUGIN
		self.init = function () {
			self.settings = $.extend({}, defaults, options);

			//// ================== CREATE ELEMENTS ================== ////
			// dimmer
			if (self.settings.useDimmer) {
				if ($('#' + self.settings.prefix + 'dimmer').length === 0) {
					var $dimmer_element = $(document.createElement('div'));
					$dimmer_element.attr('id', self.settings.prefix + 'dimmer');
					$dimmer_element.hide();
					$(document.body).prepend($dimmer_element);
				}
			}
			// box element
			$tagator_element = $(document.createElement('div'));
			if ($source_element[0].id !== undefined) {
				$tagator_element.attr('id', self.settings.prefix + $source_element[0].id);
			}
			$tagator_element.addClass(self.settings.prefix + 'element options-hidden');
			$tagator_element.css({
				padding:     $source_element.css('padding'),
				'flex-grow': $source_element.css('flex-grow'),
				position:    'relative'
			});
			if (parseInt($source_element.css('width')) != 0) {
				$tagator_element.css({
					width: $source_element.css('width')
				});
			}
			if (self.settings.height === 'element') {
				$tagator_element.css({
					height: $source_element.outerHeight + 'px'
				});
			}
			$source_element.after($tagator_element);
			$source_element.hide();
			// textlength element
			$textlength_element = $(document.createElement('span'));
			$textlength_element.addClass(self.settings.prefix + 'textlength');
			$textlength_element.css({
				position:   'absolute',
				visibility: 'hidden'
			});
			$tagator_element.append($textlength_element);
			// tags element
			$tags_element = $(document.createElement('div'));
			$tags_element.addClass(self.settings.prefix + 'tags');
			$tagator_element.append($tags_element);
			// placeholder element
			$placeholder_element = $(document.createElement('div'));
			$placeholder_element.addClass(self.settings.prefix + 'placeholder');
			$tagator_element.append($placeholder_element);
			// input element
			$input_element = $(document.createElement('input'));
			$input_element.addClass(self.settings.prefix + 'input');
			$input_element.width(20);
			$input_element.attr('autocomplete', 'false');
			$tagator_element.append($input_element);
			// options element
			$options_element = $(document.createElement('ul'));
			$options_element.addClass(self.settings.prefix + 'options');

			$tagator_element.append($options_element);

			//// ================== BIND ELEMENTS EVENTS ================== ////
			// source element
			$source_element.change(function () {
				refreshTags();
			});
			// box element
			$tagator_element.bind('focus', function (e) {
				e.preventDefault();
				e.stopPropagation();
				showOptions();
				$input_element.focus();
			});
			$tagator_element.bind('mousedown', function (e) {
				e.preventDefault();
				e.stopPropagation();
				$input_element.focus();
				if ($input_element[0].setSelectionRange) {
					$input_element.focus();
					$input_element[0].setSelectionRange($input_element.val().length, $input_element.val().length);
				} else if ($input_element[0].createTextRange) {
					var range = $input_element[0].createTextRange();
					range.collapse(true);
					range.moveEnd('character', $input_element.val().length);
					range.moveStart('character', $input_element.val().length);
					range.select();
				}
			});
			$tagator_element.bind('mouseup', function (e) {
				e.preventDefault();
				e.stopPropagation();
			});
			$tagator_element.bind('click', function (e) {
				e.preventDefault();
				e.stopPropagation();
				if (self.settings.showAllOptionsOnFocus) {
					//showOptions();
					searchOptions();
				}
				$input_element.focus();
			});
			$tagator_element.bind('dblclick', function (e) {
				e.preventDefault();
				e.stopPropagation();
				$input_element.focus();
				$input_element.select();
			});
			// input element
			$input_element.bind('click', function (e) {
				e.preventDefault();
				e.stopPropagation();
			});
			$input_element.bind('dblclick', function (e) {
				e.preventDefault();
				e.stopPropagation();
			});
			$input_element.bind('keydown', function (e) {
				e.stopPropagation();
				var keyCode = e.keyCode || e.which;
				switch (keyCode) {
					case key.up:
						e.preventDefault();
						if (selected_index > -1) {
							selected_index = selected_index - 1;
						} else {
							selected_index = $options_element.find('.' + self.settings.prefix + 'option').length - 1;
						}
						refreshActiveOption();
						scrollToActiveOption();
						break;
					case key.down:
						e.preventDefault();
						if (selected_index < $options_element.find('.' + self.settings.prefix + 'option').length - 1) {
							selected_index = selected_index + 1;
						} else {
							selected_index = -1;
						}
						refreshActiveOption();
						scrollToActiveOption();
						break;
					case key.escape:
						e.preventDefault();
						break;
					case key.comma:
						e.preventDefault();
						if (selected_index === -1) {
							if ($input_element.val() !== '') {
								addTag($input_element.val());
							}
						}
						resizeInput();
						break;
					case key.enter:
						e.preventDefault();
						if (selected_index !== -1) {
							selectOption();
						} else {
							if ($input_element.val() !== '') {
								addTag($input_element.val());
							}
						}
						resizeInput();
						break;
					case key.backspace:
						if ($input_element.val() === '') {
							$source_element.val($source_element.val().substring(0, $source_element.val().lastIndexOf(',')));
							$source_element.trigger('change');
							searchOptions();
						}
						resizeInput();
						break;
					default:
						resizeInput();
						break;
				}
				refreshPlaceholder();
			});
			$input_element.bind('keyup', function (e) {
				e.preventDefault();
				e.stopPropagation();
				var keyCode = e.keyCode || e.which;
				if (keyCode === key.escape || keyCode === key.enter) {
					hideOptions();
				} else if (keyCode < 37 || keyCode > 40) {
					searchOptions();
				}
				if ($tagator_element.hasClass('options-hidden') && (keyCode === key.left || keyCode === key.right || keyCode === key.up || keyCode === key.down)) {
					searchOptions();
				}
				resizeInput();
				refreshPlaceholder();
			});
			$input_element.bind('focus', function (e) {
				e.preventDefault();
				e.stopPropagation();
				if (!$options_element.is(':empty') || self.settings.showAllOptionsOnFocus) {
					searchOptions();
					showOptions();
				}
			});
			$input_element.bind('blur', function (e) {
				e.preventDefault();
				e.stopPropagation();
				hideOptions();
			});
			refreshTags();
		};


		// RESIZE INPUT
		var resizeInput = function () {
			$textlength_element.html($input_element.val());
			$input_element.css({width: ($textlength_element.width() + 20) + 'px'});
		};


		// SET AUTOCOMPLETE LIST
		self.autocomplete = function (autocomplete) {
			self.settings.autocomplete = autocomplete !== undefined ? autocomplete : [];
		};


		// REFRESH TAGS
		self.refresh = function () {
			refreshTags();
		};
		var refreshTags = function () {
			$tags_element.empty();
			var tags = $source_element.val().split(',');
			$.each(tags, function (key, value) {
				if (value !== '' && checkAllowedTag(value)) {
					var $tag_element = $(document.createElement('div'));
					$tag_element.addClass(self.settings.prefix + 'tag');
					$tag_element.html(value);
					// remove button
					var $button_remove_element = $(document.createElement('div'));
					$button_remove_element.data('text', value);
					$button_remove_element.addClass(self.settings.prefix + 'tag_remove');
					$button_remove_element.bind('mousedown', function (e) {
						e.preventDefault();
						e.stopPropagation();
					});
					$button_remove_element.bind('mouseup', function (e) {
						e.preventDefault();
						e.stopPropagation();
						removeTag($(this).data('text'));
						$source_element.trigger('change');
					});
					$button_remove_element.html('X');
					$tag_element.append($button_remove_element);
					// clear
					var $clear_element = $(document.createElement('div'));
					$clear_element.css('clear', 'both');
					$tag_element.append($clear_element);

					$tags_element.append($tag_element);
				}
			});
			refreshPlaceholder();
			searchOptions();
		};
		
		// REFRESH PLACEHOLDER
		var refreshPlaceholder = function () {
			if ($tags_element.is(':empty') && !$input_element.val() && $source_element.attr('placeholder')) {
				$placeholder_element.html($source_element.attr('placeholder'));
				$placeholder_element.show();
			} else {
				$placeholder_element.hide();
			}
		};

		// REMOVE TAG FROM ORIGINAL ELEMENT
		var removeTag = function (text) {
			var tagsBefore = $source_element.val().split(',');
			var tagsAfter = [];
			$.each(tagsBefore, function (key, value) {
				if (value !== text && value !== '') {
					tagsAfter.push(value);
				}
			});
			$source_element.val(tagsAfter.join(','));
		};

		// CHECK IF TAG IS PRESENT
		var hasTag = function (text) {
			var tags = $source_element.val().split(',');
			var hasTag = false;
			$.each(tags, function (key, value) {
				if ($.trim(value) === $.trim(text)) {
					hasTag = true;
				}
			});
			return hasTag;
		};

		// CHECK IF TAG IS ALLOWED
		var checkAllowedTag = function (text) {
			if (!self.settings.allowAutocompleteOnly) {
				return true;
			}

			var checkAllowedTag = false;
			$.each(self.settings.autocomplete, function (key, value) {
				if ($.trim(value) === $.trim(text)) {
					checkAllowedTag = true;
				}
			});
			return checkAllowedTag;
		};

		// ADD TAG TO ORIGINAL ELEMENT
		var addTag = function (text) {
			if (!hasTag(text) && checkAllowedTag(text)) {
				$source_element.val($source_element.val() + ($source_element.val() !== '' ? ',' : '') + text);
				$source_element.trigger('change');
			}
			$input_element.val('');
			$tagator_element.focus();
			hideOptions();
		};

		// OPTIONS SEARCH METHOD
		var searchOptions = function () {
			$options_element.empty();
			if ($input_element.val().replace(/\s/g, '') !== '' || self.settings.showAllOptionsOnFocus) {
				var optionsArray = [];
				$.each(self.settings.autocomplete, function (key, value) {
					if (value.toLowerCase().indexOf($input_element.val().toLowerCase()) !== -1) {
						if (!hasTag(value)) {
							optionsArray.push(value);
						}
					}
				});
				generateOptions(optionsArray);
			}
			if ($input_element.is(':focus')) {
				if (!$options_element.is(':empty')) {
					showOptions();
				} else {
					hideOptions();
				}
			} else {
				hideOptions();
			}
			selected_index = -1;
		};

		// GENERATE OPTIONS
		var generateOptions = function (optionsArray) {
			var index = -1;
			$(optionsArray).each(function (key, value) {
				index++;
				var option = createOption(value, index);
				$options_element.append(option);
			});
			refreshActiveOption();
		};

		// CREATE RESULT OPTION
		var createOption = function (text, index) {
			// holder li
			var option = document.createElement('li');
			$(option).data('index', index);
			$(option).data('text', text);
			$(option).html(text);
			$(option).addClass(self.settings.prefix + 'option');
			if (this.selected) {
				$(option).addClass('active');
			}

			// BIND EVENTS
			$(option).bind('mouseover', function (e) {
				e.stopPropagation();
				e.preventDefault();
				selected_index = index;
				refreshActiveOption();
			});
			$(option).bind('mousedown', function (e) {
				e.stopPropagation();
				e.preventDefault();
			});
			$(option).bind('click', function (e) {
				e.preventDefault();
				e.stopPropagation();
				selectOption();
			});


			return option;
		};

		// SHOW OPTIONS AND DIMMER
		var showOptions = function () {
			$tagator_element.removeClass('options-hidden').addClass('options-visible');
			if (self.settings.useDimmer) {
				$('#' + self.settings.prefix + 'dimmer').show();
			}
			$options_element.css('top', ($tagator_element.outerHeight - 2) + 'px');
			if ($tagator_element.hasClass('single')) {
				selected_index = $options_element.find('.' + self.settings.prefix + 'option').index($options_element.find('.' + self.settings.prefix + 'option.active'));
			}
			scrollToActiveOption();
		};

		// HIDE OPTIONS AND DIMMER
		var hideOptions = function () {
			$tagator_element.removeClass('options-visible').addClass('options-hidden');
			if (self.settings.useDimmer) {
				$('#' + self.settings.prefix + 'dimmer').hide();
			}
		};

		// REFRESH ACTIVE IN OPTIONS METHOD
		var refreshActiveOption = function () {
			$options_element.find('.active').removeClass('active');
			if (selected_index !== -1) {
				$options_element.find('.' + self.settings.prefix + 'option').eq(selected_index).addClass('active');
			}
		};

		// SCROLL TO ACTIVE OPTION IN OPTIONS LIST
		var scrollToActiveOption = function () {
			var $active_element = $options_element.find('.' + self.settings.prefix + 'option.active');
			if ($active_element.length > 0) {
				$options_element.scrollTop($options_element.scrollTop() + $active_element.position().top - $options_element.height() / 2 + $active_element.height() / 2);
			}

		};

		// SELECT ACTIVE OPTION
		var selectOption = function () {
			addTag($options_element.find('.' + self.settings.prefix + 'option').eq(selected_index).data('text'));
		};


		// REMOVE PLUGIN AND REVERT INPUT ELEMENT TO ORIGINAL STATE
		self.destroy = function () {
			$tagator_element.remove();
			$.removeData($source_element, 'tagator');
			$source_element.show();
			if ($('.tagator').length === 0) {
				$('#' + self.settings.prefix + 'dimmer').remove();
			}
		};

		// Initialize plugin
		self.init();
	};

	$.fn.tagator = function () {
		var parameters = arguments[0] !== undefined ? arguments : [{}];
		return this.each(function () {
			if (typeof(parameters[0]) === 'object') {
				if (undefined === $(this).data('tagator')) {
					var plugin = new $.tagator(this, parameters[0]);
					$(this).data('tagator', plugin);
				}
			} else if ($(this).data('tagator')[parameters[0]]) {
				$(this).data('tagator')[parameters[0]].apply(this, Array.prototype.slice.call(parameters, 1));
			} else {
				$.error('Method ' + parameters[0] + ' does not exist in $.tagator');
			}
		});
	};
}(jQuery));


$(function () {
	$('.tagator').each(function () {
		var $this = $(this);
		var options = {};
		$.each($this.data(), function (key, value) {
			if (key.substring(0, 7) == 'tagator') {
				var value_temp = value.toString().replace(/'/g, '"');
				value_temp = $.parseJSON(value_temp);
				if (typeof value_temp == 'object') {
					value = value_temp;
				}
				options[key.substring(7, 8).toLowerCase() + key.substring(8)] = value;
			}
		});
		$this.tagator(options);
	});
});