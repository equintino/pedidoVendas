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
                var corBack = '#ccc';
                $('table td').click(function(){
                    var campo=$(this).attr('nome');
                    $('input').each(function(){
                        if($(this).attr('name')==campo){
                            $(this).css('background',corBack).focus();
                        }else{
                            $(this).css('background','none');
                        }
                    });
                });
                function limpa_formulário_cep() {
                    $("#endereco").val("");
                    $("#bairro").val("");
                    $("#cidade").val("");
                    $("#uf").val("");
                    $("#ibge").val("");
                }
                $('.cep').keyup(function(e){
                    if(e.keyCode==13){
                        if($(this).val().length==8){
                            $('#numero').css('background',corBack).focus();
                            //$(this).blur().css('background','none');
                        }
                    }
                });
                $(".cep").blur(function() {
                    var cep = $(this).val().replace(/\D/g, '');
                    if (cep != "") {
                        var validacep = /^[0-9]{8}$/;
                        if(validacep.test(cep)) {
                            $("#endereco").val("...");
                            $("#bairro").val("...");
                            $("#cidade").val("...");
                            $("#uf").val("...");
                            $("#ibge").val("...");
                            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                                if (!("erro" in dados)) {
                                    $("#endereco").val(dados.logradouro);
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
                            $('#numero').css('background',corBack).focus();
                            $(this).css('background','none');
                        }else {
                            limpa_formulário_cep();
                            alert("Formato de CEP inválido.");
                        }
                    }else {
                        limpa_formulário_cep();
                    }
                });
                function validCPF(cpf){
                //$('#cpf').blur(function(){
                    //var cpf = $('#cpf').val().replace(/[^0-9]/g, '').toString();
                    cpf_=cpf.replace(/[^0-9]/g,'');
                    if( cpf_.length == 11 ){
                        var v = [];
                        //Calcula o primeiro dígito de verificação.
                        v[0] = 1 * cpf_[0] + 2 * cpf_[1] + 3 * cpf_[2];
                        v[0] += 4 * cpf_[3] + 5 * cpf_[4] + 6 * cpf_[5];
                        v[0] += 7 * cpf_[6] + 8 * cpf_[7] + 9 * cpf_[8];
                        v[0] = v[0] % 11;
                        v[0] = v[0] % 10;
                        //Calcula o segundo dígito de verificação.
                        v[1] = 1 * cpf_[1] + 2 * cpf_[2] + 3 * cpf_[3];
                        v[1] += 4 * cpf_[4] + 5 * cpf_[5] + 6 * cpf_[6];
                        v[1] += 7 * cpf_[7] + 8 * cpf_[8] + 9 * v[0];
                        v[1] = v[1] % 11;
                        v[1] = v[1] % 10;
                        //Retorna Verdadeiro se os dígitos de verificação são os esperados.
                        //alert(v[0]);
                        if ( (v[0] != cpf_[9]) || (v[1] != cpf_[10]) ){
                            alert('CPF inválido: ' + cpf);
                            $('#cpf').val('');
                            //$('#cpf').css('background',corBack).focus();
                            
                            $('input').each(function(){
                                if($(this).attr('name')=='cpf'){
                                    $(this).css('background',corBack).focus();
                                }else{
                                    $(this).css('background','none');
                                    die;
                                }
                            });
                        }
                    }
                    return cpf;
                }

                /*function validCPF (cpf) {
                    var confere=cpf.match(/^\d{3}\.?\d{3}\.?\d{3}\-?\d{2}$/);
                    alert(confere);
                    return cpf;
                }*/
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
                            $('.cep').css('background',corBack).focus();
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
                    var cpf=validCPF($(this).val());
                    if(typeof cpf!='undefined'){
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
                    $('#nascimento').css('background',corBack).focus();
                });
                $('form input[name=cpf').css('background',corBack);
                $('form input[name=cpf').keyup(function(e){
                    if(e.keyCode==13){
                        if($(this).val().length==14){
                            $('#nascimento').css('background',corBack).focus();
                            $(this).css('background','none');
                        }
                    }
                });
                $('#nascimento').keyup(function(e){
                    if(e.keyCode==13){
                        $('#telefone').css('background',corBack).focus();
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
                $('.tipo select').change(function(){
                   $('td input').val('');
                   if($(this).val()=='pj'){
                       $('#pj').show();
                       $('#pf').hide();
                       $('input[name=cnpj]').focus();
                   }else{
                       $('#pj').hide();
                       $('#pf').show();
                       $('input[name=cpf]').focus();
                   }
                });
                if(cnpj){
                    $('.tipo select').val('pj');
                }
                $('#tabIdEmp input[name=cnpj').keyup(function(){
                    var cnpj=$(this).val();
                    if(cnpj.length==14){
                        window.location.assign("../web/index.php?pagina=teste&cnpj="+cnpj+"");
                    }
                });
            });
        </script>
        <?php array_key_exists('cnpj',$_GET)? $cnpj=$_GET['cnpj']:$cnpj=null; ?>
        <script>var cnpj="<?= $cnpj ?>"</script>
        <?php if($cnpj): $selecionado='selected'; ?>
            <style>#pf{display: none;}</style>
        <?php else: $selecionado=null; ?>
            <style>#pj{ display: none;}</style>
        <?php endif; ?>
        <style>
            body{
                padding: 0;
                margin: 0;
                background: white;
            }
            #corpo{
                width: 1100px;
                margin: 40px auto;
                text-align: center;
                //border: solid red;
            }
            .titulo{
                font-size: 30px;
            }
            table{
                margin: auto;
                width: 100%;
                //border: solid green;
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
                width: 950px;
                border-radius: 8px;
                //border: solid yellow;
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
            /*#tabIdEmp tr td{
                border: 1px solid red; 
            }*/
        </style>
    </head>
    <body>
        <?php
            include '../dao/dao.php';
            $dao=new dao();
            //print_r(phpinfo());die;
            //print_r($dao->showBancoSql());die;
            //$cnpj='11482378000195';
            //$cnpj='02558157000162';
            //$cnpj='39062831000557';
            
            function getCnpj($cnpj){
                $ch=curl_init("https://www.receitaws.com.br/v1/cnpj/".$cnpj);
                curl_setopt($ch, CURLOPT_POST, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($ch);
                curl_close($ch);
                $dColetado=json_decode($output);
                $campos=$dados=array();
                if($dColetado):
                    foreach($dColetado as $key => $item){
                        if($key != 'atividade_principal' && $key != 'atividades_secundarias' && $key != 'qsa' && $key != 'extra'){
                            $dados[$key]=$item;
                            $campos[$key]=$item;
                        }elseif($key == 'atividade_principal'){
                            foreach($item[0] as $key2 => $item2){
                                $dados[$key][$key2]=$item;
                            }
                        }elseif($key == 'atividades_secundarias'){
                            foreach($item as $item2){
                                foreach($item2 as $key3 => $item3){
                                    $dados[$key][$key3]=$item3;
                                }
                            }
                        }elseif($key == 'qsa'){
                            foreach($item as $item2){
                                foreach($item2 as $key3 => $item3){
                                    $dados[$key][$key3]=$item3;
                                }
                            }
                        }elseif($key == 'extra'){
                            foreach($item as $key2 => $item2){
                                $dados[$key][$key2]=$item2;
                            }
                        }
                    }
                    return $dados;
                endif;
            }
            $dados=getCnpj($cnpj);
            //echo '<pre>';print_r($dados);
            $campoCnpj=Array('data_situacao','complemento','situacao','abertura','natureza_juridica','ultima_atualizacao','status','efr','motivo_situacao','situacao_especial','data_situacao_especial','capital_social');
            $identCnpj=array('cnpj','fantasia','nome','telefone','email',);
            $endCnpj=array('logradouro','numero','bairro','municipio','uf','cep',);
        ?>
        <div id='corpo'>
            <div class='titulo'>CADASTRO DE CLIENTE</div>
            <div class='tipo'>
                <span>Tipo do Formulário: </span> 
                <select name='tipoForm'>
                    <option <?= $selecionado ?> value='pf'>Pessoa Fisica</option>
                    <option <?= $selecionado ?> value='pj'>Pessoa Jurídica</option>
                </select>
            </div>
            <form id="pf" method="get" action="#">
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
                    <legend>Localização</legend>
                    <table cellspacing='0' cellpadding='0' border='0'>
                        <tr>
                            <td width="370px">&nbsp</td><td align=right>Digite aqui o CEP para busca do endereço: </td>
                            <td><input name="cep" type="text" class="cep" value="" size="10" maxlength="9" /></td>
                        </tr>
                    </table>
                    <table cellspacing='0' cellpadding='0' border='1'>
                        <tr>
                            <td colspan="2" nome="endereco"><label>Endereço:</label><br />
                            <input name="endereco" type="text" id="endereco" size="80" /></td>    
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
            <form id="pj" method="get" action="#">
                <fieldset class='dCliente'>
                    <legend>Identificação</legend>
                    <table id=tabIdEmp cellspacing='0' cellpadding='0' border='1'>
                        <tr>
                            <td width=10px nome="<?= $identCnpj[0] ?>" ><label><?= $identCnpj[0] ?>:</label><br />
                                <input autofocus type="text" name="<?= $identCnpj[0] ?>" id="<?= $identCnpj[0] ?>" value="<?= $dados[$identCnpj[0]] ?>"/></td>
                            <td colspan=2 nome="<?= $identCnpj[1] ?>"><label><?= $identCnpj[1] ?>:</label><br />
                                <input size="50px" type="text" name="<?= $identCnpj[1] ?>" id="<?= $identCnpj[1] ?>" value="<?= $dados[$identCnpj[1]] ?>" /></td>
                        </tr>
                        <tr>
                            <td colspan=2 nome="<?= $identCnpj[2] ?>"><label>Razão Social:</label><br>
                                <input type="text" size="40px" name="<?= $identCnpj[2] ?>" id="<?= $identCnpj[2] ?>" value="<?= $dados[$identCnpj[2]] ?>" /></td>
                            <td width=10px nome="<?= $identCnpj[3] ?>"><label><?= $identCnpj[3] ?>:</label><br />
                                <input size=15px name="<?= $identCnpj[3] ?>" id="telefone" value="<?= $dados[$identCnpj[3]] ?>" /></td>
                        </tr>
                        <tr>
                            <td nome="<?= $identCnpj[4] ?>" colspan=3><label>E-mail:</label><br>
                                <input type="text" size="40px" name="<?= $identCnpj[4] ?>" id="<?= $identCnpj[4] ?>" value="<?= $dados[$identCnpj[4]] ?>" /></td>
                        </tr>
                        <tr>
                            <td nome="qsa" colspan=3><label>QSA:</label><br>
                                <input type="text" size="40px" name="qsa" id="qsa" value="<?= $dados['qsa']['nome'] ?>" /></td>
                        </tr>
                        <tr>
                            <td colspan=2 nome="atvPrincipal" ><label>Atividade Principal:</label><br>
                                <input type="text" size="70px" name="atvPrincipal" id="atvPrincipal" value="<?= $dados['atividade_principal']['text'][0]->text ?>" /></td>
                            <td nome="tipo" ><label>Tipo:</label><br>
                                <input size=10px type="text" name="tipo" id="tipo" value="<?= $dados['tipo'] ?>" /></td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset class='endCliente'>
                    <legend>Localização</legend>
                    <table cellspacing='0' cellpadding='0' border='1'>
                        <tr>
                            <td nome="endereco" ><label>Endereço:</label><br />
                                <input size="50px" type="text" name="endereco" id="endereco" value="<?= $dados['logradouro'] ?>"/></td>
                            <td nome="numero" ><label>N°:</label><br />
                                <input size="5px" type="text" name="numero" id="numero" value="<?= $dados['numero'] ?>"/></td>
                            <td nome="complemento" ><label>Complemento:</label><br />
                                <input size="15px" type="text" name="complemento" id="complemento" value="<?= $dados['complemento'] ?>"/></td>
                        </tr>
                        <tr>
                            <td nome="bairro" ><label>Bairro:</label><br />
                                <input size="20px" type="text" name="bairro" id="bairro" value="<?= $dados['bairro'] ?>"/></td>
                            <td nome="cidade" ><label>Cidade:</label><br />
                                <input size="20px" type="text" name="cidade" id="cidade" value="<?= $dados['municipio'] ?>"/></td>
                            <td nome="estado" ><label>Estado:</label><br />
                                <input size="5px" type="text" name="estado" id="estado" value="<?= $dados['uf'] ?>"/></td>
                        </tr>
                        <tr>
                            <td nome="cep" colspan=3><label>Cep:</label><br />
                                <input size="20px" type="text" name="cep" id="cep" value="<?= $dados['cep'] ?>"/></td>
                        </tr>
                    </table>
                </fieldset>
            </form>
            <div id='status'></div>
        </div>
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