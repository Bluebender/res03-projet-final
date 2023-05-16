<?php  
   
abstract class AbstractController  
{  
    protected function render(string $view, array $values) : void
    {  
        $template = $view;
        $data = $values;
        require "templates/layout.phtml";
    }  
    
    protected function jsRender(array $values)
    {  
        echo json_encode($values);
    }
    
    protected function sanitize(string $value) : string
    {  
        return htmlspecialchars($value);
    }
    
}