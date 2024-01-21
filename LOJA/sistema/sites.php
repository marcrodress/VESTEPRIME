<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<? if($_GET['pg'] == 'consultar_cpf'){?>
<iframe src="http://www.receita.fazenda.gov.br/aplicacoes/atcta/cpf/consultapublica.asp" frameborder="0" width="1200" height="900"></iframe>
<? } ?>
<? if($_GET['pg'] == 'consultar_cnpj'){?>
<iframe src="http://www.receita.fazenda.gov.br/pessoajuridica/cnpj/cnpjreva/cnpjreva_solicitacao.asp" frameborder="0" width="1200" height="900"></iframe>
<? } ?>
<? if($_GET['pg'] == 'spc'){?>
<iframe src="https://servicos.spc.org.br/spc/controleacesso/autenticacao/entry.action" frameborder="0" width="1200" height="900"></iframe>
<? } ?>
<? if($_GET['pg'] == 'serasa'){?>
<iframe src="http://pme.serasaexperian.com.br/" frameborder="0" width="1200" height="900"></iframe>
<? } ?>
<? if($_GET['pg'] == 'google'){?>
<div class="module-search module">
<h3>Buscar No Blog</h3>
<div class="module-content">
<form action="http://blogsearch.google.com/blogsearch" method="get">
<input value=http://SEUBLOG.blogspot.com/ name="bl_url" type="hidden"/>
<label for="search" accesskey="4"></label><br/>
<input id="search" name="as_q" size="20" type="text"/>
<input value="Buscar" name="submit" type="submit"/></form></div></div>
<? } ?>
<? if($_GET['pg'] == 'easy_loan'){?>
<iframe src="http://www.easyloan.com.br" frameborder="0" width="1200" height="900"></iframe>
<? } ?>
<? if($_GET['pg'] == 'globo'){?>
<iframe src="http://www.globo.com" frameborder="0" width="1200" height="900"></iframe>
<? } ?>
<? if($_GET['pg'] == 'email'){?>
<iframe src="http://mail.google.com" frameborder="0" width="1200" height="900"></iframe>
<? } ?>
<? if($_GET['pg'] == 'scpc'){?>
<iframe src="https://www2.boavistaservicos.com.br/" frameborder="0" width="1200" height="900"></iframe>
<? } ?>
<? if($_GET['pg'] == 'itau'){?>
<iframe src="http://www.itau.com.br/cartoes/escolha/" frameborder="0" width="1200" height="900"></iframe>
<? } ?>
<? if($_GET['pg'] == 'brasil'){?>
<iframe src="https://www2.bancobrasil.com.br/aapf/login.jsp?aapf.IDH=sim&perfil=1" frameborder="0" width="1200" height="900"></iframe>
<? } ?>
<? if($_GET['pg'] == 'losango'){?>
<iframe src="http://www2.losango.com.br/1/2/losango/para-voce/cartoes-losango/cartao-losango-visa" frameborder="0" width="1200" height="900"></iframe>
<? } ?>
<? if($_GET['pg'] == 'localizao_documentos'){?>
<iframe src="http://portal.detran.ce.gov.br/index.php/localize-seus-documentos-veiculos" frameborder="0" width="1200" height="900"></iframe>
<? } ?>
<? if($_GET['pg'] == 'consultar_veiculos'){?>
<iframe src="http://portal.detran.ce.gov.br/index.php/consulta-de-veiculos" frameborder="0" width="1200" height="900"></iframe>
<? } ?>
<? if($_GET['pg'] == 'coelce'){?>
<iframe src="https://www.coelce.com.br/Default.aspx" frameborder="0" width="1200" height="900"></iframe>
<? } ?>
<? if($_GET['pg'] == 'inss'){?>
<iframe src="http://www3.dataprev.gov.br/cws/contexto/hiscre/index.html" frameborder="0" width="1200" height="900"></iframe>
<? } ?>
<? if($_GET['pg'] == 'imposto_de_renda_inss'){?>
<iframe src="http://www010.dataprev.gov.br/cws/contexto/irpf01/index.html" frameborder="0" width="1200" height="900"></iframe>
<? } ?>
</body>
</html>