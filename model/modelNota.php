<?php class nota{ private $id;  public function getid(){return $this->id; } public function setid($id){$this->id=$id; } private $tabela;  public function gettabela(){return $this->tabela; } public function settabela($tabela){$this->tabela=$tabela; } private $excluido;  public function getexcluido(){return $this->excluido; } public function setexcluido($excluido){$this->excluido=$excluido; } private $criado;  public function getcriado(){return $this->criado; } public function setcriado($criado){$this->criado=$criado; } private $compl; public function getcompl(){return $this->compl; } public function setcompl($compl ){$this->compl=$compl; } private $cChaveNFe; public function getcChaveNFe(){return $this->cChaveNFe; } public function setcChaveNFe($cChaveNFe ){$this->cChaveNFe=$cChaveNFe; } private $cCodCateg; public function getcCodCateg(){return $this->cCodCateg; } public function setcCodCateg($cCodCateg ){$this->cCodCateg=$cCodCateg; } private $cModFrete; public function getcModFrete(){return $this->cModFrete; } public function setcModFrete($cModFrete ){$this->cModFrete=$cModFrete; } private $nIdNF; public function getnIdNF(){return $this->nIdNF; } public function setnIdNF($nIdNF ){$this->nIdNF=$nIdNF; } private $nIdPedido; public function getnIdPedido(){return $this->nIdPedido; } public function setnIdPedido($nIdPedido ){$this->nIdPedido=$nIdPedido; } private $nIdReceb; public function getnIdReceb(){return $this->nIdReceb; } public function setnIdReceb($nIdReceb ){$this->nIdReceb=$nIdReceb; } private $nIdTransp; public function getnIdTransp(){return $this->nIdTransp; } public function setnIdTransp($nIdTransp ){$this->nIdTransp=$nIdTransp; } private $det; public function getdet(){return $this->det; } public function setdet($det ){$this->det=$det; } private $nfProdInt; public function getnfProdInt(){return $this->nfProdInt; } public function setnfProdInt($nfProdInt ){$this->nfProdInt=$nfProdInt; } private $cCodItemInt; public function getcCodItemInt(){return $this->cCodItemInt; } public function setcCodItemInt($cCodItemInt ){$this->cCodItemInt=$cCodItemInt; } private $cCodProdInt; public function getcCodProdInt(){return $this->cCodProdInt; } public function setcCodProdInt($cCodProdInt ){$this->cCodProdInt=$cCodProdInt; } private $nCodItem; public function getnCodItem(){return $this->nCodItem; } public function setnCodItem($nCodItem ){$this->nCodItem=$nCodItem; } private $nCodProd; public function getnCodProd(){return $this->nCodProd; } public function setnCodProd($nCodProd ){$this->nCodProd=$nCodProd; } private $prod; public function getprod(){return $this->prod; } public function setprod($prod ){$this->prod=$prod; } private $CFOP; public function getCFOP(){return $this->CFOP; } public function setCFOP($CFOP ){$this->CFOP=$CFOP; } private $EXTIPI; public function getEXTIPI(){return $this->EXTIPI; } public function setEXTIPI($EXTIPI ){$this->EXTIPI=$EXTIPI; } private $NCM; public function getNCM(){return $this->NCM; } public function setNCM($NCM ){$this->NCM=$NCM; } private $cEAN; public function getcEAN(){return $this->cEAN; } public function setcEAN($cEAN ){$this->cEAN=$cEAN; } private $cEANTrib; public function getcEANTrib(){return $this->cEANTrib; } public function setcEANTrib($cEANTrib ){$this->cEANTrib=$cEANTrib; } private $cProd; public function getcProd(){return $this->cProd; } public function setcProd($cProd ){$this->cProd=$cProd; } private $cProdOrig; public function getcProdOrig(){return $this->cProdOrig; } public function setcProdOrig($cProdOrig ){$this->cProdOrig=$cProdOrig; } private $indTot; public function getindTot(){return $this->indTot; } public function setindTot($indTot ){$this->indTot=$indTot; } private $nCMCTotal; public function getnCMCTotal(){return $this->nCMCTotal; } public function setnCMCTotal($nCMCTotal ){$this->nCMCTotal=$nCMCTotal; } private $nCMCUnitario; public function getnCMCUnitario(){return $this->nCMCUnitario; } public function setnCMCUnitario($nCMCUnitario ){$this->nCMCUnitario=$nCMCUnitario; } private $qCom; public function getqCom(){return $this->qCom; } public function setqCom($qCom ){$this->qCom=$qCom; } private $qTrib; public function getqTrib(){return $this->qTrib; } public function setqTrib($qTrib ){$this->qTrib=$qTrib; } private $uCom; public function getuCom(){return $this->uCom; } public function setuCom($uCom ){$this->uCom=$uCom; } private $uTrib; public function getuTrib(){return $this->uTrib; } public function setuTrib($uTrib ){$this->uTrib=$uTrib; } private $vDesc; public function getvDesc(){return $this->vDesc; } public function setvDesc($vDesc ){$this->vDesc=$vDesc; } private $vFrete; public function getvFrete(){return $this->vFrete; } public function setvFrete($vFrete ){$this->vFrete=$vFrete; } private $vOutro; public function getvOutro(){return $this->vOutro; } public function setvOutro($vOutro ){$this->vOutro=$vOutro; } private $vProd; public function getvProd(){return $this->vProd; } public function setvProd($vProd ){$this->vProd=$vProd; } private $vSeg; public function getvSeg(){return $this->vSeg; } public function setvSeg($vSeg ){$this->vSeg=$vSeg; } private $vUnCom; public function getvUnCom(){return $this->vUnCom; } public function setvUnCom($vUnCom ){$this->vUnCom=$vUnCom; } private $vUnTrib; public function getvUnTrib(){return $this->vUnTrib; } public function setvUnTrib($vUnTrib ){$this->vUnTrib=$vUnTrib; } private $xProd; public function getxProd(){return $this->xProd; } public function setxProd($xProd ){$this->xProd=$xProd; } private $xProdOrig; public function getxProdOrig(){return $this->xProdOrig; } public function setxProdOrig($xProdOrig ){$this->xProdOrig=$xProdOrig; } private $ide; public function getide(){return $this->ide; } public function setide($ide ){$this->ide=$ide; } private $dCan; public function getdCan(){return $this->dCan; } public function setdCan($dCan ){$this->dCan=$dCan; } private $dEmi; public function getdEmi(){return $this->dEmi; } public function setdEmi($dEmi ){$this->dEmi=$dEmi; } private $dInut; public function getdInut(){return $this->dInut; } public function setdInut($dInut ){$this->dInut=$dInut; } private $dReg; public function getdReg(){return $this->dReg; } public function setdReg($dReg ){$this->dReg=$dReg; } private $dSaiEnt; public function getdSaiEnt(){return $this->dSaiEnt; } public function setdSaiEnt($dSaiEnt ){$this->dSaiEnt=$dSaiEnt; } private $finNFe; public function getfinNFe(){return $this->finNFe; } public function setfinNFe($finNFe ){$this->finNFe=$finNFe; } private $hEmi; public function gethEmi(){return $this->hEmi; } public function sethEmi($hEmi ){$this->hEmi=$hEmi; } private $hSaiEnt; public function gethSaiEnt(){return $this->hSaiEnt; } public function sethSaiEnt($hSaiEnt ){$this->hSaiEnt=$hSaiEnt; } private $indPag; public function getindPag(){return $this->indPag; } public function setindPag($indPag ){$this->indPag=$indPag; } private $mod; public function getmod(){return $this->mod; } public function setmod($mod ){$this->mod=$mod; } private $nNF; public function getnNF(){return $this->nNF; } public function setnNF($nNF ){$this->nNF=$nNF; } private $serie; public function getserie(){return $this->serie; } public function setserie($serie ){$this->serie=$serie; } private $tpAmb; public function gettpAmb(){return $this->tpAmb; } public function settpAmb($tpAmb ){$this->tpAmb=$tpAmb; } private $tpNF; public function gettpNF(){return $this->tpNF; } public function settpNF($tpNF ){$this->tpNF=$tpNF; } private $info; public function getinfo(){return $this->info; } public function setinfo($info ){$this->info=$info; } private $cImpAPI; public function getcImpAPI(){return $this->cImpAPI; } public function setcImpAPI($cImpAPI ){$this->cImpAPI=$cImpAPI; } private $dAlt; public function getdAlt(){return $this->dAlt; } public function setdAlt($dAlt ){$this->dAlt=$dAlt; } private $dInc; public function getdInc(){return $this->dInc; } public function setdInc($dInc ){$this->dInc=$dInc; } private $hAlt; public function gethAlt(){return $this->hAlt; } public function sethAlt($hAlt ){$this->hAlt=$hAlt; } private $hInc; public function gethInc(){return $this->hInc; } public function sethInc($hInc ){$this->hInc=$hInc; } private $uAlt; public function getuAlt(){return $this->uAlt; } public function setuAlt($uAlt ){$this->uAlt=$uAlt; } private $uInc; public function getuInc(){return $this->uInc; } public function setuInc($uInc ){$this->uInc=$uInc; } private $nfDestInt; public function getnfDestInt(){return $this->nfDestInt; } public function setnfDestInt($nfDestInt ){$this->nfDestInt=$nfDestInt; } private $cCodCliInt; public function getcCodCliInt(){return $this->cCodCliInt; } public function setcCodCliInt($cCodCliInt ){$this->cCodCliInt=$cCodCliInt; } private $nCodCli; public function getnCodCli(){return $this->nCodCli; } public function setnCodCli($nCodCli ){$this->nCodCli=$nCodCli; } private $nfEmitInt; public function getnfEmitInt(){return $this->nfEmitInt; } public function setnfEmitInt($nfEmitInt ){$this->nfEmitInt=$nfEmitInt; } private $cCodEmpInt; public function getcCodEmpInt(){return $this->cCodEmpInt; } public function setcCodEmpInt($cCodEmpInt ){$this->cCodEmpInt=$cCodEmpInt; } private $nCodEmp; public function getnCodEmp(){return $this->nCodEmp; } public function setnCodEmp($nCodEmp ){$this->nCodEmp=$nCodEmp; } private $pedido; public function getpedido(){return $this->pedido; } public function setpedido($pedido ){$this->pedido=$pedido; } private $titulos; public function gettitulos(){return $this->titulos; } public function settitulos($titulos ){$this->titulos=$titulos; } private $cCodIntTitulo; public function getcCodIntTitulo(){return $this->cCodIntTitulo; } public function setcCodIntTitulo($cCodIntTitulo ){$this->cCodIntTitulo=$cCodIntTitulo; } private $cNumTitulo; public function getcNumTitulo(){return $this->cNumTitulo; } public function setcNumTitulo($cNumTitulo ){$this->cNumTitulo=$cNumTitulo; } private $dDtEmissao; public function getdDtEmissao(){return $this->dDtEmissao; } public function setdDtEmissao($dDtEmissao ){$this->dDtEmissao=$dDtEmissao; } private $dDtPrevisao; public function getdDtPrevisao(){return $this->dDtPrevisao; } public function setdDtPrevisao($dDtPrevisao ){$this->dDtPrevisao=$dDtPrevisao; } private $dDtVenc; public function getdDtVenc(){return $this->dDtVenc; } public function setdDtVenc($dDtVenc ){$this->dDtVenc=$dDtVenc; } private $nCodComprador; public function getnCodComprador(){return $this->nCodComprador; } public function setnCodComprador($nCodComprador ){$this->nCodComprador=$nCodComprador; } private $nCodProjeto; public function getnCodProjeto(){return $this->nCodProjeto; } public function setnCodProjeto($nCodProjeto ){$this->nCodProjeto=$nCodProjeto; } private $nCodTitRepet; public function getnCodTitRepet(){return $this->nCodTitRepet; } public function setnCodTitRepet($nCodTitRepet ){$this->nCodTitRepet=$nCodTitRepet; } private $nCodTitulo; public function getnCodTitulo(){return $this->nCodTitulo; } public function setnCodTitulo($nCodTitulo ){$this->nCodTitulo=$nCodTitulo; } private $nCodVendedor; public function getnCodVendedor(){return $this->nCodVendedor; } public function setnCodVendedor($nCodVendedor ){$this->nCodVendedor=$nCodVendedor; } private $nParcela; public function getnParcela(){return $this->nParcela; } public function setnParcela($nParcela ){$this->nParcela=$nParcela; } private $nTotParc; public function getnTotParc(){return $this->nTotParc; } public function setnTotParc($nTotParc ){$this->nTotParc=$nTotParc; } private $nValorTitulo; public function getnValorTitulo(){return $this->nValorTitulo; } public function setnValorTitulo($nValorTitulo ){$this->nValorTitulo=$nValorTitulo; } private $total; public function gettotal(){return $this->total; } public function settotal($total ){$this->total=$total; } private $ICMSTot; public function getICMSTot(){return $this->ICMSTot; } public function setICMSTot($ICMSTot ){$this->ICMSTot=$ICMSTot; } private $vBC; public function getvBC(){return $this->vBC; } public function setvBC($vBC ){$this->vBC=$vBC; } private $vBCST; public function getvBCST(){return $this->vBCST; } public function setvBCST($vBCST ){$this->vBCST=$vBCST; } private $vCOFINS; public function getvCOFINS(){return $this->vCOFINS; } public function setvCOFINS($vCOFINS ){$this->vCOFINS=$vCOFINS; } private $vICMS; public function getvICMS(){return $this->vICMS; } public function setvICMS($vICMS ){$this->vICMS=$vICMS; } private $vII; public function getvII(){return $this->vII; } public function setvII($vII ){$this->vII=$vII; } private $vIPI; public function getvIPI(){return $this->vIPI; } public function setvIPI($vIPI ){$this->vIPI=$vIPI; } private $vNF; public function getvNF(){return $this->vNF; } public function setvNF($vNF ){$this->vNF=$vNF; } private $vPIS; public function getvPIS(){return $this->vPIS; } public function setvPIS($vPIS ){$this->vPIS=$vPIS; } private $vST; public function getvST(){return $this->vST; } public function setvST($vST ){$this->vST=$vST; } private $vTotTrib; public function getvTotTrib(){return $this->vTotTrib; } public function setvTotTrib($vTotTrib ){$this->vTotTrib=$vTotTrib; } private $ISSQNtot; public function getISSQNtot(){return $this->ISSQNtot; } public function setISSQNtot($ISSQNtot ){$this->ISSQNtot=$ISSQNtot; } private $vISS; public function getvISS(){return $this->vISS; } public function setvISS($vISS ){$this->vISS=$vISS; } private $vServ; public function getvServ(){return $this->vServ; } public function setvServ($vServ ){$this->vServ=$vServ; } private $retTrib; public function getretTrib(){return $this->retTrib; } public function setretTrib($retTrib ){$this->retTrib=$retTrib; } private $vBCIRRF; public function getvBCIRRF(){return $this->vBCIRRF; } public function setvBCIRRF($vBCIRRF ){$this->vBCIRRF=$vBCIRRF; } private $vBCRetPrev; public function getvBCRetPrev(){return $this->vBCRetPrev; } public function setvBCRetPrev($vBCRetPrev ){$this->vBCRetPrev=$vBCRetPrev; } private $vIRRF; public function getvIRRF(){return $this->vIRRF; } public function setvIRRF($vIRRF ){$this->vIRRF=$vIRRF; } private $vRetCOFINS; public function getvRetCOFINS(){return $this->vRetCOFINS; } public function setvRetCOFINS($vRetCOFINS ){$this->vRetCOFINS=$vRetCOFINS; } private $vRetCSLL; public function getvRetCSLL(){return $this->vRetCSLL; } public function setvRetCSLL($vRetCSLL ){$this->vRetCSLL=$vRetCSLL; } private $vRetPIS; public function getvRetPIS(){return $this->vRetPIS; } public function setvRetPIS($vRetPIS ){$this->vRetPIS=$vRetPIS; } private $vRetPrev; public function getvRetPrev(){return $this->vRetPrev; } public function setvRetPrev($vRetPrev ){$this->vRetPrev=$vRetPrev; } private $modificado; public function getmodificado(){return $this->modificado; } public function setmodificado($modificado ){$this->modificado=$modificado; } }