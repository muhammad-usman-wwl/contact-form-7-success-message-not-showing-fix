<?php
/**
 * Plugin Name: SDCC Debug Helper (demo troublemaker)
 * Description: A tiny DEMO plugin built for the "Contact Form 7 — Success Message Not Showing" tutorial. It stands in for any real plugin that leaves debug output switched on: it prints an HTML comment into Contact Form 7's REST API responses. That stray output corrupts the JSON, so CF7's JavaScript cannot read the result — the mail is actually sent, but the success message never appears and the browser console shows a JSON parse error. Deactivate it to "fix" the site.
 * Version: 1.0.0
 * Author: Simplified Dev Code Camp
 */

add_filter( 'rest_pre_serve_request', 'sdcc_debug_helper_pollute_cf7_response', 10, 4 );

function sdcc_debug_helper_pollute_cf7_response( $served, $result, $request, $server ) {
	$route = $request->get_route();
	if ( false !== strpos( $route, '/contact-form-7/v1/contact-forms/' ) ) {
		// The bug: raw output inside a REST response. The JSON that follows
		// is no longer valid JSON, so the browser cannot parse it.
		echo "\n<!-- SDCC Debug Helper: request logged -->\n";
	}
	return $served;
}
