var dhCalUISingle = false;

function dhCalUI (_res, _id) {
	if(dhCalUISingle) return false;
	dhCalUISingle = true;
	console.log("attention!");
	var container = document.getElementById(_id);
	var resourse = document.getElementById(_res);
	var _this = this, prev, next, boxWidth = 0, wrap=null, eventName = "touchstart"; //touchstart
	_this.currentMonth = new Date().getMonth()+1;
	_this.currentPage = 0; // ページの位置
	
	$(container).hide().append(source()).find("#calContainer").append(boxSource());
	$("#calContainer .calbox").width($("body").width());
	boxWidth = $("#calContainer .calbox:first-child").width();
	$("#calContainer").width(boxWidth * 6);
	wrap = $("#calContainer");
	prev = document.getElementById("controler").getElementsByClassName("prev")[0];
	next = document.getElementById("controler").getElementsByClassName("next")[0];
	prev.addEventListener(eventName, prevStart, false);
	next.addEventListener(eventName, nextStart, false);
	
	var dd = new Date();
	for(var i=1; i<=6; i++) {
		$("#calContainer .calbox:nth-child("+(i)+") .content").append(getCal( dd.getFullYear(), _this.currentMonth+(i-1), dd.getDay() ));
	};
	
	//tapEvent for get selected date
	$(".calbox").bind(eventName, tapGrid);
	
	//show
	$(container).fadeIn(300);
	return _this;
	
		
	function prevStart (e) { // 先月へ
		e.preventDefault();
		(_this.currentPage-- <= 0) ? _this.currentPage = 0 : _this.currentPage;
		wrap.animate({"margin-left":-(_this.currentPage*boxWidth)}, 200);
		}
	
	function nextStart (e) { // 次月へ
		e.preventDefault();
		(_this.currentPage++ >= 5) ? _this.currentPage = 5 : _this.currentPage;
		wrap.animate({"margin-left":-(_this.currentPage*boxWidth)}, 200);
		}
	
	function source () { return '<div id="controler"><a class="prev" href="#">先月へ</a><a class="next" href="#">次月へ</a></div><div class="clipArea"><div id="calContainer"></div></div><div id="calConfirm"><p></p><a href="#">決定</a></div>'; };
	
	function boxSource () {
		var mm = _this.currentMonth, yy = new Date().getFullYear();
		//mm = 11;//テスト用
		var con = "";
			for(var i=0; i<6; i++) {
				con += '<div class="calbox"><header><span class="y">'+yy+'</span>年<span class="m">'+mm+'</span>月</header><div class="content"></div></div>';
				if (mm++ >= 12) {
					mm-=12;
					yy = new Date().getFullYear()+1;
				}
			}
			return con;
		};
		
	// make calender
	
	function getCal (year,month,day) {
		var today=new Date();
		if (!year) var year=today.getFullYear();
		if (!month) var month=today.getMonth()-1;
		else month--;
		if (!day) var day=today.getDate();
		var leap_year=false;
		if ((year%4 == 0 && year%100 != 0) || (year%400 == 0)) leap_year=true;
		var lom=new Array(31,28+leap_year,31,30,31,30,31,31,30,31,30,31);
		dow=new Array("日","月","火","水","木","金","土");
		var days=0;
		for (var i=0; i < month; i++) days+=lom[i];
		var week=Math.floor((year*365.2425+days)%7);
		var j=0;
		var when=year+"年 "+(month+1)+"月";
		var calendar='<table>';
		calendar+="<tr>";
		for (i=0; i < 7; i++) calendar+="<th>"+dow[i]+"<\/th>";
		calendar+="<\/tr>\n<tr>";
		for (i=0; i < week; i++,j++) calendar+="<td><\/td>";
		for (i=1; i <= lom[month]; i++) {
			calendar+="<td";
			var dd = new Date();
			if (dd.getDate() == i && dd.getMonth() == month && year == dd.getFullYear()) {
				calendar+=" class=\"today\"";
			}
			calendar+=">"+i;
	
			/*if(hoge) { //予定が入っていたら
			
			}*/
		
			calendar += "<\/td>";
			j++;
		if (j > 6) {
			calendar+="<\/tr>\n<tr>";
			j=0;
			}
		}
		for (i=j; i > 6; i++) calendar+="<td><\/td>";
		calendar+="<\/tr></table>";
		return calendar;
	};
	
	//tap!
	function tapGrid (e) {
		var yy = $(this).find("header .y").text();
		var mm = $(this).find("header .m").text();
		var dd = $(e.target).text();
		if($(e.target)[0].tagName.toLowerCase() !== "td") {
			return false;
		}
		
		$("#calConfirm").fadeIn(200);
		
		$("#calConfirm a").text(yy+"年"+mm+"月"+dd+"日で決定する").bind(eventName, function (e){
			$(resourse).text(yy+"年"+mm+"月"+dd+"日");
			$(container).fadeOut(300, function (){
					$(_this).trigger("complete");
					$(container).children().remove();
					dhCalUISingle = false;
					delete _this;
					//return false;
				});
		});
	}
}