<?php
$l = 945747;
$c = 130713;

//настройки отображения
$window_length=200;
$car="🚗";
$tomeoutMS=10000;

$memoryEconomicMode=true;

//$l=4;
//$c=1;

//тахометр: сколько пройдено условных метров
$taho1 = 0;
$taho2 = 0;

//текущая координата авто
$coord1 = 0;
$coord2 = $l;

//счетчик условных секунд
$counter = 0;

//направление движения авто: прямое или обратное
$coord1Inverse = false;
$coord2Inverse = false;
if(!$memoryEconomicMode){
$arr1=[];
$arr2=[];
}
do
{
    $termCoord1=round(($window_length/$l)*$coord1);
    $termCoord2=round(($window_length/$l)*$coord2);
    for($i=0; $i<=$window_length; $i++){
        if($i==$termCoord1 || $i==$termCoord2){
         echo("\e[33m".$car."\e[39m");
        }
        else
        if($i == 0||$i == $window_length){
         echo('|');
	 continue;
        }
        else
        if($i==round(($window_length/$l)*$c)){
          echo(".");
	  continue;
        }
	else echo '_';
    }
    $taho1++;
    $taho2++;
if(!$memoryEconomicMode){
    $arr1[]=$coord1;
    $arr2[]=$coord2;
}
    if ($coord1Inverse) {
        $coord1 = $coord1-1;
    } else {
        $coord1 = $coord1+1;
    }

    if ($coord2Inverse) {
        $coord2 = $coord2+1;
    } else {
        $coord2 = $coord2-1;
    }

    if ($coord1==$c) {
        $coord1Inverse = true;
    }
    if($coord1==0){
    	$coord1Inverse = false;
    }

    if ($coord2==$c) {
        $coord2Inverse = true;
    }
    
    if ($coord2==$l) {
        $coord1Inverse = false;
    }
    $counter++;
    if(!($coord1==0 and $coord2==$l)){
     echo "\r";
    }
    usleep(1);
} while (!($coord1==0 and $coord2==$l));
echo "\n";
if(!$memoryEconomicMode){
echo implode('-',$arr1). "\n";
echo implode('-',$arr2). "\n";
}
echo $counter . "\n";
