<?php
/**
 * @package kcdd
 */
namespace Inc;

final class Init
{

	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function getServices() 
	{
		return [
			Base\SettingsLinks::class,
			Base\Enqueue::class,
			Base\Settings::class,
			Orders\RequestPayment::class,
			Orders\ProcessPayout::class,
			Data\Table::class,
			Admin\Page::class,
			Admin\PayWidget::class,
			Admin\PageSettings::class,
			Admin\PagePayout::class,
		];
	}

	/**
	 * Loop through the classes, initialize them, 
	 * and call the register() method if it exists
	 * @return
	 */
	public static function register_services() 
	{
		foreach ( self::getServices() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param  class $class    class from the services array
	 * @return class instance  new instance of the class
	 */
	private static function instantiate( $class )
	{
		$service = new $class();

		return $service;
	}
}