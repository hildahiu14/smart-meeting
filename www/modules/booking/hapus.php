<?php
require_once '../../config/database.php';
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("DELETE FROM booking WHERE id_booking = ?");
$stmt->execute([$id]);
header("Location: index.php?msg=Booking berhasil dihapus");
exit;
