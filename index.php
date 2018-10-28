
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link type="text/css" rel="stylesheet" href="script.css">
</head>
<body>
<?php
$customer_list = array(
    "1"=>array("name" => "Lê Thị Mĩ Hoàn","day_of_birth" => "2000-09-08","address" =>"Hải Phòng","profile" =>"hoan2.jpg"),
    "2"=>array("name" => "Phạm Thị Lấn","day_of_birth" => "1997-04-20","address" =>"Nam Định","profile" => "ngoc1.jpg"),
    "3"=>array("name" => "Nguyễn Thị Trang","day_of_birth" => "2000-02-17","address" =>"Hà Nội","profile" =>"trang1.jpg"),
);
function searchByDate($customers, $from_date, $to_date)
{
    if (empty($from_date) && empty($to_date)) {
        return $customers;
    }
    $filtered_customers = [];
    foreach ($customers as $customer) {
        if (!empty($from_date) && (strtotime($customer['day_of_birth']) < strtotime($from_date)))
            continue;
        if (!empty($to_date) && (strtotime($customer['day_of_birth']) > strtotime($to_date)))
            continue;
        $filtered_customers[] = $customer;
    }
    return $filtered_customers;
}
?>
<?php
$from_date = NULL;
$to_date = NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_date = $_POST["from"];
    $to_date = $_POST["to"];
}
$filtered_customers = searchByDate($customer_list, $from_date, $to_date);
?>
<form method="post">
    Từ: <input id="from" type="text" name="from" placeholder="yyyy/mm/dd"/>
    Đến: <input id="to" type="text" name="to" placeholder="yyyy/mm/dd"/>
    <input type="submit" id="submit" value="search"/>
</form>
<table border="0">
    <caption><h2>Danh sách khách hàng</h2></caption>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Địa chỉ</th>
        <th>Ảnh</th>
    </tr>
    <?php if(count($filtered_customers) === 0):?>
        <tr>
            <td colspan="5" class="message">Không tìm thấy khách hàng nào</td>
        </tr>
    <?php endif; ?>

    <?php foreach($filtered_customers as $index=> $customer): ?>
        <tr>
            <td><?php echo $index + 1;?></td>
            <td><?php echo $customer['name'];?></td>
            <td><?php echo $customer['day_of_birth'];?></td>
            <td><?php echo $customer['address'];?></td>
            <td><div class="profile"><img src="<?php echo $customer['profile'];?>"/></div> </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>