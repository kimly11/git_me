<?php 

    $studentInfo = [
        "ID" => "mis2023210009",
        "Name" => "Chim pharin",
        "Gender" => "Male",
        "Date to Birth" => "20/01/2004",
        "Major" => "MIS",
        "Address" => "Phnom Penh",
        "Fees" => "150$",
        "Credit" => "5"
    ];
    echo "======= Student Information =======<br>";
    foreach ($studentInfo as $key => $value) {
        echo "$key: $value<br>";
    }
    $elementCount = count($studentInfo);
    echo "<br>Total number of element : $elementCount<br>";
?>