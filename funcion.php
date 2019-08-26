<?php

require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;



$woocommerce = new Client(
    'http://umamexico.com/',
    'ck_a16848c51f13241037cd193eb63f79ff50fd467c',
    'cs_5f5a627bf4966588bb2892b2a559292cf50188a7',
    [
        'wp_api' => true,
        'version' => 'wc/v3'
    ]
);

$servername = "localhost";
$database = "api";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 
echo "Connected successfully";

try {
    // Array of response results.
    $results = $woocommerce->get('orders');
     foreach ($results as $result) {
        $s=substr(json_encode( $result->status),1,9);
        if($s=="completed"){
        
            foreach ($result->line_items as $item) {
                $firstname= $result->billing->first_name;
                $lastname=$result->billing->last_name;
                $email=$result->billing->email;
                $itemname=$item->name;
                $itemtotal=$item->total;
                 $address1=$result->billing->address_1;
                $address2=$result->billing->address_2;
               $city=$result->billing->city;
                $state=$result->billing->state;
                $postcode=$result->billing->postcode;
                $country=$result->billing->country;
                $phone=$result->billing->phone;
                $company=$result->billing->company;
        
                $stmt = $conn->prepare("INSERT INTO datos(billing_first_name,billing_last_name,	billing_email,	line_items_name,line_items_total,billing_address1,billing_address2,billing_city,billing_state,billing_postcode,billing_country,	billing_phone,billing_company) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $stmt->bind_param('ssssissssisis', $firstname, $lastname,$email,$itemname,$itemtotal,$address1,$address2,$city,$state,$postcode,$country,$phone,$company);
                $stmt->execute();

            }
           
            
           

           
          
    
         
        }else{
            echo "salio";
        }  
      }
      echo "Se han creado las entradas exitosamente";
// Cerrar conexiones
$stmt->close();
$conn->close();

    // Example: ['customers' => [[ 'id' => 8, 'created_at' => '2015-05-06T17:43:51Z', 'email' => ...
  // echo '<pre><code>' . print_r( json_encode( $results), true ) . '</code><pre>'; // JSON output.

    // Last request data.
   

} catch (HttpClientException $e) {
    echo '<pre><code>' . print_r( $e->getMessage(), true ) . '</code><pre>'; // Error message.
    echo '<pre><code>' . print_r( $e->getRequest(), true ) . '</code><pre>'; // Last request data.
    echo '<pre><code>' . print_r( $e->getResponse(), true ) . '</code><pre>'; // Last response data.
}


?>