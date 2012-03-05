(function($, window) {
	var ts_info = {
		name: "ui-time-selector"
	};
	
	var ts_skin = "<div class='ui-time-selector'>"
 + "<div class='tenkey-frame'>"
 + "<span id='ui-btn-0' data-value='0' class='button'>0</span>"
 + "<span id='ui-btn-1' data-value='1' class='button'>1</span>"
 + "<span id='ui-btn-2' data-value='2' class='button'>2</span>"
 + "<span id='ui-btn-3' data-value='3' class='button disabled'>3</span>"
 + "<span id='ui-btn-4' data-value='4' class='button disabled'>4</span>"
 + "<span id='ui-btn-5' data-value='5' class='button disabled'>5</span>"
 + "<span id='ui-btn-6' data-value='6' class='button disabled'>6</span>"
 + "<span id='ui-btn-7' data-value='7' class='button disabled'>7</span>"
 + "<span id='ui-btn-8' data-value='8' class='button disabled'>8</span>"
 + "<span id='ui-btn-9' data-value='9' class='button disabled'>9</span>"
 + "</div>"
 + "<span id='ui-btn-back' data-value='back' class='button disabled'>もどる</span>"
 + "<span id='ui-btn-cancel' data-value='cancel' class='button'>消す</span>"
 + "<span id='ui-btn-now' data-value='now' class='button'>今の時刻</span>"
 + "<div class='input-frame'>"
 + "<span id='ui-input-1' class='input forcus'></span>"
 + "<span id='ui-input-2' class='input'></span>"
 + "<span id='ui-input-3' class='input'></span>"
 + "<span id='ui-input-4' class='input'></span>"
 + "</div>"
 + "</div>";

	$.fn.timeSelector = function(arg) {

		var oTarget = $(this);
		var tHour = oTarget.data("hour");
		var tMinute = oTarget.data("minute");
		if (!tHour && !tMinute) {
			return;
		}
		
		var format = (arg.format) ? arg.format : "%H:%M";
		
		var toHour = arg.toHour;
		var toMinute = arg.toMinute;
		if (!toHour && !toMinute) {
			return;
		}
		
		oTarget.on("click", function() {
		
			var oHour = $("#" + tHour), oMinute = $("#" + tMinute);
			var hdnHour = $("#" + toHour), hdnMinute = $("#" + toMinute);
			var defHour = oHour.val(), defMinute = oMinute.val();
			
			var valH1 = valH2 = valM1 = valM2 = "";
			if (defHour != "" && defMinute != "") {
				if (defHour.length < 2) {
					valH1 = "0";
					valH2 = defHour.charAt(0);
				} else {
					valH1 = defHour.charAt(0);
					valH2 = defHour.charAt(1);
				}

				if (defMinute.length < 2) {
					valM1 = "0";
					valM2 = defMinute.charAt(0);
				} else {
					valM1 = defMinute.charAt(0);
					valM2 = defMinute.charAt(1);
				}
			}
 		
			var setId = $(this).attr("id") + "-" + ts_info.name;
			if (0 < $("#" + setId).size()) {
				return;
			}
			
			var oWrapper = $(ts_skin).attr("id", setId);
			
			if (arg.target) {
				$("#" + arg.target).append(oWrapper);
			} else {
				$("body").append(oWrapper);
			}
			
			var oKeys = oWrapper.find(".button");
			var oInput = oWrapper.find(".input");
			
			oInput.filter("[id='ui-input-1']").text(valH1);
			oInput.filter("[id='ui-input-2']").text(valH2);
			oInput.filter("[id='ui-input-3']").text(valM1);
			oInput.filter("[id='ui-input-4']").text(valM2);
			
	
			oKeys.on("touchstart mousedown", function(e) {
				var oSelf = $(this);
				oSelf.addClass("tap");
				
				var value = oSelf.data("value");
	
				switch (value) {
					case "back":
					
						if (oSelf.hasClass("disabled")) {
							break;
						}
						
						var oForcus = oInput.filter("[class*='forcus']");
						oForcus.text("");
	
						var oPrev = oForcus.prev();
						if (oPrev.size() < 1) {
							console.log("2");
							break;
						}
						
						oForcus.removeClass("forcus");
						oPrev.addClass("forcus");
						oPrev.text("");

						if (oPrev.prev().size() < 1) {
							oSelf.addClass("disabled")
						}
						
						setButtonConditions(oPrev);

						break;
					case "cancel":
						oWrapper.remove();
						break;
					case "enter":
						var valKeta1 = oInput.filter("[id='ui-input-1']").text();
						var valKeta2 = oInput.filter("[id='ui-input-2']").text();
						var valKeta3 = oInput.filter("[id='ui-input-3']").text();
						var valKeta4 = oInput.filter("[id='ui-input-4']").text();

						setValue(valKeta1, valKeta2, valKeta3, valKeta4);
/*	
						oTarget.text(valKeta1 + valKeta2 + ":" + valKeta3 + valKeta4);
						oHour.val(parseInt(valKeta1 + "" + valKeta2));
						oMinute.val(parseInt(valKeta3 + "" + valKeta4));
*/						
						oWrapper.remove();

						break;
					case "now":
						var now = new Date();
						var nowHour = "" + now.getHours();
						var nowMinute = "" + now.getMinutes();
						
						if (nowHour.length < 2) {
							valH1 = "0";
							valH2 = nowHour.charAt(0);
						} else {
							valH1 = nowHour.charAt(0);
							valH2 = nowHour.charAt(1);
						}
		
						if (nowMinute.length < 2) {
							valM1 = "0";
							valM2 = nowMinute.charAt(0);
						} else {
							valM1 = nowMinute.charAt(0);
							valM2 = nowMinute.charAt(1);
						}


						setValue(valH1, valH2, valM1, valM2);
/*						
						oTarget.text(valH1 + "" + valH2 + ":" + valM1 + "" + valM2);
						oHour.val(parseInt(valH1 + "" + valH2));
						oMinute.val(parseInt(valM1 + "" + valM2));
*/						
						oWrapper.remove();
						
						break;
					default:

						if (oSelf.hasClass("disabled")) {
							break;
						}
					
						var oForcus = oInput.filter("[class*='forcus']");
						oForcus.text(value);
						
						var oNext = oForcus.next();
						
						if (oNext.size() < 1) {
						
							var valKeta1 = oInput.filter("[id='ui-input-1']").text();
							var valKeta2 = oInput.filter("[id='ui-input-2']").text();
							var valKeta3 = oInput.filter("[id='ui-input-3']").text();
							var valKeta4 = oInput.filter("[id='ui-input-4']").text();

							setValue(valKeta1, valKeta2, valKeta3, valKeta4);
/*									
							oTarget.text(valKeta1 + "" + valKeta2 + ":" + valKeta3 + "" + valKeta4);
							oHour.val(parseInt(valKeta1 + "" + valKeta2));
							oMinute.val(parseInt(valKeta3 + "" + valKeta4));
*/							
							oWrapper.remove();

							break;
						} else {
							oNext.text("");
							var oNext2 = oNext.next();
							if (0 < oNext2.size()) {
								oNext2.text("");
								var oNext3 = oNext2.next();
								if (0 < oNext3.size()) {
									oNext3.text("");
								}
							}
						}
						
						setButtonConditions(oNext);

						oForcus.removeClass("forcus");
						oNext.addClass("forcus");
						$("#ui-btn-back").removeClass("disabled").text("もどる");
						break;
				}
				
				function setButtonConditions(obj) {
					var obFrame = oWrapper.find(".tenkey-frame");
					obFrame.find("span").addClass("disabled");
					if (obj.attr("id") == "ui-input-1") {
						obFrame.find("#ui-btn-0, #ui-btn-1, #ui-btn-2").removeClass("disabled");
					}else if (obj.attr("id") == "ui-input-2") {
						if (value == "0" || value == "1") {
							obFrame.find(".disabled").removeClass("disabled");
						} else {
							obFrame.find("#ui-btn-0, #ui-btn-1, #ui-btn-2, #ui-btn-3").removeClass("disabled");
						}
					} else if (obj.attr("id") == "ui-input-3") {
						obFrame.find("#ui-btn-0, #ui-btn-1, #ui-btn-2, #ui-btn-3, #ui-btn-4, #ui-btn-5").removeClass("disabled");
					} else if (obj.attr("id") == "ui-input-4") {
						oWrapper.find(".tenkey-frame span").removeClass("disabled");
					}
				}

				function setValue(valH1, valH2, valM1, valM2) {
					var setH = valH1 + "" + valH2;
					var setM = valM1 + "" + valM2;
					var setVal = format.replace("%H", setH);
							setVal = setVal.replace("%M", setM);
							
							console.log(parseInt(setH, 10));

					oTarget.html(setVal);
					oHour.val(parseInt(setH, 10));
					oMinute.val(parseInt(setM, 10));					
					hdnHour.val(parseInt(setH, 10));
					hdnMinute.val(parseInt(setM, 10));
				}
				
				
				e.preventDefault();
			}).on("touchend mouseup", function(e) {
				$(this).removeClass("tap");
			});
			
			
		});	

	};


})(jQuery, window);