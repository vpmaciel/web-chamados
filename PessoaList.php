<?php
require_once 'classes/Connection.php';
require_once 'classes/Pessoa.php';

class PessoaList
{
    private $html;
    
    public function __construct()
    {
        $this->html = file_get_contents('html/PessoaList.html');
    }
    
    public function delete($param)
    {
        try
        {
            $id = (int) $param['id'];
            Pessoa::delete($id);
        }
        catch (Exception $e)
        {
            print $e->getMessage();
        }
    }
    
    public function load()
    {
        try
        {
            $campo = isset($_REQUEST['campo']) ? $_REQUEST['campo'] : null;
            $valor = isset($_REQUEST['valor']) ? $_REQUEST['valor'] : null;
         
            if(isset($valor) && strlen($valor) > 0)
            {
                $pessoas = Pessoa::search($campo, $valor);                    

                $items = '';
                foreach ($pessoas as $pessoa)
                {  
                    $item = file_get_contents('html/PessoaItem.html');
                    $item = str_replace( '{id}',    $pessoa['id'], $item);
                    $item = str_replace( '{nome}',    $pessoa['nome'], $item);
                    $item = str_replace( '{endereco}',    $pessoa['endereco'], $item);
                    $item = str_replace( '{bairro}',    $pessoa['bairro'], $item);
                    $item = str_replace( '{telefone}',    $pessoa['telefone'], $item);
                    
                    $items .= $item;
                }                
                $this->html = str_replace('{items}', $items, $this->html);
            }  else if(isset($campo)) {
                print("<script>alert('Digite um termo para pesquisar !');</script>");
            }

            $items = '';
            $this->html = str_replace('{items}', $items, $this->html);
        }
        catch (Exception $e)
        {
            print $e->getMessage();
        }
    }
    
    public function show()
    {
        $this->load();
        print $this->html;
    }
}
