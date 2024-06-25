<?php
require("../layouts/header.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (!isset($_GET['slug'])) {
    header("Location: index.php");
}

$slug = htmlspecialchars($_GET['slug']);

?>

<div class="container mt-5 mb-5">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <?php
                        $query = "SELECT books.id, books.cover, books.title, books.description, 
                        authors.name AS author_name, publishers.name AS publisher_name, publication_years.year
                        FROM books
                        LEFT JOIN authors ON books.author_id = authors.id
                        LEFT JOIN publishers ON books.publisher_id = publishers.id
                        LEFT JOIN publication_years ON books.publication_year_id = publication_years.id
                        WHERE books.slug = '$slug' ";
                        $result = mysqli_query($conn, $query);

                        if ($result->num_rows > 0) : ?>

                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <div class="col-lg-2">
                                    <img src="<?php echo $row['cover']; ?>" class="rounded me-2" style="width: 150px; height: 220px; object-fit: center;" alt="zpedia">

                                </div>
                                <div class="col-lg-8 mt-2">
                                    <h5 class="card-title">
                                        <?php echo $row['title']; ?>
                                    </h5>
                                    <p class="card-text" style="text-align: justify;">
                                        <?php echo $row['description']; ?>

                                    </p>

                                    <p class="card-text"><small class="text-muted"><b>Pengarang : </b>
                                            <?php echo $row['author_name'] ?? '-'; ?><br>
                                            <b>Penerbit/Thn Terbit : </b>
                                            <?php echo $row['publisher_name'] ?? '-'; ?>/<?php echo $row['year']; ?>
                                        </small></p>

                                    <a class="text-decoration-none" href="<?php echo $base_url; ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<?php require("../layouts/footer.php"); ?>