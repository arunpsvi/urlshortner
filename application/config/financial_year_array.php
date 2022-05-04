<?php $dates = range($start, date('Y'));
foreach($dates as $date){

    if (date('m', strtotime($date)) <= 8) {//Upto June
        $year = ($date-1) . '-' . $date;
    } else {//After June
        $year = $date . '-' . ($date + 1);
    }

    echo "<option value='$year'>$year</option>";
}
?>