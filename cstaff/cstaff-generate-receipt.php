<!DOCTYPE html>
<html lang="en">
<!-- Template used from https://codepen.io/garrettbear/details/JzMmqg -->

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receipt</title>
  <link rel="stylesheet" href="../css/receipt.css">
  <?php
  session_start();
  include("../conn_db.php");
  if ($_SESSION["user_role"] != "CSTAFF") {
    header("location:../restricted.php");
    exit(1);
  }

  if (isset($_GET['odr_id'])) {
    if (!empty(($_GET['odr_id']))) {
      $odr_id = mysqli_real_escape_string($mysqli, $_GET['odr_id']);
      if ((isset($_SESSION["user_id"]))) {
        $user_id = $_SESSION["user_id"];
      }
    } else {
      header("location:cstaff-mng-order.php");
      exit(1);
    }
  } else {
    header("location:cstaff-mng-order.php");
    exit(1);
  }
  ?>
</head>

<body>
  <div id="showScroll" class="container">
    <div class="receipt">
      <?php
      $query = "SELECT * FROM user WHERE user_id = {$user_id}";
      $arr = $mysqli->query($query)->fetch_array();
      $store_name = "Rong Sheng’s Famous Pastries and Cake";
      $store_operatinghour = "8:00A.M- 6:00P.M";
      $store_location = "Klang";
      ?>
      <h1 class="logo">Store:<?php echo " " . $store_name ?></h1>
      <div class="address">
        <?php echo $store_location ?>
      </div>
      <div class="transactionDetails">
        <div class="detail"><?php echo "Receipt Generated: " . date("jS-M-Y H:ia") ?></div>
      </div>
      <div class="transactionDetails">
        <?php echo "Served By: " . $arr['user_fname'] . " " . $arr['user_lname'] ?>
      </div>
      <div class="break">
        ********************************
      </div>
      <?php
      // $query = "SELECT m.mitem_name,od.odr_detail_amount,od.odr_detail_price,od.odr_detail_remark FROM odr_detail od INNER JOIN mitem m ON od.mitem_id = m.mitem_id WHERE od.odr_id = {$odr_id}";
      // $result = $mysqli->query($query);
      // $rowcount = mysqli_num_rows($result);
      $query = $mysqli->prepare("SELECT m.mitem_name,od.odr_detail_amount,od.odr_detail_price,od.odr_detail_remark FROM odr_detail od INNER JOIN mitem m ON od.mitem_id = m.mitem_id WHERE od.odr_id =?");
      $query->bind_param('i', $odr_id);
      $query->execute();
      $result = $query->get_result();
      $rowcount = $result->num_rows;
      if ($rowcount > 0) {
        while ($row = $result->fetch_array()) {
      ?>
          <div class="transactionDetails">
            <div class="detail"><?php echo $row["odr_detail_amount"] . "X" ?></div>
            <div class="detail">
              <?php
              if ($row["odr_detail_remark"] != "") {
                echo $row["mitem_name"] . " (" . $row["odr_detail_remark"] . ") ";
              } else {
                echo $row["mitem_name"] . " (No Remark)";
              }
              ?>
            </div>
            <div class="detail"><?php echo "RM " . $row["odr_detail_amount"] * $row["odr_detail_price"] ?></div>
          </div>
      <?php
        }
      }
      ?>
      <div class="break">
        ********************************
      </div>
      <?php
      // $query = "SELECT SUM(odr_detail_amount*odr_detail_price) AS total_price FROM odr_detail WHERE odr_id = {$odr_id}";
      // $arr = $mysqli->query($query)->fetch_array();
      $query = $mysqli->prepare("SELECT SUM(odr_detail_amount*odr_detail_price) AS total_price FROM odr_detail WHERE odr_id =?");
      $query->bind_param('i', $odr_id);
      $query->execute();
      $arr = $query->get_result()->fetch_array();
      $total_price = "RM " . $arr['total_price'];
      ?>
      <div class="paymentDetails bold">
        <div class="detail">TOTAL</div>
        <div class="detail"><?php echo $total_price ?></div>
      </div>
      <div class="paymentDetails">
        <div class="detail">CHARGE</div>
        <div class="detail"><?php echo $total_price ?></div>
      </div>
      <div class="feedback">
        <div class="break">
          **************************
        </div>
        <p class="center">
          All goods sold are not refundable !
        </p>
        <h4 class="web">Thank You for Ordering</h4>
        <div class="break">
          **************************
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    window.print();
  </script>

</body>

</html>