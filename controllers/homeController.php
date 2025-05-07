<?php
  require APP_ROOT . '/vendor/autoload.php';

class HomeController extends BaseController {
    private $menuModel;
    private $orderItemModel;
    private $categoryModel;    
    public function __construct() {
        $this->menuModel = new Menu();
        $this->orderItemModel = new OrderItem();
        $this->categoryModel = new Category();
    }
    public function index($queryParams){
        $this->data['menuItems'] = $this->menuModel->getAll();
        $this->data['categories'] = $this->categoryModel->getAll();

        $this->render('index','home');
        return;
    }

    public function about(){
        $this->render('about','home');
        return;
    }

    public function contact(){
        $this->render('contact','home');
        return;
    }
    public function menu(){
        $this->data['menuItems'] = $this->menuModel->getAll();
        $this->data['categories'] = $this->categoryModel->getAll();
        $this->render('menu','home');
        return;
    }
    public function reservation(){
        $this->render('reservation','home');
        return;
    }
}

?>