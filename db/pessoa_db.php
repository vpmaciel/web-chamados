<?php

function get_pessoa($id)
{
    $conn = pg_connect('host=localhost port=5432 dbname=livro user=postgres password=');
    
    $result = pg_query($conn, "SELECT * FROM pessoa WHERE id = '{$id}'");
    $pessoa = pg_fetch_assoc($result);
    pg_close($conn);
    return $pessoa;
}

function exclui_pessoa($id)
{
    $conn = pg_connect('host=localhost port=5432 dbname=livro user=postgres password=');
    
    $result = pg_query($conn, "DELETE FROM pessoa WHERE id = '{$id}'");
    pg_close($conn);
    return $result;
}

function insert_pessoa($pessoa)
{
    $conn = pg_connect('host=localhost port=5432 dbname=livro user=postgres password=');
    
    $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone,
                                email, id_cidade)
                        VALUES ( '{$pessoa['id']}', '{$pessoa['nome']}', '{$pessoa['endereco']}',
                    '{$pessoa['bairro']}', '{$pessoa['telefone']}', '{$pessoa['email']}', '{$pessoa['id_cidade']}')";
    $result = pg_query($conn, $sql);
    pg_close($conn);
    
    return $result;
}

function update_pessoa($pessoa)
{
    $conn = pg_connect('host=localhost port=5432 dbname=livro user=postgres password=');
    
    $sql = "UPDATE pessoa SET nome = '{$pessoa['nome']}',
                          endereco = '{$pessoa['endereco']}',
                          bairro = '{$pessoa['bairro']}',
                          telefone = '{$pessoa['telefone']}',
                          email = '{$pessoa['email']}',
                          id_cidade = '{$pessoa['id_cidade']}'
                WHERE id = '{$pessoa['id']}'";
    
    $result = pg_query($conn, $sql);
    pg_close($conn);
    return $result;

}

function lista_pessoas()
{
    $conn = pg_connect('host=localhost port=5432 dbname=livro user=postgres password=');
    
    $result = pg_query($conn, "SELECT * FROM pessoa ORDER BY id");
    $list = pg_fetch_all($result);
    pg_close($conn);
    return $list;
}

function get_next_pessoa()
{
    $conn = pg_connect('host=localhost port=5432 dbname=livro user=postgres password=');
    
    $result = pg_query($conn, "SELECT max(id) as next FROM pessoa");
    $pessoa = pg_fetch_assoc($result);
    $next   = (int) $pessoa['next'] +1;
    pg_close($conn);
    return $next;
}
