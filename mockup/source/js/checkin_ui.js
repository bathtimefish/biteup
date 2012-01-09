function checkInUI () {
	
	//
	// チェックインのスライド用 UI
	//
	
	var container = null, hundle = null, x = 0, timer = null, maxLength = 0, _this = this;
	this.isWorking = false;
	
	// isWorking trueだと勤務中なのでcheckoutを表示、falseの場合はcheckInを表示
	
	this.init = function (target) {
		container = document.getElementById(target);
		var code = "<div class='checkInWrapper'><div class='hundle'></div></div>";
		$(container).addClass((_this.isWorking) ? "working" : null);
		$(container).css({"position":"relative"});
		hundle = $(container).append(code).find(".hundle").css({"position":"absolute"});
		$(hundle).bind("mousedown touchstart",touchStart);
		//maxLength = parseInt($(container).width()) - parseInt($(hundle).innerWidth());
		maxLength = 320-109;
	}
	
	var hundleTouchX = 0;
	function touchStart (e) {
		
		e.preventDefault();
		e.stopPropagation();
		hundleTouchX = (event.clientX || event.touches[0].clientX);
		//touchMove();//指タップでも移動処理を1度行う
		$(window).bind("mousemove touchmove",touchMove);
		$(hundle).unbind("mousedown touchstart",touchStart);
		$(window).bind("mouseup touchend",touchEnd);
	}
	
	function touchMove (e) {
		x = (event.clientX || event.touches[0].clientX) -hundleTouchX;
		//console.log(event.touches[0].clientX)
		if ( maxLength < parseInt(x) ) {
			x = maxLength;
		}
		$(hundle).css({"left": x});
	}
	
	function touchEnd (e) {
			//console.log(x)
		//console.log($(container).width(), parseInt($(hundle).css("left"))+parseInt($(hundle).width()) );
		$(window).unbind("mouseup touchend",touchEnd);
		$(window).unbind("mousemove touchmove",touchMove);
		if(x >= maxLength) {
			// チェックイン or アウト 確定
			
			submitCheck();
			
		}else{
			$(hundle).animate({"left": 0}, 200, function (){
				$(hundle).bind("mousedown touchstart",touchStart);
			});
		}
	}
	
	function submitCheck () {
		var sendMsg = "";
		if(_this.isWorking) {
			//チェックアウトをした
			//alert("チェックアウトをした");
			//$(container).removeClass("working");
			sendMsg = "checkOut";
			_this.isWorking = false;
		}else{
			//チェックインをした
			//alert("チェックインをした");
			//$(container).addClass("working");
			sendMsg = "checkIn";
			_this.isWorking = true;
		}
		
		post(sendMsg);
	}
	
	function post (msg) {
		var sendData = null, codes = null;
		if(msg === "checkIn") { // まあまあ楽
			sendData = {"isWorking": true, "workID": "バイトのID", "userID": "nakashizu"};
			codes = "<div class='commentArea' style='display:none; top: 40px;'><p class='sendingIcon'>送信中</p></div>";
			$(container).append(codes);
			$(container).find(".commentArea").slideDown(400,function (){
					postSend (sendData);
				});
			
			// これでチェックインは終わり
		}else{ //　チェックアウト
		//console.log(msg)
			sendData = { "isWorking": false, "workID": "バイトのID", "userID": userData.rows[0].userName, "comment": "ユーザのコメント" };
			codes = "<div class='commentArea' style='display:none; top: 40px;'><textarea></textarea><a href='#'>送信する</a></div>";
			$(container).append(codes);
			var tx = $(container).find(".commentArea textarea")[0];
			var btn = $(container).find(".commentArea a")[0];
			var tx = $(container).find(".commentArea").slideDown(400);
			$(btn).bind("click", function (e){
					e.preventDefault();
					//コメントエリアを消す
					$(container).find(".commentArea").fadeOut(300, function (){
							$(container).append("<p class='sendingIcon'><span><img src='common/img/icon_date.png' alt='sync'></span>送信中</p>");
							sendData.comment = $(tx).val();
							postSend (sendData);
						});
				});
		}
		
		function postSend (msgs) {
			$.ajax({
				 type: "POST",
				 url: "/test.php",
				 data: msgs,
				 success: function(res){
					 var timer = setTimeout(function (){
						 clearTimeout(timer);
					 		console.log( "Saved: " + res );
						 	$(container).find(".sendingIcon").text("送信完了しました！");
							$(container).delay(1500).fadeOut(500, function (){
								if(!_this.isWorking) {
									//チェックアウト完了、消す
									$(this).remove();
									$("#topics").animate({"height": 200}, 500);
									$(".containerInner").addClass("checkInWrapperUp");

								}else{
									//チェックイン完了、画像、クラス名を変更してfadeIn
									$(container).find(".commentArea").remove();
									$(container).bind("mousedown touchstart",touchStart);
									$(hundle).css({"left": 0});
									$(container).addClass("working").fadeIn(300);
								}
								
								//
								
							});
								
						}, 1000);
				 }
			 });/**/
		}//postSend
		
	}
	
}