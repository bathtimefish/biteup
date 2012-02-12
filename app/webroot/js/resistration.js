//
// バイト新規登録、編集ページだけに使うスクリプト
//

var Biteup = {
	
	ev: "touchstart mousedown", //イベントハンドラ用
	
	//新規登録送信チェック ----------------------------------------------------------------------
	
	checkResist: function (){
		var errorMsg = "";
		if($("input[name='jobPlace']").val() == "") {
			errorMsg += "勤務先を入れてぽ！\n";
		}
		if($("input[name='date']").val() == "") {
			errorMsg += "日付を決めてぽ！\n";
		}
		if($("#hdnStartHour").val() == "" || $("#hdnStartMinute").val() == "" || $("#hdnEndHour").val() == "" || $("#hdnEndMinute").val() == "" ) {
			errorMsg += "時刻を決めてぽ！\n";
		}
		if($("select[name='job']").val() == "" ) {
			errorMsg += "ジャンルを選んでぽ！\n";
		}
		
		if(errorMsg != "") {
			alert(errorMsg);
		}else{
			return true;
		}
	},
	
	//新しいバイト先か？それとも今までのバイト先を選ぶか？
	newCompanyUI: function (){
		//もしも過去に勤務先がある場合、hiddenに勤務先の値をツッコむ
		if($("#haveEver").css("display") === "block") { $("input[name='jobPlace']").val($("select[id='company']").val()); }
			$("select[id='company']").change(function (){
					if($(this).val() === "new") {
						var _this = this;
						$(_this).val($(_this).children()[0]);//新規が選ばれると一旦最初のoptionの値に戻す
						$("#newEver").next("dd").slideDown(300, function (){
							$(_this).closest("dd").slideUp(300);
							$("#newEver").removeClass("hidden");
							$("#haveEver").addClass("hidden").bind("click", Biteup.haveEver);
						});
					}else{
						//新規勤務先じゃなかったらhiddenに登録
						$("input[name='jobPlace']").val($(this).val());
					}
				});
				$("input.newRegist").keypress(function(e) {
					//新規勤務先がキーダウンされたタイミングでもhiddenに送信
					$("input[name='jobPlace']").val($(this).val());
				});
		},//newCompanyUI
		
	haveEver: function (){ //過去のバイト先が選ばれる
		$("input[name='jobPlace']").val($("select[id='company']").val());
		$("#haveEver").removeClass("hidden").next("dd").slideDown(300, function (){
				$("#newEver").addClass("hidden").bind("click", Biteup.newEver).next("dd").slideUp(300);
			});
		},
		
	newEver: function (){ //新しいバイト先が選ばれる
		$("input[name='jobPlace']").val($("input.newRegist").val());
		$("#newEver").removeClass("hidden").next("dd").slideDown(300, function (){
			$("#haveEver").addClass("hidden").next("dd").slideUp(300);
		});
	},
			
	showCalendar: function (){
		$("#biteCalCall").unbind(Biteup.ev);
		var cal = new dhCalUI("biteCalCall","biteCalendar");
		$(cal).bind("complete", function (e){
			$("input[name='date']").val( $("#biteCalCall").text().replace(/[年月]/g, "-" ).replace("日",""));
			$("#biteCalCall").bind(Biteup.ev, Biteup.showCalendar);
		});
	}
		

		
		
}; // Biteup

window.onload = function (){
	var ev = "touchstart mousedown"; //touchstart
	$("#biteCalCall").bind(Biteup.ev, Biteup.showCalendar);
	Biteup.newCompanyUI();
	
	$("#startTime").timeSelector({ format: "<em>%H</em><em>%M</em>", target: "timeFrame1" });
	$("#endTime").timeSelector({ format: "<em>%H</em>時間<em>%M</em>分", target: "timeFrame2" });
		
}
