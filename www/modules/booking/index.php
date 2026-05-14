<?php
require_once '../../config/database.php';
include '../../includes/header.php';

$stmt = $pdo->query("
    SELECT b.*, r.nama_ruangan, k.nama_karyawan, k.divisi
    FROM booking b
    JOIN ruangan r ON b.id_ruangan = r.id_ruangan
    JOIN karyawan k ON b.id_karyawan = k.id_karyawan
    ORDER BY b.tanggal DESC, b.jam_mulai DESC
");
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="page-header">
    <h1>Data Booking Ruang Meeting</h1>
    <a href="proses_tambah.php" class="btn btn-primary">+ Buat Booking</a>
</div>
<div class="card">
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>
    <?php if (isset($_GET['err'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['err']) ?></div>
    <?php endif; ?>
    <table>
        <thead>
            <tr><th>No</th><th>Ruangan</th><th>Karyawan</th><th>Divisi</th>
            <th>Tanggal</th><th>Jam Mulai</th><th>Jam Selesai</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        <?php foreach ($bookings as $i => $b): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($b['nama_ruangan']) ?></td>
            <td><?= htmlspecialchars($b['nama_karyawan']) ?></td>
            <td><?= htmlspecialchars($b['divisi']) ?></td>
            <td><?= $b['tanggal'] ?></td>
            <td><?= $b['jam_mulai'] ?></td>
            <td><?= $b['jam_selesai'] ?></td>
            <td><span class="badge badge-<?= $b['status'] === 'aktif' ? 'success' : 'danger' ?>"><?= ucfirst($b['status']) ?></span></td>
            <td>
                <a href="edit.php?id=<?= $b['id_booking'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="hapus.php?id=<?= $b['id_booking'] ?>" class="btn btn-danger btn-sm btn-hapus">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include '../../includes/footer.php'; ?>
