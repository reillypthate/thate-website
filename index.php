<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/common_functions.php'); ?>
<?php require_once(ROOT_PATH . '/includes/public_functions.php'); ?>
<?php require_once(ROOT_PATH . '/includes/modules/head_module.php'); ?>
<?php 
	$thisPage = "home";
	generateHead("Home | Reilly Thate", "Reilly Thate is a well-rounded young artist with a scientific background. This website showcases his work across his broad range of expertise, as well as detailed recounts of his workflows and creative processes.");
?>

	<body>

		<?php require_once(ROOT_PATH . '/includes/modules/header_section.php'); ?>

        <main>

<!-- Page Teaser -->
            <section id="page_teaser">
				<p>
					Reilly Thate is a well-rounded young artist with a scientific background.
				</p>
				<p>
					This website showcases his work across his broad range of expertise, as well as detailed recounts of his workflows and creative processes.
				</p>
			</section>

<!-- Main Section of Page -->
			<section class="page_preview" id="primary_section">
				<article class="description">
					<h2>
						<a href="portfolio.php" class="trick-highlight trick-hover">
							Portfolio
						</a>
					</h2>
					<div class="section_thesis">
						<p>
							Reilly maintains an impressive portfolio that showcases his work in a variety of contexts.
						</p>
						<p>
							His portfolio contains a selection of academic coursework that reflect years of education in science and art, as well as a selection of projects he worked on for self-enrichment.
						</p>
					</div>
					<article class="sub_description">
						<h3>Academic Coursework</h3>
						<p>
							Reilly graduated from Rochester Institute of Technology in 2018 with a B.S. in Bioinformatics, and he is currently pursuing an A.A.S. in Media Production at Anne Arundel Community College.
						</p>
						<p>
							Reilly's education at R.I.T. incorporated intensive study in such courses as:
						</p>
						<ul>
							<li>Bioinformatics Algorithms</li>
							<li>Statistical Analysis</li>
							<li>Genetic Engineering</li>
						</ul>
						<p>
							At A.A.C.C., his education is focused on artistic endeavors in such courses as:
						</p>
						<ul>
							<li>Video Editing & Drawing</li>
							<li>Web Design</li>
							<li>Typography</li>
						</ul>
					</article>
					<article class="sub_description">
						<h3>Self-Enrichment</h3>
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
					<p class="to_all bump-down">
						<a href="portfolio.php">Visit Portfolio</a>
					</p>
				</article>
			</section>
<!-- Pinned Project(s) -->
			<section id="primary_accent">
				<h2 class="trick-highlight">Featured</h2>
				<div class="tiles">
					<article class="home_card">
						<a href="project.php?project-slug=birthday-toast">
							<figure class="card_banner">
								<img src="media/images/blogTeasers/banner_birthday-toast.jpg">
							</figure>
							<h3>Project: Birthday Toast</h3>
							<p>
								An 18th birthday party doesn't go quite according to plan...
							</p>
						</a>
					</article>
					<p class="to_all"><a href="projects.php">All Projects</a></p>
					<article class="home_card">
						<a href="blog_post.php?post-slug=n-body-orbital-simulator">
							<figure class="card_banner">
								<img src="media/images/blogTeasers/banner_n-body.jpg">
							</figure>
							<h3>Blog: N-Body Orbitals</h3>
							<p>
								A JavaScript project in which randomly-generated orbs of different colors and mass interact with each other via gravity.
							</p>
						</a>
					</article>
					<p class="to_all"><a href="blog.php">All Blog Posts</a></p>
				</div>
			</section>

<!-- Blog Posts: Three Most Recent -->
			<section class="page_preview" id="recent_posts">
				<h2>
					<a href="blog.php"  class="trick-highlight trick-hover">
						Recent Posts
					</a>
				</h2>

<?php $posts=getNumPublishedPosts(3); ?>
<?php foreach($posts as $post): ?>
	<?php echo "<!-- Post: " . $post['name'] . " -->\r\n"; ?>
				<article class="blog-post__preview">
<?php if (isset($post['image'])): ?>
					<figure class="blog_banner ratio-container-a">
						<a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $post['slug']; ?>" class="img_link">
							<?php echo getPostImg($post['image']) . "\r\n"; ?>
						</a>
					</figure>
<?php endif ?>
					<article class="blog_summary">
						<p class="date_published">
							<?php echo date_format(date_create($post['created_at']), "M d, Y") . "\r\n"; ?>
						</p>
						<h3>
							<a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $post['slug']; ?>" class="trick-highlight">
								<?php echo $post['name'] . "\r\n"; ?>
							</a>
						</h3>
<?php if (isset($post['summary'])) : ?>
						<p class="summary">
							<?php echo $post['summary'] . "\r\n"; ?>
						</p>
<?php else : ?>
						<p class="summary">
							** No summary written for this post. **
						</p>
<?php endif; ?>
						<p class="to_more"><a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $post['slug']; ?>">Read More</a></p>
					</article>
				</article>

<?php endforeach ?>
					<p class="to_all bump-down">
						<a href="blog.php">Visit Blog</a>
					</p>
			</section>
			
		</main>

<?php require_once(ROOT_PATH . '/includes/modules/footer_section.php'); ?>