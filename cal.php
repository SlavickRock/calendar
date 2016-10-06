<?php
include('db.php');

@$data= $_POST['date'];
@$sobytia= $_POST['description'];
if (isset($_GET['day'])) $de = ($_GET['day']);
if (isset($_GET['month'])) $month = ($_GET['month']);
if (isset($_GET['year'])) $year = ($_GET['year']);
if (isset($_POST['ok'])) {

if (isset($_POST['day'])) {
  $day=$_POST['day'];
}
$connect = $mysqli->query("INSERT INTO prazdniky (date,description) VALUES ('$data','$sobytia') ") or die("Нет подключения!!!");
echo "Выходной добавлен";
}

?>
<!DOCTYPE html>
<link href= "style.css" type="text/css" rel="stylesheet"/>
<link href= "css3.css" type="text/css" rel="stylesheet"/>

<html >
        <head>
                <meta charset="utf-8">
                <title></title>
        </head>
        <body>
                <br>
                 <form  action="cal.php" method="post">
                           Название выходного:<br> <textarea class = 'pullDown' name="description"
                            rows="10" cols="40" style='border-radius: 10px;border:
                             4px solid rgba(7, 13, 0, 0.59);padding: 5px 5px 5px 5px'>
                             </textarea>
                             <br>
                        Дата выходного:<br><input class = 'pullDown' type="text" name="date"
                        style='border-radius: 8px;border: 2px solid rgba(7, 13, 0, 0.59)'
                        value="<?= @"$year-$month-$de"?>" > 
                        <br> <br>
                        <input class= 'stretchLeft' type="submit" name="ok"style='border-radius: 10px;border:
                         2px solid rgb(174, 82, 238)' value="Добавить">
                 </form>
                 <br>
                 <form  action="index.php" method="post">
                        <input class= 'stretchLeft' type="submit"style='border-radius: 10px;border: 2px solid rgb(249, 26, 26) ' value="Back" />
                 </form>

        </body>
</html>
