<?php

//Definir um fuso horario padrao
date_default_timezone_set('America/Sao_Paulo');

//Gerar com PHP o horario atual
$horario_atual = date("H:i:s");
var_dump($horario_atual);

//Gerar a data com PHP no formato que deve ser salvo no BD
$data_entrada = date('Y/m/d');

//incluir a conexao com o BD
include_once "conexao.php";

//ID do usuario fixo para testar
$id_usuario = 1;

//Recuperar o ultimo ponto do usuario
$query_ponto = "SELECT id, saida_intervalo, retorno_intervalo, saida
                FROM ponto
                WHERE usaurio_id = :usuario_id
                ORDER BY id DESC
                LIMIT 1";

//Preparar a Query
$result_ponto = $conn -> prepare($query_ponto);

//Substituir o link da query pelo valor
$result_ponto ->bindParam(':usuario_id', $id_usuario);

//Executar a Query
$result_ponto ->execute();

//verifica se encontrou algum registro no BD
if(($result_ponto) and ($result_ponto->rowCount() != 0)){
    //Realizar a leitura do registro
    $row_ponto = $result_ponto->fetch(PDO::FETCH_ASSOC);
    var_dump($row_ponto);
    //Extrair para inserir através do nome da chave do array
    extract($row_ponto);

    //Verifica se o usuario bateu o ponto de saida para o intervalo
    if(($saida_intervalo == "") or ($saida_intervalo == null)){
        //Coluna que deve receber o valor
        $col_tipo_registro = "saida_intervalo";
        $tipo_registro = "editar";
        $text_tipo_registro = "saida intervalo";
    }
}else{
    echo "Nenhuma ponto encontrado!<br>";
}
//Verificar o tipo de registro, novo ponto ou editar registro existe
switch($tipo_registro){
    case "editar":
}
