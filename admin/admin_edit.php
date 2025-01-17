<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Admin
        <small>Edit Admin</small>
      </h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Home</a></div>
        <div class="breadcrumb-item active">Admin</div>
        <div class="breadcrumb-item active">Edit Admin</div>
      </div>
    </div>
    <div class="content-wrapper">

      <section class="content">
        <div class="row">
          <section class="col-lg-6 col-lg-offset-3">
            <div class="box box-info">

              <div class="box-header">
                <h3 class="box-title">Edit Admin</h3>
                <a href="admin.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp;
                  Kembali</a>
              </div>
              <div class="box-body">
                <form action="admin_update.php" method="post" enctype="multipart/form-data">
                  <?php
                  $id = $_GET['id'];
                  $stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id = :id");
                  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                  $stmt->execute();
                  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($data as $d) {
                    ?>

                    <div class="form-group">
                      <label>Nama</label>
                      <input type="text" class="form-control" name="nama" value="<?php echo $d['admin_nama'] ?>"
                        required="required">
                      <input type="hidden" class="form-control" name="id" value="<?php echo $d['admin_id'] ?>"
                        required="required">
                    </div>

                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" name="username" value="<?php echo $d['admin_username'] ?>"
                        required="required">
                    </div>

                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" name="password" min="5"
                        placeholder="Kosong Jika tidak ingin di ganti">
                      <small class="text-muted">Kosongkan Jika tidak ingin di ganti</small>
                    </div>

                    <div class="form-group">
                      <label>Foto</label>
                      <input type="file" name="foto">
                      <small class="text-muted">Kosong Jika tidak ingin di ganti</small>
                    </div>

                    <div class="form-group">
                      <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                    </div>
                    <?php
                  }
                  ?>

                </form>
              </div>

            </div>
          </section>
        </div>
      </section>

    </div>
    <?php include 'footer.php'; ?>