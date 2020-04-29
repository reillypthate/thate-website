        
        <header>
			<h1><a href="index.php" class="trick-highlight trick-hover">Reilly Thate</a></h1>
			<span class="logo logo-renegade"></span>
			<nav id="topNav">
				<ul id="topNav_list">
					<li class="topNav_item"
					<?php if($thisPage=="portfolio"){echo " id=\"active_page\">Portfolio";}else{echo "><a href=\"portfolio.php\">Portfolio</a>";}?>
					</li>
					<li class="topNav_item"
					<?php if($thisPage=="blog"){echo " id=\"active_page\">Blog";}else{echo "><a href=\"blog.php\">Blog</a>";}?>
					</li>
					<li class="topNav_item"
					<?php if($thisPage=="about"){echo " id=\"active_page\">About";}else{echo "><a href=\"about.php\">About</a>";}?>
					</li>
				</ul>
				<button id="topNav_toggle" aria-expanded="false">Menu</button>
			</nav>
		</header>
