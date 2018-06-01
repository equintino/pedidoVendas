<?php 
/*require_once('../nusoap/lib/nusoap.php');	
$cpfcnpj = $_GET['cpfcnpj'];
$tipo = $_GET['tipo']; 
$usuario = 'K05436';
$password = 'TRQGUX1Y';
$sigla	 = 'IHBJY';
$wsdl = 'http://consulta.confirmeonline.com.br/Integracao/Consulta?wsdl';

	$client = new nusoap_client($wsdl, 'wsdl');
	$err = $client->getError();
	if ($err) {
		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
	}
	// Doc/lit parameters get wrapped
	$param = array(
		               	 'usuario'   	=> $usuario,
		               	 'password'     => $password,
				 'sigla'	=> $sigla,
		                 'cpfcnpj'      => $cpfcnpj
		);

	/*
	* aqui no ws de credito chamei $result = $client->call('ccredito', array('parameters' => $param));
	*no de consulta so funcionou da forma abaixo. se eu colocar como esta no de credito recebo erro
	*dizendo q a senha esta invalida. e com o retorno da senha invalida a class simpleXml reconhece
	*/
	/*$result = $client->call('Cpfcnpj', $param);
	// Check for a fault
	if($client->fault):
		echo '<h2>Fault</h2><pre>';
		print_r($result);
		echo '</pre>';
	else:
		// Check for errors
		$err = $client->getError();
		if($err):
			// Display the error
			echo '<h2>Error</h2><pre>' . $err . '</pre>';
		else:
			// Display the result
			echo '<pre>';
			print_r($result);
			echo '</pre>';
			 $xml = simplexml_load_string($result);
	  		echo '<pre>';
			print_r($xml);
			echo '</pre><br />';
			

		endif;
	endif;*/

?>
<?php 
require_once('nusoap/lib/nusoap.php');	
$cpfcnpj = $_GET['cpfcnpj'];
$tipo = $_GET['tipo']; 
$usuario = 'K05436';
$password = 'TRQGUX1Y';
$sigla	 = 'IHBJY';
$wsdl = 'http://consulta.confirmeonline.com.br/Integracao/Credito?wsdl';

	$client = new nusoap_client($wsdl, 'wsdl');
	$err = $client->getError();
	if($err):
		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
	endif;
	// Doc/lit parameters get wrapped
	$param = array(
		               	 'usuario'   	=> $usuario,
		               	 'password'     => $password,
		                 'cpfcnpj'      => $cpfcnpj
		);
	$result = $client->call('ccredito', array('parameters' => $param));
	// Check for a fault
	if($client->fault):
		echo '<h2>Fault</h2><pre>';
		print_r($result);
		echo '</pre>';
	else:
		// Check for errors
			$err = $client->getError();
			if($err):
				// Display the error
				echo '<h2>Error</h2><pre>' . $err . '</pre>';
			else:
				// Display the result
				echo '<h2>Credito</h2><pre>';
				print_r($result);
				echo '</pre>';
	
				 $xml = simplexml_load_string($result['return']);
		  		echo '<pre>';
				print_r($xml);
				echo '</pre>';

			endif;
		endif;

?>