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
			<section class="page_preview" id="recent">
				<h2>Recent Posts</h2>
				<?php $posts=getPublishedPosts(); ?>
				<?php foreach($posts as $post): ?>
					<article class="blog_post">
						<?php if (isset($post['image'])): ?>
							<figure class="blog_banner">
								<?php echo getPostImg($post['image']); ?>
							</figure>
						<?php endif ?>

						<article class="blog_summary">
							<p class="date_published"><?php echo date_format(date_create($post['created_at']), "M d, Y"); ?></p>
							<h3><?php echo $post['title']; ?></h3>
							<?php echo getPostSummary($post); ?>
							<p class="to_blog"><a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $post['slug']; ?>">Read More</a></p>
						</article>
					</article>
				<?php endforeach ?>
			</section>			
        </main>
<?php require_once(ROOT_PATH . '/includes/footer_section.php'); ?>