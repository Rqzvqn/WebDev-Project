<?php


use services\SgamesService;

include 'autoload.php';

class SgamesController
{
    private SgamesService $sgames_service;

    public function __construct() {
        $this->sgames_service = new SgamesService();
    }

    public function index() {
        echo json_encode($this->sgames_service->getAll());
    }
}