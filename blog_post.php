<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/common_functions.php'); ?>
<?php require_once(ROOT_PATH . '/includes/public_functions.php'); ?>
<?php require_once(ROOT_PATH . '/includes/modules/head_module.php'); ?>
<?php
	if (isset($_GET['post-slug']))
	{
		$post = getPostBySlug($_GET['post-slug']);
	}
?>
<?php 
	$thisPage = "blog_post";
	generateHead($post['name'] . " | Reilly Thate", "A blog written by Reilly Thate about " . $post['name'] . ".");
?>
    <body>

		<?php require_once(ROOT_PATH . '/includes/modules/header_section.php'); ?>

<!-- Blog Content -->
        <main>
			<section class="primary_section blog_post">
<?php if ($post['published'] == false): ?>
				<h2>Sorry... This post has not been published</h2>
<?php else: ?>
					<!-- Place the banner image above the blog, if it exists. -->
<?php if (isset($post['image'])): ?>
				<figure class="blog_banner">
					<?php echo getPostImg($post['image']) . "\r\n"; ?>
				</figure>
<?php endif ?>

				<p class="date_published">
					<?php echo date_format(date_create($post['created_at']), "M d, Y") . "\r\n"; ?>
				</p>
				<h2 class="trick-highlight"><?php echo $post['name']; ?></h2>
				<article class="post_content">
					<?php echo html_entity_decode($post['body']); ?>
				</article>
				<div class="post_closer">
					<figure>
						<img src="media/images/reilly_thumbnail.jpg" alt="Reilly Thate">
					</figure>
					<p>
						Posted by <?php echo getPostAuthor($post['author_id']); ?> on <?php echo date_format(date_create($post['created_at']), "F d, Y"); ?> at around <?php echo date_format(date_create($post['created_at']), "g a"); ?>.
					</p>
				</div>
<?php endif ?>
			</section>
		</main>
		
<?php require_once(ROOT_PATH . '/includes/modules/footer_section.php'); ?>