<?php
/*
Plugin Name: Kiss Share
Description: No premium, no trackers, just sharing. Keep it simple, stupid!
Version: 0.1.1
Author: Sascha Englert
Author URI: https://englerts.de
License: GPL3
Licencse URI: https://www.gnu.org/licenses/gpl-3.0.html
 
Kiss Share is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.
 
Kiss Share is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Kiss Share. If not, see https://www.gnu.org/licenses/gpl-3.0.html.
 */

 

final class KissShare {
  const PLUGIN = "kiss-share";
  const REQUIRED = "manage_options";
  const PLUGIN_PAGE_TITLE = "Kiss Share Options";
  const PLUGIN_MENU_TITLE = "Kiss Share";

  public static function Instance() {
    static $instance = null;
    if ($instance === null) {
      $instance = new KissShare();
    }

    return $instance;
  }

    /**
     *
     */
    private function __construct() {
    register_activation_hook(__FILE__, 'KissShare::activate');
    register_deactivation_hook(__FILE__, 'KissShare::deactivate');
    register_uninstall_hook(__FILE__, 'KissShare::uninstall');
  }

  static function activate() {
    add_action('wp-head', 'KissShare::head');
    add_action('wp_footer', 'KissShare::footer');
    add_action('admin_menu', 'KissShare::options');
  }

  static private function head() {

  }

  static private function footer() {

  }

  static private function options() {
      add_options_page(self::PLUGIN_PAGE_TITLE, self::PLUGIN_MENU_TITLE, self::REQUIRED, self::PLUGIN_MENU_TITLE, "KissShare:renderOptionsMenu");
  }

  static private function renderOptionsMenu() {
    // check user capabilities
    if (!current_user_can(self::REQUIRED)) {
      return;
  }
  ?>
  <div class="wrap">
      <h1><?= esc_html(get_admin_page_title()); ?></h1>
      <form action="options.php" method="post">
          <?php
          // output security fields for the registered setting "wporg_options"
          settings_fields('wporg_options');
          // output setting sections and their fields
          // (sections are registered for "wporg", each field is registered to a specific section)
          do_settings_sections('wporg');
          // output save settings button
          submit_button('Save Settings');
          ?>
      </form>
  </div>
  <?php
  }

  static function deactivate() {

  }

  static function uninstall() {
    
  }
}

KissShare::Instance();
