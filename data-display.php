<span style="font-family: 'Century Gothic'"><?php

      function unix_tail($file, $num_to_get=10)
    {
    $fp = fopen($file, 'r');
    $position = filesize($file);
    $chunklen = 4096;
    if($position-$chunklen <= 0 )fseek($fp,0);
    else fseek($fp, $position-$chunklen);
    $data="";$ret="";$lc=0;
    while($chunklen > 0)
    {
    $data = fread($fp, $chunklen);
    $dl=strlen($data);
    for($i=$dl-1;$i>=0;$i--){
    if($data[$i]=="\n"){
    if($lc==0 && $ret!="")$lc++;
    $lc++;
    if($lc>$num_to_get)return $ret;
    }
    $ret=$data[$i].$ret;
    }
    if($position-$chunklen <= 0 ){
    fseek($fp,0);
    $chunklen=$chunklen-abs($position-$chunklen);
    }else fseek($fp, $position-$chunklen);
    $position = $position - $chunklen;
    }
    fclose($fp);
    return $ret;
    }

echo ('
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<center><div id="pogoda">');



$pogoda1 = unix_tail ("dailylog.txt", 1);
if ($pogoda1 [0] == " ")
{
$pogoda1 [0]  = substr($pogoda1 [0], 1);
$dzien1 = $pogoda1 [0].$pogoda1 [1];
}
else
{
$dzien1 = $pogoda1 [0].$pogoda1 [1];
}
$pogoda1 = str_replace ("   ", " ", $pogoda1);
$pogoda1 = str_replace ("  ", " ", $pogoda1);

$pogoda1 = explode(' ', $pogoda1);


$miesiac1 = $pogoda1 [1];
$rok1 = $pogoda1 [2];
$godzina1 = $pogoda1 [3];
$minuta1 = $pogoda1 [4];
$temperatura_out1 = $pogoda1 [5];
$temperatura_out1 = str_replace ("00", "0", $temperatura_out1);
$wilgotnosc1 = $pogoda1 [6];
$dewpoint = $pogoda1 [7];
$barometer1 = $pogoda1 [8];
$windspeed = $pogoda1 [9];
$gustspeed = $pogoda1 [10];
$direction = $pogoda1 [11];
$rainlastmin = $pogoda1 [12];
$dailyrain = $pogoda1 [13]; 
$monthlyrain = $pogoda1 [14]; 
$yearlyrain = $pogoda1 [15]; 
$heatindex = $pogoda1 [16]; 

/*
$n = count($pogoda1);
	for ($i=0;$i<$n; $i++)
		echo $pogoda1[$i].'<br />';

$miesiac1 = explode(' ', $miesiac1);
$miesiac1 = $miesiac1[0];
$rok1 = $pogoda1[2];
$tmp1 = explode(' ', $rok1);
$tmp2 = explode('  ', $rok1);
$temperatura_out = $tmp1[1];
$tmp4 = explode(' ', $pogoda1[3]);
$wilgotnosc = $tmp4[0];
*/

switch ($miesiac1)

{

case 1:
$miesiac1 = "Stycznia";
break;

case 2:
$miesiac1 = "Lutego";
break;

case 3:
$miesiac1 = "Marca";
break;

case 4:
$miesiac1 = "Kwietnia";
break;

case 5:
$miesiac1 = "Maja";
break;

case 6:
$miesiac1 = "Czerwca";
break;

case 7:
$miesiac1 = "Lipca";
break;

case 8:
$miesiac1 = "Sierpnia";
break;

case 9:
$miesiac1 = "Wrzesnia";
break;

case 10:
$miesiac1 = "Października";
break;

case 11:
$miesiac1 = "Listopada";
break;

case 12:
$miesiac1 = "Grudnia";
break;


}
echo "<b><br /><span style='font-size: 15pt'>Dane z odczytu ze stacji meteorologicznej:</span><br /><br />Data odczytu:</b><br />";
echo ("".$dzien1." ".$miesiac1." ".$rok1." | ".$godzina1.":".$minuta1);
echo "<br /><br />";
echo ('<span style="text-decoration: underline"><b>Dane z odczytu na dachu szkoły:</b><br /></span><br />
');
echo ("Temperatura powietrza zewnętrzna: <b>".$temperatura_out1.' °C</b><br />');
echo ("Wigotność powietrza: <b>".$wilgotnosc1." %</b><br />
");
echo ("Temperatura punktu rosy: <b>".$dewpoint." °C</b><br />
");
echo ("Ćiśnienie atmosferyczne: <b>".$barometer1." hPa</b><br />
");
echo ("Prędkość wiatru: <b>".$windspeed." m/s</b><br />
");
echo ("Prędkość wiatru w porywach do: <b>".$gustspeed." m/s</b><br />
");

/*
echo ("Kierunek wiatru:<br />");
if ($direction<=90)
{

echo ('<img src="wiatry/w_wschodni.png" />');
}
*/
echo ("
Ilosć deszczu, który spadł w ostatniej minucie: <b>".$rainlastmin." mm</b><br />");

echo ("
Ilosć deszczu, który spadł w ciągu dzisiejszego dnia: <b>".$dailyrain." mm</b><br />");

echo ("
Ilosć deszczu, który spadł w ciągu aktualnego miesiąca: <b>".$monthlyrain." mm</b><br />");

echo ("
Ilosć deszczu, który spadł w ciągu aktualnego roku: <b>".$yearlyrain." mm</b><br />");


$pogoda2 = unix_tail ("uvlog.txt", 1);
$pogoda2 = str_replace ("   ", " ", $pogoda2);
$pogoda2 = str_replace ("  ", " ", $pogoda2);

$pogoda2 = explode(' ', $pogoda2);

$solar_radiation = $pogoda2 [5];
$uv = $pogoda2 [6];


echo ("Nasilenie promieniowania UV: <b>".$uv."</b><br />");

echo ("Aktywność słoneczna: <b>".$solar_radiation."</b><br />");



$pogoda3 = unix_tail ("indoorlog.txt", 1);
if ($pogoda3 [0] == " ")
{
$pogoda3 = substr($pogoda3, 1);
}
$pogoda3 = str_replace ("   ", " ", $pogoda3);
$pogoda3 = str_replace ("  ", " ", $pogoda3);

$pogoda3 = explode(' ', $pogoda3);

$in_temp = $pogoda3 [5];
$in_humidity = $pogoda3 [6] [0].$pogoda3 [6] [1];


echo ('<span style="text-decoration: underline"><br /><b>Dane z odczytu w pracowni komputerowej:</b></span><br /><br />
');


echo ("Temperatura powietrza w szkole: <b>".$in_temp." °C</b><br />");

echo ("Wilgotność powietrza w szkole: <b>".$in_humidity." %</b>"); 

echo (" 
<center></center>");
?></span>
