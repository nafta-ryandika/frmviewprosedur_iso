<?php
include ("configuration.php");
include ("connection.php");
include ("endec.php");
?>

<html>
    <head>
        <script src="js/jquery.js"></script>
        <script src="js/jquery-ui.js"></script>
        <link rel="stylesheet" href="css/jquery-ui.css"/>

        <script src="js/jquery.cookie.js" type="text/javascript"></script>
        <script src="js/jquery.treeview.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/jquery.treeview.css" />


        <script type="text/javascript">
            $(document).ready(function(){
                $("#prosedur").treeview({
                    persist: "location",
                    collapsed: true
                });
                
                $( "#view-image" ).dialog({
                    autoOpen: false,
                    modal: true,
                    height: 600,
                    width: 700,
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
            
            .watermark{
                background: url("images/watermark.png");
                opacity: 0.25;
                font-size: 3em;
                text-align: center;
                z-index: 0;
                
                height: 100%
            }
        </style>
    </head>

    <body>
        
        <div class="background" style="background-image: url(../office/frm/frmprosedur/convert/e_prosedur_jaminan_-1428981108.jpg); background-repeat: no-repeat">
            <div class="watermark"></div>
        </div>
        ##################################################################################################################################
        <div class="background" style="background-image: url(../office/frm/frmprosedur/convert/e_prosedur_jaminan_-1428981108.jpg); background-repeat: no-repeat">
            <div class="watermark">
                
            </div>
        </div>

    </body>
</html>