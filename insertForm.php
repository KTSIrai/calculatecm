<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบฟอร์มบันทึกข้อมูลแปลงที่ดิน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">    
    <style>
        body {
            background-color: #f0f8ff;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            max-width: 550px;
            margin-top: 20px;
        }
        .form-control {
            border-radius: 4px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        h2 {
            color: #000000;
        }
        .form-group label {
            font-weight: 400;
            color: #333;
        }
        .form-group input {
            border: 1px solid #ced4da;
        }
        .form-group input:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }
        .alert {
            color: red;
            display: none;
            margin-top: 5px;
        }
    </style>
    
    <script>
        function validateForm(event) {
            let plotId = document.getElementById("plot_id").value;
            let plcontractNumber = document.getElementById("plcontract_number").value;
            let valid = true;

            // ตรวจสอบว่ากรอก plot_id
            if (plotId === "") {
                document.getElementById("plot_id_alert").style.display = "block";
                valid = false;
            } else {
                document.getElementById("plot_id_alert").style.display = "none";
            }

            // ตรวจสอบว่ากรอก plcontract_number
            if (plcontractNumber === "") {
                document.getElementById("plcontract_number_alert").style.display = "block";
                valid = false;
            } else {
                document.getElementById("plcontract_number_alert").style.display = "none";
            }

            // ถ้าฟอร์มไม่ถูกต้อง ให้หยุดการส่งข้อมูล
            if (!valid) {
                event.preventDefault();
            }
        }

        function convertSquareMeters() {
            const squareMeters = document.getElementById("square_meters").value;
            if (squareMeters === "" || isNaN(squareMeters)) {
                document.getElementById("conversion_result").innerHTML = "โปรดกรอกจำนวนตารางเมตรที่ถูกต้อง";
                return;
            }

            const rai = Math.floor(squareMeters / 1600);
            const ngan = Math.floor((squareMeters % 1600) / 400);
            const wah = Math.floor(((squareMeters % 1600) % 400) / 4);

            document.getElementById("conversion_result").innerHTML = 
                  rai + " ไร่ " + ngan + " งาน " + wah +  "  ตารางวา ";

            document.getElementById("rai").value = rai;
            document.getElementById("ngan").value = ngan;
            document.getElementById("wah").value = wah;

            let rai_adjusted = rai;
            let ngan_adjusted = ngan;

            if (ngan > 3) {
                rai_adjusted += 1; // ปัดขึ้น 1 ไร่ถ้าเกิน 3 งาน
                ngan_adjusted = 0; // งานจะถูกตั้งค่าใหม่
            } else if (ngan < 2) {
                ngan_adjusted = 0; // ถ้าน้อยกว่า 2 งาน ปัดลงไม่ให้มีงาน
            }

            document.getElementById("adjusted_conversion_result").innerHTML =
                rai_adjusted + " ไร่ ";

            // ใส่ค่า rai, ngan, wah หลังจากปัดเศษลงในฟอร์ม
            document.getElementById("rai_adjusted").value = rai_adjusted;
        }
    </script>
</head>
<body>
    
    <div class="container my-3">
        <h2 class="text-center">บันทึกข้อมูลแปลงที่ดิน</h2>
        <form action="insertData.php" method="POST" onsubmit="validateForm(event)">
            <div class="form-group">
                <label for="production_year">ปีการผลิต</label>    
                <input type="text" class="form-control" name="production_year" id="production_year" placeholder="ปีการผลิต">
            </div>
            <div class="form-group">
                <label for="plot_id">IDแปลง <span class="text-danger">*</span></label>    
                <input type="text" class="form-control" name="plot_id" id="plot_id" placeholder="IDแปลง">
                <div id="plot_id_alert" class="alert">กรุณากรอก IDแปลง</div>
            </div> 
            <div class="form-group">
                <label for="plcontract_number">เลขสัญญา <span class="text-danger">*</span></label>    
                <input type="text" class="form-control" name="plcontract_number" id="plcontract_number" placeholder="เลขสัญญา">
                <div id="plcontract_number_alert" class="alert">กรุณากรอก เลขสัญญา</div>
            </div>
            <div class="form-group">
                <label for="sugar_type">ชนิดอ้อย</label>    
                <input type="text" class="form-control" name="sugar_type" id="sugar_type" placeholder="ชนิดอ้อย">
            </div>
            <div class="form-group">
                <label for="quota_name">ชื่อโคต้า</label>    
                <input type="text" class="form-control" name="quota_name" id="quota_name" placeholder="ชื่อโคต้า">
            </div>
            <div class="form-group">
                <label for="promotion_unit">หน่วยส่งเสริม</label>    
                <input type="text" class="form-control" name="promotion_unit" id="promotion_unit" placeholder="หน่วยส่งเสริม">
            </div>
            <div class="form-group">
                <label for="promoter_area">เขต นักส่งเสริม</label>    
                <input type="text" class="form-control" name="promoter_area" id="promoter_area" placeholder="เขต นักส่งเสริม">
            </div>
            <div class="form-group">
                <label for="village">หมู่ที่</label>    
                <input type="text" class="form-control" name="village" id="village" placeholder="หมู่ที่">
            </div>
            <div class="form-group">
                <label for="district_sub">ตำบล</label>    
                <input type="text" class="form-control" name="district_sub" id="district_sub" placeholder="ตำบล">
            </div>
            <div class="form-group">
                <label for="district">อำเภอ</label>    
                <input type="text" class="form-control" name="district" id="district" placeholder="อำเภอ">
            </div>
            <div class="form-group">
                <label for="province">จังหวัด</label>    
                <input type="text" class="form-control" name="province" id="province" placeholder="จังหวัด">
            </div>
            <div class="form-group">
                <label for="square_meters">จำนวนตารางเมตร</label>    
                <input type="number" class="form-control" name="square_meters" id="square_meters" placeholder="จำนวนตารางเมตร" oninput="convertSquareMeters()">
            </div><br>
            <div class="form-group">
                <label>ผลลัพธ์การแปลง:</label>
                <p id="conversion_result" class="form-control">ยังไม่ได้กรอกข้อมูล</p>
            </div>
            <div class="form-group">
                <label>ส่งเสริม(ไร่):</label>
                <p id="adjusted_conversion_result" class="form-control">ยังไม่ได้กรอกข้อมูล</p>
            </div>
           
            <input type="hidden" name="rai" id="rai">
            <input type="hidden" name="ngan" id="ngan">
            <input type="hidden" name="wah" id="wah">
            <input type="hidden" name="rai_adjusted" id="rai_adjusted">

            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            <a href="index.php" class="btn btn-secondary">ยกเลิกการบันทึก</a>
        </form>
    </div>
    
</body>
</html>
