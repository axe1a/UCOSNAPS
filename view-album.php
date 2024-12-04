<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$album_id = $_GET['album_id'] ?? null;
if (!$album_id) {
    header("Location: albums.php");
    exit();
}

$album = getAlbumById($pdo, $album_id);
$photos = getPhotosByAlbum($pdo, $album_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($album['album_name']) ?></title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="insertPhotoForm" style="display: flex; justify-content: center;">
        

        <!-- Photo Upload Form for this Album -->
        <form method="POST" action="core/handleForms.php" enctype="multipart/form-data">
            <h2><?= htmlspecialchars($album['album_name']) ?></h2>
            <p><?= htmlspecialchars($album['description'] ?? '') ?></p>    
            <input type="hidden" name="album_id" value="<?= $album_id ?>">
            <p>
                <input type="file" name="image" id="image">
            </p>
            <button type="submit" name="insertPhotoBtn">Add Photo to Album</button>
        </form>

        <!-- Photos Grid -->
        <div class="photoContainer" style="background-color: ghostwhite; border-style: solid; border-color: gray;width: 25%;">
            <?php foreach($photos as $row): ?>
                <div class="photo">
                <img src="images/<?php echo $row['photo_name']; ?>" alt="" style="width: 100%;">
                <h3 style="margin-left: 20px;"><?php echo $row['description'] ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>