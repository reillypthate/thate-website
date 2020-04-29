<?php if (session_status() == 0): ?>
<?php include('../config.php');?>
<?php endif ?>
<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
    <title>Admin ~ Dashboard | Reilly Thate</title>
</head>
<body>
    <?php include('includes/header_section.php'); ?>
    <main class="manager">
        <section class="manager_preview">
            <h2>Blog Manager</h2>
            <table>
                <tr>
                    <td>Number of Blogs</td>
                    <td><?php echo getBlogCount(); ?></td>
                </tr>
                <tr>
                    <td>Number of Images</td>
                    <td><?php echo getMediaCount(); ?></td>
                </tr>
                <tr>
                    <td>Number of Categories</td>
                    <td><?php echo getCategoryCount(); ?></td>
                </tr>
                <tr>
                    <td>Number of Tags</td>
                    <td><?php echo getTagCount(); ?></td>
                </tr>
            </table>
            <div class="manager_control_center">
                <button onclick="window.location.href= 'blog_manager.php';"><h3>Manage Blog Posts</h3></button>
                <button onclick="window.location.href= 'media_manager.php';"><h3>Manage Media</h3></button>
                <button onclick="window.location.href= 'category_manager.php';"><h3>Manage Categories</h3></button>
                <button onclick="window.location.href= 'tag_manager.php';"><h3>Manage Tags</h3></button>
            </div>
        </section>
    </main>
    <footer>

    </footer>
</body>
</html>