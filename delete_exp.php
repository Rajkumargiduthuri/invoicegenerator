<?php
include("bhavidb.php");

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM `exp_name` WHERE `id` = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: exp_customized_edits.php");
