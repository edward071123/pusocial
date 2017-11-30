$(function () {
	var wow = new WOW ({
		boxClass:     'wow',      // animated element css class (default is wow)
		animateClass: 'animated', // animation css class (default is animated)
		offset:       120,          // distance to the element when triggering the animation (default is 0)
		mobile:       false,       // trigger animations on mobile devices (default is true)
		live:         true        // act on asynchronously loaded content (default is true)
	});

	wow.init();
	// 預設標題區塊 .abgne_tip_gallery_block .caption 的 top
	var _titleHeight = 55;
	$('.abgne_tip_gallery_block').each(function(){
		// 先取得區塊的高及標題區塊等資料
		var $this = $(this), 
			_height = $this.height(), 
			$caption = $('.caption', $this),
			_captionHeight = $caption.outerHeight(true),
			_speed = 200;
		
		// 當滑鼠移動到區塊上時
		$this.hover(function(){
			// 讓 $caption 往上移動
			$caption.stop().animate({
				top: _height - _captionHeight
			}, _speed);
		}, function(){
			// 讓 $caption 移回原位
			$caption.stop().animate({
				top: _height - _titleHeight
			}, _speed);
		});
	});
			
	// 預設顯示第一個 Tab
	var _showTab = 0;
	var $defaultLi = $('ul.tabs li').eq(_showTab).addClass('active');
	$($defaultLi.find('a').attr('href')).siblings().hide();
			
	// 當 li 頁籤被點擊時...
	// 若要改成滑鼠移到 li 頁籤就切換時, 把 click 改成 mouseover
	$('ul.tabs li').click(function() {
		// 找出 li 中的超連結 href(#id)
		var $this = $(this),
			_clickTab = $this.find('a').attr('href');
		// 把目前點擊到的 li 頁籤加上 .active
		// 並把兄弟元素中有 .active 的都移除 class
		$this.addClass('active').siblings('.active').removeClass('active');
		// 淡入相對應的內容並隱藏兄弟元素
		$(_clickTab).stop(false, true).fadeIn().siblings().hide();

		return false;
	}).find('a').focus(function(){
		this.blur();
	});

	function MM_goToURL() { //v3.0
		var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
		for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
	}

	$("#btnShowHide").click(function(){
		$("#divShowHide").toggle();
	});

	$("#btnShowHide2").click(function () {
		console.log('123');
		$("#divShowHide2").toggle();
	});

	$("#btnShowHide3").click(function(){
		$("#divShowHide3").toggle();
	});

	$("#btnShowHide4").click(function(){
		$("#divShowHide4").toggle();
	});
});

	

