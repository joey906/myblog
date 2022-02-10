<?php
require "./dbc.php";
echo 'majide'. '<br>';

foreach($blogData as $loop){
    echo $loop['id']." ".$loop['name'].'<br>';
}

function setCategoryName($category){
    if ($category == '1'){
        return 'ブログ';
    } elseif ($category == '2'){
        return '日常';
    } else {
        return 'その他';
    }
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
    <table>
        <tr>
            <th>No</th>
            <th>タイトル</th>
            <th>カテゴリ</th>
        </tr>
        <?php foreach($blogData as $column):?>
        <tr>
            <td><?php echo $column["id"]?></td>
            <td><?php echo $column["title"]?></td>
            <td><?php echo setCategoryName($column["category"])?></td>
        </tr>
        <?php endforeach;?>
    </table>
</body>
</html>
