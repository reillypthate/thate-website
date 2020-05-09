<?php if (session_status() != 0): ?>
<?php require_once('../config.php'); ?>
<?php endif ?>
<?php require_once(ROOT_PATH . '../includes/common_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/helper_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/course_functions.php'); ?>
<?php require_once(ROOT_PATH . '/admin/includes/modules/head_module.php'); ?>
<?php 
	$thisPage = "course_manager";
	generateHead("Course Manager | Thate Admin", "The CMS for Reilly Thate's website.");
?>
<body id="manager">
    <?php include('includes/modules/header_section.php'); ?>
    <main>
    <?php $courses = getAllCourses(); ?>
        <section class="controller">
            <h2>
                <?php if ($isEditingCourse === true): ?>
                    Edit Course
                <?php else: ?>
                    Create Course
                <?php endif ?>
            </h2>
            <article>
                <?php include(ROOT_PATH . '/includes/errors.php') ?>
                <form method="post" action="<?php echo BASE_URL . 'admin/course_manager.php'; ?>">
                    <?php if ($isEditingCourse === true): ?>
                        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                    <?php endif ?>
                    <!-- Fieldset for Creating/Updating Courses; basic info. -->
                    <fieldset>
                        <legend>
                            <?php if ($isEditingCourse === true): ?>
                                Update Course in Database
                            <?php else: ?>
                                Add a New Course to Database
                            <?php endif ?>
                        </legend>

                        <label for="course_name">Course Name</label>
                        <input type="text" id="course_name" name="course_name" <?php if ($isEditingCourse) : echo "value=\"" . $course_name . "\""; endif; ?>>

                        <label for="course_summary">Course Summary</label>
                        <textarea id="course_summary" name="course_summary" row="3" col="80"><?php if ($isEditingCourse) : echo $course_summary; endif; ?></textarea>

                        <?php if ($isEditingCourse === true): ?>
                            <button type="submit" name="update_course">Update Course</button>
                        <?php else: ?>
                            <button type="submit" name="create_course">Create Course</button>
                        <?php endif ?>
                    </fieldset>
                    <!-- Fieldset for Adding/Removing associated Project(s) from Courses. -->
                    <?php if ($isEditingCourse === true) : ?>
                        <fieldset>
                            <legend>
                                Manage Associated Projects
                            </legend>
                            <?php $course_projects = getProjectsFromCourse($course_id); ?>
                            <?php foreach ($course_projects as $key => $project) : ?>
                                <div class="associate_manager">
                                    <div class="up-down">
                                        <button>
                                            Up
                                        </button>
                                        <button>
                                            Down
                                        </button>
                                    </div>
                                    <div class="proj_details">
                                        <h3>
                                            <?php echo $project['project_name']; ?>
                                        </h3>
                                    </div>
                                    <div class="remove_container">
                                        <button>
                                            REMOVE
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </fieldset>
                    <?php endif; ?>
                </form>
            </article>
        </section>

        <!-- Display records from database -->
        <section class="rows list-section">
            <h2>Courses</h2>
            <?php if (empty($courses)): ?>
                <p class="message">No courses in the database.</p>
            <?php else: ?>
                <?php foreach ($courses as $key => $course): ?>
                    <article class="single">                        
                        <div class="single_details">
                            <h3><?php echo $course['name'];  ?></h3>
                            <p>
                                <?php if (!isset($course['summary'])) : ?>
                                    ** No summary has been written for this course. **
                                <?php else : ?>
                                    <?php echo $course['summary']; ?>
                                <?php endif; ?>
                            </p>
                            <div class="associates">
                                <h3>Projects</h3>
                                <?php $course_projects = getProjectsFromCourse($course['id']); ?>
                                <?php if (count($course_projects) == 0 ) : ?>
                                    <p>No projects associated with this course.</p>
                                <?php else : ?>
                                    <ol>
                                    <?php foreach($course_projects as $key => $project) : ?>
                                        <li><?php echo $project['project_name']?></li>
                                    <?php endforeach; ?>
                                    </ol>
                                    <div class="edit_remove">
                                        <button onclick="window.location.href='course_manager.php?edit-projects=<?php echo $course['id']?>'">Add/Remove</button>
                                        <button class='delete_button' onclick="window.location.href='course_manager.php?clear-projects=<?php echo $course['id']?>'">Clear</button>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="associates">
                                <h3>Blogs</h3>
                                <?php $course_blogs = getBlogsFromCourse($course['id']); ?>
                                <?php if (count($course_blogs) == 0 ) : ?>
                                    <p>No blogs associated with this course.</p>
                                <?php else : ?>
                                    <p>Blogs Galore!</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="edit_remove">
                            <button onclick="window.location.href='course_manager.php?edit-course=<?php echo $course['id']?>'">Edit</button>
                            <button class='delete_button' onclick="window.location.href='course_manager.php?delete-course=<?php echo $course['id']?>'">Delete</button>
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