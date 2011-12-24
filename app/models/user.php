<?php
class User extends AppModel {
 var $name = 'User';
 var $displayField = 'name';
 var $validate = array(
  'nickname' => array(
   'notempty' => array(
    'rule' => array('notempty'),
    //'message' => 'Your custom message here',
    //'allowEmpty' => false,
    //'required' => false,
    //'last' => false, // Stop validation after this rule
    //'on' => 'create', // Limit validation to 'create' or 'update' operations
   ),
  ),
  'username' => array(
   'notempty' => array(
    'rule' => array('notempty'),
    //'message' => 'Your custom message here',
    //'allowEmpty' => false,
    //'required' => false,
    //'last' => false, // Stop validation after this rule
    //'on' => 'create', // Limit validation to 'create' or 'update' operations
   ),
  ),
  'password' => array(
   'notempty' => array(
    'rule' => array('notempty'),
    //'message' => 'Your custom message here',
    //'allowEmpty' => false,
    //'required' => false,
    //'last' => false, // Stop validation after this rule
    //'on' => 'create', // Limit validation to 'create' or 'update' operations
   ),
  ),
  'email' => array(
   'email' => array(
    'rule' => array('email'),
    //'message' => 'Your custom message here',
    //'allowEmpty' => false,
    //'required' => false,
    //'last' => false, // Stop validation after this rule
    //'on' => 'create', // Limit validation to 'create' or 'update' operations
   ),
  ),
 );
 //The Associations below have been created with all possible keys, those that are not needed can be removed

}
