<?php include('../config.php');?>
    <?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
    <?php include(ROOT_PATH . '/admin/includes/blog_functions.php'); ?>
    <?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
    <title>Admin ~ Category Manager | Reilly Thate</title>
</head>
<body>
    <header>
        <span class="logo logo-renegade"></span>
        <h1 id="admin_page_label"><a href="dashboard.php">Admin</a></h1>
    </header>
    <main>
    <?php $categories = getAllCategories(); ?>
        <!-- Middle form - to create and edit -->
        <section class="action">
            <h2>Create/Edit Categories</h2>
            <form method="post" action="<?php echo BASE_URL . 'admin/category_manager.php'; ?>">
				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>
                <!-- If editing topic, the id is required to identify that topic -->
                <?php if ($isEditingCategory === true): ?>
                    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                <?php endif ?>
                <input type="text" name="category_name" value="<?php echo $category_name;?>" placeholder="Category Name"> 
                <!-- If editing topic, display the update button instead of the create button -->
                <?php if ($isEditingCategory === true): ?>
                    <button type="submit" class="btn" name="update_category">Update Category Name</button>
                <?php else: ?>
                    <button type="submit" class="btn" name="create_category">Save Category</button>
                <?php endif ?>
            </form>
        </section>

        <!-- Display records from database -->
        <section id="categories">
            <?php if (empty($categories)): ?>
                <p class="message">No categories in the database.</p>
            <?php else: ?>
                <table class="categories">
                    <thead>
                        <th>#</th>
                        <th>Category</th>
                        <th>Edit/Delete</th>
                    </thead>
                    <tbody>
                        <?php foreach($categories as $key => $category): ?>
                            <tr>
                                <td class="indices"><?php echo $key + 1; ?></td>
                                <td class="names"><?php echo $category['title']; ?></td>
                                <td>
                                    <button onclick="window.location.href='category_manager.php?edit-category=<?php echo $category['id']?>'">Edit</button>
                                    <button onclick="window.location.href='category_manager.php?delete-category=<?php echo $category['id']?>'">Delete</button>
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