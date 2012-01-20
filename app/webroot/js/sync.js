var Sync = {
	
		// userName 書式　userData.rows[0].userName , userData.rows[0].userID
		
		interval: 5000, // 10秒おきにポーリング
		timer: null,
	
		//　ポーリング用
		apiID : [
		"",
		"",
		"/biteup/api/users/index", //2 トップページ用
		"",
		"",
		"",
		"/biteup/api/feeds/latest", // 6 フレンドタイムライン
		"/biteup/api/feeds/past/",// 7 このスラッシュの後に[min_feed_id:Number]がくっつく
		"/biteup/api/likes/setlike", // 8 オツカレコメントあんどボタンを押した時通信
		"/biteup/api/users/getlevel" // 9 キャラクター構成のためのレベル、職業
		],
		
		
		
	//ポーリングスタート ----------------------------------------------------------------------
		start: function (nm, fn){
			Sync.timer = setInterval(poll, Sync.interval);
				
			//共通ポーリング実行部分 ----------------------------------------------------------------------
				function poll () {
					if(Sync.isOnline()) {
						$.ajax({
							type: "POST",
							url: Sync.apiID[nm],
							data: userData,
							success: function(res){
								if(res) {
									var obj = (new Function("return " + res))();
									if(parseInt(obj.infoCount) != 0) { $("header span.alert").css("display","block").text(obj.infoCount); } else {$("header span.alert").css("display","none")} // 新着カウント表示
									fn(obj); // 共通以外は引数で送られてきた関数を実行
								}
							}
						});
					}
				}
			//共通ポーリング実行部分 ----------------------------------------------------------------------


			},
	
		//1回だけリクエスト
		once: function (nm, fn){
			if(Sync.isOnline()) {
				$.ajax({
					type: "POST",
					url: Sync.apiID[nm],
					data: userData,
					success: function(res){
						if(res) {
							var obj = (new Function("return " + res))();
							fn(obj); // 共通以外は引数で送られてきた関数を実行
						}
					}
				});
			}
			
		},
		

	isOnline: function () {
		if(!navigator.onLine) return false;
		else return true;
	},

	//オツカレと言ってくれた ----------------------------------------------------------------------
		otsukare : {
				said: function (o){
					$("#otsukareLoadIcon").fadeIn(300);
					var ms = $(o).find("input[type='text']").val();
					userData.rows[0].message = ms;
					var msgs = userData;
					var timer = setTimeout(sendData, 1000);
						function sendData() {
							$.ajax({
								type: "POST",
								url: Sync.otsukareComment_api,
								data: msgs,
								success: function(res){
									if(res) {
											var dom = Sync.otsukare.dom(ms);
											clearTimeout(timer);
											$("#otsukareLoadIcon").hide();
											$(".commentForm").fadeOut(300, function () {
											$(dom).prependTo(".commentList ul").hide().slideDown(1000);
										});
									}
								}
							});
						}//sendData
					}, //said
					dom: function (msg) {
						var data = '<li><a href="#"><p class="commentAvatar"><canvas width="80" height="80"></canvas></p><div class="detail"><h2>'+userData.rows[0].userName+'</h2><p class="text">'+msg+'</p><p class="times">さきほど</p></div></a></li>';
						return data;
					} // dom
			}
	
	//オツカレと言ってくれた ----------------------------------------------------------------------
	

		
		
	};