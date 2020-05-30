<header>
			<h1>
				<a href="index.php" class="trick-highlight trick-hover">
					Reilly Thate
				</a>
			</h1>
<!-- Renegade Logo; imported in CSS -->
<?php if($adminEnabled == true): ?>
			<a href="/thate-website/admin/"><span class="logo logo-renegade"></span></a>
<?php else: ?>
			<span class="logo logo-renegade"></span>
<?php endif; ?>

<!-- Top Nav; if on one of these pages, the respective button will be disabled. -->
			<nav id="topNav">
				<ul id="topNav_list">
					<li class="topNav_item"<?php if($thisPage=="portfolio"): ?> id="active_page">Portfolio<?php else:?>><a href="portfolio.php">Portfolio</a><?php endif; ?></li>
					<li class="topNav_item"<?php if($thisPage=="blog"): ?> id="active_page">Blog<?php else:?>><a href="blog.php">Blog</a><?php endif; ?></li>
					<li class="topNav_item"<?php if($thisPage=="about"): ?> id="active_page">About<?php else:?>><a href="about.php">About</a><?php endif; ?></li>
				</ul>
				<button id="topNav_toggle" aria-expanded="false">Menu</button>
			</nav>
		</header>
