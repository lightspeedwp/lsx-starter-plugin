<?php
/**
 * {class-name} helper functions
 *
 * @package   {class-name}
 * @author    LightSpeed
 * @license   GPL3
 * @link
 * @copyright 2017 LightSpeed
 **/

/**
 * {plugin-label} class autoloader.
 * It locates and finds class via classes folder structure.
 *
 * @param string $class class name to be checked and loaded.
 */
function {prefix_small}_autoload_class( $class ) {

	$parts = explode( '\\', $class );

	if ( '{namespace}' === $parts[0] ) {
		$path = {PREFIX_CAPS}_PATH . 'includes/classes/';
		array_shift( $parts );
		$name = array_shift( $parts );

		if ( file_exists( $path . $name ) ) {
			$file = str_replace( '_', '-', strtolower( array_pop( $parts ) ) );
			if ( ! empty( $parts ) ) {
				$path .= '/' . implode( '/', $parts );
			}
			$class_file = $path . $name . '/class-' . $file . '.php';
			if ( file_exists( $class_file ) ) {
				include_once $class_file;

				return;
			}
		}
		$name = str_replace( '_', '-', strtolower( $name ) );

		if ( file_exists( {PREFIX_CAPS}_PATH . 'includes/classes/class-' . $name . '.php' ) ) {
			include_once {PREFIX_CAPS}_PATH . 'includes/classes/class-' . $name . '.php';
		}
	}

}

/**
 * Tour Operator wrapper to load and manipulate the overall instances.
 *
 * @since 1.0.7
 * @return  \lsx\Tour_Operator  A single instance
 */
function {prefix_small}() {
	// Init tour operator and return object.
	return \{namespace}\{class-name}::init();
}