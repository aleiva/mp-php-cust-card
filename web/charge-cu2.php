<?php
  require_once('./sdk/meli.php');

  $meli = new Meli('7929281084187786', 'zgO0UhRBSnDRYLq0M8emV62s7VUw62Vu');
  $response = $meli->getAccessToken();
  $params = array('access_token' => $response['body']->access_token);
  $payer_email = 'test@mp.com';
  $card_token_id = $_POST['card_token'];

  //Creación de pago.
  $body = array();
  $body['amount'] = 2.0;
  $body['card'] = $card_token_id;
  $body['payer_email'] = $payer_email;

  //Deberiamos hacer esto opcional
  $body['reason'] = 'PHP reason';
  $body['installments'] = 1;


  $payment = $meli->post('/checkout/custom/beta/create_payment', $body, $params);

  echo $payment["body"]->payment_id."\n";

  //Creación de customers y asignación de tarjeta
  $body = array('email' => $payer_email, 'card' => $card_token_id);
  $customer = $meli->post('/customers', $body, $params);


  echo $customer["body"]->id;

?>