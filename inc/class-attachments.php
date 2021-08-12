<?php

namespace WildWolf\WordPress\PerformanceTweaks;

final class Attachments {
	use Singleton;

	/**
	 * Constructed during `init`
	 */
	private function __construct() {
		$this->init();
	}

	private function init(): void {
		add_action( 'pre_get_posts', [ $this, 'pre_get_posts' ] );
	}

	/**
	 * @see https://core.trac.wordpress.org/ticket/39358
	 */
	public function pre_get_posts(): void {
		remove_filter( 'posts_clauses', '_filter_query_attachment_filenames' );
	}
}
