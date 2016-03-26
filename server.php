<?php
error_reporting(0);
if (isset($_REQUEST['query'])){
    $connect = mysqli_connect("localhost","root","");
    mysqli_select_db($connect, "zynkdict" );
    mysqli_query($connect, "SET NAMES UTF8");

    switch ($_REQUEST['lang'])
    {
        case 'ru':
            $query = "SELECT  word,translate FROM ru_to_kg WHERE word LIKE '{$_REQUEST['query']}'" ;
            break;
        case 'kg':
            $query = "SELECT  word,translate FROM kg_to_ru WHERE word LIKE '{$_REQUEST['query']}'" ;
            break;
        default:
            $query = "SELECT  word,translate FROM ru_to_kg WHERE word LIKE '{$_REQUEST['query']}'" ;
    }


 
    $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
   
    $row = mysqli_fetch_assoc($result);
    do
    {
        if (!empty($row))
        {
            if (!empty($row))
            {
                $words[] = $row;
                //$words[] = $row2;
            }
//        echo($row['word']. ' - ' . $row['translate']);
        }
    }
    while($row = mysqli_fetch_assoc($result));


    if (!empty($words))
    {
        echo(json_encode($words));
    }
    else
    {
        echo(json_encode(['error'=>'Word not found']));
    }

}

