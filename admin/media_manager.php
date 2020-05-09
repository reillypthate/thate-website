<?php if (session_status() != 0): ?>
<?php require_once('../config.php'); ?>
<?php endif ?>
<?php require_once(ROOT_PATH . '../includes/common_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/helper_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/blog_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/modules/head_module.php'); ?>
<?php 
	$thisPage = "media_manager";
	generateHead("Media Manager | Thate Admin", "The CMS for Reilly Thate's website.");
?>
<body id="manager">
    <?php include('includes/modules/header_section.php'); ?>
    <main>
    <?php $pictures = getAllPictures(); ?>
        <section id="add_picture">
            <h2>
                <?php if ($isEditingMedia === true): ?>
                    Edit Media
                <?php else: ?>
                    Upload Media
                <?php endif ?>
            </h2>
            <article>
                <?php include(ROOT_PATH . '/includes/errors.php') ?>
                <form method="post" action="<?php echo BASE_URL . 'admin/media_manager.php'; ?>">
                    <?php if ($isEditingMedia === true): ?>
                        <input type="hidden" name="media_id" value="<?php echo $mediaId; ?>">
                    <?php endif ?>
                    <fieldset>
                        <legend>
                            <?php if ($isEditingMedia === true): ?>
                                Update Media in Database
                            <?php else: ?>
                                Add Media to Database
                            <?php endif ?>
                        </legend>
                        <label for="upload">Upload</label>
                        <input type="file" id="upload" name="media_path" <?php if ($isEditingMedia) : echo "value=\"" . $media_path . "\""; endif; ?>>
                        <label for="name">Media Title</label>
                        <input type="text" id="name" name="media_name" <?php if ($isEditingMedia) : echo "value=\"" . $media_name . "\""; endif; ?>>
                        <label for="alt">Alt Description</label>
                        <textarea id="alt" name="media_alt" row="3" col="50"><?php if ($isEditingMedia) : echo $media_alt; endif; ?></textarea>

                        <?php if ($isEditingMedia === true): ?>
                            <button type="submit" name="update_media">Update Media</button>
                        <?php else: ?>
                            <button type="submit" name="add_media">Add Media</button>
                        <?php endif ?>
                    </fieldset>
                </form>
            </article>
        </section>

        <!-- Display records from database -->
        <section id="pictures" class="rows list-section">
            <h2>Media</h2>
            <?php if (empty($pictures)): ?>
                <p class="message">No pictures in the database.</p>
            <?php else: ?>
                <?php foreach ($pictures as $key => $picture): ?>
                    <article class="single">
                        <figure>
                            <img src="<?php echo "../" . $picture['base_path'] ?>" alt="<?php echo $picture['alt']?>">
                        </figure>
                        <div class="single_details">
                            <h3><?php echo $picture['name'];  ?></h3>
                            <p><?php echo $picture['alt']; ?></p>
                            <div class="edit_remove">
                                <button onclick="window.location.href='media_manager.php?edit-media=<?php echo $picture['id']?>'">Edit</button>
                                <button onclick="window.location.href='media_manager.php?delete-media=<?php echo $picture['id']?>'">Delete</button>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif ?>
        </section>
       
    </main>
    <footer>

    </footer>
</body>
</html>