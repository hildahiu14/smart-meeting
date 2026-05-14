<?php
require_once '../../config/database.php';
include '../../includes/header.php';

$ruangan = $pdo->query("SELECT * FROM ruangan ORDER BY nama_ruangan")->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="page-header">
    <h1>Data Ruangan</h1>
    <a href="tambah.php" class="btn btn-primary">+ Tambah Ruangan</a>
</div>
<div class="card">
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>
    <table>
        <thead><tr><th>No</th><th>Nama Ruangan</th><th>Kapasitas</th><th>Fasilitas</th><th>Aksi</th></tr></thead>
        <tbody>
        <?php foreach ($ruangan as $i => $r): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($r['nama_ruangan']) ?></td>
            <td><?= $r['kapasitas'] ?> orang</td>
            <td><?= htmlspecialchars($r['fasilitas']) ?></td>
            <td>
                <a href="edit.php?id=<?= $r['id_ruangan'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="hapus.php?id=<?= $r['id_ruangan'] ?>" class="btn btn-danger btn-sm btn-hapus">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include '../../includes/footer.php'; ?>
