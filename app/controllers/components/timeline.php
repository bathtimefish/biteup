<?php
class TimelineComponent extends Object
{
	var $_controller;
	function startup(& $controller) {
		$this->_controller = $controller;
	}
    // タイムラインの情報取得。
    function getTimeline($user_id) {
		$friends = $this->_controller->Friend->find('all', array('conditions'=> array('user_id'=>$user_id)));
    	$feed_id = '';
		foreach ($friends as $val) {
			$feed_id .= $val['Friend']['friend_id'].',';
		}
		$feed_id = $feed_id.$user_id;
		$feeds = $this->_controller->Feed->find('all', array('order' => 'Feed.created DESC','conditions'=> array("Feed.user_id IN ($feed_id)")));
	
		$timeline = array();
		
		foreach($feeds as $feed){
			$timeline[$feed['Feed']['id']]['name'] = $feed['User']['username'];
			$comment_cnt = 0;
			foreach ($feed['Like'] as $like) {
				if ($like['message']!='')
					$comment_cnt++;
			}
			$timeline[$feed['Feed']['id']]['like_count'] = count($feed['Like']);
			$timeline[$feed['Feed']['id']]['comment_count'] = $comment_cnt;
			$timeline[$feed['Feed']['id']]['time'] = $this->getActionTime($feed['Feed']['created']);
		}
		return $timeline;
    }
    
    //  〜分前の投稿
    function getActionTime($time){
    	$action = time()-strtotime(date($time));
    	if ($action < 60) {
    		$pattern = '今';
    	} elseif (60 <= $action && $action < 180) {
    		$pattern = '1分前';
    	} elseif (180 <= $action && $action < 300) {
    		$pattern = '3分前';
    	} elseif (200 <= $action && $action < 600) {
    		$pattern = '5分前';
    	} elseif (600 <= $action && $action < 900) {
    		$pattern = '10分前';
    	} elseif (900 <= $action && $action < 1200) {
    		$pattern = '15分前';
    	} elseif (1200 <= $action && $action < 1800) {
    		$pattern = '20分前';
    	} elseif (1800 <= $action && $action < 2700) {
    		$pattern = '30分前';
    	} elseif (2700 <= $action && $action < 3600) {
    		$pattern = '45分前';
    	} elseif (3600 <= $action && $action < 7200) {
    		$pattern = '1時間前';
    	} elseif (7200 <= $action && $action < 10800) {
    		$pattern = '2時間前';
    	} elseif (10800 <= $action && $action < 18000) {
    		$pattern = '3時間前';
    	} elseif (18000 <= $action && $action < 25200) {
    		$pattern = '5時間前';
    	} elseif (25200 <= $action && $action < 36000) {
    		$pattern = '7時間前';
    	} elseif (36000 <= $action && $action < 54000) {
    		$pattern = '10時間前';
    	} elseif (54000 <= $action && $action < 72000) {
    		$pattern = '15時間前';
    	} elseif (72000 <= $action && $action < 86400) {
    		$pattern = '20時間前';
    	} elseif (86400 <= $action && $action < 172800) {
    		$pattern = '1日前';
    	} elseif (172800 <= $action && $action < 259200) {
    		$pattern = '2日前';
    	} elseif (259200 <= $action && $action < 604800) {
    		$pattern = '3日前';
    	} elseif (604800 <= $action && $action < 1209600) {
    		$pattern = '1週間前';
    	} elseif (1209600 <= $action && $action < 2592000) {
    		$pattern = '2週間前';
    	} elseif (2592000 <= $action && $action < 7776000) {
    		$pattern = '1ヶ月前';
    	} elseif (7776000 <= $action && $action < 15552000) {
    		$pattern = '3ヶ月前';
    	} elseif (15552000 <= $action && $action < 31104000) {
    		$pattern = '半年前';
    	} else {
    		$pattern = '1年以上前';
    	}
    	return $pattern;
    }
}
