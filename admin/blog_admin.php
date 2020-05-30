<?php if (session_status() != 0): ?>
<?php require_once('../config.php'); ?>
<?php endif ?>
<?php require_once(ROOT_PATH . '../includes/common_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/helper_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/blog_admin_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/modules/head_module.php'); ?>
<?php 
	$thisPage = "blog_admin";
	generateHead("Blog Manager | Thate Admin", "The CMS for Reilly Thate's website.");
?>

    <body id="manager">
    <?php include('includes/modules/header_section.php'); ?>
        <main>
            <section id="blog_manager" class="collapsible_section">
                <h2>
                    <button aria-expanded="false" class="collapsible" onclick="update()">
                        Blog Manager
                        <svg aria-hidden="true" focusable="false" viewBox="0 0 10 10">  
                            <rect class="vert" height="8" width="2" y="1" x="4"/>
                            <rect height="2" width="8" y="4" x="1"/>
                        </svg> 
                    </button>
                </h2>
                <div class="collapsible_div" hidden>
                    <p>Test 1</p>
                    <p>Test 2</p>
                    <p>Test 3</p>
                </div>
            </section>
<?php $posts=getAllPosts(); ?>
            <section id="post_manager" class="collapsible_section">
                <h2>
                    <button aria-expanded="true" class="collapsible" onclick="update()">
                        Post Manager
                        <svg aria-hidden="true" focusable="false" viewBox="0 0 10 10">  
                            <rect class="vert" height="8" width="2" y="1" x="4"/>
                            <rect height="2" width="8" y="4" x="1"/>
                        </svg> 
                    </button>
                </h2>
                <div class="collapsible_div">
                    <form method="post" action="<?php echo BASE_URL. 'admin/blog_admin.php'; ?>">
<?php if ($isEditingPost === true) : ?>
                        <!-- Store `post_id` in a hidden input element -->
                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
<?php endif; ?>
                        <fieldset>
                            <legend>
<?php if ($isEditingPost === true) : ?>
                                Update Post in Database
<?php else : ?>
                                Create a New Post
<?php endif; ?>
                            </legend>
                            
                            <!-- Banner Selection -->
<?php generateSelectElement("post_image", "Banner", "post_image", $post_image, getAllPictures(), 'id', 'name', $isEditingPost, 7); ?>

                            <label for="post_name">Post Name</label>
                            <input type="text" id="post_name" name="post_name" <?php if($isEditingPost) echo "value=\"" . $post_name . "\""; ?>>

                            <label for="post_summary">Post Summary</label>
                            <textarea id="post_summary" name="post_summary" row="4" col="80"><?php if($isEditingPost) echo $post_summary; ?></textarea>

                            <label for="post_body">Post Body</label>
                            <textarea id="post_body" name="post_body" row="20" col="80"><?php if($isEditingPost) echo $post_body; ?></textarea>

                            <div class="radio_container">
                                <input type="radio" id="post_published" name="post_published" value="1" <?php if($isEditingPost) {if($post_published === 1) echo "checked";}?>>
                                <label for="post_published">Publish</label>
                                <input type="radio" id="post_unpublished" name="post_published" value="0" <?php if($isEditingPost){ if($post_published === 0) echo "checked";} else echo "checked ";?>>
                                <label for="post_unpublished">Don't Publish</label>
                            </div>

<?php if ($isEditingPost === true) : ?>
                            <button type="submit" name="update_post">Update Post</button>
                            <button type="submit" name="delete_post"><em>Delete Post</em></button>
<?php else : ?>
                            <button type="submit" name="create_post">Create Post</button>
<?php endif; ?>
                            <button type="cancel" name="cancel_post">Cancel</button>
                        </fieldset>
                    </form>
<?php if ($isEditingPost === true) : ?>
<?php $post = getPostById($post_id); ?>
                    <!-- Blog Preview -->
                    <article id="blog_preview">
                    	<!-- Place the banner image above the blog, if it exists. -->
<?php if (isset($post['image'])): ?>
                        <figure class="blog_banner">
                            <?php echo getPostImg($post['image']) . "\r\n"; ?>
                        </figure>
<?php endif ?>
                        <p class="date_published">
                            <?php echo date_format(date_create($post['created_at']), "M d, Y") . "\r\n"; ?>
                        </p>
                        <h2 class="trick-highlight"><?php echo $post['name']; ?></h2>
                        <article class="post_content">
                            <?php echo html_entity_decode($post['body']); ?>
                        </article>
                        <div class="post_closer">
                            <figure>
                                <img src="../media/images/reilly_thumbnail.jpg" alt="Reilly Thate">
                            </figure>
                            <p>
                                Posted by <?php echo getPostAuthor($post['author_id']); ?> on <?php echo date_format(date_create($post['created_at']), "F d, Y"); ?> at around <?php echo date_format(date_create($post['created_at']), "g a"); ?>.
                            </p>
                        </div>
                    </article>
<?php endif; ?>
                    <article>
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" id="t_key">#</th>
                                    <th scope="col" id="t_name">Name</th>
                                    <th scope="col" id="t_description">Summary</th>
                                    <th scope="col" id="t_published">Published</th>
                                    <th scope="col" id="t_edit">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
<?php if (empty($posts)) : ?>
                                <tr>
                                    <td colspan="5">No posts in the database.</td>
                                </tr>
<?php else : ?>
<?php foreach($posts as $key => $post) : ?>
                                <tr>
                                    <th headers="t_key">
                                        <?php echo $key; ?>
                                    </th>
                                    <td headers="t_name">
                                        <?php echo $post['name']; ?>
                                    </td>
                                    <td headers="t_description">
                                        <?php echo $post['summary']; ?>
                                    </td>
                                    <td headers="t_published">
                                        <?php
                                            if($post['published'] == 0)
                                                echo "<em>No</em>";
                                            else
                                                echo "Yes";
                                        ?>
                                    </td>
                                    <td headers="t_edit">
                                        <button onclick="window.location.href='blog_admin.php?edit-post=<?php echo $post['id']?>#post_manager'">Edit</button>
                                    </td>
                                </tr>
<?php endforeach; ?>
<?php endif; ?>
                            </tbody>
                        </table>
                    </article>
                </div>
            </section>
            <script type="text/javascript">
                update();
                function update()
                {
                    const headings = document.querySelectorAll('h2');

                    Array.prototype.forEach.call(headings, h => 
                    {
                        let btn = h.querySelector('button');
                        let target = h.nextElementSibling;

                        btn.onclick = () => {
                            let expanded = btn.getAttribute('aria-expanded') === 'true';

                            btn.setAttribute('aria-expanded', !expanded);
                            target.hidden = expanded;
                        }
                    });
                }
            </script>       
    </main>
    <footer>

    </footer>
</body>
</html>