<?php
// Only allow access from localhost (SSRF target)
if ($_SERVER['REMOTE_ADDR'] !== '127.0.0.1') {
    http_response_code(403);
    echo "Access denied. This endpoint is only accessible from LOCAL IP. Maybe if you can login as admin so you can do somthing ?";
    exit();
}

// Success
echo "Congratulation! You now completly exploit lab 2. Ready for lab 3 ?  ";
