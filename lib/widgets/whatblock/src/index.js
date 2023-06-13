import { useBlockProps } from '@wordpress/block-editor';

import WhatBlock from './layouts/frontend/WhatBlock.jsx';
import './scss/editor.scss';
import './scss/style.scss';

const { registerBlockType } = wp.blocks;

registerBlockType( 'qu/whatblock', {
	apiVersion: 2,
	title: 'What is Block',
	icon: 'lightbulb',
	category: 'widgets',
	attributes: {
		header: {
			type: 'string',
			default: 'What can',
		},
		content: {
			type: 'string',
			default: 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta laboriosam neque accusantium modi, quae maxime illo accusamus error quasi esse debitis nostrum exercitationem tempore expedita sunt autem, voluptates porro? Odit, culpa atque.',
		},
	},

	edit: ( props ) => {
		const blockProps = useBlockProps();   //eslint-disable-line
		return (
			<div { ...blockProps }>
				<WhatBlock { ...props } />
			</div>
		);
	},

	save: ( ) => {
		return null;
	},
} );
