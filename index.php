  <!DOCTYPE html>
	<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href= "style.css" type="text/css" rel="stylesheet"/>
<link href= "css3.css" type="text/css" rel="stylesheet"/>
<title>Календарь</title>
</head>
<body>
<?php
include('db.php');

// местоположение скрипта
$self = $_SERVER['PHP_SELF'];

// Вычисляем число дней в текущем месяце

// проверяем, если в переменная month была установлена в URL-адресе,
//либо используем PHP функцию date(), чтобы установить текущий месяц.
	if(isset($_GET['month']))
		$month = $_GET['month'];
	elseif(isset($_GET['viewmonth']))
		$month = $_GET['viewmonth'];
	else
		$month = date('m');

// Теперь мы проверим, если переменная года устанавливается в URL,
//либо использовать PHP функцию date(),
//чтобы установить текущий год, если текущий год не установлен в URL-адресе.
if(isset($_GET['year']))
	$year = $_GET['year'];
elseif(isset($_GET['viewyear']))
	$year = $_GET['viewyear'];
else
	$year = date('Y');

if($month == '12')
	$next_year = $year + 1;
else
	$next_year = $year;


$Month_r = array(
"1" => "январь",
"2" => "февраль",
"3" => "март",
"4" => "апрель",
"5" => "май",
"6" => "июнь",
"7" => "июль",
"8" => "август",
"9" => "сентябрь",
"10" => "октябрь",
"11" => "ноябрь",
"12" => "декабрь");
$klass= "";

$first_of_month = mktime(0, 0, 0, $month, 1, $year);

// Массив имен всех дней в неделю
$day_headings = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

	$maxdays = date('t', $first_of_month);
	$date_info = getdate($first_of_month);
	$month = $date_info['mon'];
	$year = $date_info['year'];
	$dayofmonth = date('t',
												mktime(0, 0, 0, $month, 1, $year));
//echo $time;echo "<br>";
$todate = "$year-$month-$dayofmonth";
//echo $todate;echo "<br>";
$fromdate = "$year-$month-01";
$connect= $mysqli->query("SELECT * FROM prazdniky WHERE   date >='$fromdate' AND date <= '$todate'");


 //Создаём массив из выборки  БД

if ($connect) {
        while ($row= mysqli_fetch_assoc($connect))
        {

							$temp_date = new DateTime($row['date']);
							$events []= $temp_date->format('j');

		          $title[]=$row['description'];
        }

}
@$q=array_combine($events,$title);


// Если текущий месяц это январь,
//и мы пролистываем календарь задом наперед число,
//обозначающее год, должно уменьшаться на один.
if($month == '1')
	$last_year = $year-1;
else
	$last_year = $year;

// Вычитаем один день с первого дня месяца,
//чтобы получить в конец прошлого месяца
$timestamp_last_month = $first_of_month - (24*60*60);
$last_month = date("m", $timestamp_last_month);

// Проверяем, что если месяц декабрь,
//на следующий месяц равен 1, а не 13
if($month == '12')
	$next_month = '1';
else
	$next_month = $month+1;

$calendar = "
<div id =\"block-on-center\" class = 'pullDown'>
<table width='390px' height='280px'  style='border: 3px double silver;border-radius: 10px;';>
    <tr >
        <td colspan='7' class='navi'>
            <a style='margin-right: 90px; color: #050d02;' href='$self?month=".$last_month."&year=".$last_year."'>&lt;&lt;</a>
           ".$Month_r[$month]." ".$year."
            <a style='margin-left: 80px; color: #050d02; ' href='$self?month=".$next_month."&year=".$next_year."'>&gt;&gt;</a>
        </td>
    </tr>
    <tr>
        <td class='datehead'>Пн</td>

        <td class='datehead'>Вт</td>
        <td class='datehead'>Ср</td>
        <td class='datehead'>Чт</td>
        <td class='datehead'>Пт</td>
        <td class='datehead'>Сб</td>
		<td class='datehead'>Вс</td>
    </tr>
    <tr>";




$weekday = $date_info['wday'];

// Приводим к числа к формату 1 - понедельник, ..., 6 - суббота
$weekday = $weekday-1;
if($weekday == -1) $weekday=6;

// станавливаем текущий день как единица 1
$day = 1;

// выводим ширину календаря
if($weekday > 0)
	$calendar .= "<td colspan='$weekday'> </td>";


while($day <= $maxdays)
{
	// если суббота, выволдим новую колонку.
    if($weekday == 7) {
		$calendar .= "</tr><tr>";
		$weekday = 0;
	}

	$linkDate = mktime(0, 0, 0, $month, $day, $year);


//проверяем если день который печатается является сегодняшним и он является выходным
	if ($month== date('m') and $day==date('d') and in_array($day, $events))
	{
		$calendar .= "
					<td class='lto' title='Сегодня!!! $q[$day]'>$day
					</td>";
	}
	// проверяем, если распечатанная дата является сегодняшней датой.
	//если так, используем другой класс css, чтобы выделить её
    elseif($month== date('m') and $day == date('d') and $year == date('Y'))
	    {
				$calendar .= "
							<td class='caltoday' title= 'Сегодня'><a href='cal.php?day=$day&month=$month&year=$year' >$day</a>
							</td>";

			}

	//Если день который печатается есть в массиве с выходными выбранными из БД



elseif (@in_array($day, $events))

{

$calendar .= "
			<td class='calto' title='$q[$day]'>$day
			</td>";


}


	//помечаем выходные дни красным

	elseif($weekday == 5 || $weekday == 6) {$red='style="color: red" ';
		$calendar .= "
				<td class='cal' title= 'Добавить выходной'><a href='cal.php?day=$day&month=$month&year=$year'><span ".$red.">{$day}</a>
				</td>";
	}


	else{

$klass = "cal";
		$calendar .= "
					<td class='cal' title= 'Добавить выходной'><a href='cal.php?day=$day&month=$month&year=$year'>$day</a>
					</td>";


}


    $day++;
    $weekday++;
}


if($weekday != 7)
	$calendar .= "<td colspan='" . (7 - $weekday) . "'> </td>";


// выводим сам календарь
echo $calendar . "</tr></table>";

$months = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');

echo "<br><form class= 'stretchLeft' style='float: right; margin-right: 10px;' action='$self' method='get'><select name='month' style='border-radius: 4px; border: 3px double silver'>";

for($i=0; $i<=11; $i++) {
	echo "<option  value='".($i+1)."'";
	if($month == $i+1)
		echo "selected = 'selected'";
	echo ">".$months[$i]."</option>";
}

echo "</select>";
echo "   "."<select class= 'stretchLeft' name='year' style='border-radius: 4px ;border: 3px double silver'>";

for($i=date('Y'); $i<=(date('Y')+20); $i++)
{
	$selected = ($year == $i ? "selected = 'selected'" : '');

	echo "<option value=\"".($i)."\"$selected>".$i."</option>";
}

echo "</select>  <input class= 'stretchLeft' type='submit' style='border-radius: 4px;border: 3px double silver '  value='Смотреть' /></form>";

if($month != date('m') || $year != date('Y'))
	echo "<a class='fadeIn' style='float: left; margin-left: 10px; font-size: 12px; padding-top: 5px;' href='".$self."?month=".date('m')."&year=".date('Y')."'>&lt;&lt; Вернуться к текущей дате</a>";
echo "</div>";


?>

</body>
</html>
