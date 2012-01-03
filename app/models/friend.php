<?php
class Friend extends AppModel {
	var $name = 'Friend';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

    var $belongsTo = array(
        /*
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
        ),
         */
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'friend_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
