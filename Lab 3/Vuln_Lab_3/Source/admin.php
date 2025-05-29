<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once 'layout.php';
startLayout("Admin Dashboard - FakeBook");
?>

<div style="max-width: 600px; margin: auto; padding: 30px; background: #f9f9f9; border-radius: 10px; box-shadow: 0 0 8px rgba(0,0,0,0.1);">
    <h2 style="color: #28a745;"> Congratulations!</h2>
    <p>You have successfully completed all steps of this FakeBook lab:</p>
    <ul>
        <li>Exploited the XXE vulnerability to read hidden system files</li>
        <li>Discovered a sensitive log file containing login attempts</li>
        <li>Identified a SQL injection vulnerability in the login form</li>
        <li>Used the SQL injection to log in as <strong>admin</strong></li>
        <li>Used the Broken Access Control to reset password then log in as <strong>admin</strong></li>     
    </ul>

    <p style="margin-top: 20px;">Here is your flag {lab3_flag_captured}. Prepare for final lab</p>
    <div style="margin-top: 30px; font-size: 14px; color: #555;">
        <strong>Note for testers:</strong><br>
