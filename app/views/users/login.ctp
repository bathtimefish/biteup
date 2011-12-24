<?php
// app/views/users/login.ctp
if (isset($error)) {
    echo '<p class="error">'.$error.'</p>';
}
echo $form->create('User', array('type' => 'post', 'action' => 'login'));
echo $form->input('OpenidUrl.openid', array('label' => false));
echo $form->end('Login');
?>
