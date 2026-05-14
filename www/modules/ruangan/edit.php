<?php
require_once '../../config/database.php';
$id = $_GET['id'] ?? 0;
$r = $pdo->prepare("SELECT * FROM ruangan WHERE id_ruangan = ?");
$r->execute([$id]);
$ruangan = $r->fetch(PDO::FETCH_ASSOC);
if (!$ruangan) { header("Location: index.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE ruangan SET nama_ruangan=?, kapasitas=?, fasilitas=? WHERE id_ruangan=?");
    $stmt->execute([$_POST['nama_ruangan'], $_POST['kapasitas'], $_POST['fasilitas'], $id]);
    header("Location: index.php?msg=Ruangan berhasil diperbarui");
    exit;
}
include '../../includes/header.php';
?>
<div class="page-header"><h1>Edit Ruangan</h1></div>
<div class="card" style="max-width:500px">
    <form method="POST">
        <div class="form-group">
            <label>Nama Ruangan</label>
            <input type="text" name="nama_ruangan" value="<?= htmlspecialchars($ruangan['nama_ruangan']) ?>" required>
        </div>
        <div class="form-group">
            <label>Kapasitas (orang)</label>
            <input type="number" name="kapasitas" value="<?= $ruangan['kapasitas'] ?>" min="1" required>
        </div>
        <div class="form-group">
            <label>Fasilitas</label>
            <textarea name="fasilitas" rows="3"><?= htmlspecialchars($ruangan['fasilitas']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn" style="background:#eee;color:#333">Batal</a>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>
