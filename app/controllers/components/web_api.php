<?php
class WebApiComponent extends Object
{
    // Result data send as JSON
    function sendApiResult($dataArray = null) {
        if(!empty($dataArray)) {
            $json = json_encode($dataArray);
            header('Content-type: application/json');
            echo $json;
        } else {
            header('Content-type: text/plain; charset=utf-8');
            echo 'undefined';
        }
    }

}
