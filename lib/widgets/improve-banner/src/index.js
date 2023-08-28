import { useBlockProps } from '@wordpress/block-editor';

import ImproveBanner from './layouts/frontend/ImproveBanner.jsx';
import './scss/editor.scss';
import './scss/style.scss';

const { registerBlockType } = wp.blocks;

registerBlockType( 'qu/improvebanner', {
	apiVersion: 2,
	title: 'Improve Banner',
	icon: 'tickets',
	category: 'widgets',
	attributes: {
		title: {
			type: 'string',
			default: 'Improve your website',
		},
		content: {
			type: 'string',
			default: 'Get started today and download the URLsLab WordPress plugin',
		},
		button: {
			type: 'string',
			default: 'Get the WordPress plugin',
		},
	},

	edit: ( props ) => {
		const blockProps = useBlockProps();   //eslint-disable-line
		return (
			<div { ...blockProps }>
				<ImproveBanner { ...props } />
			</div>
		);
	},

	save: ( ) => {
		return null;
	},
} );
