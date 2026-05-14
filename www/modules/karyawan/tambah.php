<?php
require_once '../../config/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO karyawan (nama_karyawan, divisi, email) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['nama_karyawan'], $_POST['divisi'], $_POST['email']]);
    header("Location: index.php?msg=Karyawan berhasil ditambahkan");
    exit;
}
include '../../includes/header.php';
?>
<div class="page-header"><h1>Tambah Karyawan</h1></div>
<div class="card" style="max-width:500px">
    <form method="POST">
        <div class="form-group"><label>Nama Karyawan</label><input type="text" name="nama_karyawan" required></div>
        <div class="form-group"><label>Divisi</label><input type="text" name="divisi" required></div>
        <div class="form-group"><label>Email</label><input type="email" name="email" required></div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn" style="background:#eee;color:#333">Batal</a>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>
