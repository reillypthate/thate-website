<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/common_functions.php'); ?>
<?php require_once(ROOT_PATH . '/includes/public_functions.php'); ?>
<?php require_once(ROOT_PATH . '/includes/modules/head_module.php'); ?>
<?php 
	$thisPage = "blog";
	generateHead("Blog | Reilly Thate", "Reilly's blog enables him to reflect on his projects and discuss his workflows.");
?>
    <body>

		<?php require_once(ROOT_PATH . '/includes/modules/header_section.php'); ?>

        <main>

<!-- Page Teaser -->
			<section id="page_teaser">
				<p>
					Reilly maintains a well-written blog that reflects his thought processes.
				</p>
				<p>
					His blog enables him to document his workflows, discuss his ideas, and offer his unique perspective on a variety of topics.
				</p>
			</section>

<!-- Main Section -->
			<section class="page_preview primary_section" id="recent_posts">
				<h2>Recent Posts</h2>

<?php $posts=getPublishedPosts(); ?>
<?php foreach($posts as $post): ?>
	<!-- Blog Post: <?php echo $post['name']; ?> -->
					<article class="blog-post__preview">
<?php if (isset($post['image'])): ?>
						<figure class="blog_banner ratio-container-a">
							<a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $post['slug']; ?>" class="img_link">
								<?php echo getPostImg($post['image']) . "\r\n"; ?>
							</a>
						</figure>
<?php endif ?>

						<article class="blog_summary">
							<p class="date_published"><?php echo date_format(date_create($post['created_at']), "M d, Y"); ?></p>
							<h3><a href="<?php echo BASE_URL . 'blog_post.php?post-slug=' . $post['slug']; ?>" class="trick-highlight"><?php echo $post['name']; ?></a></h3>
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
			</section>
        </main>
<?php require_once(ROOT_PATH . '/includes/modules/footer_section.php'); ?>