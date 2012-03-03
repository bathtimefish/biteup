<?php
class FacebookComponent extends Object
{
    var $Facebook;
    var $User;

    /* component statup */
    function startup(&$controller) {
        App::import('Vendor', 'facebook/php-sdk/src/facebook');
        $this->Facebook = new Facebook(array(
            /*** App ID & Secret ***/
            'appId'  => '206177822805264',
            'secret' => 'b9b37bc15a58a969eec0a93fdfb9999a',
            'cookie' => true,
        ));
        $this->User =& new User();
    }//startup()

    // get Facebook Login URL
    function getLoginUrl() {
        return $this->Facebook->getLoginUrl(array(
            'scope' => 'email,publish_stream,user_checkins,publish_checkins,offline_access',
            'display' => 'touch',
	));
        /*
        Sample:

        function facebook_login() {
            $this->autoRender = false;
            $url = $this->Facebook->getLoginUrl();
            $this->redirect($url);
        }

        function fbcallback() {
            $user_id = $this->Auth->user('id');
            $this->Facebook->saveUser($user_id);
        }
       */
    }

    function saveUser($user_id = null) {
        if(empty($user_id)) {
            $this->log('Facebook saveUser(): User ID is empty.', LOG_DEBUG);
            return false;
        }
        $uid = $this->Facebook->getUser();
        if(!$uid) {
            $this->log('Facebook saveUser(): user get failed, UserID='.$user_id, LOG_DEBUG);
            return false;
        }
        $access_token = $this->Facebook->getAccessToken();
        if(!$access_token) {
            $this->log('Facebook saveUser(): access token get failed, FB_uid='.$uid, LOG_DEBUG);
            return false;
        }
        $this->User->recursive = 0;
        $user = array('User' => array(
            'id' => $user_id,
            'fb_access_token' => $access_token
        ));
        if(!$this->User->save($user,false)) {
            $this->log('Facebook Access Token cannot save, UserID='.$user_id, LOG_DEBUG);
            return false;
        }
        return true;
    }

    function getUser() {
        return $this->Facebook->getUser();
    }

    // get Access Token
    function getAccessToken() {
        $sess = $this->Facebook->getSession();
        if(!empty($sess)) {
            return $this->Facebook->getAccessToken();
        }
    }

    // get Me (User Profile)
    function getMe($user_id = null) {
        if(!$user_id) return false;
        $user = $this->User->read(null, $user_id);
        if(empty($user)) return false;
        if(empty($user['User']['fb_access_token'])) {
            $this->log('Facebook getMe(): fb_access_token is empty, UserID='.$user_id, LOG_DEBUG);
            return false;
        }
        $attachment = array(
            'access_token' => $user['User']['fb_access_token'],
        );
        $me = null;
        try {
            $me = $this->Facebook->api('/me', $attachment);
        } catch (FacebookApiException $e) {
            $this->log($e->getType(), LOG_DEBUG);
            $this->log($e->getMessage(), LOG_DEBUG);
        }
        return $me;
    }

    // publish stream
    function publish($user_id = null, $message = null) {
        if(!$user_id || !$message) return false;
        $user = $this->User->read(null, $user_id);
        if(empty($user)) return false;
        if(empty($user['User']['fb_access_token'])) {
            $this->log('Facebook publish(): fb_access_token is empty, UserID='.$user_id, LOG_DEBUG);
            return false;
        }
        $attachment = array(
            'access_token' => $user['User']['fb_access_token'],
            'message' => htmlspecialchars($message),
        );
        try {
            $this->Facebook->api('/me/feed', 'POST', $attachment);
        } catch (FacebookApiException $e) {
            $this->log($e->getType(), LOG_DEBUG);
            $this->log($e->getMessage(), LOG_DEBUG);
            return false;
        }
        return true;
        /*
         * Publish to News Feed
        $this->Facebook->api('/me/feed', 'POST', array(
            'access_token' => "access_token",
            'message' => "This is a Message",
            'name' => "User Name",
            'link' => "http://example.com",
            'description' => "here description",
            'picture'=> "http://example.com/image.jpg"
        ));
        */
        /*
         * Checkin Method
        $this->Facebook->api('/me/checkins', 'POST', array(
            'access_token' => 'access_token',
            'message' => 'This is a Message',
            'name' => 'Place Name',
            'link' => 'http://example.com',
            'description' => 'heare description',
            'place' => 'Place ID',
            'picture' => 'http://example.com/image.jpg',
            'coordinates' => '{"latitude":"' . 0.123456 . '",
            "longitude": "' . 0.789012 . '"}'
        ));
        */
    }

}
