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


                    <?php
                    $queryAuthor = "SELECT * FROM authors";
                    $resAuthor = mysqli_query($conn, $queryAuthor);
                    $authors = mysqli_fetch_all($resAuthor, MYSQLI_ASSOC);

                    $queryPublisher = "SELECT * FROM publishers";
                    $resPublisher = mysqli_query($conn, $queryPublisher);
                    $publishers = mysqli_fetch_all($resPublisher, MYSQLI_ASSOC);

                    $queryYear = "SELECT * FROM publication_years";
                    $resYear = mysqli_query($conn, $queryYear);
                    $years = mysqli_fetch_all($resYear, MYSQLI_ASSOC);
                    ?>
                    <!-- Modal -->
                    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="<?php echo $base_url; ?>action/add/book.php">
                                    <div class=" modal-body">
                                        <div class="form-group mb-2">
                                            <label>Sampul</label>
                                            <input type="text" class="form-control" name="cover" placeholder="Sampul URL Gambar" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label>Judul Buku</label>
                                            <input type="text" class="form-control" name="title" placeholder="" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label>Deskripsi</label>
                                            <textarea type="text" class="form-control" name="description" placeholder="" rows="3" required></textarea>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label>Pengarang</label>
                                            <select type="select" class="form-select" name="author_id">
                                                <option value="" selected></option>
                                                <?php foreach ($authors as $author) : ?>
                                                    <option value="<?php echo $author['id']; ?>"><?php echo $author['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label>Penerbit</label>
                                            <select type="select" class="form-select" name="publisher_id">
                                                <option value="" selected></option>
                                                <?php foreach ($publishers as $publisher) : ?>
                                                    <option value="<?php echo $publisher['id']; ?>"><?php echo $publisher['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label>Tahun Terbit</label>
                                            <select type="select" class="form-select" name="publication_year_id">
                                                <option value="" selected></option>
                                                <?php foreach ($years as $year) : ?>
                                                    <option value="<?php echo $year['id']; ?>"><?php echo $year['year']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end Modal -->

                    <?php
                    $no = 1;
                    $query = "SELECT books.id, books.author_id, books.publisher_id, books.publication_year_id, books.title, books.slug, books.cover, books.description, authors.name 
                    FROM books 
                    LEFT JOIN authors ON books.author_id = authors.id";
                    $hasil = mysqli_query($conn, $query);
                    if ($hasil->num_rows > 0) :
                    ?>
                        <div class="table-responsive">
                            <table id="table" class="table table-striped dt-responsive  nowrap w-100">
                                <thead>

                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Sampul</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php while ($row = mysqli_fetch_assoc($hasil)) : ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td class="text-wrap"><?php echo $row['title']; ?></td>
                                            <td><img class="rounded me-2" width="100px" src="<?php echo $row['cover']; ?>"></td>
                                            <td class="deskripsi"><?php echo $row['description']; ?></td>
                                            <td>
                                                <a href="detail.php?slug=<?php echo $row['slug']; ?>" class="btn btn-success" title="Detail"><i class="fa fa-list"></i></a>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#edit<?php echo $row['id']; ?>" class="btn btn-warning" title="Edit"><i class="fa fa-pencil"></i></button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Data</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form method="POST" action="<?php echo $base_url; ?>action/update/book.php">
                                                                <div class="modal-body">
                                                                    <div class="form-group mb-2">
                                                                        <label>Sampul</label>
                                                                        <input type="text" class="form-control" name="cover" value="<?php echo $row['cover']; ?>" required>
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label>Judul Buku</label>
                                                                        <input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>" required>
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label>Deskripsi</label>
                                                                        <textarea type="text" class="form-control" name="description" rows="3" required><?php echo $row['description']; ?></textarea>
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label>Pengarang</label>
                                                                        <select type="select" class="form-select" name="author_id">
                                                                            <?php foreach ($authors as $author) : ?>
                                                                                <option value="<?php echo $author['id']; ?>" <?php echo $row['author_id'] == $author['id'] ? 'selected' : ''; ?>><?php echo $author['name']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label>Penerbit</label>
                                                                        <select type="select" class="form-select" name="publisher_id">
                                                                            <?php foreach ($publishers as $publisher) : ?>
                                                                                <option value="<?php echo $publisher['id']; ?>" <?php echo $row['publisher_id'] == $publisher['id'] ? 'selected' : ''; ?>><?php echo $publisher['name']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label>Tahun Terbit</label>
                                                                        <select type="select" class="form-select" name="publication_year_id">
                                                                            <?php foreach ($years as $year) : ?>
                                                                                <option value="<?php echo $year['id']; ?>" <?php echo $row['publication_year_id'] == $year['id'] ? 'selected' : ''; ?>><?php echo $year['year']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
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
                                                <form style="display: inline-block;" method="POST" action="<?php echo $base_url; ?>action/delete/book.php" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
<script>
    function updateData(data) {

    }
</script>

<?php require("../layouts/footer.php"); ?>