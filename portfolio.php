<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/common_functions.php'); ?>
<?php require_once(ROOT_PATH . '/includes/public_functions.php'); ?>
<?php require_once(ROOT_PATH . '/includes/modules/head_module.php'); ?>
<?php 
	$thisPage = "portfolio";
	generateHead("Portfolio | Reilly Thate", "Reilly's portfolio showcases his work in a variety of contexts, from academic to self-enrichment.");
?>
    <body>

        <?php require_once(ROOT_PATH . '/includes/modules/header_section.php'); ?>
		
		<main>
			
<!-- Page Teaser -->
            <section id="page_teaser">
				<p>
					Reilly maintains an impressive portfolio that showcases his work in a variety of contexts.
				</p>
				<p>
					His portfolio contains a selection of academic coursework that reflect years of education in science and art, as well as a selection of projects he worked on for self-enrichment.
				</p>
			</section>

<!-- Main Section of Page -->
			<section id="primary_section">
				<article class="description">
					<h2>
						<a href="#" class="trick-highlight">
							Coursework
						</a>
					</h2>
					<p>I've completed work across a variety of courses during my time at Rochester Institute of Technology and Anne Arundel Community College.</p>
				</article>
				<!-- Course Tiles -->
				<article class="categories courses">
<?php $courses=getAllCourses(); ?> 
<?php $featured_courses = getCoursesBySlugs(array("video-2", "responsive-web-design", "typography")); ?>
<?php foreach($featured_courses as $course) : ?>
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
					<p class="to_all" id="to_all_courses"><a href="courses.php">All Courses</a></p>
				</article>
			</section>
<!-- Pinned Project(s) -->
			<section class="tiles" id="primary_accent">
				<h2 class="trick-highlight">Pinned Project</h2>
				<article class="simple_grid">
					<article class="home_card  polaroid-hover">
						<a href="https://youtu.be/19ghZuSgtuU">
							<figure class="card_banner">
								<img src="media/images/blogTeasers/banner_birthday-toast.jpg">
							</figure>
							<h3>Birthday Toast</h3>
							<p>
								An 18th birthday party doesn't go quite according to plan...
							</p>
						</a>
					</article>
					<p class="to_all"><a href="projects.php">All Projects</a></p>
				</article>
			</section>

			<section id="self_enrichment">
				<article class="description">
					<article class="sub_description">
						<h2>
							<a href="#" class="trick-highlight">
								Self-Enrichment
							</a>
						</h2>
						<p>
							In his free time, Reilly likes to take on challenging projects to leverage and expand the limits of his knowledge and creativity.
							ranging from filmmaking, design, and writing to programming, analysis, and research.
						</p>
						<p>
							There are countless ways he can integrate his skills and knowledge beyond academic coursework&mdash;these projects enable him to demonstrate what he's truly capable of.
						</p>
						<p>
							Reilly's primary areas of focus are in film and web development.
						</p>
					</article>
				</article>
			</section>
		</main>

<?php require_once(ROOT_PATH . '/includes/modules/footer_section.php'); ?>