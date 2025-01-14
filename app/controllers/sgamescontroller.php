<?php
use controllers\Controller;

include 'autoload.php';

class SgamesController extends Controller{
    public function index() {
        require __DIR__ . '/../views/sgames.php';
    }
}