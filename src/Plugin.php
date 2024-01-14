<?php

namespace Alban\SimplisitiGTM;

use Alban\Simplisiti\Support\Plugin\Plugin as BasePlugin;
use Alban\Simplisiti\Support\Plugin\Manipulate\ManipulateSetting;
use Alban\Simplisiti\Support\Plugin\Manipulate\ManipulateHeader;
use Alban\Simplisiti\Support\Plugin\Managers\SettingManager;
use Alban\Simplisiti\Support\Plugin\Managers\HeadManager;

class Plugin extends BasePlugin implements ManipulateSetting, ManipulateHeader
{
    public function withSettings(SettingManager $settingManager): void {
        $settingManager->settingEntry($this, label: 'GTM', description: 'Google Tag Manager Settings');

        $settingManager->addSetting($this, name: 'head', type: 'textarea', label: 'Head', description: 'Copy the heat code from Google Tag Manager', required: true);
        $settingManager->addSetting($this, name: 'body', type: 'textarea', label: 'Body', description: 'Copy the body code from Google Tag Manager', required: true);
    }

    public function withHeaders(HeadManager $headManager): void {
        $head = $this->getSettingValue('head');

        if ($head) {
            $headManager->addHead($head);
        }
    }

    public function withBody(BodyManager $bodyManager): void {
        $body = $this->getSettingValue('body');

        if ($body) {
            $bodyManager->addBody($body);
        }
    }
}
