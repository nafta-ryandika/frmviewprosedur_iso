<?php
include ("../../configuration.php");
include ("../../connection.php");
include ("../../endec.php");

function cekDepartemen($xdept, $dept) {
    $hasil = false;
    $arr_dept = explode("|", $xdept);
    for ($i = 0; $i < count($arr_dept); $i++) {
        if ($arr_dept[$i] == $dept) {
            $hasil = true;
        }
    }
    return $hasil;
}

function CreateTreeView($xid_dept, $xid_parent) {
    $sql = "SELECT 
                b.depnama
                , a.id
                , a.id_parent
                , a.prosedur
                , a.nama_gambar
                , a.total_halaman
                FROM prosedur_iso a
                LEFT JOIN rldept b ON a.departemen = b.depkode
                WHERE b.depkode = '" . $xid_dept . "' AND a.id_parent = '" . $xid_parent . "'
                ORDER BY cast(a.prosedur as unsigned), SUBSTRING_INDEX(a.prosedur, \".\", 1) ";
    // echo($sql);

    $rs = mysql_query($sql);
    $count = mysql_num_rows($rs);
    if ($count > 0) {
        while ($data = mysql_fetch_array($rs)) {
            $xid = $data['id'];
            $sql1 = "SELECT 
                b.depnama
                , a.id
                , a.id_parent
                , a.prosedur
                , a.nama_gambar
                , a.total_halaman
                FROM prosedur_iso a
                LEFT JOIN rldept b ON a.departemen = b.depkode
                WHERE b.depkode = '" . $xid_dept . "' AND a.id_parent = '" . $xid . "'  
                ORDER BY cast(a.prosedur as unsigned), SUBSTRING_INDEX(a.prosedur, \".\", 1) ";
            // echo($sql1);
            $rs1 = mysql_query($sql1);
            $count1 = mysql_num_rows($rs1);
            echo "<ul>";
            if ($count1 > 0 || $data['nama_gambar'] == "") {
                echo "<li><span class='folder'>" . $data['prosedur'] . "</span>";
                CreateTreeView($xid_dept, $xid);
            } else {
                ?>
                <li><a onclick="openImage('<?php echo $data['nama_gambar'] ?>','<?php echo $data['total_halaman'] ?>')"><span class="file"><?php echo $data['prosedur'] ?> </span></a></li>
                <?php
            }
            echo "</ul>";
        }
    }
}
?>

<html>
    <head>
        <title>Form 1</title>
<!--        <script src="js/jquery.js"></script>
        <script src="js/jquery-ui.js"></script>
        <link rel="stylesheet" href="css/jquery-ui.css"/>

        <script src="js/jquery.cookie.js" type="text/javascript"></script>
        <script src="js/jquery.treeview.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/jquery.treeview.css" />-->


        <script type="text/javascript">
            $(document).ready(function(){
                $("#prosedur").treeview({
                    persist: "location",
                    collapsed: true
                });
                
                $( "#view-image" ).dialog({
                    autoOpen: false,
                    modal: true,
                    height: 594,
                    width: 800,
                    position: { my: "top", at: "top"},
                    title: "View Prosedur"
                });
            });
            
            function openImage(picture, jmlPage){
                
                var data = "intxtmode=viewgambar2&namagambar="+picture+"&jmlpage="+jmlPage;
                $.ajax({
                    url: "actfrm.php",
                    type: "POST",
                    data: data,
                    cache: false,
                    success: function(img){
                        $("#dialog-image").html(img);
                        $("#view-image").dialog("open");
                
                        $('img').bind('contextmenu', function(e){
                            return false;
                        }); 
                    }
                });
            }
        </script>
        <style type="text/css">

            .background{
                width: 650px;
                height: 900px;
                margin: 0 auto;
            }

            /*            .watermark{
                            background: url("images/watermark.png");
                            opacity: 0.25;
                            font-size: 3em;
                            text-align: center;
                            z-index: 0;
            
                            height: 100%
                        }*/
        </style>
    </head>
    <body>
        <div id="view-image">
            <div id="dialog-image">
                <!--isi images-->
            </div>
        </div>

        <ul id="prosedur" class="filetree">
            <?php
            $sql = "SELECT 
                        b.depkode
                        , b.depnama
                        -- , b.dept_login
                        FROM rldept b
                        -- WHERE b.dept_login is not null 
                        -- GROUP BY b.nama_dept ";
            $rs = mysql_query($sql);
            while ($data = mysql_fetch_array($rs)) {
//                if($_SESSION[$domainApp."_mygroup"] == "admin" || $_SESSION[$domainApp."_myxuser"] == "NURI" || $_SESSION[$domainApp."_myxuser"] == "ISOSTAF"){
                // $xdept = "IMP|ACC|EDP|WHS|HRD|ANP|MEM|MER|OPR|GAF|FIN|ISO";
//                }else{
//                    $xdept = $_SESSION[$domainApp."_myxdept"];
//                }
                // $ar_dept = explode("|", $xdept);
                // $count = count($ar_dept);
                echo "<li><span class='folder'>" . $data['depnama'] . "</span>";
                // for ($idx = 1; $idx < count($ar_dept); $idx++) {
                //     if ($ar_dept[$idx] == $data['dept_login']) {
                        CreateTreeView($data['depkode'], 0);
                //     }
                // }
                echo "</li>";
            }
            ?>        
        </ul>
    </body>
</html>