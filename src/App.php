<?php
namespace tmc\bs\src;

/**
 * @author jakubkuranda@gmail.com
 * Date: 04.06.2018
 * Time: 12:02
 */

use shellpress\v1_3_71\ShellPress;
use tmc\bs\src\Components\Display;
use tmc\bs\src\Components\Settings;
use tmc\bs\src\Components\ShortCodes;
use tmc_bs_apf;

class App extends ShellPress {

	/** @var Settings */
	public $settings;

	/** @var ShortCodes */
	public $shortCodes;

	/** @var Display */
	public $display;

	/**
	 * Called automatically after core is ready.
	 *
	 * @return void
	 */
	protected function onSetUp() {

		//  ----------------------------------------
		//  Components
		//  ----------------------------------------

		$this->settings     = new Settings( $this );
		$this->shortCodes   = new ShortCodes( $this );
		$this->display      = new Display( $this );

		//  ----------------------------------------
		//  Options pages
		//  ----------------------------------------

		if( is_admin() && ! wp_doing_ajax() && ! wp_doing_cron() ){ //  Keep it lightweight.

			$this::s()->requireFile( 'vendor/tmc/admin-page-framework/admin-page-framework.php', 'TMC_v1_0_6_AdminPageFramework' );

			new tmc_bs_apf( $this::s()->options->getOptionsKey(), $this::s()->getMainPluginFile() );

		}

	}

}