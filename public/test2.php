<?
echo phpinfo();

$dsn = 'sqlsrv:server=127.0.0.1;Database=fujacook;';
$user = 'fujacook';
$password = '3Tv8u8LcrQQBl7X1';
 
// �إ� PDO ����
$pdo = new PDO($dsn, $user, $password);
 
$sql = "SELECT * FROM testtable";
$pre = $pdo->prepare($sql);
$pre->execute();
$row = $pre->fetchAll(2);
 
print_r($row);
?>