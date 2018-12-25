<?php

$db_host = "localhost";
$db_user = "sc2syrup";
$db_passwd = "tmdgml65";
$db_name = "sc2syrup";

// MySQL - DB 접속.

$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
if (mysqli_connect_errno()){
exit;
} else {
}
mysqli_set_charset($conn,"utf8");



// 테이블 쿼리 후 내용 출력.
try {

		$listPage = $_POST['listPage'];
		if(!$listPage) {
			throw new exception('$listPage 값이 없습니다.');
		}

    $list = $listPage * 10;
    $backList = ($listPage-1) * 10;

    $sql = "select * from ask_board where bno < {$list} order by bno desc limit 10";

    if ($view = mysqli_query($conn,$sql)){

    //  $res = mysqli_fetch_assoc($view);
		$result = array();

			while($row = mysqli_fetch_assoc($view)){
				array_push($result, $row);
			}

      mysqli_close($conn);

      } else {
      echo "테이블 쿼리 오류: " . mysqli_error($conn);
      exit;
      }

}catch(exception $e) {

		$result['success']	= false;
		$result['msg']		= $e->getMessage();
		$result['code']		= $e->getCode();

	}finally {

		echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

	}

?>
