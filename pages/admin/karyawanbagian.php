<?php
$database = new Database;
$db = $database->getConnection();

if (isset($_GET['id'])) {
    $findsql = "SELECT * FROM karyawan where id=?";
    $stmt = $db->prepare($findsql);
    $stmt->bindParam(1, $_GET['id']);
    $stmt->execute();
    $row = $stmt->fetch();
    if (isset($row['id'])) {
    } else {
        echo '<meta http-equiv="refresh" content="0;url=?page=karyawanread"/>';
    }
} else {
    echo '<meta http-equiv="refresh" content="0;url=?page=karyawanread"/>';
}

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Karyawan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                    <li class="breadcrumb-item">Karyawan</li>
                    <li class="breadcrumb-item">Riwayat Bagian</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Riwayat Bagian</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nik">Nomor Induk Karyawan</label>
                        <input type="text" name="nik" class="form-control" value="<?= $row['nik'] ?>" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nohp">Handphone</label>
                        <input type="text" name="nohp" class="form-control" onkeypress="return (event.charCode > 47 && event.charCode <58) || event.charCode == 46" maxlength="14" value="<?= $row['handphone'] ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="<?= $row['nama_lengkap'] ?>" disabled>
            </div>
            <form action="" method="post">
                <input type="hidden" name="karyawan_id" value="<?= $_GET['id'] ?>">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="bagian_id">Bagian</label>
                            <select name="bagian_id" class="form-control" required>
                                <option value="">--Pilih Bagian--</option>
                                <?php

                                $selectsql = 'SELECT * FROM bagian';
                                $stmtb = $db->prepare($selectsql);
                                $stmtb->execute();
                                while ($rowb = $stmtb->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=\"" . $rowb['id'] . "\">" . $rowb['nama_bagian'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="button_edit" class="btn btn-success btn-block float-right mb-3">
                        <i class="fa fa-save"> Simpan</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->