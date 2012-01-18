var Sync = {
	
		//　ポーリング用
		
		top_api : "/biteup/api/users/index",
		friendTimeline_new_api : "/biteup/api/feeds/latest",
		friendTimeline_old_api : "/biteup/api/feeds/past/",//このスラッシュの後に[min_feed_id:Number]がくっつく
		otsukareComment_api : "/biteup/api/likes/setlike", //オツカレコメントあんどボタンを押した時通信
		
		otsukareComment_api : "/test2.php", //テスト用に上書き、本番では外す
		
		
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