<?php

namespace hyii\base;

use hyii\base\WebController;

class PublicWebController extends WebController {

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }


}