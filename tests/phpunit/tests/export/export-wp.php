<?php

/**
 * Test export_wp functionality
 *
 * @group export
 */
class Tests_Export_Export_Wp extends WP_UnitTestCase {
	function setUp() {
		parent::setUp();
		require_once ABSPATH . '/wp-admin/includes/export.php';
	}

	/**
	 * export_wp() shall work when running more than once.
	 *
	 * As of ticket #33563 calling `export_wp()` multiple times at one runtime causes WP to die.
	 * The function has been refactored and should no longer be such a pain.
	 *
	 * @see https://core.trac.wordpress.org/ticket/33563
	 *
	 * @runInSeparateProcess
	 */
	function test_it_can_run_multiple_times() {

		ob_start();
		export_wp();
		$export_content = ob_get_clean();

		ob_start();
		export_wp();

		$this->assertEquals( $export_content, ob_get_clean() );
	}
}