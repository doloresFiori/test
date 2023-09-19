<?
    include $_SERVER["DOCUMENT_ROOT"] . "/php/config.php";
    include $_SERVER["DOCUMENT_ROOT"] . "/php/functions.php";
    include "../../vendor/autoload.php";
    db_connect();
?><!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>TestDB</title>
    <meta name="viewport" content="width=device-width">
</head>
<style>
    table{git status
        border: 1px solid black;
        border-collapse: collapse;
    }
    td{
        border: 1px solid black;
        padding-left: 5px;
    }
    th{
        border: 1px solid black;
    }
    img{
        padding: 10px;
    }
    </style>
<body class="testdb">
    <h1>HELLO WORLD</h1>
    <h3>
        <table>
            <thead>
            <tr>
                <th>Общая площадь</th>
                <th>Адрес</th>
                <th>Этаж</th>
                <th>Вид из окна</th>
                <th>Тип дома</th>
                <th>Материал дома</th>
                <th>Общая стоимость</th>
                <th>Телефон</th>
                <th>Описание</th>
                <th>Фотографии</th>
            </tr>
            </thead>
            <tbody>
    <?php
    $query = "SELECT * FROM `NL_PROP_RESALE`";
    $select_resale = db_query($query) or die(db_error($query));
    if (db_num_rows($select_resale) > 0) {
        while ($row = db_fetch_assoc($select_resale)) {
            echo '<tr><td>'.$row['NL_PROP_RESALE_AREA_FULL'].'</td>
<td>'.$row['NL_PROP_RESALE_ADDRESS'].'</td>
<td>'.$row['NL_PROP_RESALE_FLOOR'].'</td>';
            if($row['ID_NL_VIEW']){
                $id_view = $row['ID_NL_VIEW'];
                $query_view = "SELECT `NL_VIEW_SHORT` FROM `NL_VIEW` WHERE `ID_NL_VIEW` = $id_view";
                $select_view = db_query($query_view) or die(db_error($query_view));
                echo '<td>'.$select_view->fetch_row()[0].'</td>';
            }
            else{
                echo '<td>Инфрмация отсутствует</td>';
            }
            if($row['ID_NL_HOUSES']){
                $id_houses = $row['ID_NL_HOUSES'];
                $query_houses = "SELECT `NL_HOUSES_SHORT` FROM `NL_HOUSES` WHERE `ID_NL_HOUSES` = $id_houses";
                $select_houses = db_query($query_houses) or die(db_error($query_houses));
                echo '<td>'.$select_houses->fetch_row()[0].'</td>';
            }
            else{
                echo '<td>Инфрмация отсутствует</td>';
            }
            if($row['ID_NL_MATERIAL']){
                $id_material = $row['ID_NL_MATERIAL'];
                $query_material = "SELECT `NL_MATERIAL_SHORT` FROM `NL_MATERIAL` WHERE `ID_NL_MATERIAL`= $id_material";
                $select_material = db_query($query_material) or die(db_error($query_material));
               echo '<td>'.$select_material->fetch_row()[0].'</td>';
            }
            else{
                echo '<td>Инфрмация отсутствует</td>';
            }
            echo '<td>'.$row['NL_PROP_RESALE_COST_TOTAL'].'</td>
<td>'.$row['NL_PROP_RESALE_PHONE'].'</td>';
            $json = urldecode($row['NL_PROP_RESALE_DESCRIPTION']);
            $lexer = new \nadar\quill\Lexer($json);
            echo '<td>'.$lexer->render().'</td><td>';
            $assoc = json_decode($row['NL_PROP_RESALE_PHOTO_URLS']);
            foreach ($assoc as $key => $value) {

                echo '<img src="'.$value.'" width="250" height="250"></img><br>';

            }
            echo '</td>';
  }
 }
    ?>
            </tr>
            </tbody>
        </table>
    </h3>
</body>
</html>