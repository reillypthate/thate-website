<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/public_functions.php'); ?>

<?php
	if (isset($_GET['course-slug']))
	{
		$course = getCourse($_GET['course-slug']);
	}
?>

<?php $thisPage="course_page"; ?>
<?php require_once(ROOT_PATH . '/includes/head_section.php'); ?>
        <title><?php echo $course['name'] ?> | Reilly Thate</title>
        <meta name="description" content="Featuring the creative works of Reilly Thate.">
        <link rel="stylesheet" href="static/css/home.css" type="text/css">
        <link rel="stylesheet" href="static/css/blog.css" type="text/css">
    </head>

    <body>
        <?php require_once(ROOT_PATH . '/includes/header_section.php'); ?>
        <main>
			<section id="page_teaser">
				<p>Course: <?php echo $course['name']; ?></p>
				<p><?php echo $course['summary']; ?></p>
			</section>
			<section class="page_preview">
				<h2 class="trick-highlight">Projects</h2>
				<?php $projects=getCourseProjects($course['id']); ?>
				<?php if (count($projects) == 0) : ?>
					<h3>No Projects</h3>
				<?php else : ?>
					<?php foreach($projects as $key => $project) : ?>
						<article class="blog-post__preview">
							<?php if (isset($project['image'])): ?>
								<figure class="blog_banner ratio-container-a">
									<a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $project['slug']; ?>" class="img_link">
										<?php echo getPostImg($project['image']); ?>
								</a>
								</figure>
							<?php endif ?>
							<article class="blog_summary">
								<p class="date_published"><?php echo date_format(date_create($project['created_at']), "M d, Y"); ?></p>
								<h3><a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $project['slug']; ?>" class="trick-highlight"><?php echo $project['project_name']; ?></a></h3>
								<p><?php echo $project['project_summary']; ?></p>
								<p class="to_more"><a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $project['slug']; ?>">Read More</a></p>
							</article>
						</article>
					<?php endforeach; ?>
				<?php endif; ?>
			</section>
        </main>
<?php require_once(ROOT_PATH . '/includes/footer_section.php'); ?>