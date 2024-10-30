<?php 
/**
	Admin Page Framework v3.8.19 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/tmcapf>
	Copyright (c) 2013-2019, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class TMC_v1_0_6_AdminPageFramework_Factory_View__SettingNotice extends TMC_v1_0_6_AdminPageFramework_FrameworkUtility {
    public $oFactory;
    public function __construct($oFactory, $sActionHookName = 'admin_notices') {
        $this->oFactory = $oFactory;
        add_action($sActionHookName, array($this, '_replyToPrintSettingNotice'));
    }
    public function _replyToPrintSettingNotice() {
        if (!$this->_shouldProceed()) {
            return;
        }
        $this->oFactory->oForm->printSubmitNotices();
    }
    private function _shouldProceed() {
        if (!$this->oFactory->isInThePage()) {
            return false;
        }
        if ($this->hasBeenCalled(__METHOD__)) {
            return false;
        }
        return isset($this->oFactory->oForm);
    }
    }
    