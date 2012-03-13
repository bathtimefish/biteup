<?php
class LevelCalcComponent extends Object
{
    var $User;
    var $Like;
    var $Level;

    /* component statup */
    function startup(&$controller) {
        $this->User =& new User();
        $this->Like =& new Like();
        $this->Level =& new Level();
    }//startup()

    // ユーザーにカレントレベルとカレントジョブIDをセットする
    function setUserLevel($user_id = null, $jobkind_id = null) {
        $this->Like->recursive = 0;
        $this->User->recursive = -1;
        $uped = array(
            'uped' => null,
            'name' => '',
        );
        if($user_id) {
            //現在の最大ポイントのLikeを取得
            $conditions = array('Like.friend_id' => $user_id, 'Like.jobkind_id' => $jobkind_id);
            $order = 'Like.current_point DESC';
            $like = $this->Like->find('first', array('conditions'=>$conditions, 'order'=>$order)); //ユーザーのPointが最大のLikeを取得
            if(!empty($like)) {
                $level = $this->changeCurrentLevel($like['Like']['jobkind_id'], $like['Like']['current_point'], $user_id);
                $this->log($level, LOG_DEBUG);
                $user = array('User' => array(
                    'id' => $user_id,
                    'current_level' => $level['level'],
                    'current_jobkind_id' => $level['jobkind_id'],
                ));
                $this->User->save($user);
                $uped['uped'] = $level['uped'];
                $uped['name'] = $level['name'];
            }
        }
        return $uped;
    }

    // ユーザーのカレントレベル、カレントジョブIDを変更する
    // ポイントが足りなければ変更しない
    function changeCurrentLevel($jobkind_id, $point, $user_id) {
        $uped = false;
        $name = '';
        //現在ポイントに最も近いそれ以下のレベルを取得
        $conditions = array('Level.jobkind_id' => $jobkind_id, 'Level.limit <=' => $point);
        $order = 'Level.limit DESC';
        $level = $this->Level->find('first', array('conditions'=>$conditions, 'order'=>$order));
        //カレントユーザーのレベルと比較
        $current_level = 0;
        $current_jobkind_id = 0;
        $user = $this->User->read(null, $user_id);
        if($user['User']['current_level'] < $level['Level']['level']) { //ユーザーのレベルより大きいければレベルアップ
            $current_level = $level['Level']['level'];
            $current_jobkind_id = $level['Level']['jobkind_id'];
            $name = $level['Level']['name'];
            $uped = true;
        } else {
            $current_level = $user['User']['current_level'];
            $current_jobkind_id = $user['User']['current_jobkind_id'];
            $uped = false;
        }
        $this->log($uped, LOG_DEBUG);
        return array('level'=>$current_level, 'jobkind_id'=>$current_jobkind_id, 'uped'=>$uped, 'name'=>$name);
    }

}
