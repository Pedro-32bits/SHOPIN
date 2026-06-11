<?php
$host = "localhost";
$banco = "shopin";
$user = "root";
$pass = "";

$conexao = new PDO(
    "mysql:host=$host;dbname=$banco;charset=utf8mb4",
    $user,
    $pass,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);
?>
<?php
    class FotoDAO {

        // Create - Inserir
        function inserir($fotoObjeto) {
            include __DIR__ . "/../conexao.php";

            try {
                $sql = "INSERT INTO foto (cod_produto, foto) VALUES (:cod_produto, :foto)";
                $consulta = $conexao->prepare($sql);
                $consulta->bindValue(":cod_produto", (int) $fotoObjeto->getCod_produto());
                $consulta->bindValue(":foto", (string) $fotoObjeto->getFoto());

                return $consulta->execute();
            } catch (PDOException $e) {
                error_log("Erro ao salvar foto: " . $e->getMessage());
                return false;
            }
        }

        // Read - Listar todas as fotos
        function listar() {
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT * FROM foto";
            $consulta = $conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll();
        }

        // Update - Atualizar
        function atualizar($fotoObjeto) {
            include __DIR__ . "/../conexao.php";
            $sql = "UPDATE foto SET cod_produto = :cod_produto, foto = :foto WHERE foto_PK = :cod";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $fotoObjeto->getFoto_PK());
            $consulta->bindValue(":cod_produto", $fotoObjeto->getCod_produto());
            $consulta->bindValue(":foto", $fotoObjeto->getFoto());

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Delete - Apagar por PK
        function apagar($cod) {
            include __DIR__ . "/../conexao.php";
            $sql = "DELETE FROM foto WHERE foto_PK = :cod"; 
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod", $cod);

            if($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Buscar (Pesquisa por nome do arquivo da foto ou código do produto)
        function buscar($pesquisa) {
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT * FROM foto WHERE foto LIKE :pesquisa OR cod_produto = :cod_prod";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":pesquisa", "%".$pesquisa."%");
            $consulta->bindValue(":cod_prod", $pesquisa); 
            $consulta->execute();
            return $consulta->fetchAll(); 
        } 

         function buscarPorProduto($cod_produto) {
            include __DIR__ . "/../conexao.php";
            $sql = "SELECT * FROM foto WHERE cod_produto = :cod_produto";
            $consulta = $conexao->prepare($sql);
            $consulta->bindValue(":cod_produto", $cod_produto);
            $consulta->execute();
            return $consulta->fetchAll();
        }
    }
?>
<?php
if (isset($_FILES['fotos']) && !empty($_FILES['fotos']['name'][0])) {
    $uploadDir = __DIR__ . "/../../../FRONTEND/img/produtos/";

    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
        die("Não foi possível criar a pasta de upload.");
    }

    if (!is_writable($uploadDir)) {
        die("Pasta de upload sem permissão de escrita.");
    }

    $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    foreach ($_FILES['fotos']['name'] as $key => $originalName) {
        if ($_FILES['fotos']['error'][$key] !== UPLOAD_ERR_OK) {
            continue;
        }

        $tmpName = $_FILES['fotos']['tmp_name'][$key];
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExt)) {
            continue;
        }

        $safeName = time() . "_" . $produtoId . "_" . preg_replace('/[^A-Za-z0-9_.-]/', '_', basename($originalName));
        $targetPath = $uploadDir . $safeName;

        if (move_uploaded_file($tmpName, $targetPath)) {
            $fotoObj = new Foto();
            $fotoObj->setCod_produto($produtoId);
            $fotoObj->setFoto("img/produtos/" . $safeName);

            if (!$fotoDao->inserir($fotoObj)) {
                error_log("Falha ao gravar a foto no banco: " . $safeName);
            }
        }
    }
}
header("location: ../../../FRONTEND/vendedor/vendedor.php");
exit;