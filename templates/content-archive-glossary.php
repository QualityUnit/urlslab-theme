<?php // @codingStandardsIgnoreLine
set_custom_source( 'layouts/Archive' );
include_once( get_template_directory() . '/lib/components/searchfield.php' );
$index = array();
$page_header_title = __( 'URLsLab plugin Glossary', 'urlslab' );
$page_header_text = __( 'If you are just getting started with help desk software or customer service in general, you might have a problem with all those new words. We have put together complete list of customer service terminology.', 'urlslab' );
if ( is_tax( 'glossary_categories' ) ) :
	$page_header_title = single_term_title( '', false );
	$page_header_text = term_description();
endif;
$page_header_args = array(
	'type' => 'lvl-1',
	'image' => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_glossary.png?ver=' . THEME_VERSION,
		'alt' => $page_header_title,
	),
	'title' => $page_header_title,
	'text' => $page_header_text,
);

$glossaryposts = get_posts(
	array(
		'post_type'   => 'glossary',
		'post_status' => 'publish',
		'numberposts' => -1,
		'order'       => 'ASC',
		'orderby'     => 'title',
	)
);

foreach ( $glossaryposts as $glossarypost ) {
	$posttitle = $glossarypost->post_title;
	$first_character = substr( $posttitle, 0, 1 );
	if ( ! in_array( $first_character, $index ) ) {
			$index[] = $first_character; 
	}
}
?>
<div id="archive" class="Archive" itemscope itemtype="https://schema.org/DefinedTermSet">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>
	<div class="Index">
		<div class="wrapper flex flex-align-center">
			<?= searchfield( __( 'Search glossary', 'urlslab' ) ); // @codingStandardsIgnoreLine ?> 
			<ul class="ml-s Index__top">
				<?php foreach ( $index as $index_item ) { ?>
					<li class="Index__top--item"><a href="#item-<?= esc_attr( $index_item ); ?>" title="<?= esc_attr( $index_item ); ?>"><?= esc_html( $index_item ); ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>

	<div class="wrapper Index__list">
		<?php
		foreach ( $index as $index_item ) {
			?>
		<div id="item-<?= esc_attr( $index_item ); ?>" data-searchGroup class="Index__list--group">
			<h3 class="Index__list--groupTitle"><?= esc_html( $index_item ); ?></h3>
			<ul>
			<?php
			foreach ( $glossaryposts as $glossarypost ) {
						$postid   = $glossarypost->id;
						$posttitle = $glossarypost->post_title;
						$first_character = substr( $posttitle, 0, 1 );

				if ( $first_character === $index_item ) {
					?>
				<li class="Index__list--item" itemscope="" itemtype="https://schema.org/DefinedTerm"><a href="<?= esc_url( get_permalink( $postid ) ); ?>" itemprop="url"><span itemprop="name" data-search><?= esc_html( $posttitle ); ?></span></a></li>
					<?php 
				} 
			} 
			?>
				</ul>
		</div>
		<?php } ?>
	</div>
</div>

<script>
	const searchField = document.querySelector( 'input[type=search]' );
	const searchGroups = document.querySelectorAll( '[data-searchGroup]' );
	
	searchField.addEventListener( 'input', ( ) => {
		const searchText = searchField.value.toLowerCase();

		searchGroups.forEach( ( group ) => {
			const searchItems = group.querySelectorAll( '[data-search]' );
			let searchItemsHidden;

			searchItems.forEach( ( item ) => {
				const itemText = item.innerText.toLowerCase();

				if ( ! itemText.includes( searchText ) ) {
					item.classList.add( 'hidden' );
					searchItemsHidden = group.querySelectorAll( '[data-search].hidden' );
					return false;
				}
				item.classList.remove( 'hidden' );
				searchItemsHidden = group.querySelectorAll( '[data-search].hidden' );
			} );

			if ( searchItems.length === searchItemsHidden.length ) {
				group.classList.add( 'hidden' );
				return false;
			}

			group.classList.remove( 'hidden' );
		} );
	} );
</script>
