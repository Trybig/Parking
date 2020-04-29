<?php 
ob_start();
include ('inc/connect_db.php');//подключение бд
function redirect_to($new_location) {
      header("Location: " . $new_location);
      exit;
  }
  //Пользователь
		$name = $_POST['user_name'];
		$gender = $_POST['gender'];
		$phone = $_POST['user_number'];
		$adress = $_POST['adress'];
		$cars = $_POST['volume'];
  //Машина
		$brand = $_POST['brand'];
		$model = $_POST['model'];
		$color = $_POST['color'];
		$car_number = $_POST['car_number'];
		$at_parking = $_POST['at_parking'];



if (isset($_POST['send']) and (
			trim($name)!='' and 
			trim($gender)!='' and
			trim($phone)!='' and 
        	trim($cars)!='' and
        	trim($brand)!='' and 
        	trim($model)!='' and 
        	trim($color)!='' and  
        	trim($car_number)!='' and 
        	trim($at_parking)!='')) 
{
	//проверка номера телефона
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=parking', 'root', '');
	$stmt = $pdo->prepare("SELECT phone_number FROM users WHERE phone_number = ? LIMIT 1"); 
$stmt->execute(array($phone)); 
if($stmt->rowCount()>0) 
echo '<center>'.'<h2>'."Номер телефона уже зарегистрирован".'</h2>'.'</center>';

else 
	{
		//проверка номера автомобиля
		$pdo = new PDO('mysql:host=127.0.0.1;dbname=parking', 'root', '');
		$stmt = $pdo->prepare("SELECT car_number FROM cars WHERE car_number = ? LIMIT 1"); 
		$stmt->execute(array($car_number)); 
		if($stmt->rowCount()>0) 
		echo '<center>'.'<h2>'."Номер автомобиля уже зарегистрирован".'</h2>'.'</center>';
 	else
		{
			//проверка длины ФИО
				if(strlen($name)<3)
			echo '<center>'.'<h2>'."Имя должно содержать не менее 3 символов".'</h2>'.'</center>';
		else {
			// если все уникально, то добавляем запись		
		$query = "INSERT INTO users (name,gender,phone_number,adress,car) VALUES (:name,:gender,:phone,:adress,:cars);
				INSERT INTO cars (brand,model,color,car_number,at_parking) VALUES (:brand,:model,:color,:car_number,:at_parking)";
		$params = [
    			':name' => $name,
    			':gender' => $gender,
    			':phone' => $phone,
    			':adress' => $adress,
    			':cars' => $cars,
    			':brand' => $brand,
    			':model' => $model,
    			':color' => $color,
    			':car_number' => $car_number,
    			':at_parking' => $at_parking
					];
		$stmt = $pdo->prepare($query);
		$stmt->execute($params);
		redirect_to ("inc/html/congrat.html");
			}
		}
	} 
}   
//проверка на пустые поля ввода
		if(isset($_POST['send']) and (
			trim($name)==''	 or
			trim($gender)==''or
			trim($phone)=='' or 
        	trim($cars)==''  or
        	trim($brand)=='' or 
        	trim($model)=='' or
        	trim($color)=='' or   
        	trim($car_number)=='' or 
        	trim($at_parking)==''))
		echo '<center>'.'<h2>'."Заполните все поля".'</h2>'.'</center>';
?>

<!DOCTYPE html>
<html lang="en">   
<head>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/inc/css/add.css" >
	<meta charset="UTF-8">
	<title>Добавление клиента</title>
</head>
<body>
<center>	
 <form action="" method="POST">
 	<strong>ФИО</strong> <br/> 
 	<input type="text"   size="30" name="user_name" value="" > <br/> <br/>
	<strong>Пол</strong> <br/> 
 	<input type="radio"  name="gender" value="male"/> 
 	<strong>мужской</strong>
 	<input type="radio"  name="gender" value="female" checked/>
 	<strong>женский</strong><br/><br/>
	<strong>Номер телефона</strong> <br/> 
 	<input type="text" size="30"  name="user_number" value="" > <br/> <br/>
 	<strong>Адрес</strong> <br/> 
 	<input type="text" size="30" name="adress" value="" > <br/> <br/>
 	<strong>Количество машин</strong> <br/> 
 	<select  name="volume">
    <option disabled>Выберите количество</option>
    <option  selected value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
   </select> <br/> <br/> 
     <strong>Марка машины</strong> <br/> 
 	<input type="text" size="30" name="brand" value="" > <br/> <br/>
 	<strong>Модель машины</strong> <br/> 
 	<input type="text" size="30" name="model" value="" > <br/> <br/>
 	<strong>Цвет машины</strong> <br/> 
 	<input type="text" size="30" name="color" value="" > <br/> <br/>
 	<strong>Гос. номер машины</strong> <br/> 
 	<input type="text" size="30" name="car_number" value="" > <br/> <br/>
 	<strong>Статус машины</strong> <br/> 
 	<input type="radio"  name="at_parking" value="yes" /> 
 	<strong>На стоянке</strong>
 	<input type="radio"  name="at_parking" value="no" checked/>
 	<strong>Не на стоянке</strong><br/><br/>
 	<input type="submit"  name="send" id="button" value="Добавить" >
 </form>
 <br/>
 <a href="/all_users.php">Все Клиенты</a>
</center>
 </body>
 
