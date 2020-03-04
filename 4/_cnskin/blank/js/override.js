/*
	override.js
	140324
*/
BiNDZoom.prototype = {
	groupCount: 0,
	options: {
		resizeDuration: 160,
		showCounter: true
	},
	initialize: function(ancs, caps, options){
		jQuery.extend(this.options, options, {});
		
		this.imageWidth = 0;
		this.imageHeight = 0;
		this.firstClick = true;
		
		this.addSet(ancs, caps);
		
		var clazz = this;
		
		this.overlay = jQuery('<div id="bindboxslim-overlay"></div>').css('display', 'none').appendTo(document.body);
		this.overlay.click(function() {
			clazz.close();
		}).bind('touchend', function() {
			clazz.close();
		});
		
		this.bindbox = jQuery('<div id="bindboxslim"></div>').css({
			display: 'none'
		}).appendTo(document.body);
		if (!bindobj.ie) this.bindbox.css('opacity', 0);
		
		this.image = jQuery('<div class="bindboxslim-image"></div>').appendTo(this.bindbox);
		
		this.closeBox = jQuery('<a id="bindboxslim-close"><span>close</span></a>');
		this.closeBox.click(function() {
			clazz.close();
		}).bind('touchend', function() {
			clazz.close();
		});
		jQuery('<div class="tl"></div>').append(this.closeBox).appendTo(this.image);
		this.image.append('<div class="tr"></div>').append('<div class="tc"></div>');
		
		var mm = jQuery('<div class="mm"></div>').append('<div class="ml"></div>').append('<div class="mr"></div>').appendTo(this.image);
		this.mc = jQuery('<div class="mc"></div>').appendTo(mm);
		
		// prev, next
		this.controlDiv = jQuery('<div id="bindboxslim-nav"></div>').appendTo(this.mc);
		this.prevLink = jQuery('<a id="bindboxslim-back"></a>').appendTo(this.controlDiv);
		this.nextLink = jQuery('<a id="bindboxslim-next"></a>').appendTo(this.controlDiv);
		this.prevLink.click(function() {
			clazz.previous();
		});
		this.nextLink.click(function() {
			clazz.next();
		});
		this.controlDiv.hide();
		
		// comment
		this.comment = jQuery('<div id="bindboxslim-text"></div>').appendTo(this.mc);
		
		// loading
		this.loading = jQuery('<div id="bindboxslim-loading"></div>').appendTo(this.mc);
		
		this.image.append('<div class="bl"></div>').append('<div class="br"></div>').append('<div class="bc"></div>');
		
		this.preloadPrev = new Image();
		this.preloadNext = new Image();
	},
	
	addSet: function(ancs, caps) {
		ancs = jQuery.extend([], ancs);
		caps = jQuery.extend([], caps);
		
		this.groupCount++;
		var groupName = "bindzoom-" + this.groupCount;
		
		var clazz = this;
		
		jQuery.each(ancs, function(i, el) {
			if (el.className.indexOf('bindzoom') > -1) {
				jQuery(el).attr('rel', groupName).click(function() {
					clazz.click(el)
					return false;
				}).bind('touchend', function() {
					clazz.click(el)
					return false;
				});
				
				if (!clazz.anchors) clazz.anchors = [];
				clazz.anchors.push(el);
				
				if (!clazz.captions) clazz.captions = [];
				clazz.captions.push(caps[i]);
				
			} else if (el.className.indexOf('bindpopup') > -1) {
				jQuery(el).click(function() {
					clazz.openURL(el);
					return false;
				});
				
				if (!clazz.pAnchors) clazz.pAnchors = [];
				clazz.pAnchors.push(el);
				
			}
		});
		
	},
	
	click: function(link){
		var j, imageNum, images = [];
		var cnt = 0;
		var clazz = this;
		jQuery.each(clazz.anchors, function(i, el) {
			if (el.rel == link.rel){
				images.push([el, clazz.captions[i], el.rel]);
				if (el == link) imageNum = cnt;
				cnt++;
			}
		});
		
		groupName = link.rel;
		
		if (typeof(this.currentGroup) != 'undefined'
			&& this.currentGroup == groupName
			&& typeof(this.activeImage) != 'undefined'
			&& this.activeImage == imageNum) {
			return false;
		}
		
		if (this.currentGroup != groupName) {
			this.images = images;
		}
		
		this.currentGroup = groupName;
		
		if (this.firstClick)
			return this.open(images, imageNum);
		else
			return this.changeImage(imageNum);
	},

	show: function(url, title){
		return this.open([[url, title]], 0);
	},
	
	open: function(images, imageNum){
		this.images = images;
		this.setup(true);
		
		var img = jQuery(this.images[imageNum][0]);
		
		var pos = getPosition(img[0]);
		this.top = pos.top - 34;
		this.left = pos.left - 34;
		
		this.anchorHeight = img.height() + 64;
		this.anchorWidth = img.width() + 64;
		this.anchorTop = pos.top - 34;
		this.anchorLeft = pos.left - 34;
		
		this.bindbox.css({
			top: this.top,
			marginLeft: this.left,
			height: this.anchorHeight,
			width: this.anchorWidth,
			display: ''
		});
		
		this.overlay.css({
			height: jQuery(document).height(),
			width: jQuery(document.body).width(),
			opacity: 0,
			display: ''
		});
		this.overlay.fadeTo(this.options.resizeDuration, 0.7);
		
		return this.changeImage(imageNum);
	},

	openURL: function(link){
		this.toggleObjectVisible(true);
		
		var pos = getPosition(link);
		this.top = pos.top - 34;
		this.left = pos.left - 34;
		
		this.anchorHeight = jQuery(link).height() + 64;
		this.anchorWidth = jQuery(link).width() + 64;
		this.anchorTop = pos.top - 34;
		this.anchorLeft = pos.left - 34;
		
		this.bindbox.css({
			top: this.top,
			marginLeft: this.left,
			height: this.anchorHeight,
			width: this.anchorWidth,
			display: ''
		});
		
		this.overlay.css({
			height: jQuery(document).height(),
			width: jQuery(document.body).width(),
			opacity: 0,
			display: ''
		});
		this.overlay.fadeTo(this.options.resizeDuration, 0.7);
		
		this.step = 1;
		return this.nextEffectURL(link);
	},
	
	toggleObjectVisible: function(open){
		var tags = 'object' + (bindobj.ie ? ',select' : ',embed');
		jQuery(tags).css('visibility', open ? 'hidden' : '');
	},
	
	setup: function(open){
		this.toggleObjectVisible(open);
		
		var clazz = this;
		if (open) {
			jQuery(document).bind('keydown', function(event) {
				switch (event.keyCode){
					case 27: case 88: case 67: clazz.close(); break;
					case 37: case 80: clazz.previous(); break;	
					case 39: case 78: clazz.next();
				}
			});
		} else {
			jQuery(document).unbind('keydown');
		}
		this.step = 0;
	},

	previous: function(){
		return this.changeImage(this.activeImage-1);
	},

	next: function(){
		return this.changeImage(this.activeImage+1);
	},

	changeImage: function(imageNum){
		if (this.step || (imageNum < 0) || (imageNum >= this.images.length)) return false;
		this.step = 1;
		this.activeImage = imageNum;
		
		this.prevLink.css({visibility:'hidden'});
		this.nextLink.css({visibility:'hidden'});
		
		this.loading.show();
		
		var clazz = this;
		this.preload = new Image();
		this.preload.onload = function() {
			clazz.nextEffect();
		};
		this.preload.src = (this.images[imageNum][0]).href;
		
		return false;
	},

	nextEffect: function(){
		switch (this.step++){
		case 1:
			this.image.className = '';
			var toolHeight = 80,
				winW = jQuery(document.body).width();
			
			var preWidth = this.imageWidth || 0;
			var preHeight = this.imageHeight || 0;
			this.imageWidth = this.preload.width;
			this.imageHeight = this.preload.height;
			if (this.imageWidth > document.body.offsetWidth - toolHeight) {
				var rate = (document.body.offsetWidth - toolHeight) / this.imageWidth;
				this.imageWidth = Math.round(this.imageWidth * rate);
				this.imageHeight = Math.round(this.imageHeight * rate);
			}
			
			if (this.imageHeight > document.body.offsetHeight - toolHeight) {
				var rate = (document.body.offsetHeight - toolHeight) / this.imageHeight;
				this.imageWidth = Math.round(this.imageWidth * rate);
				this.imageHeight = Math.round(this.imageHeight * rate);
			}
			
			this.loading.hide();
			
			this.img = document.getElementById('imgContents');
			if (this.img) this.mc[0].removeChild(this.img);
			this.img = jQuery('<img id="imgContents" src="' + String(this.images[this.activeImage][0]) + '">').css({
				maxWidth: this.imageWidth,
				maxHeight: this.imageHeight
			}).prependTo(this.mc);
			if (!bindobj.ie) this.img.css('opacity', 0);
			
			if (this.firstClick) {
				this.img.css({
					width: this.anchorWidth - 64,
					height: this.anchorHeight - 64
				});
			}
			
			this.comment.html('');
			this.comment.append(jQuery('<div id="bindboxslim-comment"></div>').append('<p>' + this.images[this.activeImage][1] + '</p>'));
			this.comment.append(jQuery('<div id="bindboxslim-num"></div>').append(
				'<p>' + this.formatZero(this.activeImage+1) + '/' + this.formatZero(this.images.length) + '</p>'));
			
			if (this.activeImage) this.preloadPrev.src = (this.images[this.activeImage-1][0]).href;
			if (this.activeImage != (this.images.length - 1)) this.preloadNext.src = (this.images[this.activeImage+1][0]).href;
			
			if (preWidth != this.imageWidth || preHeight != this.imageHeight) {
				var clazz = this;
				var win = jQuery(window);
				var destTop = win.scrollTop() + Math.round((win.height() - this.imageHeight - toolHeight) / 2);
				if (destTop < 0) destTop = 0;
				var obj = {
					height: this.imageHeight + 120,
					width: this.imageWidth + 80,
					marginLeft: (winW - (this.imageWidth + 80)) / 2,
					top: destTop
				};
				if (!bindobj.ie) obj['opacity'] = 1;
				this.bindbox.animate(obj, this.options.resizeDuration);
				
				if (this.firstClick) {
					var iobj = {
						height: this.imageHeight,
						width: this.imageWidth
					};
					if (!bindobj.ie) iobj['opacity'] = 1;
					this.img.animate(iobj, this.options.resizeDuration);
				} else {
					this.img.animate({
						height: this.imageHeight,
						width: this.imageWidth
					}, this.options.resizeDuration);
				}
				
				this.mc.animate({
					height: this.imageHeight + 40,
					width: this.imageWidth
				}, this.options.resizeDuration,
				function() {
					clazz.nextEffect();
				});
				break;
			}
			
			this.img.css({
				width: this.imageWidth,
				height: this.imageHeight
			});
			if (!bindobj.ie) this.img.css('opacity', 1);
			
			this.step++;
			
		case 2:
			if (!bindobj.ie) {
				var clazz = this;
				this.img.animate({opacity: 1}, this.options.resizeDuration,
				function() {
					clazz.nextEffect();
				});
			} else {
				this.nextEffect();
			}
			break;
			
		case 3:
			this.firstClick = false;
			
			this.comment.show();
			this.controlDiv.show();
			this.prevLink.show();
			this.nextLink.show();
			if (this.activeImage) this.prevLink.css({visibility: 'visible'});
			if (this.activeImage != (this.images.length - 1)) this.nextLink.css({visibility: 'visible'});
			this.step = 0;
		}
	},
	
	formatZero: function(src) {
		var s = new String(src);
		if (s.length < 3) {
			var buf = '';
			for (var i=0; i< 3-s.length; i++) buf += '0';
			return buf + s;
		}
		return s;
	},
	
	nextEffectURL: function(link){
		switch (this.step++){
		case 1:
			var ancH = 0, ancW = 0, scroll = false, autoFit = false;
			var winW = jQuery(document.body).width();
			var ary = link.className.split(' ');
			for (var i=0; i < ary.length; i++) {
				var wk = ary[ i ];
				if (wk == 'bdscroll') scroll = true;
				else if (wk == 'bdautofit') autoFit = true;
				else if (wk.substring(0, 1) == 'h') ancH = new Number(wk.substring(1));
				else if (wk.substring(0, 1) == 'w') ancW = new Number(wk.substring(1));
			}
			
			if (autoFit) {
				var win = jQuery(window);
				ancW = winW - 80;
				ancH = win.height() - 80;
			}
			
			this.img = document.getElementById('imgContents');
			if (this.img) this.mc[0].removeChild(this.img);
			this.img = jQuery('<iframe id="imgContents" src="' + link.href + '" frameborder="0"></iframe>').prependTo(this.mc);
			this.img.hide();
			
			this.img.attr('width', ancW - 80);
			this.img.attr('height', '100%');
			
			if (scroll) {
				this.img.attr('scrolling', 'auto');
			} else {
				this.img.attr('scrolling', 'no');
				this.img.css({
					overflow: 'hidden',
					overflowX: 'hidden',
					overflowY: 'hidden'
				});
			}
			
			var clazz = this;
			var win = jQuery(window);
			var obj = {
				height: ancH + 80,
				width: ancW,
				marginLeft: (winW - ancW) / 2,
				top: win.scrollTop() + ((win.height() - ancH - 64) / 2)
			};
			if (!bindobj.ie) obj['opacity'] = 1;
			this.bindbox.animate(obj, this.options.resizeDuration);
			
			this.mc.animate({
				height: ancH,
				width: ancW - 80
			}, this.options.resizeDuration,
			function() {
				clazz.nextEffectURL();
			});
			break;
			
		case 2:
			this.firstClick = false;
			this.img.show();
			this.prevLink.hide();
			this.nextLink.hide();
			this.step = 0;
		}
	},
	
	closeEffect: function(){
		this.comment.hide();
		this.controlDiv.hide();
		
		this.overlay.fadeTo(this.options.resizeDuration, 0, function() {
			jQuery(this).hide();
		});
		
		var clazz = this;
		var obj = {
			height: this.anchorHeight,
			width: this.anchorWidth
		};
		if (!bindobj.ie) obj['opacity'] = 0;
		this.img.animate(obj, this.options.resizeDuration,
		function() {
			clazz.closeEnd();
			var wk = clazz.img[0];
			if (wk.parentNode) wk.parentNode.removeChild(wk);
		});
		
		var bobj = {
			height: this.anchorHeight,
			width: this.anchorWidth,
			marginLeft: this.anchorLeft,
			top: this.anchorTop
		};
		if (!bindobj.ie) bobj['opacity'] = 0;
		this.bindbox.animate(bobj, this.options.resizeDuration,
		function() {
			clazz.closeEnd();
		});
		
	},
	
	closeEnd: function() {
		this.bindbox.css({
			width: this.options.initialWidth,
			height: this.options.initialHeight
		});
		this.bindbox.hide();
	},
	
	close: function(){
		if (this.step < 0) return;
		this.step = -1;
		if (this.preload){
			this.preload.onload = function(){};
			this.preload = null;
		}
		// TODO: Effect STOP
		//for (var f in this.fx) this.fx[f].stop();
		this.firstClick = true;
		this.imageWidth = 0;
		this.imageHeight = 0;
		this.activeImage = -1;
		this.currentGroup = '';
		
		this.setup(false);
		
		this.closeEffect();
		
		return false;
	}
};

