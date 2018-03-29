<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// GET TODOS INDICADORES
$app->get('/indicador/all', function(Request $request, Response $response){
	
	$sql = "SELECT * FROM indicador";
	
	try
	{
		$db = new db();
		$db = $db->connect();
		
		$stmt = $db->query($sql);
		$indicadores = $stmt->fetchAll(PDO::FETCH_OBJ);
		
		$db = null;
		
		echo json_encode($indicadores);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}	
});

// GET INDICADOR ESPECÍFICO
$app->get('/indicador/{id}', function(Request $request, Response $response){
	
	$id = $request->getAttribute('id');	
	$sql = "SELECT * FROM indicador WHERE id = $id";
	
	try
	{
		$db = new db();
		$db = $db->connect();
		
		$stmt = $db->query($sql);
		$indicador = $stmt->fetchAll(PDO::FETCH_OBJ);
		
		$db = null;
		
		echo json_encode($indicador);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}	
});

// ADICIONAR INDICADOR OU ATUALIZAR
$app->post('/indicador/save', function(Request $request, Response $response){
	
	$id = $request->getParam('id');	
	$dataIntegracao = $request->getParam('dataIntegracao');
	$dataUltAlteracao = $request->getParam('dataUltAlteracao');
	$formulaCalculo = $request->getParam('formulaCalculo');
	$idDrgIntegracao = $request->getParam('idDrgIntegracao');
	$identDirecaoSeta = $request->getParam('identDirecaoSeta');
	$identPeriodicidade = $request->getParam('identPeriodicidade');
	$identReferencial = $request->getParam('identReferencial');
	$informacoesAdicionais = $request->getParam('informacoesAdicionais');
	$nome = $request->getParam('nome');
	$numDecimais = $request->getParam('numDecimais');
	$objetivo = $request->getParam('objetivo');
	$unidade = $request->getParam('unidade');
	$usuarioUltAlteracao = $request->getParam('usuarioUltAlteracao');
	$versao = $request->getParam('versao');
	
	$sql = 'INSERT INTO indicador ("id", "dataIntegracao", "dataUltAlteracao", "formulaCalculo", "idDrgIntegracao", "identDirecaoSeta", "identPeriodicidade", "identReferencial", "informacoesAdicionais", "nome", "numDecimais", "objetivo", "unidade", "usuarioUltAlteracao", "versao") VALUES (:id, :dataIntegracao, :dataUltAlteracao, :formulaCalculo, :idDrgIntegracao, :identDirecaoSeta, :identPeriodicidade, :identReferencial, :informacoesAdicionais, :nome, :numDecimais, :objetivo, :unidade, :usuarioUltAlteracao, :versao) ON CONFLICT (id) DO UPDATE SET "id"=:id, "dataIntegracao"=:dataIntegracao, "dataUltAlteracao"=:dataUltAlteracao, "formulaCalculo"=:formulaCalculo, "idDrgIntegracao"=:idDrgIntegracao, "identDirecaoSeta"=:identDirecaoSeta, "identPeriodicidade"=:identPeriodicidade, "identReferencial"=:identReferencial, "informacoesAdicionais"=:informacoesAdicionais, "nome"=:nome, "numDecimais"=:numDecimais, "objetivo"=:objetivo, "unidade"=:unidade, "usuarioUltAlteracao"=:usuarioUltAlteracao, "versao"=:versao';
	
	try
	{
		$db = new db();
		$db = $db->connect();
		
		$stmt = $db->prepare($sql);
		
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':dataIntegracao', $dataIntegracao);
		$stmt->bindParam(':dataUltAlteracao', $dataUltAlteracao);
		$stmt->bindParam(':formulaCalculo', $formulaCalculo);
		$stmt->bindParam(':idDrgIntegracao', $idDrgIntegracao);
		$stmt->bindParam(':identDirecaoSeta', $identDirecaoSeta);
		$stmt->bindParam(':identPeriodicidade', $identPeriodicidade);
		$stmt->bindParam(':identReferencial', $identReferencial);
		$stmt->bindParam(':informacoesAdicionais', $informacoesAdicionais);
		$stmt->bindParam(':nome', $nome);
		$stmt->bindParam(':numDecimais', $numDecimais);
		$stmt->bindParam(':objetivo', $objetivo);
		$stmt->bindParam(':unidade', $unidade);
		$stmt->bindParam(':usuarioUltAlteracao', $usuarioUltAlteracao);
		$stmt->bindParam(':versao', $versao);
		
		$stmt->execute();
		
		$db = null;
		
		echo '{"notice": {"text": "Indicador adicionado/atualizado!"}}';
	}
	catch(PDOException $e)
	{
		echo '{"error": {"text": '.$e->getMessage().'}}';
	}	
});

// DELETAR Indicador
$app->delete('/indicador/delete/{id}', function(Request $request, Response $response){
	
	$id = $request->getAttribute('id');
	$sql = "DELETE FROM indicador WHERE id = :id";
	
	try
	{
		$db = new db();
		$db = $db->connect();
		
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		
		$db = null;
		
		echo '{"notice": {"text": "Indicador DELETADO!"}}';
	}
	catch(PDOException $e)
	{
		echo '{"error": {"text": '.$e->getMessage().'}}';
	}	
});