<?php

require 'conn.php';

// $clear_query = 'DELETE FROM wch';
// $result = mysqli_query($link, $clear_query);


// for ($i=0; $i<12;$i++) {
//     $d = $i + 10;

//     $n = rand(0,10);
//     $date = date("Y\-m\-d", mktime(0,0,0,9, $d, 2018));
//     for ($j=$i+1; $j>0; $j--) {
//         $query = "INSERT INTO wch (date) VALUES ('$date')";
//         $result = mysqli_query($link, $query);
//         if(!$result) {
//                 die(mysqli_error($link));
//             } else {
//                 $html = "";
//             $html .= "Date=> " . $date;
//             $html .= " Query no.=>" . $j;
//             $html .= " //Inserted Successfully<br>";
//             echo $html;
//         }
//     }
//     echo "<br><br>";
// }

// $gradient = array("4CAF50","6FBB51","93C853","B7D454","DBE156","FFEE58","F3C64E","E89E44","DC773B","D14F31","C62828");
// $i = 0;
// $css = "";
// foreach ($gradient as $clr) {
//     global $i;
//     $i++;
//     $css .= ".badge-" . $i . "{ background-color:" . $clr . "; }";
// }
// $css_file = fopen("../css/style.css", "a");
// fwrite($css_file, $css);

$css="";
for ($i=1; $i<12; $i++) {
    $css .= ".badge-" . $i . ":hover";
    if ($i < 11) {
        $css .= ", ";
    } else {
        $css .= " ";
    }
}

$css .= "{ background-color: rgba(2, 44, 107, 0.534); }";

$css_file = fopen("../css/style.css", "a");
fwrite($css_file, $css);
echo $css;

?>
