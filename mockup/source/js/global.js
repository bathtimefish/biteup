
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
			follow: function (){
					
				},
			unfollow: function (){
				}
		}

	//フォローボタンが押された ----------------------------------------------------------------------
	
	//オツカレと言ってくれた ----------------------------------------------------------------------
	var Otsukare = {
			said: function (o){
				$("#otsukareLoadIcon").fadeIn(300);
				var ms = $(o).find("input[type='text']").val();
				userData.rows[0].message = ms;
				var msgs = userData;
				var timer = setTimeout(sendData, 1000);
					function sendData() {
						$.ajax({
							type: "POST",
							url: "/test2.php",
							data: msgs,
							success: function(res){
								if(res != "") {
										clearTimeout(timer);
										$("#otsukareLoadIcon").hide();
										$(".commentForm").fadeOut(300, function () {
										$(res).prependTo(".commentList ul").hide().slideDown(1000);
									});
								}
							}
						});
					}//sendData
				}
		}

	//オツカレと言ってくれた ----------------------------------------------------------------------
	
	
	
	//アクティベート（実行） ----------------------------------------------------------------------
	window.onload = function (){
		
		// Grobal Activate
		Global.init();
		
		//新規登録アクティベート
		Resist.check();
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	