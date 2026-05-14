<?php
require_once '../../config/database.php';
$id = $_GET['id'] ?? 0;
$s = $pdo->prepare("SELECT * FROM karyawan WHERE id_karyawan = ?");
$s->execute([$id]);
$k = $s->fetch(PDO::FETCH_ASSOC);
if (!$k) { header("Location: index.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE karyawan SET nama_karyawan=?, divisi=?, email=? WHERE id_karyawan=?");
    $stmt->execute([$_POST['nama_karyawan'], $_POST['divisi'], $_POST['email'], $id]);
    header("Location: index.php?msg=Karyawan berhasil diperbarui");
    exit;
}
include '../../includes/header.php';
?>
<div class="page-header"><h1>Edit Karyawan</h1></div>
<div class="card" style="max-width:500px">
    <form method="POST">
        <div class="form-group"><label>Nama Karyawan</label><input type="text" name="nama_karyawan" value="<?= htmlspecialchars($k['nama_karyawan']) ?>" required></div>
        <div class="form-group"><label>Divisi</label><input type="text" name="divisi" value="<?= htmlspecialchars($k['divisi']) ?>" required></div>
        <div class="form-group"><label>Email</label><input type="email" name="email" value="<?= htmlspecialchars($k['email']) ?>" required></div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn" style="background:#eee;color:#333">Batal</a>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>
