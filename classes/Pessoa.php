<?php
class Pessoa
{
    private static $conn;

    public function __construct() {
         self::$conn = Connection::open('chamados');
    }

    public static function setConnection( PDO $conn )
    {
        self::$conn = $conn;
    }
    
    public static function getConnection()
    {
        if (empty(self::$conn))
        {            
            self::$conn = Connection::open('chamados');
        }
        return self::$conn;
    }

    public static function search($chave, $valor)
    {        
        $conn = self::getConnection();
        
        // Lista de colunas permitidas
        $colunasPermitidas = ['id', 'nome', 'endereco', 'bairro', 'telefone', 'email', 'cidade'];

        $colunasCampoNaoTexto = ['id'];

                // Valida a coluna
        if (!in_array($chave, $colunasPermitidas)) {
            throw new InvalidArgumentException("Coluna inválida para busca: {$chave}");
        }

        // Se o valor for numérico, faz uma busca por igualdade exata
        if (in_array($chave, $colunasCampoNaoTexto)) {
            $sql = "SELECT * FROM pessoa WHERE {$chave} = :valor ORDER BY {$chave}";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':valor' => $valor]);
        } else {
            // Para textos, aplica a conversão para maiúsculas e busca com LIKE (fazendo cast ::text para evitar falhas se a coluna for do tipo text/varchar)
            $sql = "SELECT * FROM pessoa WHERE UPPER({$chave}::text) LIKE :valor ORDER BY {$chave}";
            $stmt = $conn->prepare($sql);
            
            $termoBusca = '%' . strtoupper($valor) . '%';
            $stmt->execute([':valor' => $termoBusca]);
        }

        if ($stmt->rowCount() == 0) {
            print("<script>alert('Registro não encontrado !');</script>");
        }         
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
        
    public static function find($id)
    {
        $conn = self::getConnection();
        
        $result = $conn->prepare("SELECT * FROM pessoa WHERE id=:id");
        $result->execute( [ ':id' => $id ]);
        return $result->fetch();
    }
    
    public static function delete($id)
    {
        $conn = self::getConnection();
        
        $result = $conn->prepare("DELETE FROM pessoa WHERE id=:id");
        $result->execute( [ ':id' => $id ]);

        print("<script>alert('Registro excluído com sucesso !');</script>");
    }
    
    public static function all()
    {
        $conn = self::getConnection();
        
        $result = $conn->query("SELECT * FROM pessoa ORDER BY id");
        return $result->fetchAll();
    }
    
    public static function save($pessoa)
    {
        $conn = self::getConnection();
        
        if (empty($pessoa['id']))
        {
            $result = $conn->query("SELECT max(id) as next FROM pessoa");
            $row = $result->fetch();
            $pessoa['id'] = (int) $row['next'] +1;
            
            $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone,
                                        email, id_cidade)
                                VALUES ( :id, :nome, :endereco,
                                         :bairro, :telefone, :email, :id_cidade )";
        }
        else
        {
            $sql = "UPDATE pessoa SET nome  = :nome,
                                  endereco  = :endereco,
                                  bairro    = :bairro,
                                  telefone  = :telefone,
                                  email     = :email,
                                  id_cidade = :id_cidade
                        WHERE id = :id";
        }
        
        $result = $conn->prepare($sql);
        $result->execute( [ ':id'   => $pessoa['id'],
                            ':nome'   => $pessoa['nome'],
                            ':endereco'   => $pessoa['endereco'],
                            ':bairro'   => $pessoa['bairro'],
                            ':telefone'   => $pessoa['telefone'],
                            ':email'   => $pessoa['email'],
                            ':id_cidade'   => $pessoa['id_cidade']
                         ]);        
        print("<script>alert('Registro salvo com sucesso !');window.location.href = 'index.php?class=PessoaList';</script>");
    }
}
