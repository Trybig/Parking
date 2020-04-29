<?php 
ob_start();
include ('inc/connect_db.php'); //подключение бд
function redirect_to($new_location) {
      header("Location: " . $new_location);
      exit;
  } 
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
  	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/inc/css/at_parking.css" >
  	<meta charset="UTF-8">
  	<title>На парковке</title>
  </head>
  <body>
  	<center>
  		<h1>Автомобили на парковке:</h1>
  	<table border="1" rules="rows" cellpadding="10">
	<thead>
    <tr>     
      <th>Марка</th>
      <th>Модель</th>
      <th>Гос.номер</th>
    </tr>
  </thead>
   <br/>
   
   <?php //вывод пользователей, которые находятся на парковке
   $sql = $pdo->query("SELECT brand, model , car_number  FROM cars WHERE at_parking='yes'");
      while ($result = $sql->fetch()) 
       echo '<tr>' .
             "<td>{$result['brand']}</td>" . 
             "<td>{$result['model']}</td>" .
             "<td>{$result['car_number']}</td>".
             '</tr>';            
    ?>
    </table>
    <br/><br/>
    <a href="/all_users.php">Все клиенты</a>
	</center>
  </body>
  </html>