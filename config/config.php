<?php
ob_start(); //バッファに一時保存して出力を制御
session_start();

$timezone = date_default_timezone_set("Asia/Tokyo");

$con = mysqli_connect("localhost", "root", "", "social");

// mysqli_connect_errnoは直近の接続コールに関するエラーを返す
if(mysqli_connect_errno()) {
	echo "Failed to connect: " . mysqli_connect_errno();
}