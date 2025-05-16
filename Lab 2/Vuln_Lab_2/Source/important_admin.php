<?php
// Only allow access from localhost (SSRF target)
if ($_SERVER['REMOTE_ADDR'] !== '127.0.0.1') {
    http_response_code(403);
    echo "Access denied. This endpoint is only accessible from ""LOCAL"" IP. Have you ever heard about SSRF ? Give it a shot.";
    exit();
}

// Success
echo "Congratulation! You now completly lab 2 by exploit successfully SSRF and Insecure Design. Ready for lab 3 ?  ";
