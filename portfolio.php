<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/public_functions.php'); ?>

<?php $thisPage="portfolio"; ?>
<?php require_once(ROOT_PATH . '/includes/head_section.php'); ?>
        
        <title>Portfolio | Reilly Thate</title>
        <meta name="description" content="Reilly maintains an impressive portfolio that showcases his work in a variety of contexts.">
    </head>

    <body>
        <?php require_once(ROOT_PATH . '/includes/header_section.php'); ?>
        <main>
            <section id="page_teaser">
				<p>
					Reilly maintains an impressive portfolio that showcases his work in a variety of contexts.
				</p>
				<p>
					His portfolio contains a selection of academic coursework that reflect years of education in science and art, as well as a selection of projects he worked on for self-enrichment.
				</p>
			</section>
			<section class="page_preview" id="academic_coursework">
				<article class="description">
					<h2>
						<a href="#" class="trick-highlight">
							Academic Coursework
						</a>
					</h2>
					<p>Reilly graduated from Rochester Institute of Technology in 2018 with a B.S. in Bioinformatics, and he is currently pursuing an A.A.S. in Media Production at Anne Arundel Community College.</p>
					<p>Reilly's education at R.I.T. incorporated intensive study in such courses as:</p>
					<ul>
						<li>Bioinformatics Algorithms</li>
						<li>Statistical Analysis</li>
						<li>Genetic Engineering</li>
					</ul>
					<p>At A.A.C.C., his education is focused on artistic endeavors in such courses as:</p>
					<ul>
						<li>Video Editing & Drawing</li>
						<li>Web Design</li>
						<li>Typography</li>
					</ul>
				</article>
				<article class="tiles">
					<h2 class="trick-highlight">Pinned Project</h2>
					<article class="home_card">
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
				</article>
			</section>
			<section class="page_preview" id="recent_posts">
				<?php $posts=getPublishedProjects(1); ?>
				<?php foreach($posts as $post): ?>
					<article class="blog-post__preview">
						<?php if (isset($post['image'])): ?>
							<figure class="blog_banner">
								<a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $post['slug']; ?>" class="img_link">
									<?php echo getPostImg($post['image']); ?>
							</a>
							</figure>
						<?php endif ?>

						<article class="blog_summary">
							<p class="date_published"><?php echo date_format(date_create($post['created_at']), "M d, Y"); ?></p>
							<h3><a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $post['slug']; ?>" class="trick-highlight"><?php echo $post['name']; ?></a></h3>
							<?php echo getPostSummary($post); ?>
							<p class="to_more"><a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $post['slug']; ?>">Read More</a></p>
						</article>
					</article>
				<?php endforeach ?>
			</section>
			<section class="page_preview" id="self_enrichment">
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
			<section class="page_preview" id="recent_posts">
				<?php $posts=getPublishedProjects(2); ?>
				<?php foreach($posts as $post): ?>
					<article class="blog-post__preview">
						<?php if (isset($post['image'])): ?>
							<figure class="blog_banner">
								<a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $post['slug']; ?>" class="img_link">
									<?php echo getPostImg($post['image']); ?>
							</a>
							</figure>
						<?php endif ?>

						<article class="blog_summary">
							<p class="date_published"><?php echo date_format(date_create($post['created_at']), "M d, Y"); ?></p>
							<h3><a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $post['slug']; ?>" class="trick-highlight"><?php echo $post['name']; ?></a></h3>
							<?php echo getPostSummary($post); ?>
							<p class="to_more"><a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $post['slug']; ?>">Read More</a></p>
						</article>
					</article>
				<?php endforeach ?>
			</section>		
        </main>
<?php require_once(ROOT_PATH . '/includes/footer_section.php'); ?>