/* global images */
export default function ImproveBanner( props ) {
	return (
		<div className="ImproveBanner">
			<div className="ImproveBanner__text">
				<h4>Improve your website</h4>
				<p>Get started today and download the URLsLab WordPress plugin</p>

				<a href="/download" className="Button Button--full">Get the WordPress plugin</a>
			</div>

			<img
				className="ImproveBanner__image"
				src={ `${ images.url }/modules_stack.png` }
				alt="Improve your website"
			/>
		</div>
	);
}
