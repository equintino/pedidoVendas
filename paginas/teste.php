<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"
                integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
                crossorigin="anonymous"></script>
        <title>Cadastro de Clientes</title>
        <style>
            input {
              font-size: 15px;
              width: 300px;
            }
        </style>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.js"></script>
        <script src="//irql.bipbop.com.br/js/jquery.bipbop.min.js"></script>
        <script type="text/javascript" >
            $(document).ready(function() {
                function limpa_formulário_cep() {
                    $("#rua").val("");
                    $("#bairro").val("");
                    $("#cidade").val("");
                    $("#uf").val("");
                    $("#ibge").val("");
                }
                $("#cep").blur(function() {
                    var cep = $(this).val().replace(/\D/g, '');
                    if (cep != "") {
                        var validacep = /^[0-9]{8}$/;
                        if(validacep.test(cep)) {
                            $("#rua").val("...");
                            $("#bairro").val("...");
                            $("#cidade").val("...");
                            $("#uf").val("...");
                            $("#ibge").val("...");
                            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                                if (!("erro" in dados)) {
                                    $("#rua").val(dados.logradouro);
                                    $("#bairro").val(dados.bairro);
                                    $("#cidade").val(dados.localidade);
                                    $("#uf").val(dados.uf);
                                    $("#ibge").val(dados.ibge);
                                }else {
                                    limpa_formulário_cep();
                                    alert("CEP não encontrado.");
                                }
                            });
                        }else {
                            limpa_formulário_cep();
                            alert("Formato de CEP inválido.");
                        }
                    }else {
                        limpa_formulário_cep();
                    }
                });
                function validCPF (cpf) {
                    return cpf.match(/^\d{3}\.?\d{3}\.?\d{3}\-?\d{2}$/);
                  }
                  $("#nascimento").mask("00/00/0000");
                  $("#cpf").mask("000.000.000-00");
                  $('#cpf, #nascimento').on('input', function(){
                    var cpf = $("#cpf").val(),
                      nascimento = $("#nascimento").val();
                    if (validCPF(cpf) && /^\d{2}\/\d{2}\/\d{4}$/.test(nascimento)) {
                      $().bipbop("SELECT FROM 'BIPBOPJS'.'CPFCNPJ'", null, {
                        data: {
                            documento: cpf,
                            nascimento: nascimento
                        },
                        success: function(data) {
                          var nome = $(data).find("body nome").text();
                          var exception = $(data).find("header exception").text();
                          if (exception) {
                            exception = exception.replace(/, t/, '. T');
                            $('#status').text(exception);
                          } else {
                            $("#nome").val(nome);
                          }
                        }
                      });
                    }
                });
                $(document).bipbop("SELECT FROM 'BIPBOPJS'.'CEP'", BIPBOP_FREE, {
      data: {
                    "cep": "25080150"
                  },
                  success: function (ret) {
                    $("#local #logradouro").text($(ret).find("body logradouro").text());
                    $("#local #bairro").text($(ret).find("body bairro").text());
                    $("#local #cidade").text($(ret).find("body cidade").text());
                    $("#local #uf").text($(ret).find("body uf").text());
                    $("#local #cep").text($(ret).find("body cep").text());
                  }
                });
                $(document).bipbop("SELECT FROM 'BIPBOPJS'.'CPFCNPJ'", BIPBOP_FREE, {
                    data: {
                        "documento": "95611711715"
                    },
                    success: function (ret) {
                        $(".nome").text($(ret).find("body nome").text());
                        var exception = $(ret).find("header exception").text();
                    }
                });
                /*$(document).bipbop("SELECT FROM 'SOCIAL'.'CONSULTA'", "SUA-CHAVE-DE-ACESSO", {
                    data: {
                        "documento": "41385594187",
                        "email" : "john@doe.com"
                    },
                    success: function (ret) {
                        jRet = $(ret);
                        $("#influence").text(jRet.find("body influence").text());
                    }
                });*/
            });
        </script>
    </head>
    <body>
        <?php
            include '../dao/dao.php';
            $dao=new dao();
            $cnpj='11482378000195';
            $cnpj='02558157000162';
            $cnpj='39062831000557';
            
            $ch=curl_init("https://www.receitaws.com.br/v1/cnpj/".$cnpj);
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);
            $dColetado=json_decode($output);
            foreach($dColetado as $key => $item){
                if($key != 'atividade_principal' && $key != 'atividades_secundarias' && $key != 'qsa' && $key != 'extra'){
                    echo $key.' -> '.$item.'<br>';
                }elseif($key == 'atividade_principal'){
                    echo $key.'<br>';
                    foreach($item[0] as $key2 => $item2){
                        echo $key2.' -> '.$item2.'<br>';
                    }
                }elseif($key == 'atividades_secundarias'){
                    echo $key.'<br>';
                    foreach($item as $item2){
                        foreach($item2 as $key3 => $item3){
                            echo $key3.' -> '.$item3.'<br>';
                        }
                    }
                }elseif($key == 'qsa'){
                    echo $key.'<br>';
                    foreach($item as $item2){
                        foreach($item2 as $key3 => $item3){
                            echo $key3.' -> '.$item3.'<br>';
                        }
                    }
                }elseif($key == 'extra'){
                    echo $key.'<br>';
                    foreach($item as $key2 => $item2){
                        echo $key2.' -> '.$item2.'<br>';
                    }
                }
            }
        ?>
      <form method="get" action=".">
        <label>Cep:
        <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" /></label><br />
        <label>Rua:
        <input name="rua" type="text" id="rua" size="60" /></label><br />
        <label>Bairro:
        <input name="bairro" type="text" id="bairro" size="40" /></label><br />
        <label>Cidade:
        <input name="cidade" type="text" id="cidade" size="40" /></label><br />
        <label>Estado:
        <input name="uf" type="text" id="uf" size="2" /></label><br />
        <label>IBGE:
        <input name="ibge" type="text" id="ibge" size="8" /></label><br />
      </form>
    
    <form>
      <p>
        <input type="text" name="cpf" id="cpf" placeholder="CPF"></input>
      </p>
      <p>
       <input type="text" name="nascimento" id="nascimento" placeholder="Nascimento dd/mm/YYYY"></input>
      </p>
      <p>
        <input type="text" name="nome" id="nome" placeholder="Nome" disabled="disabled"></input>
      </p>

      <p id="status"></p>
    </form>
    
    <div id="local">
        Logradouro: <span id="logradouro">N/A</span>
        Bairro: <span id="bairro">N/A</span>
        Cidade: <span id="cidade">N/A</span>
        UF: <span id="uf">N/A</span>
        CEP: <span id="cep">N/A</span>
    </div>
    
    <span class='nome'>Daniel Azevedo Almeida</span>
    </body>
</html>





<?php
/*class ConsultaCPF
{
	private $cpf_number;
	private $data_nasc;
	private $errno;
	private $json;
	const PASSWORD = 'Sup3RbP4ssCr1t0grPhABr4sil';
	const URL = 'https://movel01.receita.fazenda.gov.br/servicos-rfb/v2/IRPF/cpf';
	public function SetCPF($cpf)
	{
		if( !$this->check_cpf($cpf) )
		{
			$this->errno = 0;
		}
		else
		{
			$this->cpf_number = $cpf;
		}
	}
	public function SetNasc($data){
		$this->data_nasc = $data;
	}
	public function consultar()
	{
		if( !isset( $this->cpf_number ) )
		{
			return false;
		}
		$this->json = $this->consulta_receita();
		if( isset( $this->errno ) )
		{
			return false;
		}
		return true;
	}
	private function consulta_receita(){
		$cpf = $this->cpf_number;
		$data_nasc = $this->data_nasc;
		$token = hash_hmac('sha1', $cpf.$data_nasc, self::PASSWORD);
		$headers = array(
			"token: ${token}",
			"plataforma: iPhone OS",
			"dispositivo: iPhone",
			"aplicativo: Pessoa Física",
			"versao: 8.3",
			"versao_app: 4.1"
		);
		unset($this->errno);
		$post_data = "cpf=${cpf}&dataNascimento=${data_nasc}";
		$request = curl_init();
		curl_setopt($request, CURLOPT_URL, self::URL);
		curl_setopt($request, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($request, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($request, CURLOPT_HTTPHEADER, $headers);
		$resp = curl_exec($request);
		if( preg_match("/Tente novamente mais tarde/", $resp) )
		{
			$this->errno = 1;
		}
		return $resp;
	}
	public function GetJson(){
		if( isset($this->json) )
		{
			return $this->json;
		}
		else
		{
			return NULL;
		}
	}
	public function error()
	{
		$errors = array('CPF Invalido', 'Consulta Falhou');
		if(! isset($this->errno) )
		{
			return "Sem erros";
		}
		else
		{
			if(count($errors) > $this->errno && $this->errno >= 0)
			{
				return $errors[$this->errno];
			}
			else
			{
				return "Erro desconhecido";
			}
		}
	}
	private function check_cpf($cpf)
	{
		if( ! preg_match("/^\d{11}$/", $cpf) )
		{
			return false;
		}
		return true;
	}
}

//:::Exemplo de uso:::
$cpf = new ConsultaCPF();
$cpf->SetCPF("95611711715");
$cpf->SetNasc("24081967"); // dia mes ano
if($cpf->consultar()){
	print $cpf->Getjson()."\n";
} else {
	print "Consulta falhou: \n";
	print $cpf->error()."\n";
}
*/