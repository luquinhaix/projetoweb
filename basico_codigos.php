<?
$conexao=mysqli_connect("localhost","root","","sistema1");
$Tipo		= $_GET['Tipo'];
$cd_nome	= $_GET['cd_nome'];
if ($Tipo == "excluir")
{
	$RSS = mysqli_query($conexao,"DELETE FROM cadastros where cd_nome=$cd_nome"); 
	$cd_nome = 0;
}

if ($Tipo == "salva")
{
	$SQL = "select * from cadastros where cd_nome=".$cd_nome;
	$RSS = mysqli_query($conexao,$SQL)or print(mysqli_error());
	$RSX = mysqli_fetch_assoc($RSS); 	
	If ( $RSX["cd_nome"] == $cd_nome )
	{
		$SQL  = "update cadastros set ds_nome='".str_replace("'","",$_GET['ds_nome'])."',";
		$SQL .= "ds_fo_ne='".str_replace("'","",$_GET['ds_fone'])."', ";
		$SQL .= "ds_email='".str_replace("'","",$_GET['ds_email'])."',	 ";
		$SQL .= "ds_cidade='".str_replace("'","",$_GET['ds_cidade'])."' ";
		$SQL .= "where cd_nome = '". $RSX["cd_nome"]."'";
		 echo $SQL;
		$RSS = mysqli_query($conexao,$SQL) or print($SQL);  

		echo "<script language='JavaScript'>alert('Operacao realizada com sucesso.');</script>";
	} 
	Else
	{
		$SQL  = "Insert into cadastros (ds_nome,ds_fone,ds_email,ds_cidade) "   ; 
		$SQL .= "VALUES ('".str_replace("'","",$_GET['ds_nome'])."',";
		$SQL .= "'".str_replace("'","",$_GET['ds_fone'])."',";
		$SQL .= "'".str_replace("'","",$_GET['ds_email'])."',";
		$SQL .= "'".str_replace("'","",$_GET['ds_cidade'])."')";
		//echo $SQL;
		$RSS = mysqli_query($conexao,$SQL) or die('erro');

		$SQL = "select * from cadastros  order by cd_nome desc limit 1";
		$RSS = mysqli_query($conexao,$SQL)or print(mysqli_error());
		$RSX = mysqli_fetch_assoc($RSS); 
		$cd_nome = $RSX["cd_nome"];
		echo "<script>alert('Registro Inserido.');</script>";
	}
} 

if ( strlen($cd_nome) == 0 )  $cd_nome = 0;
$SQL = "Select * from cadastros  where cd_nome = $cd_nome";
$RSS = mysqli_query($conexao,$SQL) or print(mysqli_error());
$RS = mysqli_fetch_assoc($RSS);	

?>
<html>
<body style="scroll-x:hidden;" >
<font style='font-size:24px; font-family:Arial;'><center>.: Meu cadastros  Nº <b><?=$cd_nome?></b>:.</center></font>
<fieldset><legend style='font-size:9px; font-family:Arial;'>Meu cadastros </legend>
	<form name="forma" action="basico.php">
	<input type="hidden" name="cd_nome" id="cd_nome" value="<?=$cd_nome;?>">
	<input type="hidden" name="Tipo" id="Tipo" value="salva">
	<table border=0 align="center" width="80%" style="font-family:verdana;font-size:10px;" cellpadding='1' cellspacing='0'>
	<tr> 
	  <td align="right">Nome </td>
	  <td><input type="text" id="ds_nome" name="ds_nome" 
	  size="60" value="<?=$RS["ds_nome"];?>" maxlength="70" style="background-color:#FFFFBB;"></td>
	</tr>
	<tr> 
	  <td align="right">Fone </td>
		<td><input type="text" id="ds_fone" name="ds_fone" size="13" value="<?=$RS["ds_fone"];?>" maxlength="12" style="background-color:#FFFFBB;"></td>
	</tr>	
	<tr> 
	  <td align="right">email </td>
	  <td><input type="text" id="ds_email" name="ds_email" 
	  size="60" value="<?=$RS["ds_email"];?>" maxlength="70" style="background-color:#FFFFBB;"></td>
	</tr>
	<tr> 
	  <td align="right">cidade </td>
		<td><input type="text" id="ds_cidade" name="ds_cidade" size="13" value="<?=$RS["ds_cidade"];?>" maxlength="12" style="background-color:#FFFFBB;"></td>
	</tr>		
	</table>

	<div align="center">
	  <input value="Novo" id="BtNovo" name="BtNovo"  type="button" onClick="window.open('basico.php','_self');" style="position: relative; width: 70">
	  <input type="button" value='Salvar' onclick='salvar()'>
	  <input type="button" value='Excluir' onclick='exclui(<?=$cd_nome;?>);'>
	</div>
</form>
</fieldset>

<?php
echo "<hr><table id='grid' name='grid' width='90%'  border style='font-family:verdana; font-size:10px;'>";

$SQL = "select * from cadastros  order by ds_nome";
$RSS = mysqli_query($conexao,$SQL)or print(mysqli_error());
while($RS = mysqli_fetch_array($RSS))
{
	echo "<tr onClick='Clica(".$RS["cd_nome"].")' >";
	echo "<td>".$RS["ds_nome"]."</td>";
	echo "<td>".$RS["ds_fone"]."</td>";
	echo "<td>".$RS["ds_email"]."</td>";
	echo "<td>".$RS["ds_cidade"]."</td>";
	echo "</tr>";
}
echo "</table></body></html>";
?>

<script language="javascript">
function Clica(cd_nome)
{
	window.open('basico.php?cd_nome='+cd_nome, "_self");
}
function exclui(cd_nome)
{
	if (confirm('Confirma a exclusao  ?'))
	{
	   window.open('basico.php?Tipo=excluir&cd_nome='+cd_nome, "_self");
	}
}
function salvar()
{
	if (forma.ds_nome.value.length == 0) { alert('Preencha o nome'); }
	else if (forma.ds_fone.value.length == 0) { alert('Preencha o fone'); }
	else { forma.submit(); }
}
</script>