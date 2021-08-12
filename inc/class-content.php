<?php

namespace WildWolf\WordPress\PerformanceTweaks;

class Content {
	use Singleton;

	/**
	 * Constructed during `init`
	 */
	private function __construct() {
		$this->init();
	}

	public function init(): void {
		$this->remove_forceful_capitalization();
		$this->remove_generator();
		$this->remove_adjacent_posts_rel_link();
		$this->skip_found_rows();
	}

	private function remove_forceful_capitalization(): void {
		remove_filter( 'the_content', 'capital_P_dangit', 11 );
		remove_filter( 'the_title', 'capital_P_dangit', 11 );
		remove_filter( 'wp_title', 'capital_P_dangit', 11 );
		remove_filter( 'document_title', 'capital_P_dangit', 11 );
		remove_filter( 'comment_text', 'capital_P_dangit', 31 );
		remove_filter( 'widget_text_content', 'capital_P_dangit', 11 );
	}

	private function remove_generator(): void {
		/** @var string[] */
		static $actions = [ 'rss2_head', 'commentsrss2_head', 'rss_head', 'rdf_header', 'atom_head', 'comments_atom_head', 'opml_head', 'app_head' ];
		foreach ( $actions as $action ) {
			remove_action( $action, 'the_generator' );
		}

		remove_action( 'wp_head', 'wp_generator' );

		add_filter( 'the_generator', [ $this, 'the_generator' ] );
	}

	private function remove_adjacent_posts_rel_link(): void {
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
	}

	private function skip_found_rows(): void {
		add_filter( 'wp_link_query_args', [ $this, 'wp_link_query_args' ], 10, 1 );
	}

	/**
	 * Filters the output of the XHTML generator tag for display.
	 */
	public function the_generator(): string {
		return '';
	}

	/**
	 * @param mixed[] $query An array of WP_Query arguments
	 * @return mixed[]
	 */
	public function wp_link_query_args( $query ) {
		$query['no_found_rows'] = true;
		return $query;
	}
}
