<?php

	//　トップページ用

	$res = "{	isCheckin: false,
						jobId: 123,
						infoCount: 2,
						jobs: [
							{
								id: 2,
							 	name: 'クロネコヤマト',
							 	date: '2012-1-20',
							 	startTime: '13-30'
							}
						],
						feeds: [
							{ id: 200, jobKind: '2', level: '1', userID: '1234', body: '<span>Hidetaro7さん</span>がバイトにチェックインしました。', likesCount: '12', commentCount: '3', created: '2012-01-19 12:00:00' },
							{ id: 201, jobKind: '1', level: '3', userID: '1234', body: '<span>Tommmmyさん</span>がバイトにチェックインしました。', likesCount: '12', commentCount: '3', created: '2012-01-18 12:00:00' },
							{ id: 202, jobKind: '4', level: '5', userID: '1234', body: '<span>nakashizuさん</span>がバイトにチェックインしました。', likesCount: '12', commentCount: '3', created: '2012-01-20 18:00:00' },
							{ id: 203, jobKind: '6', level: '2', userID: '1234', body: '<span>BathTimeFishさん</span>がバイトにチェックインしました。', likesCount: '12', commentCount: '3', created: '2012-01-20 20:00:00' }
						]
					} ";
	print( $res );

?>