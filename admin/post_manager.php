<?php include('../config.php');?>
    <?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
    <?php include(ROOT_PATH . '/admin/includes/blog_functions.php'); ?>
    <?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
    <title>Admin ~ Post Manager | Reilly Thate</title>
</head>
<body>
    <header>
        <span class="logo logo-renegade"></span>
        <h1 id="admin_page_label"><a href="dashboard.php">Admin</a></h1>
    </header>
    <main>
    <?php $posts = getAllPosts(); ?>
        <!-- Middle form - to create and edit -->
        <section class="action">
            <h2>Create/Edit Tags</h2>
            <form method="post" action="<?php echo BASE_URL . 'admin/post_manager.php'; ?>">
				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>
                <!-- If editing post, the id is required to identify that post -->
                <?php if ($isEditingTag === true): ?>
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <?php endif ?>
                <input type="text" name="title" value="<?php echo $post_title;?>" placeholder="Post Title"> 
                <!-- If editing post, display the update button instead of the create button -->
                <?php if ($isEditingPost === true): ?>
                    <button type="submit" class="btn" name="update_post">Update Post Name</button>
                <?php else: ?>
                    <button type="submit" class="btn" name="create_post">Save Post</button>
                <?php endif ?>
            </form>
        </section>

        <!-- Display records from database -->
        <section id="posts">
            <?php if (empty($posts)): ?>
                <p class="message">No posts in the database.</p>
            <?php else: ?>
                <table class="posts">
                    <thead>
                        <th>#</th>
                        <th>Post</th>
                        <th>Edit/Delete</th>
                    </thead>
                    <tbody>
                        <?php foreach($posts as $key => $post): ?>
                            <tr>
                                <td class="indices"><?php echo $key + 1; ?></td>
                                <td class="names"><?php echo $post['title']; ?></td>
                                <td>
                                    <button onclick="window.location.href='post_manager.php?edit-post=<?php echo $post['id']?>'">Edit</button>
                                    <button onclick="window.location.href='post_manager.php?delete-post=<?php echo $post['id']?>'">Delete</button>
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