<?php
include ("../../configuration.php");
include ("../../connection.php");
include ("../../endec.php");
?>

<html>
    <head>
        <title>Form 1</title>
        <script src="js/jquery.js"></script>
        <script src="js/jquery-ui.js"></script>
        <link rel="stylesheet" href="css/jquery-ui.css"/>

        <script src="js/jquery.cookie.js" type="text/javascript"></script>
        <script src="js/jquery.treeview.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/jquery.treeview.css" />


        <script type="text/javascript">
            $(document).ready(function(){
                $("#loadingview").fadeIn("slow", function(){
                    $.ajax({
                        url: "frmview.php",
                        type: "POST",
                        cache: false,
                        success: function(html){
                            $("#load-data").html(html);
                            $("#loadingview").fadeOut("slow",function(){
                                $("#tbldata").fadeIn("slow");
                            });
                        }
                    });
                })
            });
            
            function refreshclick(){
                $("#tbldata").fadeOut("slow", function(){
                    $("#loadingview").fadeIn("slow", function(){
                        $.ajax({
                            url: "frmview.php",
                            type: "POST",
                            cache: false,
                            success: function(html){
                                $("#load-data").html(html);
                                $("#loadingview").fadeOut("slow",function(){
                                    $("#tbldata").fadeIn("slow");
                                });
                            }
                        });
                    })
                });
            }
        </script>
    </head>
    <body>
        <div id="loadingview" style="display: none" align="center"><img src="images/load.gif" alt="loading" /></div>
        <table id="tbldata" style="display: none" width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td>
                    <div id="load-data"></div>
                </td>
                <td valign="top">
                    <div style="text-align: right"><input id="cmdrefresh" type="button" value="refresh" onclick="refreshclick()"/></div>
                </td>
            </tr>
        </table>
    </body>
</html>