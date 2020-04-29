<?php include('../config.php');?>
    <?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
    <?php include(ROOT_PATH . '/admin/includes/blog_functions.php'); ?>
    <?php include(ROOT_PATH . '/admin/includes/project_functions.php'); ?>
    <?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
    <title>Admin ~ Blog Manager | Reilly Thate</title>
</head>
<body>
    <?php $thisPage = "project_manager" ?>
    <?php include('includes/header_section.php'); ?>
    <main>
    <?php $projects = getAllProjects();?>
    
        <section id="add_project">
            <h2>
                <?php if ($isEditingProject === true): ?>
                    Edit Project
                <?php else: ?>
                    Create Project
                <?php endif ?>
            </h2>
            <article>
                <?php include(ROOT_PATH . '/includes/errors.php') ?>
                <form method="post" action="<?php echo BASE_URL . 'admin/project_manager.php'; ?>">
                    <?php if ($isEditingProject === true): ?>
                        <input type="hidden" name="project_id" value="<?php echo $projectId; ?>">
                    <?php endif ?>
                    <fieldset>
                        <legend>
                            <?php if ($isEditingProject === true): ?>
                                Update Project in Database
                            <?php else: ?>
                                Create a New Project
                            <?php endif ?>
                        </legend>

                        <label for="blog">Blog Post</label>
                        <select id="blog" name="project_blog">
                            <option value="">&mdash;</option>
                            <?php foreach( getAllPosts() as $blog) : ?>
                                <option value="<?php echo $blog['id']; ?>" 
                                <?php if($isEditingProject) : if($projectBlogId == $blog['id']) : echo "selected"; endif; endif; ?>><?php echo $blog['id'] . ': ' . $blog['name']; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="pub_container">Portfolio Scope</label>
                        <div id="pub_container">
                            <input type="radio" id="academic" name="portfolio_scope" value="1" onclick="changeScopeContent()" <?php if($isEditingProject): ?><?php if($projectScope == 1):echo "checked"; endif;?> <?php endif;?>><label for="academic" id="label_academic">Academic</label>
                            <input type="radio" id="self-enrichment" name="portfolio_scope" value="2" onclick="changeScopeContent()" <?php if($isEditingProject): ?><?php if($projectScope == 2):echo "checked"; endif;?> <?php endif;?>><label for="self-enrichment" id="label_self">Self-Enrichment</label>
                        </div>
                        <div id="courses" hidden>
                            <?php if ($isEditingProject): ?>
                                <input type='hidden' name='no_course' value=<?php echo $noCourse; ?></input> 
                            <?php endif; ?>
                            <label for="course">Courses</label>
                            <select id="course" name="project_course">
                                <option value="">&mdash;</option>
                                <?php foreach( getAllCourses() as $course) : ?>
                                    <option value="<?php echo $course['id']; ?>" 
                                    <?php if($isEditingProject) : if($projectCourse == $course['id']) : echo "selected"; endif; endif; ?>><?php echo $course['id'] . ': ' . $course['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
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
        <section id="projects">
            <h2>Projects</h2>
            <?php if (empty($projects)): ?>
                <p class="message">No projects in the database.</p>
            <?php else: ?>
                <?php foreach ($projects as $key => $project): ?>
                    <article class="single">
                        <figure>
                            <?php echo getBlogPostBanner($project['image']); ?>
                        </figure>
                        
                        <div class="single_details">
                            <h3><?php echo $project['name'];  ?></h3>
                            <p>
                                <?php if (!isset($project['summary'])) : ?>
                                    ** No summary has been written for this blog post. **
                                <?php else : ?>
                                    <?php echo $project['summary']; ?>
                                <?php endif; ?>
                            </p>
                            <p<?php if ($project['published'] == 0) : ?> class="error">
                            *** Not published! ***<?php else: ?>>Published!<?php endif; ?>
                            </p>
                            <p><?php echo $project['scope']; ?>
                            <?php if ($project['scope'] == "Academic") : echo "(".getProjectCourse($project['id']).")"; endif; ?></p>
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