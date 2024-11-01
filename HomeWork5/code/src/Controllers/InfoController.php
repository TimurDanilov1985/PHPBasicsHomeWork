<?php

namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Models\Info;
use Geekbrains\Application1\Render;

class InfoController {

    public function actionIndex() {
        $render = new Render();

        $info = new Info();

        $server = $info->getServer();
        $phpVersion = $info->getPhpVersion();
        $browser = $info->getBrowser();
        
        return $render->renderPage('info.twig', ['server' => $server, 'php' => $phpVersion, 'browser'=> $browser]);
    }
}