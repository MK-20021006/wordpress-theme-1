<?php
/**
 * Sanitizer to add the 'no-icon' to all links that contain images.
 */
class AMP_Link_Img_No_Icon_Class_Sanitizer extends AMP_Base_Sanitizer {

	/**
	 * Sanitize.
	 */
	public function sanitize() {
		$xpath = new DOMXPath( $this->dom );

		/**
		 * Link element.
		 *
		 * @var DOMElement $link
		 */
		foreach ( $xpath->query( '//a[ .//amp-img or .//amp-anim ]' ) as $link ) {
			$link->setAttribute( 'class', trim( (string) $link->getAttribute( 'class' ) . ' no-icon' ) );
		}
	}
}