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
  <head>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/inc/css/all_users.css" >
	<meta charset="UTF-8">
	<title>Все клиенты</title>
</head>
<body>
  <center>
	<p>Все клиенты:</p>
  <br/>
<table border="1" rules="rows" cellpadding="10">
<thead>
    <tr>
      
      <th>ФИО</th>
      <th>Автомобиль</th>
      <th>Гос.номер</th>
      <th>Удаление</th>
      <th>Редактирование</th>
    </tr>
  </thead>
   <br/>
<?php 
// запрос на удаление 
if(isset($_GET['del_id'])){

	$del_id=$_GET['del_id'];
	$sql = "DELETE  FROM users WHERE id=?; DELETE  FROM cars WHERE id=?;";
    $query = $pdo->prepare($sql);
    $query->execute(array($del_id,$del_id));
    redirect_to('/all_users.php');

}
//логика пагинации 
  $limit = 5;
  $page = ($_GET['page']) ? $_GET['page'] : 1;;
  $test = ($page-1) * $limit;
  $count_pages = 15;
  $active = ($_GET['page']) ? $_GET['page'] : 1;
  $count_show_pages = 10;
  $url = "/all_users.php";
  $url_page = "/all_users.php?page=";
  if ($count_pages > 1) { 
    $left = $active - 1;
    $right = $count_pages - $active;
    if ($left < floor($count_show_pages / 2)) $start = 1;
    else $start = $active - floor($count_show_pages / 2);
    $end = $start + $count_show_pages - 1;
    if ($end > $count_pages) {
      $start -= ($end - $count_pages);
      $end = $count_pages;
      if ($start < 1) $start = 1;
 }
//вывод клиентов
$sql = $pdo->query("SELECT users.id, users.name , cars.brand , cars.car_number FROM users JOIN cars ON users.id = cars.id LIMIT $limit OFFSET $test");
      while ($result = $sql->fetch()) 
       echo '<tr>' .
             "<td>{$result['name']}</td>" . 
             "<td>{$result['brand']}</td>" .
             "<td>{$result['car_number']}</td>".
             "<td><a id=\"del\" href='?del_id={$result['id']}'>Удалить</a></td>" .
             "<td><a id=\"upd\" href='upd.php?upd_id={$result['id']}'>Изменить</a></td>" .
             '</tr>';             	     
?>                      	
</table>
<br/><br/>
<a href="/at_parking.php">Клиенты на парковке</a>
<br/><br/>
<a href="/add.php">Добавить Клиента</a>
<br/><br/>
  <div id="pagination">
    <span>Страницы: </span>
    <?php //пагинация
    if ($active != 1) { ?>
      <a href="<?=$url?>" title="Первая страница">&lt;&lt;</a>
      <a href="<?php if ($active == 2) { ?><?=$url?><?php } else { ?><?=$url_page.($active - 1)?><?php } ?>" title="Предыдущая страница">&lt;</a>
    <?php } ?>
    <?php for ($i = $start; $i <= $end; $i++) { ?>
      <?php if ($i == $active) { ?><span><?=$i?></span><?php } else { ?><a href="<?php if ($i == 1) { ?><?=$url?><?php } else { ?><?=$url_page.$i?><?php } ?>"><?=$i?></a><?php } ?>
    <?php } ?>
    <?php if ($active != $count_pages) { ?>
      <a href="<?=$url_page.($active + 1)?>" title="Следующая страница">&gt;</a>
      <a href="<?=$url_page.$count_pages?>" title="Последняя страница">&gt;&gt;</a>
    <?php } ?>
  </div>
<?php } ?>
</center>
</body>
</html>