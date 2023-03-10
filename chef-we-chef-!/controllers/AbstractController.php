<?php  
   
abstract class AbstractController  
{  
    protected function render(string $view, array $values) : void
    {  
        $template = $view;
        $data = $values;  
        require "templates/visitor/layout.phtml";  
    }  
}