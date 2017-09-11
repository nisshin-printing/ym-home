<div class="main--container">
	<div class="row">
		<div class="column small-4"><?php get_sidebar(); ?></div>

		<div class="column small-12 large-8">

			<section class="contents--section">
				<div class="contents">
					<?php
						the_post_thumbnail();
						the_content();
					?>
				</div>

			</section>

		</div>
	</div>
</div>
