<?php if (session_status() != 0): ?>
<?php require_once('../config.php'); ?>
<?php endif ?>
<?php require_once(ROOT_PATH . '../includes/common_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/helper_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/blog_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/modules/head_module.php'); ?>
<?php 
	$thisPage = "blog_manager";
	generateHead("Blog Manager | Thate Admin", "The CMS for Reilly Thate's website.");
?>

    <body id="manager">
    <?php include('includes/modules/header_section.php'); ?>

        <main>
<?php $posts = getAllPosts(); ?>
            <section id="add_post" class="controller">
                <h2>
                    <?php if ($isEditingPost === true): ?>
                        Edit Post
                    <?php else: ?>
                        Create Post
                    <?php endif ?>
                </h2>
                <article>
<?php include(ROOT_PATH . '/includes/errors.php') ?>
                    <form method="post" action="<?php echo BASE_URL . 'admin/blog_manager.php'; ?>">
<?php if ($isEditingPost === true): ?>
                            <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
<?php endif ?>
                        <fieldset>
                            <legend>
<?php if ($isEditingPost === true): ?>
                                    Update Post in Database
<?php else: ?>
                                    Write a New Blog Post
<?php endif ?>
                            </legend>

                            <!-- Banner Selection -->
<?php generateSelectElement("banner", "Banner", "post_banner", $post_banner, getAllPictures(), 'id', 'name', $isEditingPost, 7); ?>

                            <label for="name">Post Title</label>
                            <input type="text" id="name" name="post_name" <?php if ($isEditingPost) : echo "value=\"" . $post_name . "\""; endif; ?>>

                            <label for="summary">Post Summary</label>
                            <textarea id="summary" name="post_summary" row="3" col="80"><?php if ($isEditingPost) : echo $post_summary; endif; ?></textarea>

                            <label for="body">Post Body</label>
                            <textarea id="body" name="post_body" row="20" col="80"><?php if ($isEditingPost) : echo $post_body; endif; ?></textarea>
                            <script src="../../ckeditor/ckeditor.js">
                            </script>
                            <script>
                                CKEDITOR.replace('body');
                            </script>

                            <div id="pub_container">
                                <input type="radio" id="published" name="post_published" value="1" <?php if($isEditingPost): ?><?php if($post_published == 1):echo "checked"; endif;?> <?php endif;?>><label for="published" id="label_published">Publish</label><br>
                                <input type="radio" id="unpublished" name="post_published" value="0" <?php if($isEditingPost): ?><?php if($post_published != 1):echo "checked"; endif;?> <?php endif;?>><label for="unpublished" id="label_published">Don't publish</label>
                            </div>
<?php if ($isEditingPost === true): ?>
                            <button type="submit" name="update_post">Update Post</button>
<?php else: ?>
                            <button type="submit" name="create_post">Create Post</button>
<?php endif ?>

                        </fieldset>
                    </form>
                </article>
            </section>

            <!-- Display records from database -->
            <section class="list-section rows">
                <h2>Blog Posts</h2>
                <?php if (empty($posts)): ?>
                    <p class="message">No posts in the database.</p>
                <?php else: ?>
                    <?php foreach ($posts as $key => $post): ?>
                        <article class="single">
                            
                            <figure>
                                <?php echo getBlogPostBanner($post['image']); ?>
                            </figure>
                            
                            <div class="single_details">
                                <h3><?php echo $post['name'];  ?></h3>
                                <p>
                                    <?php if (!isset($post['summary'])) : ?>
                                        ** No summary has been written for this blog post. **
                                    <?php else : ?>
                                        <?php echo $post['summary']; ?>
                                    <?php endif; ?>
                                </p>
                                <p<?php if ($post['published'] == 0) : ?> class="error">
                                *** Not published! ***<?php else: ?>>Published!<?php endif; ?>
                                </p>
                                <div class="edit_remove">
                                    <button onclick="window.location.href='blog_manager.php?edit-post=<?php echo $post['id']?>'">Edit</button>
                                    <button onclick="window.location.href='blog_manager.php?delete-post=<?php echo $post['id']?>'">Delete</button>
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