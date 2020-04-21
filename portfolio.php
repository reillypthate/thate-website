<?php require_once('config.php'); ?>

<?php $thisPage="portfolio"; ?>
<?php require_once(ROOT_PATH . '/includes/head_section.php'); ?>
        
        <title>Portfolio | Reilly Thate</title>
        <meta name="description" content="Featuring the creative works of Reilly Thate.">
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

			</section>
			<section class="page_preview" id="self_enrichment">
			
			</section>
			<section class="page_preview" id="featured_projects">
				<article class="description">
					<article class="sub_description">
						<h2>Academic Coursework</h2>
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
						<h2>Self-Enrichment</h2>
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
				</article>
			</section>
			
        </main>
<?php require_once(ROOT_PATH . '/includes/footer_section.php'); ?>