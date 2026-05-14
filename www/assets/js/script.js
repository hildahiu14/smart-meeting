// Smart Meeting — Main Script

// Konfirmasi hapus
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-hapus').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            if (!confirm('Yakin ingin menghapus data ini?')) {
                e.preventDefault();
            }
        });
    });
});
