        
        <header>
			<h1><a href="index.php" class="trick-highlight trick-hover">Admin</a></h1>
			<span class="logo logo-renegade"></span>
			<nav id="topNav">
				<ul id="topNav_list" class="admin">
					<li class="topNav_item"
					<?php if($thisPage=="blog_manager"){echo " id=\"active_page\">Blog Manager";}else{echo "><a href=\"blog_manager.php\">Blog Manager</a>";}?>
					</li>
					<li class="topNav_item"
					<?php if($thisPage=="project_manager"){echo " id=\"active_page\">Project Manager";}else{echo "><a href=\"project_manager.php\">Project Manager</a>";}?>
					</li>
					<li class="topNav_item"
					<?php if($thisPage=="media_manager"){echo " id=\"active_page\">Media Manager";}else{echo "><a href=\"media_manager.php\">Media Manager</a>";}?>
					</li>
					<li class="topNav_item"
					<?php if($thisPage=="course_manager"){echo " id=\"active_page\">Course Manager";}else{echo "><a href=\"course_manager.php\">Course Manager</a>";}?>
					</li>
				</ul>
				<button id="topNav_toggle" aria-expanded="false">Menu</button>
			</nav>
		</header>