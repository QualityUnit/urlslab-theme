<?php // @codingStandardsIgnoreLine
set_custom_source('layouts/Archive');
include_once( get_template_directory( ) . '/lib/components/searchfield.php' );
$index = [];
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

$posts = get_posts([
		'post_type'   => 'glossary',
		'post_status' => 'publish',
		'numberposts' => -1,
		'order'       => 'ASC',
		'orderby'     => 'title'
	]);

	foreach( $posts as $post ) {
		$title = $post->post_title;
		$firstCharacter = substr($title, 0, 1);
		if ( ! in_array( $firstCharacter, $index ) ) {
				$index[] = $firstCharacter; 
		}
	}
?>
<div id="archive" class="Archive" itemscope itemtype="https://schema.org/DefinedTermSet">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>
	<div class="Index">
		<div class="wrapper flex flex-align-center">
			<?= searchField( __( 'Search glossary', 'urlslab' ) ) ?>
			<ul class="ml-s Index__top">
				<?php foreach ( $index as $indexItem ) { ?>
					<li class="Index__top--item"><a href="#item-<?= esc_attr( $indexItem ); ?>" title="<?= esc_attr( $indexItem ); ?>"><?= esc_html( $indexItem ); ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>

	<div class="wrapper Index__list">
		<?php
				foreach ( $index as $indexItem ) {
		?>
		<div id="item-<?= esc_attr( $indexItem ); ?>" data-searchGroup class="Index__list--group">
			<h3 class="Index__list--groupTitle"><?= esc_html( $indexItem ); ?></h3>
			<ul>
				<?php
						foreach ( $posts as $post ) {
							$id   = $post->id;
							$title = $post->post_title;
							$firstCharacter = substr( $title, 0, 1 );

						if ( $firstCharacter === $indexItem ) {
				?>
				<li class="Index__list--item" itemscope="" itemtype="https://schema.org/DefinedTerm"><a href="<?= esc_url( get_permalink( $id ) ); ?>" itemprop="url"><span itemprop="name" data-search><?= esc_html( $title ); ?></span></a></li>
				<?php } } ?>
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