
<table border="1">
    <tr>
        <td>ID</td>
        <td>USERNAME</td>
        <td>PASSWORD</td>
        <td>FIRST NAME</td>
        <td>LAST NAME</td>
        <td>EMAIL</td>
    </tr>



<?php
// error_reporting(0);

include("config.inc.php");
include("connect.db.php");

$connect = connect_db($dbname, $username, $password);

$sql = "SELECT * FROM users";
$res = $connect->query($sql);
foreach($res as $fila) {
    print("<tr>");
    print("<td>". $fila['id'] ."</td>");
    print("<td>". $fila['username'] ."</td>");
    print("<td>". $fila['password'] ."</td>");
    print("<td>". $fila['first_name'] ."</td>");
    print("<td>". $fila['last_name'] ."</td>");
    print("<td>". $fila['email'] ."</td>");
    print("</tr>");
}
$connect = null;
?>
</table>