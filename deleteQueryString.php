<?php
    require('dbconnect.php');
    $id=$_GET["idpn"];

    $sql="DELETE FROM land_info WHERE id =$id";

    $result=mysqli_query($connect,$sql);

    if($result){
        header("location:index.php");
        exit(0);
    }else{
        echo "มีข้อผิดผลาดเกิดขึ้น";   
    
    }