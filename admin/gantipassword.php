<?php include 'header.php'; ?>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Ganti Password
        <small>Ganti Password</small>
      </h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Home</a></div>
        <div class="breadcrumb-item active">Ganti Password</div>
      </div>
    </div>
    <div class="content-wrapper">
      <section class="content">
        <div class="row">
          <section class="col-lg-5">

            <?php
            if (isset($_GET['alert'])) {
              if ($_GET['alert'] == "sukses") {
                echo "<div class='alert alert-success'>Password anda berhasil diganti!</div>";
              }
            }
            ?>

            <div class="box box-info">

              <div class="box-header">
                <h3 class="box-title">Ganti Password</h3>
              </div>
              <div class="box-body">
                <form action="gantipassword_act.php" method="post">
                  <div class="form-group">
                    <label>Masukkan Password Baru</label>
                    <input type="password" class="form-control" placeholder="Masukkan Password Baru .." name="password"
                      required="required" min="5">
                  </div>
                  <div class="form-group">
                    <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                  </div>
                </form>
              </div>

            </div>
          </section>
        </div>
      </section>

    </div>
    <?php include 'footer.php'; ?>