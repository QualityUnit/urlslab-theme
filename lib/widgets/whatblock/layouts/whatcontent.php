<?php 
function whatcontent( $attr ) {
		return '
			<div class="WhatBlock">
				<div class="WhatBlock__icon">
					<span class="icn-lightbulb"></span>
				</div>
				<h3>' . esc_html( $attr['header'] ) . '</h3>
				<p>' . esc_html( $attr['content'] ) . '</p>
			</div>
		';
}
