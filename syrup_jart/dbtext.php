<?php


$db_host = "localhost";
$db_user = "sc2syrup";
$db_passwd = "tmdgml65";
$db_name = "sc2syrup";

$conn = mysqli_connect($db_host, $db_user, $db_passwd, $db_name);
if(mysqli_connect_errno()) {
  // echo "MySQL 연결 오류: " . mysqli_connect_error();
  exit;
}else {
  // echo "DB : \"$db_name\"에 접속 성공.<br />";
}

try {
  $name=$_POST['name'];
  $title=$_POST['title'];
  $contents=$_POST['contents'];
  $password=$_POST['password'];

  mysqli_set_charset($conn,"utf8");

  $sql = "insert into ask_board(name, title, contents, password) values('$name', '$title', '$contents', '$password')";

  if(mysqli_query($conn,$sql)) {
    // echo "테이블에 값 쓰기 완료: $sql<br/>";
    $result = 1;
  }else {
    // echo "테이블에 값 쓰기 오류" . mysqli_error($conn);
    $result = 2;
  }

} catch (\Exception $e) {
  $result = 2;

}


?>
