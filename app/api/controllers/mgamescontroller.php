<?php

use services\MgameService;

include 'autoload.php';

class MgamesController {
    private MgameService $mgame_Service;

    public function __construct()
    {
        $this->mgame_Service = new MgameService();
    }

    public function index() {
        echo json_encode($this->mgame_Service->getAll());
    }
}