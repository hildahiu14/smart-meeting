<?php
require_once 'config/database.php';
include 'includes/header.php';

// Ruangan paling sering digunakan
$topRuangan = $pdo->query("
    SELECT r.nama_ruangan, COUNT(b.id_booking) AS total
    FROM booking b
    JOIN ruangan r ON b.id_ruangan = r.id_ruangan
    WHERE b.status = 'aktif'
    GROUP BY r.id_ruangan
    ORDER BY total DESC
    LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);

// Divisi paling aktif
$topDivisi = $pdo->query("
    SELECT k.divisi, COUNT(b.id_booking) AS total
    FROM booking b
    JOIN karyawan k ON b.id_karyawan = k.id_karyawan
    GROUP BY k.divisi
    ORDER BY total DESC
    LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="page-header"><h1>Laporan & Logs</h1></div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:20px">
    <div class="card">
        <h2>Ruangan Paling Sering Digunakan</h2>
        <table>
            <thead><tr><th>Ruangan</th><th>Total Booking</th></tr></thead>
            <tbody>
            <?php foreach ($topRuangan as $r): ?>
            <tr>
                <td><?= htmlspecialchars($r['nama_ruangan']) ?></td>
                <td><strong><?= $r['total'] ?></strong></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="card">
        <h2>Divisi Paling Aktif</h2>
        <table>
            <thead><tr><th>Divisi</th><th>Total Booking</th></tr></thead>
            <tbody>
            <?php foreach ($topDivisi as $d): ?>
            <tr>
                <td><?= htmlspecialchars($d['divisi']) ?></td>
                <td><strong><?= $d['total'] ?></strong></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
