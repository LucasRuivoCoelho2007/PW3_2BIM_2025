<?php

function open_database() {
    try {
        $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
                        DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (Exception $e) {
        // Armazena mensagem de erro na sessão
        $_SESSION['message'] = "Erro ao conectar com o banco de dados: " . $e->getMessage();
        $_SESSION['type'] = 'danger';
        return null;
    }
}


// Função para filtrar registros da tabela
function filter($table = null, $condition = null) {
    $database = open_database();
    $found = null;

    try {
        $sql = "SELECT * FROM " . $table;
        if ($condition) {
            $sql .= " WHERE " . $condition;
        }
        $stmt = $database->prepare($sql);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $found = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }

    return $found;
}

// Função para pesquisar todos os registros de uma tabela
function find_all($table) {
    return filter($table);
}

// Função para pesquisar um registro por ID
function find($table = null, $id = null) {
    if (!$table || !$id) {
        return null;
    }

    try {
        $database = open_database();
        $stmt = $database->prepare("SELECT * FROM " . $table . " WHERE id = :id LIMIT 1");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null; // Retorna null se não encontrar

    } catch (Exception $e) {
        die("Erro ao buscar registro: " . $e->getMessage());
    }
}

// Função para salvar um novo registro
function save($table = null, $data = null) {
    $database = open_database();
    $columns = implode(",", array_keys($data));
    $placeholders = ":" . implode(",:", array_keys($data)); // Ex: :column1, :column2

    $sql = "INSERT INTO " . $table . " ($columns) VALUES ($placeholders)";
    
    try {
        $stmt = $database->prepare($sql);

        // Bind each parameter to avoid SQL injection
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        
        $stmt->execute();

        $_SESSION['message'] = 'Registro cadastrado com sucesso.';
        $_SESSION['type'] = 'success';
    } catch (Exception $e) {
        $_SESSION['message'] = 'Não foi possível realizar a operação.';
        $_SESSION['type'] = 'danger';
    }
}

// Função para atualizar um registro
function update($table = null, $id = 0, $data = null) {
    if (!$table || !$id || !$data) {
        $_SESSION['message'] = 'Dados inválidos para atualização.';
        $_SESSION['type'] = 'danger';
        return false;
    }

    $database = open_database();
    $items = [];

    foreach ($data as $key => $value) {
        $items[] = "$key = :$key"; // Ex: column1 = :column1
    }
    $items = implode(", ", $items);

    $sql = "UPDATE " . $table . " SET $items WHERE id = :id";
    
    try {
        $stmt = $database->prepare($sql);

        // Bind values
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['message'] = 'Registro atualizado com sucesso.';
            $_SESSION['type'] = 'success';
            return true;
        } else {
            $_SESSION['message'] = 'Falha ao atualizar o registro.';
            $_SESSION['type'] = 'danger';
            return false;
        }
    } catch (Exception $e) {
        $_SESSION['message'] = 'Erro ao atualizar: ' . $e->getMessage();
        $_SESSION['type'] = 'danger';
        return false;
    }
}


// Função para remover um registro
function remove($table = null, $id = null) {
    $database = open_database();
    
    try {
        if ($id) {
            $sql = "DELETE FROM " . $table . " WHERE id = :id";
            $stmt = $database->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $_SESSION['message'] = "Registro Removido com Sucesso.";
            $_SESSION['type'] = 'success';
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }
}

// Função para criptografar uma senha (opcional)
function criptografia($senha) {
    $custo = "08";
    $salt = "CflfilePArK1BJomM0F6aJ"; // Deve ter exatamente 22 caracteres
    
    $hash = crypt($senha, "$2a$" . $custo . "$" . $salt);
    
    return $hash;
}


// Função para limpar as mensagens de sessão
function clear_messages() {
    $_SESSION["message"] = null;
    $_SESSION["type"] = null;
}

// Funções para formatar dados (como telefone, data, CPF/CNPJ)
function telefone($dado) {
    $tel = "(" . substr($dado, 0, 2) . ") " . substr($dado, 2, 5) . "-" .  substr($dado, 7, 4);    
    return $tel; 
}

function formatadata($data, $formato) {
    $dt = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
    return $dt->format($formato);
}

function cep($cepdado) {
    $cep = substr($cepdado, 0, 5) . "-" . substr($cepdado, 5, 3);        
    return $cep;
}

function format_cpf_cnpj($value) {
    $value = preg_replace("/[^0-9]/", "", $value);
    
    if (strlen($value) === 11) {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $value);
    } elseif (strlen($value) === 14) {
        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "$1.$2.$3/$4-$5", $value);
    }
    
    return $value;
}

?>
