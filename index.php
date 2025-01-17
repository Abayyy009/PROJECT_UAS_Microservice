<?php include 'header.php'; ?>

<!-- Jumbotron -->
<div class="bg-success text-white py-5">
    <div class="container py-5 ">
        <br>
        <br>
        <br>
        <br>
        <h1 class="display-4">
            Best products & <br />
            brands in our store
        </h1>
        <p class="lead">
            Trendy Products, Factory Prices, Excellent Service
        </p>
        <button type="button" class="btn btn-light btn-lg shadow-0 text-primary pt-2 border border-white">
            Learn more
        </button>
        <button type="button" class="btn btn-light btn-lg shadow-0 text-primary pt-2 border border-white">
            <span class="pt-1">Purchase now</span>
        </button>
    </div>
    <br>
    <br>
    <br>
    <br>
</div>

<br>
<br>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-custom text-center p-4">
                <div class="card-body">
                    <div class="card-icon text-primary">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h4 class="card-title">Desain Eksklusif</h4>
                    <p class="card-text">Laptop dengan desain yang elegan dan modern.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom text-center p-4">
                <div class="card-body">
                    <div class="card-icon text-warning">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h5 class="card-title">Mudah Dikustomisasi</h5>
                    <p class="card-text">Laptop yang mudah disesuaikan dengan kebutuhan Anda.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom text-center p-4">
                <div class="card-body">
                    <div class="card-icon text-purple">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="card-title">Keamanan Ekstrem</h4>
                    <p class="card-text">Keamanan data yang terjamin dengan teknologi terbaru.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom text-center p-4">
                <div class="card-body">
                    <div class="card-icon text-success">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4 class="card-title">Layanan 24 Jam</h4>
                    <p class="card-text-center">Layanan pelanggan tersedia 24 jam setiap hari.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">

        <style type="text/css">
            @media (max-width: 480px) {
                .col-xs-6.custom-width {
                    max-width: 50% !important;
                }

                .col-xs-6.custom-width img {
                    height: 150px !important;
                }
            }
        </style>

        <!-- row -->
        <div class="row">


            <!-- MAIN -->
            <div id="main" class="col-md-12">

                <?php
                if (isset($_GET['cari'])) {
                    echo "Hasil Pencarian : " . htmlspecialchars($_GET['cari']);
                }
                ?>

                <!-- STORE -->
                <div id="store">
                    <header class="mb-4">
                        <h2>Abayyy's Products</h2>
                    </header>
                    <br>
                    <!-- row -->
                    <div class="row">

                        <?php
                        $halaman = 12;
                        $page = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
                        $mulai = ($page > 1) ? ($page - 1) * $halaman : 0;

                        $dsn = 'mysql:host=localhost;dbname=project';
                        $username = 'root';
                        $password = '';

                        try {
                            $conn = new PDO($dsn, $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // Query utama untuk mengambil data produk
                            $query = "SELECT * FROM produk";

                            // Memproses urutan data berdasarkan harga atau default urutan berdasarkan ID
                            if (isset($_GET['urutan']) && $_GET['urutan'] == "harga") {
                                $query .= " ORDER BY produk_harga ASC";
                            } else {
                                $query .= " ORDER BY produk_id DESC";
                            }

                            // Memproses pencarian berdasarkan nama produk
                            if (isset($_GET['cari'])) {
                                $cari = '%' . $_GET['cari'] . '%';
                                $query .= " WHERE produk_nama LIKE :cari";
                            }

                            // Mengatur batasan hasil dengan limit dan offset
                            $query .= " LIMIT $mulai, $halaman";

                            // Menyiapkan dan menjalankan statement SQL
                            $stmt = $conn->prepare($query);

                            if (isset($cari)) {
                                $stmt->bindParam(':cari', $cari, PDO::PARAM_STR);
                            }

                            $stmt->execute();
                            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Menghitung total jumlah data untuk pagination
                            $stmtCount = $conn->prepare("SELECT COUNT(*) as total FROM produk");
                            $stmtCount->execute();
                            $total = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
                            $pages = ceil($total / $halaman);

                            // Menampilkan data produk
                            foreach ($data as $d) {
                                ?>
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="product product-single">
                                        <div class="product-thumb">
                                            <a href="produk_detail.php?id=<?php echo htmlspecialchars($d['produk_id']); ?>"
                                                class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</a>
                                            <?php if (empty($d['produk_foto1'])) { ?>
                                                <img src="gambar/sistem/produk.png"
                                                    style="height: 250px; width: 100%; object-fit: cover;">
                                            <?php } else { ?>
                                                <img src="gambar/produk/<?php echo htmlspecialchars($d['produk_foto1']); ?>"
                                                    style="height: 250px; width: 100%; object-fit: cover;">
                                            <?php } ?>
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-price">
                                                <?php echo "Rp. " . number_format($d['produk_harga']) . ",-"; ?>
                                                <?php if ($d['produk_jumlah'] == 0) { ?>
                                                    <del class="product-old-price">Kosong</del>
                                                <?php } ?>
                                            </h3>
                                            <h2 class="product-name"><a
                                                    href="produk_detail.php?id=<?php echo htmlspecialchars($d['produk_id']); ?>"><?php echo htmlspecialchars($d['produk_nama']); ?></a>
                                            </h2>
                                            <div class="product-btns text-center">
                                                <a class="btn btn-primary btn-lg" style="margin-bottom: 10px;"
                                                    href="checkout.php?id=<?php echo htmlspecialchars($d['produk_id']); ?>&jumlah=1&redirect=index">
                                                    <i class="fa fa-shopping-cart"></i> Pesan!!
                                                </a>
                                                <a class="btn btn-success btn-lg"
                                                    href="produk_detail.php?id=<?php echo htmlspecialchars($d['produk_id']); ?>">
                                                    <i class="fa fa-search"></i> Lihat
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } catch (PDOException $e) {
                            echo 'Koneksi gagal: ' . $e->getMessage();
                        }
                        ?>
                    </div>
                    <!-- /row -->

                    <!-- Pagination -->
                    <div class="store-filter clearfix">
                        <div class="pull-right">
                            <ul class="store-pages">
                                <li><span class="text-uppercase">Page:</span></li>
                                <?php for ($i = 1; $i <= $pages; $i++) { ?>
                                    <?php if ($page == $i) { ?>
                                        <li class="active"><?php echo $i; ?></li>
                                    <?php } else { ?>
                                        <li><a
                                                href="?halaman=<?php echo $i; ?><?php echo (isset($_GET['urutan']) && $_GET['urutan'] == 'harga') ? '&urutan=harga' : ''; ?><?php echo (isset($_GET['cari'])) ? '&cari=' . htmlspecialchars($_GET['cari']) : ''; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /Pagination -->

                    <?php
                    // Menampilkan pesan jika tidak ada produk yang ditemukan
                    if (empty($data)) {
                        echo '<center><h4>Belum ada produk.</h4></center>';
                    }
                    ?>
                </div>
                <!-- /STORE -->

            </div>
            <!-- /MAIN -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->

<?php include 'footer.php'; ?>