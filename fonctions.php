<?php

function login($user,$pass){


    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://localhost:3000/api/v1/login");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&password=$pass");

    curl_setopt($ch, CURLOPT_POST, 1);

    $headers = array();
    $headers[] = "Content-Type: application/x-www-form-urlencoded";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);

    $json = json_decode($result);

    if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
    }
    curl_close ($ch);

    return $json;
}

function list_channels($token,$id){

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://localhost:3000/api/v1/channels.list");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


    $headers = array();
    $headers[] = "X-Auth-Token: $token";
    $headers[] = "X-User-Id: $id";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $list = curl_exec($ch);

    $obj = json_decode($list);

    foreach($obj->channels as $k){
      echo "<li>#".$k->name."</li></br>";
    }

    if (curl_errno($ch)) {
      echo 'Err:' . curl_error($ch);
    }
    curl_close ($ch);
}

function send_msg ($token,$id){

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, "http://localhost:3000/api/v1/chat.postMessage");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "channel=#general&text=Je suis un pote à Gé et j'ai gagné!" );
  curl_setopt($ch, CURLOPT_POST, 1);

  $headers = array();
  $headers[] = "X-Auth-Token: $token";
  $headers[] = "X-User-Id: $id";
  $headers[] = "Content-Type: application/x-www-form-urlencoded";
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $msg = curl_exec($ch);

  $json = json_decode($msg);

  $message = $json->message->msg;

  echo $message;

  if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
  }
  curl_close ($ch);
}
?>
