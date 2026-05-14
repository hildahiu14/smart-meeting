<?php
require_once 'config/database.php';
include 'includes/header.php';

// Hitung statistik
$totalRuangan = $pdo->query("SELECT COUNT(*) FROM ruangan")->fetchColumn();
$totalKaryawan = $pdo->query("SELECT COUNT(*) FROM karyawan")->fetchColumn();
$totalBooking  = $pdo->query("SELECT COUNT(*) FROM booking")->fetchColumn();
$bookingHariIni = $pdo->query("SELECT COUNT(*) FROM booking WHERE DATE(tanggal) = CURDATE()")->fetchColumn();
?>

<div class="page-header">
    <h1>Dashboard</h1>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <span class="label">Total Ruangan</span>
        <span class="value"><?= $totalRuangan ?></span>
    </div>
    <div class="stat-card">
        <span class="label">Total Karyawan</span>
        <span class="value"><?= $totalKaryawan ?></span>
    </div>
    <div class="stat-card">
        <span class="label">Total Booking</span>
        <span class="value"><?= $totalBooking ?></span>
    </div>
    <div class="stat-card">
        <span class="label">Booking Hari Ini</span>
        <span class="value"><?= $bookingHariIni ?></span>
    </div>
</div>

<div class="card">
    <h2>Booking Terbaru</h2>
    <table>
        <thead>
            <tr>
                <th>No</th><th>Ruangan</th><th>Karyawan</th><th>Divisi</th>
                <th>Tanggal</th><th>Jam Mulai</th><th>Jam Selesai</th><th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $stmt = $pdo->query("
            SELECT b.*, r.nama_ruangan, k.nama_karyawan, k.divisi
            FROM booking b
            JOIN ruangan r ON b.id_ruangan = r.id_ruangan
            JOIN karyawan k ON b.id_karyawan = k.id_karyawan
            ORDER BY b.tanggal DESC, b.jam_mulai DESC
            LIMIT 10
        ");
        $no = 1;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama_ruangan']) ?></td>
            <td><?= htmlspecialchars($row['nama_karyawan']) ?></td>
            <td><?= htmlspecialchars($row['divisi']) ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td><?= $row['jam_mulai'] ?></td>
            <td><?= $row['jam_selesai'] ?></td>
            <td>
                <span class="badge badge-<?= $row['status'] === 'aktif' ? 'success' : 'danger' ?>">
                    <?= ucfirst($row['status']) ?>
                </span>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
