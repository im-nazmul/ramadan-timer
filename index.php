<!DOCTYPE html>
<html>
<head>
    <title>Ramadan Time</title>
</head>
<body>
    <div id="ramadan-time">
        <?php
            date_default_timezone_set("Asia/Dhaka");

            $ramadanStart = strtotime("6:15 pm 24 march 2023");
            $ramadanEnd = strtotime("6:21 pm 21 april 2023");
            
            $seheriTime = strtotime("4:38 am");
            $iftarTime = strtotime("6:15 pm");

            // Calculate time until Ramadan start
            $currentTime = time();
            if ($currentTime < $ramadanStart) {
                $timeRemaining = $ramadanStart - $currentTime;
                $timeRemainingText = secondsToTime($timeRemaining);
                echo "Ramadan starts in: $timeRemainingText\n";
            } elseif ($currentTime < $seheriTime) {
                $timeRemaining = $seheriTime - $currentTime;
                $timeRemainingText = secondsToTime($timeRemaining);
                echo "Seheri time remaining: $timeRemainingText\n";
            } elseif ($currentTime < $iftarTime) {
                $timeRemaining = $iftarTime - $currentTime;
                $timeRemainingText = secondsToTime($timeRemaining);
                echo "Iftar time remaining: $timeRemainingText\n";
            } elseif ($currentTime < $ramadanEnd) {
                // Calculate time remaining until next Seheri
                $seheriTimeTomorrow = strtotime('tomorrow', $seheriTime);
                $timeRemaining = $seheriTimeTomorrow - $currentTime;
                $timeRemainingText = secondsToTime($timeRemaining);
                echo "Seheri time remaining: $timeRemainingText\n";
            }

            // Function to convert seconds to days, hours, minutes, and seconds
            function secondsToTime($seconds) {
                $days = floor($seconds / 86400);
                $hours = floor(($seconds % 86400) / 3600);
                $minutes = floor(($seconds % 3600) / 60);
                $seconds = $seconds % 60;
                return "$days days, $hours hours, $minutes minutes, and $seconds seconds";
            }
        
        ?>


    </div>
    <script>
        //call the PHP script every one second
        setInterval(function(){
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    document.getElementById("ramadan-time").innerHTML = xhr.responseText;
                }
            }
            xhr.open("GET", "<?php echo $_SERVER['PHP_SELF']; ?>", true);
            xhr.send();
        }, 1000);
    </script>
</body>
</html>
