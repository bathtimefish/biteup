
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
	
	};
	

	
// Activate
window.onload = Global.init;
