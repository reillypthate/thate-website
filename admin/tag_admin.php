<?php if (session_status() != 0): ?>
<?php require_once('../config.php'); ?>
<?php endif ?>
<?php require_once(ROOT_PATH . '../includes/common_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/helper_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/modules/head_module.php'); ?>
<?php 
	$thisPage = "tag_admin";
	generateHead("Tag Manager | Thate Admin", "The CMS for Reilly Thate's website.");
?>

    <body id="manager">
    <?php include('includes/modules/header_section.php'); ?>

        <main>
<?php $tags = getAllTags(); ?>
            <section id="add_tag" class="controller">
                <h2>
<?php if ($isEditingTag === true): ?>
                    Edit Tag
<?php else: ?>
                    Create Tag
<?php endif ?>
                </h2>
                <article>
<?php include(ROOT_PATH . '/includes/errors.php') ?>
                    <form method="post" action="<?php echo BASE_URL . 'admin/tag_admin.php'; ?>">
<?php if ($isEditingTag === true): ?>
                            <input type="hidden" name="tag_id" value="<?php echo $tag_id; ?>">
<?php endif ?>
                        <fieldset>
                            <legend>
<?php if ($isEditingTag === true): ?>
                                Update Tag in Database
<?php else: ?>
                                Create a New Tag
<?php endif ?>
                            </legend>

                            <label for="name">Tag Name</label>
                            <input type="text" id="name" name="tag_name" <?php if ($isEditingTag) : echo "value=\"" . $tag_name . "\""; endif; ?>>

                            <!-- Banner Selection -->
<?php generateSelectElement("parent", "Parent Tag", "tag_p_id", $tag_p_id, getAllTags(), 'id', 'name', $isEditingTag, 7); ?>

                            <label for="tag_description">Tag Description</label>
                            <textarea id="tag_description" name="tag_description"><?php if ($isEditingTag) : echo $tag_description; endif; ?></textarea>

<?php if ($isEditingTag === true): ?>
                            <button type="submit" name="update_tag">Update Tag</button>
                            <button type="submit" name="delete_tag">Delete Tag</button>
<?php else: ?>
                            <button type="submit" name="create_tag">Create Tag</button>
<?php endif ?>
                        </fieldset>
                    </form>
                </article>
            </section>

            <section>
                <h2>Tags</h2>
                <table>
                    <thead>
                        <tr>
                            <th scope="col" id="t_key">#</th>
                            <th scope="col" id="t_parent">Parent</th>
                            <th scope="col" id="t_name">Name</th>
                            <th scope="col" id="t_description">Description</th>
                            <th scope="col" id="t_edit">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
<?php if (empty($tags)) : ?>
                        <tr>
                            <td colspan="5">No tags in the database.</td>
                        </tr>
<?php else : ?>
<?php foreach($tags as $key => $tag) : ?>
                        <tr>
                            <th headers="t_key">
                                <?php echo $key; ?>
                            </th>
                            <td headers="t_parent">
                                <em><?php 
                                    if(isset($tag['p_id'])) 
                                        echo getTagById($tag['p_id'])['name'];
                                    else
                                        echo "N/A";
                                ?></em>
                            </td>
                            <td headers="t_name">
                                <?php echo $tag['name']; ?>
                            </td>
                            <td headers="t_description">
                                <?php echo $tag['description']; ?>
                            </td>
                            <td headers="t_edit">
                                <button onclick="window.location.href='tag_admin.php?edit-tag=<?php echo $tag['id']?>'">Edit</button>
                            </td>
                        </tr>
<?php endforeach; ?>
<?php endif; ?>
                    </tbody>
                </table>
            </section>
    </main>
    <footer>

    </footer>
</body>
</html>