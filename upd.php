<?php 
//ob_start();
include ('inc/connect_db.php'); // подключение бд
function redirect_to($new_location) {
      header("Location: " . $new_location);
      exit;
  } 
  		$name = $_POST['user_name'];
		$gender = $_POST['gender'];
		$phone = $_POST['user_number'];
		$adress = $_POST['adress'];
		$cars = $_POST['volume'];
		$brand = $_POST['brand'];
		$model = $_POST['model'];
		$color = $_POST['color'];
		$car_number = $_POST['car_number'];
		$at_parking = $_POST['at_parking'];
		$upd_id=$_GET['upd_id'];
//проверка на заполненные поля и существование гет запроса
if (isset($_POST['save']) and isset($_GET['upd_id'])
			and (
			trim($name)!='' and 
			trim($phone)!='' and 
        	trim($cars)!='' and
        	trim($brand)!='' and 
        	trim($model)!='' and 
        	trim($color)!='' and  
        	trim($car_number)!='')) 
{		
  //запрос на редактирвоание
		$sql = "UPDATE users SET name=?, gender=?, phone_number=?, adress=?,car=?  WHERE id=?;
		        UPDATE cars SET brand=?, model=?, color=?, car_number=?,at_parking=?  WHERE id=?;";
          $query = $pdo->prepare($sql);
          $query->execute(array($name,$gender,$phone,$adress,$cars,$upd_id,$brand,$model,$color,$car_number,$at_parking,$upd_id));
          redirect_to('/all_users.php');
      }
// проверка на пустые поля ввода
      if(isset($_POST['save']) and (
			trim($name)==''	 or
			trim($phone)=='' or 
        	trim($cars)==''  or
        	trim($brand)=='' or 
        	trim($model)=='' or
        	trim($color)=='' or   
        	trim($car_number)=='' ))
		echo '<center>'.'<h2>'."Заполните все поля".'</h2>'.'</center>';
// Передаем данные  в поля
if (isset($_GET['upd_id'])) {
    $upd_id= trim($_GET['upd_id']);
    $sql =  ("SELECT * FROM users JOIN cars ON users.id=? AND cars.id=?; ");
    $query = $pdo->prepare($sql);
    $query -> execute(array($upd_id,$upd_id));
    $staff = $query->fetch(PDO::FETCH_LAZY);
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/inc/css/upd.css" >
	<meta charset="UTF-8">
	<title>Редактирование</title>
</head>
<body>
	<center>
	<form action="" method="POST">
 	<strong>ФИО</strong> <br/> 
 	<input type="text" size="30" name="user_name" value="<?= isset($_GET['upd_id']) ? $staff['name'] : ''; ?>" > <br/> <br/>
	
	<strong>Пол</strong> <br/> 
 	<input type="radio"  name="gender" value="male" checked/> 
 	<strong>мужской</strong>
 	<input type="radio"  name="gender" value="female"/>
 	<strong>женский</strong><br/><br/>
	<strong>Номер телефона</strong> <br/> 
 	<input type="text" size="30" name="user_number" value="<?= isset($_GET['upd_id']) ? $staff['phone_number'] : ''; ?>" > <br/> <br/>
 	<strong>Адрес</strong> <br/> 
 	<input type="text" size="30" name="adress" value="<?= isset($_GET['upd_id']) ? $staff['adress'] : ''; ?>" > <br/> <br/>

 	<strong>Количество машин</strong> <br/> 
 	<select  name="volume" value="<?= isset($_GET['upd_id']) ? $staff['car'] : ''; ?>" >
    <option disabled>Выберите количество</option>
    <option  selected value="<?= isset($_GET['upd_id']) ? $staff['car'] : ''; ?>"> Зарегистрированное количество: <?= isset($_GET['upd_id']) ? $staff['car'] : ''; ?></option>
    <option   value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
   </select> <br/> <br/> 
     <strong>Марка машины</strong> <br/> 
 	<input type="text" size="30" name="brand" value="<?= isset($_GET['upd_id']) ? $staff['brand'] : ''; ?>"" > <br/> <br/>
 	<strong>Модель машины</strong> <br/> 
 	<input type="text" size="30" name="model" value="<?= isset($_GET['upd_id']) ? $staff['model'] : ''; ?>"" > <br/> <br/>
 	<strong>Цвет машины</strong> <br/> 
 	<input type="text" size="30" name="color" value="<?= isset($_GET['upd_id']) ? $staff['color'] : ''; ?>"" > <br/> <br/>
 	<strong>Гос. номер машины</strong> <br/> 
 	<input type="text" size="30" name="car_number" value="<?= isset($_GET['upd_id']) ? $staff['car_number'] : ''; ?>"" > <br/> <br/>
 	<strong>Статус машины</strong> <br/> 
 	<input type="radio"  name="at_parking" value="yes"/> 
 	<strong>На стоянке</strong>
 	<input type="radio"  name="at_parking" value="no" checked/>
 	<strong>Не на стоянке</strong><br/><br/>
 	<input type="submit" id="button" name="save"  value="Сохранить" >
 </form>
</center>
</body>
</html>
