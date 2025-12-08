<?php
session_start();            // Start or resume the session
session_unset();            // Remove all session variables
session_destroy();          // Destroy the session completely

// Optional: Redirect user
header("Location: index");
exit();