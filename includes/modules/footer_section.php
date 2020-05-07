<!-- Footer Section: Contains social media icons and copyright info -->
        <footer>
			<section id='social_media_bar'>
				<figure class='social_logo_container'>
					<a href="https://www.youtube.com/channel/UCr9bNNf2-HwIflgvgbjnnOQ" target="_blank" class="social_media_link">
						<img src="media/icons/yt_icon.svg" alt="YouTube logo: a red television screen with a white play button.">
					</a>
				</figure>
				<figure class='social_logo_container'>
					<a href="https://github.com/reillypthate" target="_blank" class="social_media_link">
						<img src="media/icons/github_icon.svg" alt="GitHub logo: a silhouette of an octocat.">
					</a>
				</figure>
			</section>
			
			<p id="site_copyright">Copyright &copy; 2020 Reilly Thate</p>
			
		</footer>

<!-- Script for TopNav toggle functionality -->
		<script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/182774/modernizr_copy.js'></script>
  		<script>
  
			var toggle = document.querySelector('#topNav_toggle');
			var menu = document.querySelector('#topNav_list');
			//var menuItems = document.querySelectorAll('#menu li a');

			toggle.addEventListener('click', function()
			{
				if (menu.classList.contains('is-active')) 
				{
					this.setAttribute('aria-expanded', 'false');
					menu.classList.remove('is-active');
				} else 
				{
					menu.classList.add('is-active'); 
					this.setAttribute('aria-expanded', 'true');
					//menuItems[0].focus();
				}
			});
  
  		</script>
		
	</body>
</html>
