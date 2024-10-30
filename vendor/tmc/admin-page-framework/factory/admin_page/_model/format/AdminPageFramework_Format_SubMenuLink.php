<?php 
/**
	Admin Page Framework v3.8.19 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/tmcapf>
	Copyright (c) 2013-2019, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class TMC_v1_0_6_AdminPageFramework_Format_SubMenuPage extends TMC_v1_0_6_AdminPageFramework_Format_Base {
    static public $aStructure = array('page_slug' => null, 'type' => 'page', 'title' => null, 'page_title' => null, 'menu_title' => null, 'screen_icon' => null, 'capability' => null, 'order' => null, 'show_page_heading_tab' => true, 'show_in_menu' => true, 'href_icon_32x32' => null, 'screen_icon_id' => null, 'show_page_title' => null, 'show_page_heading_tabs' => null, 'show_in_page_tabs' => null, 'in_page_tab_tag' => null, 'page_heading_tab_tag' => null, 'disabled' => null, 'attributes' => null, 'style' => null, 'script' => null, 'show_debug_info' => null,);
    static public $aScreenIconIDs = array('edit', 'post', 'index', 'media', 'upload', 'link-manager', 'link', 'link-category', 'edit-pages', 'page', 'edit-comments', 'themes', 'plugins', 'users', 'profile', 'user-edit', 'tools', 'admin', 'options-general', 'ms-admin', 'generic',);
    public $aSubMenuPage = array();
    public $oFactory;
    public $iParsedIndex = 1;
    public function __construct() {
        $_aParameters = func_get_args() + array($this->aSubMenuPage, $this->oFactory, $this->iParsedIndex);
        $this->aSubMenuPage = $_aParameters[0];
        $this->oFactory = $_aParameters[1];
        $this->iParsedIndex = $_aParameters[2];
    }
    public function get() {
        return $this->_getFormattedSubMenuPageArray($this->aSubMenuPage);
    }
    protected function _getFormattedSubMenuPageArray(array $aSubMenuPage) {
        $aSubMenuPage = $aSubMenuPage + array('show_page_title' => $this->oFactory->oProp->bShowPageTitle, 'show_page_heading_tabs' => $this->oFactory->oProp->bShowPageHeadingTabs, 'show_in_page_tabs' => $this->oFactory->oProp->bShowInPageTabs, 'in_page_tab_tag' => $this->oFactory->oProp->sInPageTabTag, 'page_heading_tab_tag' => $this->oFactory->oProp->sPageHeadingTabTag, 'capability' => $this->oFactory->oProp->sCapability,) + self::$aStructure;
        $aSubMenuPage['page_slug'] = $this->sanitizeSlug($aSubMenuPage['page_slug']);
        $aSubMenuPage['screen_icon_id'] = trim($aSubMenuPage['screen_icon_id']);
        return array('href_icon_32x32' => $aSubMenuPage['screen_icon'], 'screen_icon_id' => $this->getAOrB(in_array($aSubMenuPage['screen_icon'], self::$aScreenIconIDs), $aSubMenuPage['screen_icon'], 'generic'), 'capability' => $this->getElement($aSubMenuPage, 'capability', $this->oFactory->oProp->sCapability), 'order' => $this->getAOrB(is_numeric($aSubMenuPage['order']), $aSubMenuPage['order'], $this->iParsedIndex * 10), 'show_debug_info' => $this->getAOrB(isset($aSubMenuPage['show_debug_info']), $aSubMenuPage['show_debug_info'], $this->oFactory->oProp->bShowDebugInfo),) + $aSubMenuPage;
    }
    }
    class TMC_v1_0_6_AdminPageFramework_Format_SubMenuLink extends TMC_v1_0_6_AdminPageFramework_Format_SubMenuPage {
        static public $aStructure = array('type' => 'link', 'title' => null, 'href' => null, 'capability' => null, 'order' => null, 'show_page_heading_tab' => true, 'show_in_menu' => true,);
        public $aSubMenuLink = array();
        public $oFactory;
        public $iParsedIndex = 1;
        public function __construct() {
            $_aParameters = func_get_args() + array($this->aSubMenuLink, $this->oFactory, $this->iParsedIndex);
            $this->aSubMenuLink = $_aParameters[0];
            $this->oFactory = $_aParameters[1];
            $this->iParsedIndex = $_aParameters[2];
        }
        public function get() {
            return $this->_getFormattedSubMenuLinkArray($this->aSubMenuLink);
        }
        protected function _getFormattedSubMenuLinkArray(array $aSubMenuLink) {
            if (!filter_var($aSubMenuLink['href'], FILTER_VALIDATE_URL)) {
                return array();
            }
            return array('capability' => $this->getElement($aSubMenuLink, 'capability', $this->oFactory->oProp->sCapability), 'order' => isset($aSubMenuLink['order']) && is_numeric($aSubMenuLink['order']) ? $aSubMenuLink['order'] : $this->iParsedIndex * 10,) + $aSubMenuLink + self::$aStructure;
        }
    }
    