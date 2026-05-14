<?php
require_once '../../config/database.php';
$id = $_GET['id'] ?? 0;
$s = $pdo->prepare("SELECT * FROM booking WHERE id_booking = ?");
$s->execute([$id]);
$b = $s->fetch(PDO::FETCH_ASSOC);
if (!$b) { header("Location: index.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE booking SET id_ruangan=?, id_karyawan=?, tanggal=?, jam_mulai=?, jam_selesai=?, keperluan=?, status=? WHERE id_booking=?");
    $stmt->execute([$_POST['id_ruangan'], $_POST['id_karyawan'], $_POST['tanggal'], $_POST['jam_mulai'], $_POST['jam_selesai'], $_POST['keperluan'], $_POST['status'], $id]);
    header("Location: index.php?msg=Booking berhasil diperbarui");
    exit;
}

$ruangan  = $pdo->query("SELECT * FROM ruangan ORDER BY nama_ruangan")->fetchAll(PDO::FETCH_ASSOC);
$karyawan = $pdo->query("SELECT * FROM karyawan ORDER BY nama_karyawan")->fetchAll(PDO::FETCH_ASSOC);
include '../../includes/header.php';
?>
<div class="page-header"><h1>Edit Booking</h1></div>
<div class="card" style="max-width:540px">
    <form method="POST">
        <div class="form-group">
            <label>Ruangan</label>
            <select name="id_ruangan" required>
                <?php foreach ($ruangan as $r): ?>
                <option value="<?= $r['id_ruangan'] ?>" <?= $r['id_ruangan'] == $b['id_ruangan'] ? 'selected' : '' ?>><?= htmlspecialchars($r['nama_ruangan']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Karyawan</label>
            <select name="id_karyawan" required>
                <?php foreach ($karyawan as $k): ?>
                <option value="<?= $k['id_karyawan'] ?>" <?= $k['id_karyawan'] == $b['id_karyawan'] ? 'selected' : '' ?>><?= htmlspecialchars($k['nama_karyawan']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group"><label>Tanggal</label><input type="date" name="tanggal" value="<?= $b['tanggal'] ?>" required></div>
        <div class="form-group"><label>Jam Mulai</label><input type="time" name="jam_mulai" value="<?= $b['jam_mulai'] ?>" required></div>
        <div class="form-group"><label>Jam Selesai</label><input type="time" name="jam_selesai" value="<?= $b['jam_selesai'] ?>" required></div>
        <div class="form-group"><label>Keperluan</label><textarea name="keperluan" rows="2"><?= htmlspecialchars($b['keperluan']) ?></textarea></div>
        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="aktif" <?= $b['status'] === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="selesai" <?= $b['status'] === 'selesai' ? 'selected' : '' ?>>Selesai</option>
                <option value="dibatalkan" <?= $b['status'] === 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn" style="background:#eee;color:#333">Batal</a>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>
