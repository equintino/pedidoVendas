<?php class NotaSearchCriteria{ private $id;public function getid(){return $this->id;}public function setid($id){$this->id=$id;return $this;} private $tabela;public function gettabela(){return $this->tabela;}public function settabela($tabela){$this->tabela=$tabela;return $this;} private $excluido;public function getexcluido(){return $this->excluido;}public function setexcluido($excluido){$this->excluido=$excluido;return $this;} private $criado;public function getcriado(){return $this->criado;}public function setcriado($criado){$this->criado=$criado;return $this;} private $compl;public function getcompl(){return $this->compl;}public function setcompl($compl){$this->compl = $compl;return $this;} private $cChaveNFe;public function getcChaveNFe(){return $this->cChaveNFe;}public function setcChaveNFe($cChaveNFe){$this->cChaveNFe = $cChaveNFe;return $this;} private $cCodCateg;public function getcCodCateg(){return $this->cCodCateg;}public function setcCodCateg($cCodCateg){$this->cCodCateg = $cCodCateg;return $this;} private $cModFrete;public function getcModFrete(){return $this->cModFrete;}public function setcModFrete($cModFrete){$this->cModFrete = $cModFrete;return $this;} private $nIdNF;public function getnIdNF(){return $this->nIdNF;}public function setnIdNF($nIdNF){$this->nIdNF = $nIdNF;return $this;} private $nIdPedido;public function getnIdPedido(){return $this->nIdPedido;}public function setnIdPedido($nIdPedido){$this->nIdPedido = $nIdPedido;return $this;} private $nIdReceb;public function getnIdReceb(){return $this->nIdReceb;}public function setnIdReceb($nIdReceb){$this->nIdReceb = $nIdReceb;return $this;} private $nIdTransp;public function getnIdTransp(){return $this->nIdTransp;}public function setnIdTransp($nIdTransp){$this->nIdTransp = $nIdTransp;return $this;} private $det;public function getdet(){return $this->det;}public function setdet($det){$this->det = $det;return $this;} private $nfProdInt;public function getnfProdInt(){return $this->nfProdInt;}public function setnfProdInt($nfProdInt){$this->nfProdInt = $nfProdInt;return $this;} private $cCodItemInt;public function getcCodItemInt(){return $this->cCodItemInt;}public function setcCodItemInt($cCodItemInt){$this->cCodItemInt = $cCodItemInt;return $this;} private $cCodProdInt;public function getcCodProdInt(){return $this->cCodProdInt;}public function setcCodProdInt($cCodProdInt){$this->cCodProdInt = $cCodProdInt;return $this;} private $nCodItem;public function getnCodItem(){return $this->nCodItem;}public function setnCodItem($nCodItem){$this->nCodItem = $nCodItem;return $this;} private $nCodProd;public function getnCodProd(){return $this->nCodProd;}public function setnCodProd($nCodProd){$this->nCodProd = $nCodProd;return $this;} private $prod;public function getprod(){return $this->prod;}public function setprod($prod){$this->prod = $prod;return $this;} private $CFOP;public function getCFOP(){return $this->CFOP;}public function setCFOP($CFOP){$this->CFOP = $CFOP;return $this;} private $EXTIPI;public function getEXTIPI(){return $this->EXTIPI;}public function setEXTIPI($EXTIPI){$this->EXTIPI = $EXTIPI;return $this;} private $NCM;public function getNCM(){return $this->NCM;}public function setNCM($NCM){$this->NCM = $NCM;return $this;} private $cEAN;public function getcEAN(){return $this->cEAN;}public function setcEAN($cEAN){$this->cEAN = $cEAN;return $this;} private $cEANTrib;public function getcEANTrib(){return $this->cEANTrib;}public function setcEANTrib($cEANTrib){$this->cEANTrib = $cEANTrib;return $this;} private $cProd;public function getcProd(){return $this->cProd;}public function setcProd($cProd){$this->cProd = $cProd;return $this;} private $cProdOrig;public function getcProdOrig(){return $this->cProdOrig;}public function setcProdOrig($cProdOrig){$this->cProdOrig = $cProdOrig;return $this;} private $indTot;public function getindTot(){return $this->indTot;}public function setindTot($indTot){$this->indTot = $indTot;return $this;} private $nCMCTotal;public function getnCMCTotal(){return $this->nCMCTotal;}public function setnCMCTotal($nCMCTotal){$this->nCMCTotal = $nCMCTotal;return $this;} private $nCMCUnitario;public function getnCMCUnitario(){return $this->nCMCUnitario;}public function setnCMCUnitario($nCMCUnitario){$this->nCMCUnitario = $nCMCUnitario;return $this;} private $qCom;public function getqCom(){return $this->qCom;}public function setqCom($qCom){$this->qCom = $qCom;return $this;} private $qTrib;public function getqTrib(){return $this->qTrib;}public function setqTrib($qTrib){$this->qTrib = $qTrib;return $this;} private $uCom;public function getuCom(){return $this->uCom;}public function setuCom($uCom){$this->uCom = $uCom;return $this;} private $uTrib;public function getuTrib(){return $this->uTrib;}public function setuTrib($uTrib){$this->uTrib = $uTrib;return $this;} private $vDesc;public function getvDesc(){return $this->vDesc;}public function setvDesc($vDesc){$this->vDesc = $vDesc;return $this;} private $vFrete;public function getvFrete(){return $this->vFrete;}public function setvFrete($vFrete){$this->vFrete = $vFrete;return $this;} private $vOutro;public function getvOutro(){return $this->vOutro;}public function setvOutro($vOutro){$this->vOutro = $vOutro;return $this;} private $vProd;public function getvProd(){return $this->vProd;}public function setvProd($vProd){$this->vProd = $vProd;return $this;} private $vSeg;public function getvSeg(){return $this->vSeg;}public function setvSeg($vSeg){$this->vSeg = $vSeg;return $this;} private $vUnCom;public function getvUnCom(){return $this->vUnCom;}public function setvUnCom($vUnCom){$this->vUnCom = $vUnCom;return $this;} private $vUnTrib;public function getvUnTrib(){return $this->vUnTrib;}public function setvUnTrib($vUnTrib){$this->vUnTrib = $vUnTrib;return $this;} private $xProd;public function getxProd(){return $this->xProd;}public function setxProd($xProd){$this->xProd = $xProd;return $this;} private $xProdOrig;public function getxProdOrig(){return $this->xProdOrig;}public function setxProdOrig($xProdOrig){$this->xProdOrig = $xProdOrig;return $this;} private $ide;public function getide(){return $this->ide;}public function setide($ide){$this->ide = $ide;return $this;} private $dCan;public function getdCan(){return $this->dCan;}public function setdCan($dCan){$this->dCan = $dCan;return $this;} private $dEmi;public function getdEmi(){return $this->dEmi;}public function setdEmi($dEmi){$this->dEmi = $dEmi;return $this;} private $dInut;public function getdInut(){return $this->dInut;}public function setdInut($dInut){$this->dInut = $dInut;return $this;} private $dReg;public function getdReg(){return $this->dReg;}public function setdReg($dReg){$this->dReg = $dReg;return $this;} private $dSaiEnt;public function getdSaiEnt(){return $this->dSaiEnt;}public function setdSaiEnt($dSaiEnt){$this->dSaiEnt = $dSaiEnt;return $this;} private $finNFe;public function getfinNFe(){return $this->finNFe;}public function setfinNFe($finNFe){$this->finNFe = $finNFe;return $this;} private $hEmi;public function gethEmi(){return $this->hEmi;}public function sethEmi($hEmi){$this->hEmi = $hEmi;return $this;} private $hSaiEnt;public function gethSaiEnt(){return $this->hSaiEnt;}public function sethSaiEnt($hSaiEnt){$this->hSaiEnt = $hSaiEnt;return $this;} private $indPag;public function getindPag(){return $this->indPag;}public function setindPag($indPag){$this->indPag = $indPag;return $this;} private $mod;public function getmod(){return $this->mod;}public function setmod($mod){$this->mod = $mod;return $this;} private $nNF;public function getnNF(){return $this->nNF;}public function setnNF($nNF){$this->nNF = $nNF;return $this;} private $serie;public function getserie(){return $this->serie;}public function setserie($serie){$this->serie = $serie;return $this;} private $tpAmb;public function gettpAmb(){return $this->tpAmb;}public function settpAmb($tpAmb){$this->tpAmb = $tpAmb;return $this;} private $tpNF;public function gettpNF(){return $this->tpNF;}public function settpNF($tpNF){$this->tpNF = $tpNF;return $this;} private $info;public function getinfo(){return $this->info;}public function setinfo($info){$this->info = $info;return $this;} private $cImpAPI;public function getcImpAPI(){return $this->cImpAPI;}public function setcImpAPI($cImpAPI){$this->cImpAPI = $cImpAPI;return $this;} private $dAlt;public function getdAlt(){return $this->dAlt;}public function setdAlt($dAlt){$this->dAlt = $dAlt;return $this;} private $dInc;public function getdInc(){return $this->dInc;}public function setdInc($dInc){$this->dInc = $dInc;return $this;} private $hAlt;public function gethAlt(){return $this->hAlt;}public function sethAlt($hAlt){$this->hAlt = $hAlt;return $this;} private $hInc;public function gethInc(){return $this->hInc;}public function sethInc($hInc){$this->hInc = $hInc;return $this;} private $uAlt;public function getuAlt(){return $this->uAlt;}public function setuAlt($uAlt){$this->uAlt = $uAlt;return $this;} private $uInc;public function getuInc(){return $this->uInc;}public function setuInc($uInc){$this->uInc = $uInc;return $this;} private $nfDestInt;public function getnfDestInt(){return $this->nfDestInt;}public function setnfDestInt($nfDestInt){$this->nfDestInt = $nfDestInt;return $this;} private $cCodCliInt;public function getcCodCliInt(){return $this->cCodCliInt;}public function setcCodCliInt($cCodCliInt){$this->cCodCliInt = $cCodCliInt;return $this;} private $nCodCli;public function getnCodCli(){return $this->nCodCli;}public function setnCodCli($nCodCli){$this->nCodCli = $nCodCli;return $this;} private $nfEmitInt;public function getnfEmitInt(){return $this->nfEmitInt;}public function setnfEmitInt($nfEmitInt){$this->nfEmitInt = $nfEmitInt;return $this;} private $cCodEmpInt;public function getcCodEmpInt(){return $this->cCodEmpInt;}public function setcCodEmpInt($cCodEmpInt){$this->cCodEmpInt = $cCodEmpInt;return $this;} private $nCodEmp;public function getnCodEmp(){return $this->nCodEmp;}public function setnCodEmp($nCodEmp){$this->nCodEmp = $nCodEmp;return $this;} private $pedido;public function getpedido(){return $this->pedido;}public function setpedido($pedido){$this->pedido = $pedido;return $this;} private $titulos;public function gettitulos(){return $this->titulos;}public function settitulos($titulos){$this->titulos = $titulos;return $this;} private $cCodIntTitulo;public function getcCodIntTitulo(){return $this->cCodIntTitulo;}public function setcCodIntTitulo($cCodIntTitulo){$this->cCodIntTitulo = $cCodIntTitulo;return $this;} private $cNumTitulo;public function getcNumTitulo(){return $this->cNumTitulo;}public function setcNumTitulo($cNumTitulo){$this->cNumTitulo = $cNumTitulo;return $this;} private $dDtEmissao;public function getdDtEmissao(){return $this->dDtEmissao;}public function setdDtEmissao($dDtEmissao){$this->dDtEmissao = $dDtEmissao;return $this;} private $dDtPrevisao;public function getdDtPrevisao(){return $this->dDtPrevisao;}public function setdDtPrevisao($dDtPrevisao){$this->dDtPrevisao = $dDtPrevisao;return $this;} private $dDtVenc;public function getdDtVenc(){return $this->dDtVenc;}public function setdDtVenc($dDtVenc){$this->dDtVenc = $dDtVenc;return $this;} private $nCodComprador;public function getnCodComprador(){return $this->nCodComprador;}public function setnCodComprador($nCodComprador){$this->nCodComprador = $nCodComprador;return $this;} private $nCodProjeto;public function getnCodProjeto(){return $this->nCodProjeto;}public function setnCodProjeto($nCodProjeto){$this->nCodProjeto = $nCodProjeto;return $this;} private $nCodTitRepet;public function getnCodTitRepet(){return $this->nCodTitRepet;}public function setnCodTitRepet($nCodTitRepet){$this->nCodTitRepet = $nCodTitRepet;return $this;} private $nCodTitulo;public function getnCodTitulo(){return $this->nCodTitulo;}public function setnCodTitulo($nCodTitulo){$this->nCodTitulo = $nCodTitulo;return $this;} private $nCodVendedor;public function getnCodVendedor(){return $this->nCodVendedor;}public function setnCodVendedor($nCodVendedor){$this->nCodVendedor = $nCodVendedor;return $this;} private $nParcela;public function getnParcela(){return $this->nParcela;}public function setnParcela($nParcela){$this->nParcela = $nParcela;return $this;} private $nTotParc;public function getnTotParc(){return $this->nTotParc;}public function setnTotParc($nTotParc){$this->nTotParc = $nTotParc;return $this;} private $nValorTitulo;public function getnValorTitulo(){return $this->nValorTitulo;}public function setnValorTitulo($nValorTitulo){$this->nValorTitulo = $nValorTitulo;return $this;} private $total;public function gettotal(){return $this->total;}public function settotal($total){$this->total = $total;return $this;} private $ICMSTot;public function getICMSTot(){return $this->ICMSTot;}public function setICMSTot($ICMSTot){$this->ICMSTot = $ICMSTot;return $this;} private $vBC;public function getvBC(){return $this->vBC;}public function setvBC($vBC){$this->vBC = $vBC;return $this;} private $vBCST;public function getvBCST(){return $this->vBCST;}public function setvBCST($vBCST){$this->vBCST = $vBCST;return $this;} private $vCOFINS;public function getvCOFINS(){return $this->vCOFINS;}public function setvCOFINS($vCOFINS){$this->vCOFINS = $vCOFINS;return $this;} private $vICMS;public function getvICMS(){return $this->vICMS;}public function setvICMS($vICMS){$this->vICMS = $vICMS;return $this;} private $vII;public function getvII(){return $this->vII;}public function setvII($vII){$this->vII = $vII;return $this;} private $vIPI;public function getvIPI(){return $this->vIPI;}public function setvIPI($vIPI){$this->vIPI = $vIPI;return $this;} private $vNF;public function getvNF(){return $this->vNF;}public function setvNF($vNF){$this->vNF = $vNF;return $this;} private $vPIS;public function getvPIS(){return $this->vPIS;}public function setvPIS($vPIS){$this->vPIS = $vPIS;return $this;} private $vST;public function getvST(){return $this->vST;}public function setvST($vST){$this->vST = $vST;return $this;} private $vTotTrib;public function getvTotTrib(){return $this->vTotTrib;}public function setvTotTrib($vTotTrib){$this->vTotTrib = $vTotTrib;return $this;} private $ISSQNtot;public function getISSQNtot(){return $this->ISSQNtot;}public function setISSQNtot($ISSQNtot){$this->ISSQNtot = $ISSQNtot;return $this;} private $vISS;public function getvISS(){return $this->vISS;}public function setvISS($vISS){$this->vISS = $vISS;return $this;} private $vServ;public function getvServ(){return $this->vServ;}public function setvServ($vServ){$this->vServ = $vServ;return $this;} private $retTrib;public function getretTrib(){return $this->retTrib;}public function setretTrib($retTrib){$this->retTrib = $retTrib;return $this;} private $vBCIRRF;public function getvBCIRRF(){return $this->vBCIRRF;}public function setvBCIRRF($vBCIRRF){$this->vBCIRRF = $vBCIRRF;return $this;} private $vBCRetPrev;public function getvBCRetPrev(){return $this->vBCRetPrev;}public function setvBCRetPrev($vBCRetPrev){$this->vBCRetPrev = $vBCRetPrev;return $this;} private $vIRRF;public function getvIRRF(){return $this->vIRRF;}public function setvIRRF($vIRRF){$this->vIRRF = $vIRRF;return $this;} private $vRetCOFINS;public function getvRetCOFINS(){return $this->vRetCOFINS;}public function setvRetCOFINS($vRetCOFINS){$this->vRetCOFINS = $vRetCOFINS;return $this;} private $vRetCSLL;public function getvRetCSLL(){return $this->vRetCSLL;}public function setvRetCSLL($vRetCSLL){$this->vRetCSLL = $vRetCSLL;return $this;} private $vRetPIS;public function getvRetPIS(){return $this->vRetPIS;}public function setvRetPIS($vRetPIS){$this->vRetPIS = $vRetPIS;return $this;} private $vRetPrev;public function getvRetPrev(){return $this->vRetPrev;}public function setvRetPrev($vRetPrev){$this->vRetPrev = $vRetPrev;return $this;} private $modificado;public function getmodificado(){return $this->modificado;}public function setmodificado($modificado){$this->modificado = $modificado;return $this;}}