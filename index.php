<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=datacm", $username, $password);
  
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
} catch(PDOException $e) {
  echo "" . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name ="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกข้อมูลแปลงที่ดิน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
    <style>
        body {
            background-color: #f7f9fc;
        }

        h2 {
            color: #000000;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            
        }

        p {
            font-family: verdana;
            font-size: 20px;
            }
        
        .table thead {
            background-color: #007bff;
            color: white;
            
        }

        .btn-dark {
            background-color: #343a40;
            border-color: #343a40;
            border: 0px solid red;
            margin: -75px -100px 10px 405px;
        }

        .btn-primary {
            width: 50px;
            margin: 5px 0px 0px 0px;
        }
        .btn-success {
            width: 15%;
        }

        .btn-success {
            margin-top: -10px;
            background-color: #04AA6D;
            color: white;
        }
        .btn-danger{
            width: 90px;
        } 

        .form-control {
            margin-bottom: 10px;
            max-width: 400px;
        }

        @media (max-width: 768px) {
            .table {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
    <h1 class="text-center">ตารางข้อมูลแปลงที่ดิน</h1>
    <hr>
        
        <table id ="myTable" class="table table-striped">
                <thead>
                  
                    <th>ปีการผลิต</th>
                    <th>ไอดีแปลง</th>
                    <th>เลขสัญญา</th>
                    <th>ชนิดอ้อย</th>
                    <th>ชื่อโคต้า</th>
                    <th>หน่วยส่งเสริม</th>
                    <th>เขต นักส่งเสริม</th>
                    <th>หมู่ที่</th>
                    <th>ตำบล</th>
                    <th>อำเภอ</th>
                    <th>จังหวัด</th>
                    <th>ตารางเมตร</th>
                    <th>ไร่</th>
                    <th>งาน</th>
                    <th>ตารางวา</th>
                    <th>ส่งเสริม(ไร่)</th>
                    <th>ลบข้อมูล</th>
                    <th>Options</th>

                    </thead>
                <tbody>
             <?php

            $stmt = $conn->query("SELECT * FROM land_info" );
            $stmt-> execute();

            $users = $stmt ->fetchAll();
            foreach($users as $row) {
                
            ?>
                    <tr>
                       
                        <td><?php echo $row["production_year"]; ?></td>
                        <td><?php echo $row["plot_id"]; ?></td>
                        <td><?php echo $row["plcontract_number"]; ?></td>
                        <td><?php echo $row["sugar_type"]; ?></td>
                        <td><?php echo $row["quota_name"]; ?></td>
                        <td><?php echo $row["promotion_unit"]; ?></td>
                        <td><?php echo $row["promoter_area"]; ?></td>
                        <td><?php echo $row["village"]; ?></td>
                        <td><?php echo $row["district_sub"]; ?></td>
                        <td><?php echo $row["district"]; ?></td>
                        <td><?php echo $row["province"]; ?></td>
                        <td><?php echo $row["square_meters"]; ?></td>
                        <td><?php echo $row["rai"]; ?></td>
                        <td><?php echo $row["ngan"]; ?></td>
                        <td><?php echo $row["wah"]; ?></td>
                        <td><?php echo $row["rai_adjusted"]; ?></td>
                        <td>
                            <a href="deleteQueryString.php?idpn=<?php echo $row["id"]; ?>" class="btn btn-danger">ลบข้อมูล</a>
                        </td>
                        <td>
                            <a target="_blank" href="exportPDF.php?id=<?=$row['id']?>" class="btn btn-sm btn-primary"> <i class="fa fa-file-pdf-o"></i>Print</a>
                        </td>
                    </tr>  
         
        <?php      
            }
        ?>
         </tbody>
        </table>
        <a href="insertForm.php" class="btn btn-success">บันทึกข้อมูลแปลงที่ดิน</a>

        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
        
        <script>
                $(document).ready(function(){

                    $('#myTable').DataTable();
                }
            
            
            );
                
        </script>

    </body>
</html>
