<?php
use controllers\Controller;

include 'autoload.php';

class MgamesController extends Controller {
    public function index() {
        require __DIR__ . '/../views/mgames.php';
    }
} 