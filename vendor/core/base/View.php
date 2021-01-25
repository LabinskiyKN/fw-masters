<?php


namespace vendor\core\base;


class View
{
    public $route;
    public $view;
    public $layout;

    public function __construct($route, $layout = '', $view='')
    {
        $this->route = $route;
        $this->view = $view;
        if($layout === false){
            $this->layout = false;
        }else{
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render($vars){
        extract($vars);
        $file_view = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        ob_start();
        if(is_file($file_view)){
            require $file_view;
        }else{
            echo "Не найден вид <b>$file_view</b>";
        }
        $content = ob_get_clean();
        if(false !== $this->layout){
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($file_layout)) {
                require $file_layout;
            } else {
                echo "Не найден шаблон <b>$file_layout</b>";
            }
        }
    }
}