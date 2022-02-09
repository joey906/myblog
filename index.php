<?php
require "./dbc.php";
echo 'majide'. '<br>';

foreach($blogData as $loop){
    echo $loop['id']." ".$loop['name'].'<br>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ一覧</title>
</head>
<body>
    <h2>ブログ一覧</h2>
    <tr>
        <th>No</th>
        <th>タイトル</th>
        <th>カテゴリ</th>
    </tr>
    <?php foreach($blogData as $column):?>
    <tr>
        <td><?php echo $column["id"]?></td>
        <td><?php echo $column["name"]?></td>
        <td></td>
    </tr>
    <?php endforeach;?>
</body>
</html>
