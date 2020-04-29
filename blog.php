<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/public_functions.php'); ?>

<?php //require_once(ROOT_PATH . '/index.html'); exit;?>

<?php $thisPage="blog"; ?>
<?php require_once(ROOT_PATH . '/includes/head_section.php'); ?>
        
        <title>Blog | Reilly Thate</title>
        <meta name="description" content="Featuring the creative works of Reilly Thate.">
    </head>

    <body>
        <?php require_once(ROOT_PATH . '/includes/header_section.php'); ?>
        <main>
			<section id="page_teaser">
				<p>
					Reilly maintains a well-written blog that reflects his thought processes.
				</p>
				<p>
					His blog enables him to document his workflows, discuss his ideas, and offer his unique perspective on a variety of topics.
				</p>
			</section>
			<section class="page_preview" id="recent_posts">
				<h2>Recent Posts</h2>
				<?php $posts=getPublishedPosts(); ?>
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