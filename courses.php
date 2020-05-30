<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/common_functions.php'); ?>
<?php require_once(ROOT_PATH . '/includes/public_functions.php'); ?>
<?php require_once(ROOT_PATH . '/includes/modules/head_module.php'); ?>
<?php 
	$thisPage = "courses";
	generateHead("Courses | Reilly Thate", "Reilly has taken courses in a variety of subjects.");
?>
    <body>

        <?php require_once(ROOT_PATH . '/includes/modules/header_section.php'); ?>
		
		<main>
			
<!-- Page Teaser -->
            <section id="page_teaser">
				<p>
					Reilly has taken a variety of courses throughout his academic career.
				</p>
				<p>
					These courses have facilitated his education in art and science.
				</p>
			</section>

<!-- Course Tiles -->
			<section class="page_preview">
				<article class="description">
					<h2>
						<a href="#" class="trick-highlight">
							AACC (2019&ndash;)
						</a>
					</h2>
					<p>
						Reilly is currently pursuing an A.A.S. in Media Production and an A.A.S. in Web Design at Anne Arundel Community College.
					</p>
					<p>
						At A.A.C.C., his education is focused on artistic endeavors in such courses as:
					</p>
					<ul>
						<li>Video Editing & Drawing</li>
						<li>Web Design</li>
						<li>Typography</li>
					</ul>
				</article>
				<article class="categories courses">
<?php $courses=getAllCourses(); ?>
<?php foreach($courses as $course) : ?>
<?php $prevSrc=getCoursePreviewImage($course['id']); ?>
<?php if($prevSrc != false) : ?>

	<!-- Course Tile: <?php echo $course['name']; ?> -->
					<article class="card">
						<h3>
							<a href="<?php echo /*BASE_URL .*/ 'course.php?course-slug=' . $course['slug']; ?>">
								<?php echo $course['name'] . "\r\n"; ?>
							</a>
						</h3>
						<figure class="ratio-container-a polaroid polaroid-hover">
								<a href="<?php echo /*BASE_URL .*/ 'course.php?course-slug=' . $course['slug']; ?>" class="to_more">
								<img src="<?php echo $prevSrc['base']; ?>" alt="<?php echo $prevSrc['alt']; ?>">
							</a>
						</figure>
						<p>
<?php if(isset($course['summary'])) : ?>
							<?php echo $course['summary'] . "\r\n"; ?>
<?php else : ?>
							** No Course Summary Available **
<?php endif; ?>
						</p>
					</article>
<?php endif; ?>
<?php endforeach; ?>
				</article>
			</section>
			
		</main>

<?php require_once(ROOT_PATH . '/includes/modules/footer_section.php'); ?>