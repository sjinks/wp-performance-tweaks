<?php
/*
Plugin name: Performance tweaks
Description: Performance tweaks for WordPress
Author: Volodymyr Kolesnykov
Author URI: https://wildwolf.name/
Version: 1.0.0
*/

use WildWolf\WordPress\PerformanceTweaks\Attachments;
use WildWolf\WordPress\PerformanceTweaks\BrowseHappy;
use WildWolf\WordPress\PerformanceTweaks\Content;
use WildWolf\WordPress\PerformanceTweaks\DeferTermCounting;
use WildWolf\WordPress\PerformanceTweaks\DisablePings;
use WildWolf\WordPress\PerformanceTweaks\Emoji;
use WildWolf\WordPress\PerformanceTweaks\Login;
use WildWolf\WordPress\PerformanceTweaks\Plugin;
use WildWolf\WordPress\PerformanceTweaks\PostMeta;
use WildWolf\WordPress\PerformanceTweaks\ResourceHints;
use WildWolf\WordPress\PerformanceTweaks\Scripts;
use WildWolf\WordPress\PerformanceTweaks\Singleton;

if ( defined( 'ABSPATH' ) ) {
	spl_autoload_register( function ( string $class ) {
		/** @psalm-var array<class-string,string> */
		static $class_map = [
			Attachments::class       => 'class-attachments.php',
			BrowseHappy::class       => 'class-browsehappy.php',
			Content::class           => 'class-content.php',
			DeferTermCounting::class => 'class-defertermcounting.php',
			DisablePings::class      => 'class-disablepings.php',
			Emoji::class             => 'class-emoji.php',
			Login::class             => 'class-login.php',
			Plugin::class            => 'class-plugin.php',
			PostMeta::class          => 'class-postmeta.php',
			ResourceHints::class     => 'class-resourcehints.php',
			Scripts::class           => 'class-scripts.php',
			Singleton::class         => 'trait-singleton.php',
		];

		if ( isset( $class_map[ $class ] ) ) {
			/** @psalm-suppress UnresolvableInclude */
			require_once __DIR__ . '/inc/' . $class_map[ $class ];
		}
	});

	Plugin::instance();
}
