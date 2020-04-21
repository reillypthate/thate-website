<?php require_once('config.php'); ?>

<?php //require_once(ROOT_PATH . '/index.html'); exit;?>

<?php $thisPage="home"; ?>
<?php require_once(ROOT_PATH . '/includes/head_section.php'); ?>
        
        <title>Home | Reilly Thate</title>
        <meta name="description" content="Featuring the creative works of Reilly Thate.">
    </head>

    <body>
        <?php require_once(ROOT_PATH . '/includes/header_section.php'); ?>
        <main>
            <section id="page_teaser">
				<p>
					Reilly Thate is a well-rounded young artist with a scientific background.
				</p>
				<p>
					This website showcases his work across his broad range of expertise, as well as detailed recounts of his workflows and creative processes.
				</p>
			</section>
			<section class="page_preview" id="featured_projects">
				<article class="description">
					<h2>Portfolio</h2>
					<p>
						Reilly maintains an impressive portfolio that showcases his work in a variety of contexts.
					</p>
					<p>
						His portfolio contains a selection of academic coursework that reflect years of education in science and art, as well as a selection of projects he worked on for self-enrichment.
					</p>
					<article class="sub_description">
						<h3>Academic Coursework</h3>
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
					<p class="to_main_page"><a href="portfolio.php">View Portfolio</a></p>
				</article>
				<article class="tiles">
					<h2>Featured Projects</h2>
					<article class="home_card">
						<figure class="card_banner">
							<img src="media/images/blogTeasers/banner_ruthless.jpg">
						</figure>
						<h3>Ruthless: The Final Chapter</h3>
						<p>
							A (fake) movie trailer in which Reilly plays a man whose dark side emerges with a violent streak...
						</p>
					</article>
					<article class="home_card">
						<figure class="card_banner">
							<img src="media/images/blogTeasers/banner_birthday-toast.jpg">
						</figure>
						<h3>Birthday Toast</h3>
						<p>
							An 18th birthday party doesn't go quite according to plan...
						</p>
					</article>
					<!--
					<article class="home_card">
						<figure class="card_banner">
							<img src="media/images/blogTeasers/blog_due-at-1159pm.jpg">
						</figure>
						<h3>Due @ 11:59pm</h3>
						<p>
							A serial procrastinator in a fit of panic from missing a crucial deadline gets more than he bargained for
							when he texts his best friend for help in the middle of the night.
						</p>
					</article>-->
				</article>
			</section>
			
			<section class="page_preview" id="recent_posts">
				<!--
				<article class="description">
					<h2>Blog</h2>
					<p>
						In conjunction with his portfolio, a blog enables Reilly to relect on his projects&mdash;but there's more to him than his work.
					</p>
					<p>
						Reilly's mind is home to an ocean of ideas, and this blog serves as an outlet for those ideas.
					</p>
					<p class="to_main_page"><a href="blog.php">Go to Blog</a></p>
				</article>
				-->
				<article class="tiles">
					<h2>Recent Posts</h2>
					<article class="home_card">
						<figure class="card_banner">
							<img src="media/images/blogTeasers/banner_n-body.jpg">
						</figure>
						<article class="card_content">
							<h3>N-body Orbital Simulator</h3>
							<p>
								A physics engine rendered in JavaScript that simulates gravitational forces between numerous particles of random mass.
							</p>
						</article>
					</article>
					<article class="home_card">
						<figure class="card_banner">
							<img src="media/images/blogTeasers/banner_crofton-crew.jpg">
						</figure>
						<article class="card_content">
							<h3>Crofton Crew (Web Design)</h3>
							<p>
								A responsive design for a podcast website, featuring an amateur podcast recorded specifically for the assignment.
							</p>
						</article>
					</article>
					<article class="home_card">
						<figure class="card_banner">
							<img src="media/images/blogTeasers/banner_bud-light-soul.jpg">
						</figure>
						<article class="card_content">
							<h3>Bud Light (For a Soul)</h3>
							<p>
								Your typical basement dweller finds himself on the wrong side of a bargain...
							</p>
						</article>
					</article>
				</article>				
			</section>
			
        </main>
<?php require_once(ROOT_PATH . '/includes/footer_section.php'); ?>