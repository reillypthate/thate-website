<?php include('../config.php');?>
    <?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
    <?php include(ROOT_PATH . '/admin/includes/blog_functions.php'); ?>
    <?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
    <title>Admin ~ Tag Manager | Reilly Thate</title>
</head>
<body>
    <header>
        <span class="logo logo-renegade"></span>
        <h1 id="admin_page_label"><a href="dashboard.php">Admin</a></h1>
    </header>
    <main>
    <?php $tags = getAllTags(); ?>
        <!-- Middle form - to create and edit -->
        <section class="action">
            <h2>Create/Edit Tags</h2>
            <form method="post" action="<?php echo BASE_URL . 'admin/tag_manager.php'; ?>">
				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>
                <!-- If editing tag, the id is required to identify that tag -->
                <?php if ($isEditingTag === true): ?>
                    <input type="hidden" name="tag_id" value="<?php echo $tag_id; ?>">
                <?php endif ?>
                <input type="text" name="tag_name" value="<?php echo $tag_name;?>" placeholder="Tag Name"> 
                <!-- If editing tag, display the update button instead of the create button -->
                <?php if ($isEditingTag === true): ?>
                    <button type="submit" class="btn" name="update_tag">Update Tag Name</button>
                <?php else: ?>
                    <button type="submit" class="btn" name="create_tag">Save Tag</button>
                <?php endif ?>
            </form>
        </section>

        <!-- Display records from database -->
        <section id="tags">
            <?php if (empty($tags)): ?>
                <p class="message">No tags in the database.</p>
            <?php else: ?>
                <table class="tags">
                    <thead>
                        <th>#</th>
                        <th>Tag</th>
                        <th>Edit/Delete</th>
                    </thead>
                    <tbody>
                        <?php foreach($tags as $key => $tag): ?>
                            <tr>
                                <td class="indices"><?php echo $key + 1; ?></td>
                                <td class="names"><?php echo $tag['title']; ?></td>
                                <td>
                                    <button onclick="window.location.href='tag_manager.php?edit-tag=<?php echo $tag['id']?>'">Edit</button>
                                    <button onclick="window.location.href='tag_manager.php?delete-tag=<?php echo $tag['id']?>'">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php endif ?>
        </section>
       
    </main>
    <footer>

    </footer>
</body>
</html>