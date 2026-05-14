<?php
require_once '../../config/database.php';
include '../../includes/header.php';
?>
<div class="page-header"><h1>Tambah Ruangan</h1></div>
<div class="card" style="max-width:500px">
    <form method="POST">
        <div class="form-group">
            <label>Nama Ruangan</label>
            <input type="text" name="nama_ruangan" required>
        </div>
        <div class="form-group">
            <label>Kapasitas (orang)</label>
            <input type="number" name="kapasitas" min="1" required>
        </div>
        <div class="form-group">
            <label>Fasilitas</label>
            <textarea name="fasilitas" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn" style="background:#eee;color:#333">Batal</a>
    </form>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO ruangan (nama_ruangan, kapasitas, fasilitas) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['nama_ruangan'], $_POST['kapasitas'], $_POST['fasilitas']]);
    header("Location: index.php?msg=Ruangan berhasil ditambahkan");
    exit;
}
include '../../includes/footer.php';
?>
