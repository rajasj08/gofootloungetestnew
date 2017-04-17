<?php

include('config.php');
 
$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//$sql = "SELECT a.order_status_id,a.date_added,a.date_modified,a.order_id,a.email,a.firstname,a.lastname FROM `oc_order` as a left join oc_order_status as b on b.order_status_id=a.order_status_id where b.name='completed' and (DATE(a.date_modified)=CURDATE() OR DATE(a.date_modified) =DATE_SUB(CURDATE(), INTERVAL 1 DAY) OR DATE(a.date_modified) =DATE_SUB(CURDATE(), INTERVAL 2 DAY))";


/* Origional query*/

$sql = "SELECT a.order_status_id,a.date_added,a.date_modified,a.order_id,a.email,a.firstname,a.lastname FROM `oc_order` as a left join oc_order_status as b on b.order_status_id=a.order_status_id where b.name='completed' and DATE(a.date_modified) = DATE_SUB(CURDATE(), INTERVAL 4 DAY)";

/*$sql = "SELECT a.order_status_id,a.date_added,a.date_modified,a.order_id,a.email,a.firstname,a.lastname FROM `oc_order` as a left join oc_order_status as b on b.order_status_id=a.order_status_id where DATE(a.date_modified) = DATE_SUB(CURDATE(), INTERVAL 6 DAY)"; */



$result = $conn->query($sql); 

 
      $count=1;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {  
      
      if($row['email']) {$tomail=trim($row['email']);} else $tomail=''; 

       $message1= htmlentities(file_get_contents(CurrentHost."/newmail.php"));   
         $message1=html_entity_decode($message1);    

         if($tomail)
        {  
          
          
          $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
          $headers .= 'From: FootLounge <order@footlounge.in>'."\r\n".
          //$headers .= 'From: rselakki@gmail.com'."\r\n".
          //'CC: rajesh@tech-bee.comm'.
        //'Reply-To: '.$emailid."\r\n" .
        'X-Mailer: PHP/' . phpversion(); 


          // Create email headers$emailid
      
        // if( mail('Pooja_khatri@yahoo.com', 'Email Notification Request Received', $str1, $headers))
       if( mail($tomail, 'Thank You for Shopping ! Review Us to Earn a Free Pair of Socks', $message1, $headers))
       { $count++;} else echo 0;         
 
        }  

    }

    if($count >1){ echo "Notification mail send successfully to the customers"; } 
} else {
    echo "No Mail Send";}
$conn->close();

?>