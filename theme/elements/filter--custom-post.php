<div class="accordion filter" data-accordion>
	<li class="accordion-item" data-accordion-item>
		<a href="#" class="accordion-title">フィルター</a>
		<div class="accordion-content filter--item" data-tab-content>
			<?php
				if ( 'members' === $post_type ) {
					$terms = get_terms( 'members-cat' );
					echo '<p class="filter--title">役職</p>';
					foreach( $terms as $term ) {
						echo '<a class="label secondary" href="', get_term_link( $term ), '">', $term->name, '</a>';
					}

					$terms = get_terms( 'members-hobby' );
					echo '<p class="filter--title">趣味</p>';
					foreach( $terms as $term ) {
						echo '<a class="label secondary" href="', get_term_link( $term ), '">', $term->name, '</a>';
					}

					$terms = get_terms( 'members-specialty' );
					echo '<p class="filter--title">主な分野・力を入れている分野</p>';
					foreach( $terms as $term ) {
						echo '<a class="label secondary" href="', get_term_link( $term ), '">', $term->name, '</a>';
					}

					$terms = get_terms( 'members-group' );
					echo '<p class="filter--title">所属団体</p>';
					foreach( $terms as $term ) {
						echo '<a class="label secondary" href="', get_term_link( $term ), '">', $term->name, '</a>';
					}
				}


				if ( 'cases' === $post_type ) {
					$terms = get_terms( 'cases-cat' );
					echo '<p class="filter--title">分野</p>';
					foreach( $terms as $term ) {
						echo '<a class="label secondary" href="', get_term_link( $term ), '">', $term->name, '</a>';
					}

					$terms = get_terms( 'cases-tag' );
					echo '<p class="filter--title">タグ</p>';
					foreach( $terms as $term ) {
						echo '<a class="label secondary" href="', get_term_link( $term ), '">', $term->name, '</a>';
					}
				}


				if ( 'voice' === $post_type ) {
					$terms = get_terms( 'voice-cat' );
					echo '<p class="filter--title">分野</p>';
					foreach( $terms as $term ) {
						echo '<a class="label secondary" href="', get_term_link( $term ), '">', $term->name, '</a>';
					}

					$terms = get_terms( 'voice-tag' );
					echo '<p class="filter--title">タグ</p>';
					foreach( $terms as $term ) {
						echo '<a class="label secondary" href="', get_term_link( $term ), '">', $term->name, '</a>';
					}
				}
			?>
		</div>
	</li>
</div>
