<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/common_functions.php'); ?>
<?php require_once(ROOT_PATH . '/includes/public_functions.php'); ?>
<?php require_once(ROOT_PATH . '/includes/modules/head_module.php'); ?>
<?php
	if (isset($_GET['project-slug']))
	{
		$project = getProject($_GET['project-slug']);
	}
?>
<?php 
	$thisPage = "project_page";
	generateHead($project['name'] . " | Reilly Thate", "Reilly's coursework in " . $project['name'] . ".");
?>
    <body>

		<?php require_once(ROOT_PATH . '/includes/modules/header_section.php'); ?>

        <main>
<!-- Page Teaser -->
			<section id="page_teaser">
				<p>
					Project: <?php echo $project['name'] . "\r\n"; ?>
				</p>
				<p>
					<?php echo $project['summary'] . "\r\n";; ?>
				</p>
			</section>
<!-- Posts -->
			<section class="page_preview">
				<h2 class="trick-highlight">Blog Series</h2>
<?php $posts=getProjectPosts($project['id']); ?>
<?php if (getNumRelatedPosts($project['id'], 1)['cnt'] == 0) : ?>
					<h3>No Posts</h3>
<?php else : ?>
<?php foreach($posts as $key => $post) : ?>
<?php if ($post['directly_related'] == 1) : ?>
	<!-- Project: <?php echo $post['name']; ?> -->
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
								<?php echo date_format(date_create($post['created_at']), "M d, Y"); ?> 
							</p>
							<h3><a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $post['slug']; ?>" class="trick-highlight"><?php echo $post['name']; ?></a></h3>
							<p>
								<?php echo $post['summary'] . "\r\n"; ?>
							</p>
							<p class="to_more"><a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $post['slug']; ?>">Read More</a></p>
						</article>
					</article>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
            </section>
            <section class="page_preview">
				<h2 class="trick-highlight">Related Posts</h2>
<?php if (getNumRelatedPosts($project['id'], 0)['cnt'] == 0) : ?>
        <h3         >No Posts</h3>
<?php else : ?>
<?php foreach($posts as $key => $post) : ?>
<?php if ($post['directly_related'] == 0) : ?>
	<!-- Project: <?php echo $post['name']; ?> -->
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
								<?php echo date_format(date_create($post['created_at']), "M d, Y"); ?> 
							</p>
							<h3><a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $post['slug']; ?>" class="trick-highlight"><?php echo $post['name']; ?></a></h3>
							<p>
								<?php echo $post['summary'] . "\r\n"; ?>
							</p>
							<p class="to_more"><a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $post['slug']; ?>">Read More</a></p>
						</article>
					</article>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
			</section>
		</main>

<?php require_once(ROOT_PATH . '/includes/modules/footer_section.php'); ?>