<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$albums = getAllAlbums($pdo, $_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Albums</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="insertPhotoForm" style="display: flex; justify-content: center;">
        
        
        <!-- Create Album Form -->
        <form method="POST" action="core/handleForms.php" enctype="multipart/form-data">
        <h2>Create New Album</h2>
            <p>
				<label for="#">Album Name</label>
				<input type="text" name="album_name" placeholder="Album Name" required><br><br>
			</p>
            <p>
                <label for="#">Description</label>
                <input type="text" name="photoDescription" placeholder="Description"><br><br>
            </p>
            <p>
                <button type="submit" name="createAlbumBtn">Create Album</button>
            </p>
        </form>
    </div>    
    
        <!-- Albums List -->
        <div class="insertPhotoForm" style="display: grid; justify-content: center;">
        <h2>My Albums</h2>     
        <?php foreach($albums as $album): ?>
                
                <div class="insertPhotoForm"><br>
                                     
                    <!-- Edit Album Form -->
                    <form method="POST" action="core/handleForms.php">
                        <input type="hidden" name="album_id" value="<?= $album_id ?>">
                        <p>
                            <label for="#">Album Name</label>
                            <input type="text" name="album_name" value="<?= htmlspecialchars($album['album_name']) ?>">
                        </p>
                        <p>
                            <label for="#">Description</label>
                            <input type="text" name="photoDescription" placeholder="Description"><br><br>
                        </p>
                        <p>
                        <input type="hidden" name="album_id" value="<?= $album_id ?>">  
                        <button type="submit" name="updateAlbumBtn">Update</button>
                        <button type="submit" name="deleteAlbumBtn" onclick="return confirm('Are you sure you want to delete this album?')">Delete</button>
                    
                        </p>
                    </form>

                    <a href="view-album.php?album_id=<?= $album['album_id'] ?>">View Album</a>
                </div>
            <?php endforeach; ?><br><br><br><br>
        </div>

        
    
</body>
</html>