<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <title>Cadastro de Clientes</title>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.js"></script>
        <script src="//irql.bipbop.com.br/js/jquery.bipbop.min.js"></script>
        <script type="text/javascript" >
            $(document).ready(function() {
                $('table td').click(function(){
                    var campo=$(this).attr('nome');
                    $('input').each(function(){
                        if($(this).attr('name')==campo){
                            $(this).focus();
                        }
                    });
                });
                function limpa_formulário_cep() {
                    $("#rua").val("");
                    $("#bairro").val("");
                    $("#cidade").val("");
                    $("#uf").val("");
                    $("#ibge").val("");
                }
                $('.cep').keyup(function(e){
                    if(e.keyCode==13){
                        if($(this).val().length==8){
                            $('#numero').css('background','pink').focus();
                            $(this).blur().css('background','none');
                        }
                    }
                });
                $(".cep").blur(function() {
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
                                    $("#cep").val(dados.cep);
                                    $("#ibge").val(dados.ibge);
                                }else {
                                    limpa_formulário_cep();
                                    alert("CEP não encontrado.");
                                }
                            });
                            $('#numero').css('background','pink').focus();
                            $(this).css('background','none');
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
                $('#telefone').keyup(function(e){
                    if($(this).val()[4]==9){
                        $('#telefone').mask("(00)90000-0000");
                        $('td[nome=telefone] label').text('Celeular');
                    }else{
                        $('#telefone').mask("(00)0000-0000");
                        $('td[nome=telefone] label').text('Telefone');
                    }
                    if(e.keyCode==13){
                        if($(this).val().length==14||$(this).val().length==13){
                            $(this).blur().css('background','none');
                            $('.cep').css('background','pink').focus();
                        }
                    }
                });
                
                /*$('#cpf, #nascimento').on('input', function(){
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
                            alert('CPF ou data de nascimento incorreta.');
                          } else {
                            $("#nome").val(nome);
                          }
                        }
                      });
                    }
                });*/
                /*$('form input[name=cep').blur(function(){
                    var cep=$(this).val();
                    if(typeof cep!='undefined'){
                        $(document).bipbop("SELECT FROM 'BIPBOPJS'.'CEP'", BIPBOP_FREE, {
              data: {
                            "cep": cep
                          },
                          success: function (ret) {
                            $("#local #logradouro").text($(ret).find("body logradouro").text());
                            $("#local #bairro").text($(ret).find("body bairro").text());
                            $("#local #cidade").text($(ret).find("body cidade").text());
                            $("#local #uf").text($(ret).find("body uf").text());
                            $("#local #cep").text($(ret).find("body cep").text());
                          }
                        });
                    }
                });*/
                $('form input[name=cpf').blur(function(){
                    var cpf=$(this).val();
                    if(typeof cep!='undefined'){
                        $(document).bipbop("SELECT FROM 'BIPBOPJS'.'CPFCNPJ'", BIPBOP_FREE, {
                            data: {
                                "documento": cpf
                            },
                            success: function (ret) {
                                var nome = $(ret).find("body nome").text();
                                var exception = $(ret).find("header exception").text();
                                if (exception) {
                                  exception = exception.replace(/, t/, '. T');
                                  $('#status').text(exception);
                                } else {
                                  $("#nome").val(nome);
                                }
                            }
                        });
                    }
                    $(this).css('background','none');
                    $('#nascimento').css('background','pink').focus();
                });
                $('form input[name=cpf').css('background','pink');
                $('form input[name=cpf').keyup(function(e){
                    if(e.keyCode==13){
                        if($(this).val().length==14){
                            $('#nascimento').css('background','pink').focus();
                            $(this).css('background','none');
                        }
                    }
                });
                $('#nascimento').keyup(function(e){
                    if(e.keyCode==13){
                        $('#telefone').css('background','pink').focus();
                        $(this).css('background','none');
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
        <style>
            body{
                padding: 0;
                margin: 0;
                background: white;
            }
            #corpo{
                width: 1100px;
                margin: auto;
                text-align: center;
            }
            .titulo{
                font-size: 30px;
            }
            table{
                margin: auto;
                width: 750px;
            }
            table tr td label{
                align: right;
            }
            input {
                font-size: 15px;
                border: none;
            }
            input.cep{
                border: 1px solid gray;
                //background: pink;
            }
            .tipo {
                float: right;
                margin-right: 200px;
            }
            fieldset.dCliente, fieldset.endCliente{
                position: relative;
                top: 10px;
                margin: auto;
                border: 1px solid gray;
                clear: right;
                width: 775px;
                border-radius: 8px;
            }
            .subTitulo{
                border: solid green;
            }
            legend{
                font-size: 20px;
                text-align: left;
            }
            label{
                color: blue;
                padding-right: 5px;
            }
        </style>
    </head>
    <body>
        <?php
            include '../dao/dao.php';
            $dao=new dao();
            $cnpj='11482378000195';
            $cnpj='02558157000162';
            $cnpj='39062831000557';
            
            function getCnpj($cnpj){
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
            }
        ?>
        <div id='corpo'>
            <div class='titulo'>CADASTRO DE CLIENTE</div>
            <form method="get" action="#">
                <div class='tipo'>
                    <span>Tipo do Formulário: </span> 
                    <select name='tipoForm'>
                        <option value='pf'>Pessoa Fisica</option>
                        <option value='pj'>Pessoa Jurídica</option>
                    </select>
                </div>
                <fieldset class='dCliente'>
                    <legend>Identificação</legend>
                    <table cellspacing='0' cellpadding='0' border='1'>
                        <tr>
                            <td nome="cpf"><label>Cpf:</label><br />
                                <input autofocus type="text" name="cpf" id="cpf" placeholder="CPF"/></td>
                            <td nome="nascimento"><label>Data Nascimento:</label><br />
                                <input size="10px" type="text" name="nascimento" id="nascimento" placeholder="Nascimento dd/mm/YYYY"/></td>
                        </tr>
                        <tr>
                            <td width="200px" nome="nome"><label>Nome:</label><br>
                                <input type="text" size="60px" name="nome" id="nome" placeholder="Nome" /></td>
                            <td nome="telefone"><label>Telefone:</label><br />
                                <input required name="telefone" id="telefone" /></td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset class='endCliente'>
                    <legend>Endereço</legend>
                    <table cellspacing='0' cellpadding='0' border='0'>
                        <tr>
                            <td width="370px">&nbsp</td><td>Digite aqui o CEP para busca do endereço: </td>
                            <td><input name="cep" type="text" class="cep" value="" size="10" maxlength="9" /></td>
                        </tr>
                    </table>
                    <table cellspacing='0' cellpadding='0' border='1'>
                        <tr>
                            <td colspan="2" nome="rua"><label>Rua:</label><br />
                            <input name="rua" type="text" id="rua" size="80" /></td>    
                            <td nome="numero"><label>N°:</label><br />
                                <input required name="numero" type="text" id="numero" size="6" /></td>
                        </tr>
                        <tr>
                            <td nome="bairro"><label>Bairro:</label><br />
                            <input name="bairro" type="text" id="bairro" size="40" /></td>
                            <td nome="cidade"><label>Cidade:</label><br />
                            <input name="cidade" type="text" id="cidade" size="40" /></td>
                            <td nome="uf"><label>Estado:</label><br />
                            <input name="uf" type="text" id="uf" size="2" /></td>
                        </tr>
                        <tr>
                            <td nome="cep"><label>Cep:</label><br />
                            <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" /></td>
                            <td colspan="2" nome="ibge"><label>IBGE:</label><br />
                            <input name="ibge" type="text" id="ibge" size="8" /></td>
                        </tr>
                    </table>
                </fieldset>
            </form>
            <div id='status'></div>
        </div>
    
    <form>
      
    </form>
    
    <!--<div id="local">
        Logradouro: <span id="logradouro">N/A</span>
        Bairro: <span id="bairro">N/A</span>
        Cidade: <span id="cidade">N/A</span>
        UF: <span id="uf">N/A</span>
        CEP: <span id="cep">N/A</span>
    </div>
    
    <span class='nome'>Daniel Azevedo Almeida</span>-->
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