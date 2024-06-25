<?php
require("../layouts/header.php");
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

?>


<div class="container container-md mt-5 mb-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?php if (isset($_SESSION)) : ?>
                        <?php if ($_SESSION['add_success']) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Berhasil tambah data
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php unset($_SESSION['add_success']); ?>
                        <?php endif ?>
                        <?php if ($_SESSION['update_success']) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Berhasil update data
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php unset($_SESSION['update_success']); ?>

                        <?php endif ?>
                        <?php if ($_SESSION['delete_success']) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Berhasil hapus data
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php unset($_SESSION['delete_success']); ?>
                        <?php endif ?>
                    <?php endif ?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambah">
                        Tambah Data
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="<?php echo $base_url; ?>action/add/publication_year.php">
                                    <div class=" modal-body">
                                        <div class="form-group mb-2">
                                            <label>Tahun Terbit</label>
                                            <input type="text" class="form-control" name="year" placeholder="Ex: 2023" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end Modal -->

                    <?php
                    $no = 1;
                    $query = "SELECT * FROM publication_years";
                    $hasil = mysqli_query($conn, $query);
                    if ($hasil->num_rows > 0) :
                    ?>
                        <div class="table-responsive">
                            <table id="ex" class="table table-striped dt-responsive  nowrap w-100">
                                <thead>

                                    <tr>
                                        <th>No</th>
                                        <th>Tahun</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php while ($row = mysqli_fetch_assoc($hasil)) : ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $row['year']; ?></td>
                                            <td>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#edit<?php echo $row['id']; ?>" class="btn btn-warning" title="Edit"><i class="fa fa-pencil"></i></button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Data</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form method="POST" action="<?php echo $base_url; ?>action/update/publication_year.php">
                                                                <div class=" modal-body">
                                                                    <div class="form-group mb-2">
                                                                        <label>Tahun Terbit</label>
                                                                        <input type="text" class="form-control" name="year" value="<?php echo $row['year']; ?>" required>
                                                                    </div>
                                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end Modal -->
                                                <form style="display: inline-block;" method="POST" action="<?php echo $base_url; ?>action/delete/publication_year.php" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <button class="btn btn-danger" type="submit" title="Delete"><i class="fa fa-trash"></i></button>

                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>

                            </table>
                        </div>

                    <?php else : ?>
                        <h1>Tidak ada data</h1>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require("../layouts/footer.php"); ?>