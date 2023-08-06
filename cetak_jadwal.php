<div class="card">
    <div class="card-header bg-primary text-white border-dark"><strong>Cetak Jadwal</strong></div>
        <div class="card-body">

        <!-- form memilih tanggal dan tombol proses -->
        <form action="preview.php" method="POST" target="_blank">
        <div class="form-group">
            <label for="">Tanggal</label>
            <input type="date" class="form-control" name="tgl_jadwal" required>
        </div>
            <input class="btn btn-primary mb-2" type="submit" name="print" value="Print">
        </form>

    </div>
</div>
