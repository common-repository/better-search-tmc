<?php
/**
 * Plugin Name: Better Search TMC
 * Description: Easy to setup, lightweight front-end search solution.
 * Version:     1.0.52
 * Plugin URI:  https://themastercut.co/plugins/better-search-tmc
 * Author URI:  https://themastercut.co
 * Author:      TheMasterCut.co
 * License:     GPL-2.0+
 * Text Domain: tmc_bs
 * Domain Path: /langugages
 *
 * Better Search TMC is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * Better Search TMC is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with The real Maintenance Mode TMC. If not, see https://www.gnu.org/licenses/old-licenses/gpl-2.0.html.
 */

defined( 'ABSPATH' ) or die( 'Access denied. Scripts are not allowed.' );

//  ----------------------------------------
//  Requirements
//  ----------------------------------------

require __DIR__ . '/vendor/autoload.php';   //  Composer

$requirementChecker = new ShellPress_RequirementChecker();

$checkPHP   = $requirementChecker->checkPHPVersion( '5.3', 'Better Search TMC requires PHP version >= 5.3' );
$checkWP    = $requirementChecker->checkWPVersion( '4.8', 'Better Search TMC requires WP version >= 4.8' );

if( ! $checkPHP || ! $checkWP ) return;

//  ----------------------------------------
//  ShellPress
//  ----------------------------------------

\tmc\bs\src\App::initShellPress( __FILE__, 'tmc_bs', '1.0.52' );
