<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: blueviolet;
        }
        .container {
            background: white;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 500px;
        }
        h1 {
            text-align: center;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"],
        input[type="reset"] {
            width: 48%;
            padding: 10px;
            margin: 5px 1%;
            border: none;
            border-radius: 4px;
            background-color: blueviolet;
            color:white;
            cursor: pointer;
        }
        input[type="reset"] {
            background-color: red;
        }
        input[type="submit"]:hover,
        input[type="reset"]:hover {
            opacity: 0.8;
        }
        .result {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>====Student Info====</h1>
        <form method="POST" action="">
            Mobile App <input type="text" name="txtmobile"><br>
            Java Language <input type="text" name="txtjava"><br>
            MySQL <input type="text" name="txtmysql"><br>
            OOP <input type="text" name="txtoop"><br>
            Database Concept <input type="text" name="txtdbconcept"><br>
            <input type="submit" name="btnsubmit" value="Calculate">
            <input type="reset" name="btnreset" value="Clear">
        </form>
        <div class="result">
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Retrieve and validate input
                    $mobile = (float)$_POST['txtmobile'];
                    $java = (float)$_POST['txtjava'];
                    $mysql = (float)$_POST['txtmysql'];
                    $oop = (float)$_POST['txtoop'];
                    $dbconcept = (float)$_POST['txtdbconcept'];

                    // Calculate total and average
                    $total = $mobile + $java + $mysql + $oop + $dbconcept;
                    $average = $total / 5;

                    // Determine grade
                    if ($average >= 90) {
                        $grade = 'A';
                    } elseif ($average >= 80) {
                        $grade = 'B';
                    } elseif ($average >= 70) {
                        $grade = 'C';
                    } elseif ($average >= 60) {
                        $grade = 'D';
                    } else {
                        $grade = 'F';
                    }

                    // Display results
                    echo "=====The result of student's score=====";
                    echo "<br> Total's Score: $total";
                    echo "<br> Average's Score: $average";
                    echo "<br> Your Grade is: $grade";
                }
            ?>
        </div>
    </div>

</body>
</html>