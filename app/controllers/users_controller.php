<?php
// app/controllers/users_controller.php
class UsersController extends AppController {
    public $components = array('Openid', 'RequestHandler');
    public $uses = array();

    public function login() {
        $realm = 'http://' . $_SERVER['HTTP_HOST'];
        $returnTo = $realm . '/users/login';

        if ($this->RequestHandler->isPost() && !$this->Openid->isOpenIDResponse()) {
            try {
                $this->Openid->authenticate($this->data['OpenidUrl']['openid'], $returnTo, $realm);
            } catch (InvalidArgumentException $e) {
                $this->set('error', 'Invalid OpenID');
            } catch (Exception $e) {
                $this->set('error', $e->getMessage());
            }
        } elseif ($this->Openid->isOpenIDResponse()) {
            $response = $this->Openid->getResponse($returnTo);

            if ($response->status == Auth_OpenID_CANCEL) {
                $this->set('error', 'Verification cancelled');
            } elseif ($response->status == Auth_OpenID_FAILURE) {
                $this->set('error', 'OpenID verification failed: '.$response->message);
            } elseif ($response->status == Auth_OpenID_SUCCESS) {
                echo 'successfully authenticated!';
                exit;
            }
        }
    }

    public function phpinfo() {
        $this->layout = "";
        phpinfo();
    }
}
?>
