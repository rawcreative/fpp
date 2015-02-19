<?php namespace FPP\Plugins;

interface DependentInterface {
	/**
	 * Get the dependent's slug (unique identifier).
	 *
	 * @return string
	 */
	public function getSlug();
	/**
	 * Get an array of dependencies' slugs.
	 *
	 * @return string|array
	 */
	public function getDependencies();
}