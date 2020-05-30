<?php if (session_status() == 0): ?>
<?php require_once('config.php'); ?>
<?php endif ?>
<?php require_once(ROOT_PATH . '../includes/common_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/helper_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/modules/head_module.php'); ?>
<?php 
	$thisPage = "dashboard";
	generateHead("Dashboard | Thate Admin", "The CMS for Reilly Thate's website.");
?>

    <body>
    <?php include('includes/modules/header_section.php'); ?>
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
            </table>
            <div class="manager_control_center">
                <button onclick="window.location.href= 'blog_manager.php';"><h3>Manage Blog Posts</h3></button>
                <button onclick="window.location.href= 'media_manager.php';"><h3>Manage Media</h3></button>
            </div>
        </section>
    </main>
    <footer>

    </footer>
</body>
</html>