<?php

require_once 'classes/Connection.php';
require_once 'classes/Pessoa.php';
require_once 'classes/Cidade.php';


class HomeForm
{
    private $html;
    private $data;
    
    public function __construct()
    {
        $this->html = file_get_contents('html/HomeForm.html');
        $this->data = [];         
        
    }
    
    public function edit($param)
    {        
    }
    
    public function save($param)
    {
     
    }
    
    public function show()
    {
        print $this->html;
    }
}
