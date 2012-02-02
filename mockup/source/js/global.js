
//Grobal（総合） ----------------------------------------------------------------------

Global = {
	
	init: function (){
			//ページ読み込み完了時処理
			Global.setPageBackBtn();
			return this;
		},
		
	setPageBackBtn: function (){
			//ヘッダのバックボタンを設定する
			$(".pageBack a").bind("click", function (e){
					e.preventDefault();
					window.history.back();
				});
			return this;
		},
		
	compareTime : function (tm) {
			var ds = Date.parse( tm.replace( /-/g, '/') );
			var interval = (new Date().getTime() - ds) / 60000; //(差を分刻みで出す)
			// 1分は60000ミリ秒
			// 1時間は60分 = 3,600,000ミリ秒			
			// 1日は1440分
			// 6時間は360分
			// 3時間は180分
			// 1時間は60分
			var time = 0;
			if		(interval > 1440)  time= "1日前";
			else	if (interval > 1440)  time= "1日前";
			else	if (interval > 360)  time= "6時間以上前";
			else	if (interval > 180)  time= "3時間以上前";
			else	if (interval > 60)  time= "1時間以上前";
			else	if (interval >= 30)  time= "30分以上前";
			else	if (interval < 30)  {
				time = parseInt(interval) + "分前"
			}
			return time;
		},

	//タイムラインのcanvasを検索してサムネイル変換関数を呼ぶ ----------------------------------------------------------------------
	
	thumbnail2Canvas : function () {
		if($(".woodWrapper")) { // && !$(".friendTimelineDetail")
			$(".avatarIcon").each(function(index, element) {
					var kind = $(this).closest("li").data("friend-jobkind");
					var level = $(this).closest("li").data("friend-level");
					Charactor.getThumbnail(kind,level,this);
				});
			}
		},
	
	// 6_friend_timeline2.html用、その人だけのタイムラインのサムネイル作成----------------------------------------------------------------------
	
	search2Canvas : function () {
		if($(".commentList")) {
			$(".commentList .commentAvatar").each(function(index, element) {
					var kind = $(this).closest("li").data("friend-jobkind");
					var level = $(this).closest("li").data("friend-level");
					Charactor.getThumbnail(kind,level,$(this).find("canvas")[0]);
				});
			}
		}

		
	
	}; // Grobal end


//Grobal（総合） ----------------------------------------------------------------------

	
	//新規登録 ----------------------------------------------------------------------
	
	var Resist = {
			check: function (){
					if($("body").hasClass("nickname")) Resist.registBook();
				},
			registBook: function () {
				var inp = $(".newRegistration #_name");
				inp.bind("change", function (){
						$(".nickname #yourname").text($(this).val());
					$("#bookArea").css({"background":"none"});
					/*var timers = setTimeout(function (){
							$("#bookArea").css({"background":"url(img/regist_book_bg.jpg) no-repeat"});
						}, 30);*/
					});
				}
		}//Resist end

	//新規登録 ----------------------------------------------------------------------
	
	var RollOver = {
		set : function () {
			var classes = $(".tapping");
			classes.each(function (){
				var img = $(this).find("img");
				var src = img.attr("src").replace(".png", "_on.png?")+new Date().getTime();
				var i = new Image().src = src;
				console.log(src)
				$(this).bind("touchstart mousedown", function (){
						img.attr("src",src);
					});
				});
		return this;
		}
	}


	
	
	//アクティベート（実行） ----------------------------------------------------------------------
	window.onload = function (){
		
		// Grobal Activate
		Global.init();
		
		//新規登録アクティベート
		Resist.check();
		
		//サムネイルをcanvasに生成
		Global.thumbnail2Canvas();
		Global.search2Canvas();
		
		//アクティブボタンの指定
		RollOver.set();

	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	