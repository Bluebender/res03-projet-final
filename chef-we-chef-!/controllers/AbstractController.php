<?php  
   
abstract class AbstractController  
{  
    protected function render(string $view, array $values) : void
    {  
        $template = $view;
        $data = $values;
        require "templates/layout.phtml";
    }  
    protected function adminRender(string $view, array $values) : void
    {  
        $template = $view;
        $data = $values;
        require "templates/admin/layout.phtml";
    }  
}