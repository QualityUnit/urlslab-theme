/* global images */
const { TextareaControl } = wp.components;

export default function ImproveBanner( { attributes, setAttributes } ) {
	const { title, content, button } = attributes;
	return (
		<div className="ImproveBanner">
			<div className="ImproveBanner__text">
				<h4><TextareaControl
					autoFocus
					value={ title }
					rows="1"
					onFocus={ ( e ) => e.currentTarget.select() }
					onChange={ ( value ) => setAttributes( { title: value } ) }
				/></h4>
				<p>
					<TextareaControl
						value={ content }
						rows="3"
						onFocus={ ( e ) => e.currentTarget.select() }
						onChange={ ( value ) => setAttributes( { content: value } ) }
					/>
				</p>
			</div>

			<img
				className="ImproveBanner__image"
				src={ `${ images.url }/modules_stack.png` }
				alt="Improve your website"
			/>
		</div>
	);
}
