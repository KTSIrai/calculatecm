<?php
require('dbconnect.php');

// Retrieve POST data
$plcontract_number = $_POST["plcontract_number"];
$plot_id = $_POST["plot_id"];
$production_year = $_POST["production_year"];
$quota_name = $_POST["quota_name"];
$square_meters = $_POST["square_meters"];
$rai = $_POST["rai"];
$ngan = $_POST["ngan"];
$wah = $_POST["wah"];
$rai_adjusted = $_POST["rai_adjusted"];
$sugar_type = $_POST["sugar_type"];
$promotion_unit = $_POST["promotion_unit"];
$promoter_area = $_POST["promoter_area"];
$village = $_POST["village"];
$district_sub = $_POST["district_sub"];
$district = $_POST["district"];
$province = $_POST["province"];

// Check if plot_id already exists
$checkPlotIdSql = "SELECT * FROM land_info WHERE plot_id = ?";
$stmt = $connect->prepare($checkPlotIdSql);
$stmt->bind_param("s", $plot_id);
$stmt->execute();
$resultPlotId = $stmt->get_result();

if ($resultPlotId->num_rows > 0) {
    // plot_id duplicate found, show error message
    echo "<script>
            alert('Error: แปลงIDนี้ใช้ไปแล้ว.โปรดคีย์เลขแปลงIDที่ไม่ซ้ำ.');
            window.location.href = 'insertForm.php';
          </script>";
    exit();  // Stop further execution if plot_id is a duplicate
}

// Check if plcontract_number already exists
$checkPlcontractNumberSql = "SELECT * FROM land_info WHERE plcontract_number = ?";
$stmt = $connect->prepare($checkPlcontractNumberSql);
$stmt->bind_param("s", $plcontract_number);
$stmt->execute();
$resultPlcontractNumber = $stmt->get_result();

if ($resultPlcontractNumber->num_rows > 0) {
    // plcontract_number duplicate found, show error message
    echo "<script>
            alert('Error: เลขสัญญานี้มีอยู่แล้ว. โปรดคีย์เลขสัญญาที่ไม่ซ้ำ.');
            window.location.href = 'insertForm.php';
          </script>";
    exit();  // Stop further execution if plcontract_number is a duplicate
}

// No duplicate found, proceed with the insertion
$sql = "INSERT INTO land_info(plcontract_number, plot_id, production_year, quota_name, square_meters, rai, ngan, wah, rai_adjusted, sugar_type, promotion_unit, promoter_area, village, district_sub, district, province) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $connect->prepare($sql);
$stmt->bind_param("ssssssssssssssss", $plcontract_number, $plot_id, $production_year, $quota_name, $square_meters, $rai, $ngan, $wah, $rai_adjusted, $sugar_type, $promotion_unit, $promoter_area, $village, $district_sub, $district, $province);

if ($stmt->execute()) {
    // Successful insertion, redirect to index.php
    header("Location: index.php");
    exit(0);
} else {
    // Show error message if insertion fails
    echo "Error: " . $stmt->error;
}

// Close connection
$connect->close();
?>
