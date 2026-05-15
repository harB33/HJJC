<?php
require_once __DIR__ . '/../../config/config.php';

$_SESSION = array();
session_destroy();

header("Location: /index.php");
exit;
