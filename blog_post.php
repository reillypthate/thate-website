<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/public_functions.php'); ?>

<?php
	if (isset($_GET['post-slug']))
	{
		$post = getPost($_GET['post-slug']);
	}
?>

<?php $thisPage="blog_post"; ?>
<?php require_once(ROOT_PATH . '/includes/head_section.php'); ?>
        
        <title><?php echo $post['name'] ?> | Reilly Thate</title>
        <meta name="description" content="Featuring the creative works of Reilly Thate.">
        <link rel="stylesheet" href="static/css/home.css" type="text/css">
        <link rel="stylesheet" href="static/css/blog.css" type="text/css">
    </head>

    <body>
        <?php require_once(ROOT_PATH . '/includes/header_section.php'); ?>
        <main>
			<section class="blog_post">
				<?php if ($post['published'] == false): ?>
					<h2>Sorry... This post has not been published</h2>
				<?php else: ?>
					<!-- Place the banner image above the blog, if it exists. -->
					<?php if (isset($post['image'])): ?>
						<figure class="blog_banner">
							<?php echo getPostImg($post['image']); ?>
						</figure>
					<?php endif ?>

					<p class="date_published"><?php echo date_format(date_create($post['created_at']), "M d, Y"); ?></p>
					<h2 class="trick-highlight"><?php echo $post['name']; ?></h2>

					<article class="post_content">
						<?php echo html_entity_decode($post['body']); ?>
					</article>
					<blockquote class="post_closer">
						Posted by <?php echo getPostAuthor($post['author_id']); ?> on <?php echo date_format(date_create($post['created_at']), "F d, Y"); ?> at around <?php echo date_format(date_create($post['created_at']), "g a"); ?>.</p>
					</blockquote>
				<?php endif ?>
			</section>
			
        </main>
<?php require_once(ROOT_PATH . '/includes/footer_section.php'); ?>