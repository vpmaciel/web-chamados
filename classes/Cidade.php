<?php
class Cidade
{
    public static function all()
    {
        $conn = new PDO("pgsql:dbname=livro;user=postgres;password=@Cia5555;host=127.0.0.1");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $result = $conn->query("SELECT * FROM cidade ORDER BY id");
        return $result->fetchAll();
    }
}
