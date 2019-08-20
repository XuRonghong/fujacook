<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Web3.js Connect</title>
</head>
<body>
  <div>
<?php
            
            if (!isset($_POST['kahap_token'])&&!isset($_POST['kahap_status'])) {
?>
    <form id="form1" action="http://fine-i.com/kahap/am_get_token_post.php" method="post">
      <input type=hidden name="kahap_hashkey" value="KAHAPACTUALMINER">
      <input type=hidden name="kahap_walletid" value="0x565fd3B3E4b5E3174C9FD18d67053DFEeb332628">
      <button type='submit' name='send' class="btn btn-primary">確認送出</button>
    </form>
<?php
            }
            else {
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
              if (isset($_POST['kahap_token']))
                $token=$_POST['kahap_token'];
?>
              <div class="panel panel-danger">
                <div class="panel-heading">結果 Token</div>
                <div class="panel-body">
                  <br>          
                  <div class='input-group'>
                    <span class="input-group-addon blue">交易Token: <?php echo $token; ?></span>
                  </div><br>
                  <div>
                    <span class="input-group-addon blue">狀態: <?php echo $status; ?></span>
                  </div><br>
                  <button type='submit' class="btn btn-info" onclick=location.href='http://localhost/kahap/eth_post.php'>
                    <i class="fa fa-gear fa-lg"></i> &nbsp;回上頁</button>
                </div>
              </div>  <!-- panel -->
<?php
            }
?>              
  </div>
</body>
</html>