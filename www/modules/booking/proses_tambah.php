<?php
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cek konflik jadwal
    $cek = $pdo->prepare("
        SELECT COUNT(*) FROM booking
        WHERE id_ruangan = ?
          AND tanggal = ?
          AND status = 'aktif'
          AND (
            (jam_mulai < ? AND jam_selesai > ?)
          )
    ");
    $cek->execute([
        $_POST['id_ruangan'],
        $_POST['tanggal'],
        $_POST['jam_selesai'],
        $_POST['jam_mulai']
    ]);
    if ($cek->fetchColumn() > 0) {
        header("Location: index.php?err=Ruangan sudah dibooking pada waktu tersebut");
        exit;
    }
    $stmt = $pdo->prepare("INSERT INTO booking (id_ruangan, id_karyawan, tanggal, jam_mulai, jam_selesai, keperluan, status) VALUES (?, ?, ?, ?, ?, ?, 'aktif')");
    $stmt->execute([
        $_POST['id_ruangan'], $_POST['id_karyawan'],
        $_POST['tanggal'], $_POST['jam_mulai'],
        $_POST['jam_selesai'], $_POST['keperluan']
    ]);
    header("Location: index.php?msg=Booking berhasil dibuat");
    exit;
}

$ruangan  = $pdo->query("SELECT * FROM ruangan ORDER BY nama_ruangan")->fetchAll(PDO::FETCH_ASSOC);
$karyawan = $pdo->query("SELECT * FROM karyawan ORDER BY nama_karyawan")->fetchAll(PDO::FETCH_ASSOC);
include '../../includes/header.php';
?>
<div class="page-header"><h1>Buat Booking Ruang Meeting</h1></div>
<div class="card" style="max-width:540px">
    <form method="POST">
        <div class="form-group">
            <label>Ruangan</label>
            <select name="id_ruangan" required>
                <option value="">-- Pilih Ruangan --</option>
                <?php foreach ($ruangan as $r): ?>
                <option value="<?= $r['id_ruangan'] ?>"><?= htmlspecialchars($r['nama_ruangan']) ?> (<?= $r['kapasitas'] ?> org)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Karyawan / Peminjam</label>
            <select name="id_karyawan" required>
                <option value="">-- Pilih Karyawan --</option>
                <?php foreach ($karyawan as $k): ?>
                <option value="<?= $k['id_karyawan'] ?>"><?= htmlspecialchars($k['nama_karyawan']) ?> — <?= htmlspecialchars($k['divisi']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group"><label>Tanggal</label><input type="date" name="tanggal" required></div>
        <div class="form-group"><label>Jam Mulai</label><input type="time" name="jam_mulai" required></div>
        <div class="form-group"><label>Jam Selesai</label><input type="time" name="jam_selesai" required></div>
        <div class="form-group"><label>Keperluan</label><textarea name="keperluan" rows="2"></textarea></div>
        <button type="submit" class="btn btn-primary">Booking Sekarang</button>
        <a href="index.php" class="btn" style="background:#eee;color:#333">Batal</a>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>
