<?php
//include "vote_graph.php";
$ratio_calcu1 = $_POST['ratio_calcu1'];
$ratio_calcu2 = $_POST['ratio_calcu2'];
$ratio_calcu3 = $_POST['ratio_calcu3'];

$height = 400;
$width = 600;

$Image = ImageCreateTrueColor($width, $height);

//---  색깔 설정
$pink = ImageColorAllocate($Image, 243, 97, 166);
$ivory = ImageColorAllocate($Image, 150, 244, 133);
$blue = ImageCOlorAllocate($Image, 103, 153, 255);
$white = ImageColorAllocate($Image, 255, 255, 255);

ImageFill($Image, 0, 0, $white);

imagerectangle($Image, 50, 50, 10 * $ratio_calcu1, 100, $pink); //---x2의 비율을 조절 해야 함
imagestring($Image, 5, 150, 100, "yokoyama you", $pink);


imagerectangle($Image, 50, 150, 10 *$ratio_calcu2, 200, $ivory); //---x2의 비율을 조절 해야 함
imagestring($Image, 5, 150, 200, "jeong jimin", $ivory);


imagerectangle($Image, 50, 250, 10 *$ratio_calcu3, 300, $blue); //---x2의 비율을 조절 해야 함
imagestring($Image, 5, 150, 300, "yasuda shota", $blue);

Header('Content-type: image/png');
imagepng($Image);

ImageDestroy($Image);


?>