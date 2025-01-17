<?php include 'header.php'; ?>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Admin
        <small>Data Admin</small>
      </h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Home</a></div>
        <div class="breadcrumb-item active">Admin</div>
      </div>
    </div>
    <div class="content-wrapper">

      <section class="content">
        <div class="row">
          <section class="col-lg-10 col-lg-offset-1">
            <div class="box box-info">

              <div class="box-header">
                <h3 class="box-title">Admin</h3>
                <a href="admin_tambah.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i> &nbsp
                  Tambah
                  Admin Baru</a>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped" id="table-datatable">
                    <thead>
                      <tr>
                        <th width="1%">NO</th>
                        <th>NAMA</th>
                        <th>USERNAME</th>
                        <th width="15%">FOTO</th>
                        <th width="10%">OPSI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include '../koneksi.php';
                      $no = 1;
                      $stmt = $conn->prepare("SELECT * FROM admin");
                      $stmt->execute();
                      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($data as $d) {
                        ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo htmlspecialchars($d['admin_nama']); ?></td>
                          <td><?php echo htmlspecialchars($d['admin_username']); ?></td>
                          <td>
                            <center>
                              <?php if (empty($d['admin_foto'])) { ?>
                                <img src="../gambar/sistem/user.png" style="width: 40px;height: auto">
                              <?php } else { ?>
                                <img src="../gambar/user/<?php echo htmlspecialchars($d['admin_foto']); ?>"
                                  style="width: 40px;height: auto">
                              <?php } ?>
                            </center>
                          </td>
                          <td>
                            <a class="btn btn-warning btn-sm" href="admin_edit.php?id=<?php echo $d['admin_id']; ?>"><i
                                class="fa fa-cog"></i></a>
                            <?php if ($d['admin_id'] != 1) { ?>
                              <a class="btn btn-danger btn-sm" href="admin_hapus.php?id=<?php echo $d['admin_id']; ?>"><i
                                  class="fa fa-trash"></i></a>
                            <?php } ?>
                          </td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
          </section>
        </div>
      </section>

    </div>
    <?php include 'footer.php'; ?>