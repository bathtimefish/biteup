
//Grobal（総合） ----------------------------------------------------------------------

Global = {
	
	init: function (){
			//ページ読み込み完了時処理
			Global.setPageBackBtn();
			return this;
		},
		
	setPageBackBtn: function (){
			//ヘッダのバックボタンを設定する
			$("header .pageBack a").bind("click", function (e){
					e.preventDefault();
					window.history.back();
				});
			return this;
		}
	
	}; // Grobal end


//Grobal（総合） ----------------------------------------------------------------------

	
	//新規登録 ----------------------------------------------------------------------
	
	var Resist = {
			check: function (){
					if($("body").hasClass("nickname")) Resist.registBook();
				},
			registBook: function () {
				var inp = $("#resistration #_name");
				inp.bind("change", function (){
						$(".nickname #yourname").text($(this).val());
					$("#bookArea").css({"background":"none"});
					var timers = setTimeout(function (){
							$("#bookArea").css({"background":"url(img/regist_book_bg.jpg) no-repeat"});
						}, 30);
					});
				}
		}//Resist end

	//新規登録 ----------------------------------------------------------------------

	//フォローボタンが押された ----------------------------------------------------------------------
	var Follow = {
			follow: function (o){
					
				},
			unfollow: function (o){
				
				}
		}

	//タイムラインのcanvasを検索してサムネイル変換関数を呼ぶ ----------------------------------------------------------------------
	
	var Thumbnail2Canvas = function () {
		if($(".woodWrapper")) { // && !$(".friendTimelineDetail")
			$(".avatarIcon").each(function(index, element) {
					var kind = $(this).closest("li").data("friend-jobkind");
					var level = $(this).closest("li").data("friend-level");
					Charactor.getThumbnail(kind,level,this);
				});
			}
		}
	
	// 6_friend_timeline2.html用、その人だけのタイムラインのサムネイル作成----------------------------------------------------------------------
	
	var Search2Canvas = function () {
		if($(".commentList")) {
			$(".commentList .commentAvatar").each(function(index, element) {
					var kind = $(".woodWrapper ul li:first-child").data("friend-jobkind");
					var level = $(".woodWrapper ul li:first-child").data("friend-level");
					Charactor.getThumbnail(kind,level,$(this).find("canvas")[0]);
				});
			}
		}
	
	
	//アクティベート（実行） ----------------------------------------------------------------------
	window.onload = function (){
		
		// Grobal Activate
		Global.init();
		
		//新規登録アクティベート
		Resist.check();
		
		//サムネイルをcanvasに生成
		Thumbnail2Canvas();
		Search2Canvas();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	