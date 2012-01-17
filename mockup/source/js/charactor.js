var Charactor = {
	chara: {
		power: {
			name: "力仕事系、労働",
			level: [
						{ lv:"0", url:"chara_power_lv0.png", alt: "ただの平凡なフェアリー" },
						{ lv:"1", url:"chara_power_lv1.png", alt: "引越しスタッフのピクシー" },
						{ lv:"2", url:"chara_power_lv2.png", alt: "建築現場のゴブリン" },
						{ lv:"3", url:"chara_power_lv3.png", alt: "現場チーフのエルフ" },
						{ lv:"4", url:"chara_power_lv4.png", alt: "筋肉ムキムキになったドワーフ" }
					]
				}, // 職業：power　終了
				
		events: {
			name: "イベントスタッフ",
			level: [
						{ lv:"0", url:"chara_event_lv0.png", alt: "ただの平凡なフェアリー" },
						{ lv:"1", url:"chara_event_lv1.png", alt: "ティッシュ配りのピクシー" },
						{ lv:"2", url:"chara_event_lv2.png", alt: "スポーツ会場警備のゴブリン" },
						{ lv:"3", url:"chara_event_lv3.png", alt: "コンサートスタッフのエルフ" },
						{ lv:"4", url:"chara_event_lv4.png", alt: "モーターショーのドワーフ" }
					]
				}, // 職業：events　終了
				
		sampling: {
			name: "サンプリングスタッフ",
			level: [
						{ lv:"0", url:"chara_sampling_lv0.png", alt: "ただの平凡なフェアリー" },
						{ lv:"1", url:"chara_sampling_lv1.png", alt: "チラシ配りのピクシー" },
						{ lv:"2", url:"chara_sampling_lv2.png", alt: "ソーセージ試食のゴブリン" },
						{ lv:"3", url:"chara_sampling_lv3.png", alt: "コーヒー試飲のエルフ" },
						{ lv:"4", url:"chara_sampling_lv4.png", alt: "ワイン試飲のほろ酔いドワーフ" }
					]
				}, // 職業：sampling　終了
				
		shop: {
			name: "店舗スタッフ",
			level: [
						{ lv:"0", url:"chara_shop_lv0.png", alt: "ただの平凡なフェアリー" },
						{ lv:"1", url:"chara_shop_lv1.png", alt: "販売員のピクシー" },
						{ lv:"2", url:"chara_shop_lv2.png", alt: "チーフのゴブリン" },
						{ lv:"3", url:"chara_shop_lv3.png", alt: "フロアマネージャーのエルフ" },
						{ lv:"4", url:"chara_shop_lv4.png", alt: "店長のドワーフ" }
					]
				}, // 職業：shop　終了
				
		office: {
			name: "オフィスワーク",
			level: [
						{ lv:"0", url:"chara_office_lv0.png", alt: "ただの平凡なフェアリー" },
						{ lv:"1", url:"chara_office_lv1.png", alt: "新人事務のピクシー" },
						{ lv:"2", url:"chara_office_lv2.png", alt: "営業事務のゴブリン" },
						{ lv:"3", url:"chara_office_lv3.png", alt: "経理で何かを企むエルフ" },
						{ lv:"4", url:"chara_office_lv4.png", alt: "企画のドワーフ" }
					]
				}, // 職業：office　終了
				
		teacher: {
			name: "講師・インストラクター",
			level: [
						{ lv:"0", url:"chara_teacher_lv0.png", alt: "ただの平凡なフェアリー" },
						{ lv:"1", url:"chara_teacher_lv1.png", alt: "アシスタントのピクシー" },
						{ lv:"2", url:"chara_teacher_lv2.png", alt: "塾講師ののゴブリン" },
						{ lv:"3", url:"chara_teacher_lv3.png", alt: "英会話教室のエルフ" },
						{ lv:"4", url:"chara_teacher_lv4.png", alt: "セミナー講師のドワーフ" }
					]
				}, // 職業：teacher　終了
				
		free: {
			name: "遊び人（その他）",
			level: [
						{ lv:"0", url:"chara_free_lv0.png", alt: "ただの平凡なフェアリー" },
						{ lv:"1", url:"chara_free_lv1.png", alt: "ヘルプのピクシー" },
						{ lv:"2", url:"chara_free_lv2.png", alt: "夜のお店のゴブリン" },
						{ lv:"3", url:"chara_free_lv3.png", alt: "悪そうな奴は大体友達なエルフ" },
						{ lv:"4", url:"chara_free_lv4.png", alt: "夜の女王ドワーフ" }
					]
				}, // 職業：free　終了
				
		season: {
			name: "季節系（夏季限定／冬季限定）",
			level: [
						{ lv:"0", url:"chara_season_lv0.png", alt: "ただの平凡なフェアリー" },
						{ lv:"1", url:"chara_season_lv1.png", alt: "海の家のピクシー" },
						{ lv:"2", url:"chara_season_lv2.png", alt: "山小屋のゴブリン" },
						{ lv:"3", url:"chara_season_lv3.png", alt: "スキーインストラクターのエルフ" },
						{ lv:"4", url:"chara_season_lv4.png", alt: "ライフセーバーのドワーフ" }
					]
				} // 職業：season　終了
				
		},
		
		// --------------------------------   chara　終了   --------------------------------
		
	background: [
			{ url: "bg_lv0.jpg" },
			{ url: "bg_lv1.jpg" },
			{ url: "bg_lv2.jpg" },
			{ url: "bg_lv3.jpg" },
			{ url: "bg_lv4.jpg" },
			{ url: "bg_lv5.jpg" }
		],
		
		// --------------------------------   背景　終了   --------------------------------
		
	commonTitle: [
			"ノーマル", "羽が生えてる",	"ツノ／コンボウ",	"耳長／帽子",	"目付き悪／ヒゲ",	"背後キラキラ？"
		],
		
		// --------------------------------   共通特徴　終了   --------------------------------
	
	getImage: function (jobKind, level){
		var imgs = {}, basePath = "/img/avatar/";
		
		imgs.bg = Charactor.background[level].url;
		$(Charactor.chara).each( function (i, val){
				for(var i in this) {
					if(i === jobKind) {
						imgs.uwamono = this[i].level[level].url;
					}
				}
			});
		
		var container = $("<div />");
		var bg = $("<img src='"+basePath+imgs.bg+"'>");
		var uwamono = $("<img src='"+basePath+imgs.uwamono+"'>");
		var bodys = $("<img src='"+basePath+"chara_lv0.png"+"'>");
		container.append(bg);
		if(level === 0) {
			bodys = uwamono;
			container.append(bodys);
		}else{
			container.append(bodys);
			container.append(uwamono);
		}
		
		return container;
			
	}





}; // Charactor オブジェクト終了