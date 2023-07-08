<?php

$dbconn = pg_connect("host=localhost port=5432 dbname=todo user=postgres password=postgres");
$result = pg_query($dbconn, "INSERT INTO todo (task) VALUES ('" . $_POST['todo'] . "') RETURNING id, task");

if (!$result) {
    echo "";
}

while ($row = pg_fetch_row($result)) {
    echo "<tr>";
        echo "<td><input value='$row[0]' type='checkbox' /></td>";
        echo "<td>$row[1]</td>";
    echo '</tr>';
}

?>
