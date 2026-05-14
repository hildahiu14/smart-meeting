<?php
require_once '../../config/database.php';
include '../../includes/header.php';
$karyawan = $pdo->query("SELECT * FROM karyawan ORDER BY nama_karyawan")->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="page-header">
    <h1>Data Karyawan</h1>
    <a href="tambah.php" class="btn btn-primary">+ Tambah Karyawan</a>
</div>
<div class="card">
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>
    <table>
        <thead><tr><th>No</th><th>Nama Karyawan</th><th>Divisi</th><th>Email</th><th>Aksi</th></tr></thead>
        <tbody>
        <?php foreach ($karyawan as $i => $k): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($k['nama_karyawan']) ?></td>
            <td><?= htmlspecialchars($k['divisi']) ?></td>
            <td><?= htmlspecialchars($k['email']) ?></td>
            <td>
                <a href="edit.php?id=<?= $k['id_karyawan'] ?>" class="btn btn-warning btn-sm">Edit</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include '../../includes/footer.php'; ?>
