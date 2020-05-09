<?php if (session_status() != 0): ?>
<?php require_once('../config.php'); ?>
<?php endif ?>
<?php require_once(ROOT_PATH . '../includes/common_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/helper_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/blog_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/project_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/modules/head_module.php'); ?>
<?php 
	$thisPage = "project_manager";
	generateHead("Project Manager | Thate Admin", "The CMS for Reilly Thate's website.");
?>

    <body id="manager">
    <?php include('includes/modules/header_section.php'); ?>

    <main>
<?php $projects = getAllProjects();?>
        <section class="controller" id="add_post">
            <h2>
<?php if ($isEditingProject === true): ?>
                    Edit Project
<?php else: ?>
                    Create Project
<?php endif ?>
            </h2>
            <article class="ctrl-main">
<?php include(ROOT_PATH . '/includes/errors.php') ?>
                <form method="post" action="<?php echo BASE_URL . 'admin/project_manager.php'; ?>">
<?php if ($isEditingProject === true): ?>
                        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
<?php endif ?>
                    <fieldset>
                        <legend>
<?php if ($isEditingProject === true): ?>
                                Update Project in Database
<?php else: ?>
                                Create a New Project
<?php endif ?>
                        </legend>
                        <fieldset>
                            <legend>Set a Portfolio Scope</legend>
                            <!-- Project Scope / Course Selection -->
                            <label for="pub_container">Portfolio Scope</label>
                            <div id="pub_container">
                                <input type="radio" id="academic" name="project_scope" value="1" onclick="changeScopeContent()" <?php if($isEditingProject): ?><?php if($project_scope == 1):echo "checked"; endif;?> <?php else: echo "checked"; endif;?>><label for="academic" id="label_academic">Academic</label>
                                <input type="radio" id="self-enrichment" name="project_scope" value="2" onclick="changeScopeContent()" <?php if($isEditingProject): ?><?php if($project_scope == 2):echo "checked"; endif;?> <?php endif;?>><label for="self-enrichment" id="label_self">Self-Enrichment</label>
                            </div>
                            <div id="courses" hidden>
<?php generateSelectElement("course", "Courses", "project_course", $project_course, getAllCourses(), 'id', 'name', $isEditingProject, 8); ?>
                            </div>
                            <div id="by_scope"></div>
                            <script type="text/javascript">
                                function changeScopeContent()
                                {
                                    if(document.getElementById("academic").checked)
                                    {
                                        document.getElementById("courses").removeAttribute("hidden");
                                    }else
                                    {
                                        if(document.getElementById("self-enrichment").checked)
                                        {
                                            document.getElementById("courses").setAttribute("hidden", true);
                                        }
                                    }
                                }
                                changeScopeContent();
                            </script>
                        </fieldset>

                        <fieldset>
                            <legend>Pick a Cover Image</legend>
                            <!-- Banner Selection -->
<?php generateSelectElement("project_banner", "Banner", "project_banner", $project_banner, getAllPictures(), 'id', 'name', $isEditingProject, 7); ?>

                        </fieldset>

                        <fieldset>
                            <legend>Title/Summary/Body</legend>
                            <label for="project_name">Project Name</label>
                            <input type="text" id="project_name" name="project_name" <?php if ($isEditingProject) : echo "value=\"" . $project_name . "\""; endif; ?>>

                            <label for="project_summary">Project Summary</label>
                            <textarea id="project_summary" name="project_summary" row="3" col="80"><?php if ($isEditingProject) : echo $project_summary; endif; ?></textarea>

                            <label for="project_body">Project Body</label>
                            <textarea id="project_body" name="project_body" row="20" col="80"><?php if ($isEditingProject) : echo $project_body; endif; ?></textarea>
                            <script src="../../ckeditor/ckeditor.js">
                            </script>
                            <script>
                                CKEDITOR.replace('project_body');
                            </script>
                        </fieldset>

                        <div id="pub_container">
                            <label for="project_published" id="label_published">Published</label> <input type="checkbox" id="project_published" name="project_published" value="0" <?php if($isEditingProject): ?><?php if($project_published == 1): echo "checked"; endif; endif; ?>>
                        </div>

<?php if ($isEditingProject === true): ?>
                        <button type="submit" name="update_project">Update Project</button>
<?php else: ?>
                        <button type="submit" name="create_project">Create Project</button>
<?php endif ?>
                    </fieldset>
                </form>
            </article>
        </section>

        <!-- Display records from database -->
        <section id="projects" class="rows list-section">
            <h2>Projects</h2>
<?php if (empty($projects)): ?>
            <p class="message">No projects in the database.</p>
<?php else: ?>
<?php foreach ($projects as $key => $project): ?>
            <article class="single">
                <figure>
                    <?php echo getBlogPostBanner($project['image']) . "\r\n"; ?>
                </figure>
                    
                <div class="single_details">
                    <h3><?php echo $project['name']; ?></h3>
                    <p>
<?php if (!isset($project['summary'])) : ?>
                        ** No summary has been written for this blog post. **
<?php else : ?>
                        <?php echo $project['summary'] . "\r\n"; ?>
<?php endif; ?>
                    </p>
                    <p<?php if ($project['published'] == 0) : ?> class="error">*** Not published! ***<?php else: ?>>Published!<?php endif; ?></p>
                    <div class="edit_remove">
                        <button onclick="window.location.href='project_manager.php?edit-project=<?php echo $project['id']?>'">Edit</button>
                        <button onclick="window.location.href='project_manager.php?delete-project=<?php echo $project['id']?>'">Delete</button>
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