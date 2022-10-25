<?php

define("DB_SERVERNAME", "localhost:3306");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_NAME", "db-university");

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn && $conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    die();
}


$sql = "SELECT DISTINCT CONCAT( `teachers`.`name` , ' ' , `teachers`.`surname` ) AS `Teachers in dipartment of Math`                     
FROM `departments`
INNER JOIN `degrees`
ON `departments`.`id` = `degrees`.`department_id`
INNER JOIN `courses`
ON `degrees`.`id` = `courses`.`degree_id`
INNER JOIN `course_teacher`
ON `courses`.`id` = `course_teacher`.`course_id`
INNER JOIN `teachers`
ON `teachers`.`id` = `course_teacher`.`teacher_id`
WHERE departments.name LIKE '%MATEMATICA'
";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) { ?>
   <ol> 
    <?php 
    while ($row = $result->fetch_assoc()) { ?>
        <li>
            <?php
            echo $row['Teachers in dipartment of Math']
            ?>
        </li>
<?php   } ?> 
</ol> 
<?php
} elseif ($result) {
    echo "0 results";
} else {
    echo "query error";
} 

