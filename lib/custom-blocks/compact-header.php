<?php
//todo: bug: pri vyske stranky,ktora je len o par stovak px vyssia ako okno preblikava compact header
//todo: vymazat zakomentovane includovanie 'sidebar_toc'
//todo: vymazat 'Post__header__small' v php a css
//todo: logo v sablonach s THEME_VERSION
//todo: filter toggle ikona
//todo: obrazok pre video(kategoria/single)
function inline_compact_header() {
	ob_start();
	$css  = file_get_contents( get_template_directory() . '/assets/dist/components/compactHeader' . isrtl() . wpenv() . '.css' );
	$css .= file_get_contents( get_template_directory() . '/assets/dist/components/Filter' . isrtl() . wpenv() . '.css' );
	ob_get_clean();

	// return the stored style
	if ( '' != $css ) {
		echo '<style id="compactheader-css" type="text/css">' . $css . '</style>'; // @codingStandardsIgnoreLine
	}
};
inline_compact_header();
?>

<?php set_custom_source( 'filterMenu', 'js' ); ?>
<?php set_custom_source( 'sortingMenu', 'js' ); ?>
<?php set_custom_source( 'compactHeader', 'js' ); ?>
<?php if ( isset( $args ) ) { ?>
	<?php
	$header_type = 'lvl-2';
	if ( ! empty( $args['type'] ) ) {
		$header_type = $args['type'];
	}
	if ( ! empty( $args['filter'] ) ) {
		$filter_items = $args['filter'];
	}
	if ( ! empty( $args['sort'] ) ) {
		$filter_sort = $args['sort'];
	}
	$search_class = '';
	if ( ! empty( $args['search'] ) ) {
		$filter_search = $args['search'];
		if ( ! empty( $filter_search['type'] ) ) {
			$search_type  = $filter_search['type'];
			$search_class = ' search--' . $search_type;
		}
	}
	if ( ! empty( $args['count'] ) ) {
		$filter_count = $args['count'];
	}
	if ( ! empty( $args['menu'] ) ) {
		$menu_header = $args['menu'];
	}
	if ( ! empty( $args['research_nav'] ) ) {
		$research_nav = $args['research_nav'];
	}
	if ( ! empty( $args['checklist'] ) ) {
		$checklist = $args['checklist'];
	}
	?>
	<div class="compact-header compact-header--<?= sanitize_html_class( $header_type ); ?>">
		<div class="compact-header__wrapper wrapper">
			<div class="compact-header__left">
				<?php
				if ( ! empty( $args['breadcrumb'] ) ) {
					site_breadcrumb( $args['breadcrumb'] );
				} else {
					site_breadcrumb();
				}
				?>
				<?php if ( ! empty( $args['title'] ) ) { ?>
					<h1 itemprop="name" class="compact-header__title"><?= esc_html( $args['title'] ); ?></h1>
				<?php } ?>
				<?php if ( ! empty( $args['update'] ) ) { ?>
					<div class="compact-header__update">
						<time class="Reviews__update" itemprop="dateModified" content="<?= esc_attr( get_the_modified_time( 'F j, Y' ) ); ?>">
							<?php if ( ! empty( $args['update']['label'] ) ) { ?>
								<?= esc_html( $args['update']['label'] . ' ' ); ?>
							<?php } ?>
							<em><?= esc_html( get_the_modified_time( 'F j, Y' ) ); ?></em>
						</time>
					</div>
				<?php } ?>
				<?php if ( ! empty( $args['text'] ) ) { ?>
					<div class="compact-header__text"><?= wp_kses_post( $args['text'] ); ?></div>
				<?php } ?>
				<?php if ( ! empty( $args['date'] ) ) { ?>
					<?php
						$date_machine  = get_the_time( 'Y-m-d' );
						$date_human    = get_the_time( 'F j, Y' );
						$date_modified = get_the_modified_time( 'F j, Y' );
						$time_modified = get_the_modified_time( 'g:i a' );
					?>
					<div class="compact-header__date">
						<?php if ( isset( $date_machine ) && isset( $date_human ) ) { ?>
							<span itemprop="datePublished" content="<?= esc_attr( $date_machine ); ?>">
																		<?=
																		esc_html( $date_human );
																		?>
																		</span>
						<?php } ?>
						<?php if ( isset( $date_modified ) && isset( $time_modified ) ) { ?>
							<?= esc_html( __( 'Last modified on', 'ms' ) ); ?>
							<?= esc_html( $date_modified ); ?>
							<?= esc_html( __( 'at', 'ms' ) ); ?>
							<?= esc_html( $time_modified ); ?>
						<?php } ?>
					</div>
				<?php } ?>
				<?php if ( ! empty( $args['buttons'] ) ) { ?>
					<div class="compact-header__buttons">
						<div class="compact-header__buttons-items">
							<?php foreach ( $args['buttons'] as $button ) { ?>
								<?php if ( isset( $button['title'] ) && isset( $button['href'] ) ) { ?>
									<?php
									$button_classes = 'Button Button--outline Button--outline-gray';
									if ( isset( $button['target'] ) ) {
										if ( '_blank' == $button['target'] ) {
											$button_classes = 'Button Button--outline';
										}
									}
									?>
									<div class="compact-header__buttons-item">
										<a href="<?= esc_url( $button['href'] ); ?>"
										   class="<?= esc_attr( $button_classes ); ?>"
										   title="<?= esc_attr( $button['title'] ); ?>"
											<?php if ( isset( $button['target'] ) ) { ?>
												<?php $button_classes .= 'Button'; ?>
												target="<?= esc_attr( $button['target'] ); ?>"
											<?php } ?>
											<?php if ( isset( $button['rel'] ) ) { ?>
												rel="<?= esc_attr( $button['rel'] ); ?>"
											<?php } ?>
											<?php if ( isset( $button['onclick'] ) ) { ?>
												onclick="<?= esc_attr( $button['onclick'] ); ?>"
											<?php } ?>
										>
											<span><?= esc_html( $button['title'] ); ?></span>
										</a>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				<?php if ( ! empty( $args['tags'] ) ) { ?>
					<div class="compact-header__tags">
						<?php foreach ( $args['tags'] as $item ) { ?>
							<div class="compact-header__tags-item">
								<?php if ( isset( $item['title'] ) ) { ?>
									<div class="compact-header__tags-title"><?= esc_html( $item['title'] ); ?>:</div>
								<?php } ?>
								<?php if ( isset( $item['list'] ) ) { ?>
									<ul class="compact-header__tags-list">
									<?php foreach ( $item['list'] as $tag_item ) { ?>
										<li>
											<?php if ( isset( $tag_item['href'] ) && isset( $tag_item['title'] ) ) { ?>
												<a href="<?= esc_url( $tag_item['href'] ); ?>"
												   title="<?= esc_attr( $tag_item['title'] ); ?>"
												   <?php if ( isset( $tag_item['target'] ) ) { ?>
													   target="<?= esc_attr( $tag_item['target'] ); ?>"
													<?php } ?>
													<?php if ( isset( $tag_item['rel'] ) ) { ?>
														rel="<?= esc_attr( $tag_item['rel'] ); ?>"
													<?php } ?>
													<?php if ( isset( $tag_item['onclick'] ) ) { ?>
														onclick="<?= esc_attr( $tag_item['onclick'] ); ?>"
													<?php } ?>
												>
													<svg class="icon-tag-solid">
														<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#tag-solid' ); ?>"></use>
													</svg>
													<?= esc_html( $tag_item['title'] ); ?>
												</a>
											<?php } ?>
										</li>
									<?php } ?>
								</ul>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="compact-header__right">
				<?php if ( ! empty( $args['toc'] ) ) { ?>
					<?php if ( isset( $args['toc']['items'] ) ) { ?>
						<?= wp_kses_post( compact_header_toc( null, $args['toc']['items'] ) ); ?>
					<?php } else { ?>
						<?= wp_kses_post( compact_header_toc() ); ?>
					<?php } ?>
				<?php } ?>
				<?php if ( ! empty( $args['image'] ) ) { ?>
					<?php
					$image = $args['image'];
					?>
					<?php if ( isset( $image['src'] ) ) { ?>
						<div class="compact-header__image">
							<img
								src="<?= esc_url( $image['src'] ); ?>"
								alt="<?= esc_attr( $image['alt'] ); ?>"
								class="compact-header__img"
							>
							<?php if ( ! empty( $args['logo'] ) ) { ?>
								<?php $logo = $args['logo']; ?>
								<?php if ( isset( $logo['src'] ) ) { ?>
									<div class="compact-header__logo">
										<img
											src="<?= esc_url( $logo['src'] ); ?>"
											<?php if ( isset( $logo['alt'] ) ) { ?>
												alt="<?= esc_attr( $logo['alt'] ); ?>"
											<?php } ?>
											class="compact-header__logo-img"
										>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
			<?php if ( isset( $filter_search ) || isset( $filter_items ) || isset( $filter_sort ) || isset( $filter_count ) || isset( $menu_header ) || isset( $research_nav ) || isset( $checklist ) ) { ?>
				<div class="compact-header__bottom flex flex-align-center">
					<?php if ( isset( $filter_search ) || isset( $filter_items ) || isset( $filter_sort ) || isset( $filter_count ) ) { ?>
						<div class="compact-header__filters-toggle">
							<a class="Button Button--outline js-compact-header__toggle">
								<?= esc_html( __( 'Filters', 'ms' ) ); ?>
								<svg class="searchField__reset-icon icon-gear">
									<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#gear' ); ?>"></use>
								</svg>
							</a>
						</div>
						<div class="compact-header__filters js-compact-header__close urlslab-skip-keywords">
							<a class="compact-header__filters-close js-compact-header__close">
								<svg class="icon-close">
									<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#close' ); ?>"></use>
								</svg>
							</a>
							<div class=" compact-header__filters-wrap 
							<?php 
							if ( isset( $filter_count ) ) {
								?>
								 compact-header__filters-wrap--count<?php } ?>">
								<span class="compact-header__filters-collapse js-compact-header__close"></span>
								<div class="compact-header__filters-inn">
									<?php if ( isset( $filter_search ) ) { ?>
										<form role="search" action="<?= site_url( '/' ); //@codingStandardsIgnoreLine ?>"
											method="get" id="searchform" class="compact-header__search">
											<div class="searchField">
												<svg class="searchField__icon icon-search">
													<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#search' ); ?>"></use>
												</svg>
												<input type="search" name="s" class="search<?= esc_attr( $search_class ); ?>" placeholder="<?php _e( 'Search', 'ms' ); ?>" maxlength="50">
												<input type="hidden" name="post_type" value="<?= esc_attr( $search_type ); ?>" />
												<span class="search-reset">
										<svg class="search-reset__icon icon-close">
											<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#close' ); ?>"></use>
										</svg>
									</span>
											</div>
										</form>
									<?php } ?>
									<?php if ( isset( $filter_sort ) ) { ?>
										<?php
										if ( ! empty( $filter_sort['items'] ) ) {
											$sort_items = $filter_sort['items'];
										}
										?>
										<?php if ( isset( $sort_items ) ) { ?>
											<div class="FilterMenu__wrapper SortingMenu__wrapper flex-tablet flex-align-center">
											<?php if ( isset( $filter_sort['label'] ) ) { ?>
												<div class="FilterMenu__desc SortingMenu__desc"><?= esc_html( $filter_sort['label'] ); ?></div>
											<?php } ?>
											<div class="FilterMenu SortingMenu" data-sort="relatedReviews">
												<div class="FilterMenu__title SortingMenu__title flex flex-align-center" data-title>
													<?= esc_html( $sort_items[0]['title'] ); ?>
												</div>
												<div class="FilterMenu__items SortingMenu__items" data-items>
													<div class="FilterMenu__items--inn SortingMenu__items--inn">
														<?php
														$counter = 0;
														foreach ( $sort_items as $item ) {
															++$counter;
															?>
															<div class="sorting FilterMenu__item SortingMenu__item">
																<input class="sorting-item" type="radio" id="<?= esc_attr( $item['value'] ); ?>" value="<?= esc_attr( $item['value'] ); ?>" name="relatedReviews" data-sortBy="<?= esc_attr( $item['title'] ); ?>" <?= esc_attr( 1 === $counter ? 'checked' : '' ); ?> />
																<label for="<?= esc_attr( $item['value'] ); ?>">
																	<span
																		<?php if ( isset( $item['onclick'] ) ) { ?>
																			onclick="<?= esc_attr( $item['onclick'] ); ?>"
																		<?php } ?>
																	><?= esc_html( $item['title'] ); ?></span>
																</label>
															</div>
														<?php } ?>
													</div>
												</div>
											</div>
										</div>
										<?php } ?>
									<?php } ?>
									<?php if ( isset( $filter_items ) ) { ?>
										<?php foreach ( $filter_items as $filter_item ) { ?>
											<?php
											if ( ! empty( $filter_item['type'] ) ) {
												$filter_type = $filter_item['type'];
											}
											if ( ! empty( $filter_item['items'] ) ) {
												$filter_list = $filter_item['items'];
											}
											if ( ! empty( $filter_item['name'] ) ) {
												$filter_name = $filter_item['name'];
											}
											?>
											<?php if ( isset( $filter_list ) && isset( $filter_type ) ) { ?>
												<?php
												if ( ! empty( $filter_item['active'] ) ) {
													$filter_active = $filter_item['active'];
												} else {
													$filter_active = $filter_list[0]['title'];
												}
												?>
												<div class="compact-header__filter">
													<?php if ( ! empty( $filter_item['title'] ) ) { ?>
														<div class="compact-header__filter-label">
															<?= esc_html( $filter_item['title'] ); ?>
														</div>
													<?php } ?>
													<div class="FilterMenu">
														<div class="FilterMenu__title">
															<?= esc_html( $filter_active ); ?>
														</div>
														<div class="FilterMenu__items">
															<div class="FilterMenu__items--inn">
																<?php if ( 'radio' == $filter_type && isset( $filter_name ) ) { ?>
																	<?php foreach ( $filter_list as $filter_list_item ) { ?>
																		<?php
																		$item_checked = false;
																		$item_value   = '';
																		if ( ! empty( $filter_list_item['checked'] ) ) {
																			$item_checked = $filter_list_item['checked'];
																		}
																		if ( ! empty( $filter_list_item['value'] ) ) {
																			$item_value = $filter_list_item['value'];
																		}
																		if ( ! empty( $filter_list_item['title'] ) ) {
																			$item_title = $filter_list_item['title'];
																		}
																		if ( ! empty( $filter_list_item['onclick'] ) ) {
																			$item_onclick = $filter_list_item['onclick'];
																		}
																		if ( '' == $item_value ) {
																			$item_id = $filter_name . '-any';
																		} else {
																			$item_id = $filter_name . '-' . $item_value;
																		}
																		?>
																		<div class="checkbox FilterMenu__item">
																			<input
																				class="filter-item"
																				type="radio"
																				id="<?= esc_attr( $item_id ); ?>"
																				value="<?= esc_attr( $item_value ); ?>"
																				name="<?= esc_attr( $filter_name ); ?>"
																				<?php if ( isset( $item_title ) ) { ?>
																					title="<?= esc_attr( $item_title ); ?>"
																				<?php } ?>
																				<?php if ( $item_checked ) { ?>
																					checked
																				<?php } ?>
																			>
																			<label for="<?= esc_attr( $item_id ); ?>">
																				<span
																					class="FilterMenu__item-title"
																					<?php if ( isset( $item_onclick ) ) { ?>
																						onclick="<?= esc_attr( $item_onclick ); ?>"
																					<?php } ?>
																				>
																					<?php if ( isset( $item_title ) ) { ?>
																						<?= esc_html( $item_title ); ?>
																					<?php } ?>
																				</span>
																			</label>
																		</div>
																	<?php } ?>
																<?php } ?>
																<?php if ( 'link' == $filter_type && isset( $filter_name ) ) { ?>
																	<?php foreach ( $filter_list as $filter_list_item ) { ?>
																		<?php if ( isset( $filter_list_item['href'] ) && isset( $filter_list_item['title'] ) && isset( $filter_list_item['active'] ) ) { ?>
																			<a href="<?= esc_url( $filter_list_item['href'] ); ?>" class="checkbox FilterMenu__item
																			<?php if ( true == $filter_list_item['active'] ) { ?>
																				active
																			<?php } ?>
																			" active>
																				<span class="checkbox-label FilterMenu__item-title"><?= esc_html( $filter_list_item['title'] ); ?></span>
																			</a>
																		<?php } ?>
																	<?php } ?>
																<?php } ?>
															</div>
														</div>
													</div>
												</div>
											<?php } ?>
										<?php } ?>
									<?php } ?>
								</div>
								<?php if ( isset( $filter_count ) ) { ?>
									<div class="compact-header__count">
										<span id="countPosts">
											<?php if ( isset( $filter_count['value'] ) ) { ?>
												<?= esc_html( $filter_count['value'] ); ?>
											<?php } ?>
										</span>
										<?php if ( isset( $filter_count['title'] ) ) { ?>
											<?= esc_html( $filter_count['title'] ); ?>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						</div>
						<div class="compact-header__filters-apply">
							<a class="Button Button--full js-compact-header__apply">
								<span><?= esc_html( __( 'Apply', 'ms' ) ); ?></span>
							</a>
						</div>
					<?php } if ( isset( $menu_header ) ) { ?>
						<div class="compact-header__menu">
							<?php if ( isset( $menu_header['title'] ) ) { ?>
								<div class="compact-header__menu-title"><?= esc_html( $menu_header['title'] ); ?></div>
							<?php } ?>
							<?php if ( isset( $menu_header['items'] ) ) { ?>
								<div class="compact-header__menu-items">
									<ul>
										<?php foreach ( $menu_header['items'] as $menu_item ) { ?>
											<?php
											$menu_item_href   = $menu_item['href'];
											$menu_item_title  = $menu_item['title'];
											$menu_item_active = $menu_item['active'];
											?>
											<li
												<?php if ( isset( $menu_item_active ) ) { ?>
													<?php if ( $menu_item_active ) { ?>
														class="active"
													<?php } ?>
												<?php } ?>
											>
												<?php if ( isset( $menu_item_href ) ) { ?>
												<a href="<?= esc_url( $menu_item_href ); ?>">
													<?php } ?>
													<?php if ( isset( $menu_item_title ) ) { ?>
														<?= esc_html( $menu_item_title ); ?>
													<?php } ?>
													<?php if ( isset( $menu_item_href ) ) { ?>
												</a>
											<?php } ?>
											</li>
										<?php } ?>
									</ul>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>
