<?php
require_once '../../config/database.php';
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("DELETE FROM ruangan WHERE id_ruangan = ?");
$stmt->execute([$id]);
header("Location: index.php?msg=Ruangan berhasil dihapus");
exit;
