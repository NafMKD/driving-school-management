<?php
session_start();

if ($_GET['type'] == "Student") {
	$file = $_GET['src'];
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$_GET['name']);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    ob_clean();
    flush();
    readfile($file);
    exit;
}