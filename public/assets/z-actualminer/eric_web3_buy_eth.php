<?php


$req='';
foreach ($_POST as $key => $value) {
    $value = urlencode(stripslashes($value));
    $req .= "$key=$value&";
}

echo $req;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Web3.js Connect</title>
    <script src="js/jquery-2.1.1.min.js"></script>
</head>
<body>
	<div>
<?php 
            if (!isset($_POST['kahap_status'])) {


?>
    <form id="form1" action="http://fine-i.com/kahap/am_buy_eth_post.php" method="post">
	    <input type=hidden name="kahap_hashkey" value="<?php echo $_POST['kahap_hashkey'];?>">
	    <input type=hidden name="kahap_tradeid" value="testorder01">
	    <input type=hidden name="kahap_walletid" value="0x565fd3B3E4b5E3174C9FD18d67053DFEeb332628">
      <input type=hidden name="kahap_vcode" value="56873887717172142175155942269461976853259567654642872852792958619230127889385">
      <input type=hidden name="kahap_acode" value="">
      <input type=hidden name="kahap_ethqty" value="0.4">
    	<button type='submit' name='send' class="btn btn-primary">確認送出</button>
    </form>
<?php
            } else {
              $status="";
              if ($_POST['kahap_status']==1)
                $status="此交易等待區塊鏈驗證中";
              else if ($_POST['kahap_status']==11)
                $status="未安裝MetaMask";
              else if ($_POST['kahap_status']==12)
                $status="未登入MetaMask";
              else if ($_POST['kahap_status']==13)
                $status="使用者取消MetaMask轉帳";
              else if ($_POST['kahap_status']==14)
                $status="ETH餘額不足";
              else if ($_POST['kahap_status']==15)
                $status="使用者錢包地址不符";
              else if ($_POST['kahap_status']==16)
                $status="KAHAP的HASHKEY有誤";
              else if ($_POST['kahap_status']==17)
                $status="連結的固定IP有誤";
              else if ($_POST['kahap_status']==99)
                $status="其它錯誤";

              $txhash="";
              if (isset($_POST['kahap_txhash']))
                $txhash=$_POST['kahap_txhash'];
              $tradeid="";
              if (isset($_POST['kahap_tradeid']))
                $tradeid=$_POST['kahap_tradeid'];
?>
              <div class="panel panel-danger">
                <div class="panel-heading">結果 BUY_ETH</div>
                <div class="panel-body">
                  <br>
                  <div class='input-group'>
                    <span class="input-group-addon blue">交易狀態:<?php echo $status; ?></span>
                  </div><br>                  
                  <div class='input-group'>
                    <span class="input-group-addon blue">交易Hash:<?php echo $txhash; ?></span> 
                  </div><br>
                   <div class='input-group'>
                    <span class="input-group-addon blue">tradeid:<?php echo $tradeid; ?></span> 
                  </div><br>
                  <button type='submit' class="btn btn-info" onclick=location.href='http://localhost/kahap/eth_post.php'>
                    <i class="fa fa-gear fa-lg"></i> &nbsp;回上頁</button>
                </div>
              </div>  <!-- panel -->
<?php
            }
?>              
	</div>
<script>
    $('.btn-primary').click();
</script>
</body>
</html>