<?php

include("configuration.php");
include("connection.php");
include("endec.php");


//variabel image
$intxtmode = $_POST['intxtmode'];
$gambar = explode(".", $_POST['namagambar']);
$namagambar = $gambar[0];
$jmlpage = $_POST['jmlpage'];

if ($intxtmode == 'add') {
    
} elseif ($intxtmode == 'edit') {
    
} elseif ($intxtmode == 'delete') {
    
} elseif ($intxtmode == 'getedit') {
    
} else if ($intxtmode == "viewgambar") {

    for ($idx = 0; $idx < $jmlpage; $idx++) {
        echo '<a href="#" style="border: black"><img src="convert/' . $namagambar . '-' . $idx . '.jpg" width="200px" height="200px"/></a>';
    }
} else if ($intxtmode == "viewgambar2") {
    if ($jmlpage == 1) {
//        echo '<div class="background" style="background-image: url(../frmprosedur_iso/convert/' . $namagambar . '.jpg); background-repeat: no-repeat">
//                    <div class="watermark"></div>
//                </div>';
        echo '<img src="../frmprosedur_iso/convert/' . $namagambar . '.jpg"  style="border: black" border="1"/>';
    } else {
        for ($idx = 0; $idx < $jmlpage; $idx++) {
//            echo '<div class="background" style="background-image: url(../frmprosedur_iso/convert/' . $namagambar . '-' . $idx . '.jpg); background-repeat: no-repeat">
//                    <div class="watermark"></div>
//                </div>';
            echo '<img src="../frmprosedur_iso/convert/' . $namagambar . '-' . $idx . '.jpg"  style="border: black" border="1"/>';
        }
    }
} else if ($intxtmode == "deletejpg") {
    
}


// close connection !!!!
mysql_close($conn)
?>