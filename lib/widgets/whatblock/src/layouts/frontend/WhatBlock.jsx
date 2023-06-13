import BulbIcon from '../../elements/BulbIcon.jsx';

const { TextareaControl } = wp.components;

export default function WhatBlock( props ) {
	const { attributes, setAttributes } = props;
	const { header, content } = attributes;
	return (
		<div className="WhatBlock">
			<BulbIcon className="WhatBlock__icon" />
			<h3>
				<TextareaControl
					autoFocus
					value={ header }
					rows="1"
					onFocus={ ( e ) => e.currentTarget.select() }
					onChange={ ( value ) => setAttributes( { header: value } ) }
				/>
			</h3>
			<p>
				<TextareaControl
					value={ content }
					rows="3"
					onFocus={ ( e ) => e.currentTarget.select() }
					onChange={ ( value ) => setAttributes( { content: value } ) }
				/>
			</p>
		</div>
	);
}
