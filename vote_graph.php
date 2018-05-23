<?php

//--- html : radio button, php : print graph
include "DB_info.php";
$Name = $_POST['member'];
//echo "후보자 명 : " . $Name . "<BR>";

//---DB_연결
$vote_conn = new mysqli(DB_info::DB_url, DB_info::DB_host,
    DB_info::DB_password, DB_info::DB_name);

//---DB_연결 유무 예외처리
if ($vote_conn->connect_errno) {
    echo "Failed to connect to Mysql : " . $vote_conn->connect_error;
}

//--- 입력 된 값, DB에 저장, 정보 업데이트
//--- 투표율 누적 필요

if ($Name != null) {

    $result = $vote_conn->query("update vote_table set vote_ratio = vote_ratio + 1 
                                where member_name = '$Name'");

    if (isset($result)) {

    } //--- html화면상에 반환할 결과 값
    //echo "투표완료<BR>";

    else {

    }
    //echo "DB 연결상의 문제 발생<BR>";

} //--- 후보 선택 하지 않았을 시

else if ($Name == null) {
    //echo "후보를 선택해 주세요<BR>";
}

$result = $vote_conn->query("select * from vote_table");
$all_ratio = null; //--- 총 표의 갯수(후에 후보당 표 비율 구할때 사용)

$candiArray = array();
for ($i = 0; $i < 3; $i++) {
    while ($row = $result->fetch_array(MYSQLI_BOTH)) {

        //  echo "후보 투표 수 : ".$row["vote_ratio"]."<BR>";
        $save_ratio = $row["vote_ratio"];
        $candiArray[$i] = $save_ratio;
        $all_ratio += $row["vote_ratio"];
        break;
    }
}
echo "총 표 갯수 : " . $all_ratio . "<BR><BR>";

//--- 각 후보들의 지지율 계산

$ratio_calcu = array();
for ($count = 0; $count < 3; $count++) {
    $ratio_calcu[$count] = ceil(($candiArray[$count] / $all_ratio) * 100);
    echo ($count + 1) . " 번째 후보 표 수 : " . $candiArray[$count] . "<BR>";
    echo " - 지지율 : " . $ratio_calcu[$count] . " %<BR><BR>";
}

echo "<form action='graph_image.php' method='post' name='auto_submit'>

<input type='hidden' name='ratio_calcu1' value='$ratio_calcu[0]'>
<input type='hidden' name='ratio_calcu2' value='$ratio_calcu[1]'>
<input type='hidden' name='ratio_calcu3' value='$ratio_calcu[2]'>

</form>";
echo "<script>function auto_submit() {
    document.auto_submit.submit();
}
auto_submit();
</script>";
echo "<img src='graph_image.php'>";

?>