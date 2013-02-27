<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Agenda Multi-Tratamientos</title>
<script src="../lib/prototype/prototype-1-6-0-2.js"></script>
<script language="javascript" src="script.js"></script>
<link rel="stylesheet" type="text/css" href="login.css"> 
</head>
 
<body bgcolor="#000000" background="imagen/backgrndlogin.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<script language="JavaScript" type="text/javascript">
		//---------------------------------------------------------------------------------
		function f_ingresar_al_sistema()
		{
		      // verifico que los campos no esten en blanco
					if($('usuario').value==''){
					       alert('El campo usuario no puede estar vacio');
								 return false;
					}
					if($('pass').value==''){
					       alert('El campo contraseña no puede estar vacio');
								 return false;
					}
					$('msgCargando').style.visibility='visible';
					// verifica la contraseña
					new Ajax.Request
					(
						'verificalogin.php',
						{
							method: 'post',
							parameters: 'accion=1&usuario='+$('usuario').value+'&pass='+$('pass').value,
							onSuccess: function(transport)
							{
								   // si la respuesta es distinta de cero entonces creo un elemento
								   // para mostrar un mensaje de error al operador
								   if(transport.responseText != '0'){
									      if(!$('messageBox')){
										         divMsg = CrearElemento({
																		tag        : 'DIV',
																		id         : 'messageBox',
																		position   : 'absolute',
																		top        : '50px',
																		left       : '0',
																		width      : '100%',
																		zindex     : '1020',
																		visibility : 'hidden'
														 });
										    }
								   }
								   if(transport.responseText == '1'){
								       // muestro mensaje que no existe el usuario
										   mostrarDialogo({ 
												   pagina   : 'msg.loginincorrecto.php',
													 elemento : 'messageBox'
										   });
										   divMsg.style.visibility='visible';
											 $('msgCargando').style.visibility='hidden';
											 return;
								   }
									 if(transport.responseText == '2'){
								       // muestro mensaje de contraseña invalida
										   mostrarDialogo({ 
												   pagina   : 'msg.passincorrecta.php',
													 elemento : 'messageBox'
										   });
										   divMsg.style.visibility='visible';
											 $('msgCargando').style.visibility='hidden';
											 return;
								   }
									 $('frmLogin').submit();
									 return true;
							},
							onFailure: function(transport)
							{
								$('marcoPrincipal').innerHTML = transport.responseText;
								$('barraHerramientas').innerHTML = '';
							}
						}
					)
		}
		//--------------------------------------------------------------------------------------------
		function mostrarDialogo(Parametro)
		{
				new Ajax.Request
				(
					Parametro.pagina,
					{
						method: 'post',
						parameters: 'usuario='+$('usuario').value,
						onSuccess: function(transport)
						{
							$(Parametro.elemento).innerHTML = transport.responseText;
							//$('CuadroDialogo1').style.left='125px';
							//$('CuadroDialogo1').style.top='125px';
						},
						onFailure: function(transport)
						{
							$(Parametro.elemento).innerHTML = transport.responseText;
							
						}
					}
				)
		}
	</script>
<div id="msgCargando" style="left:30%; top:30%; position:absolute; z-index:1010; opacity:.8; filter:alpha(opacity=80); visibility:hidden">
  <div style="width:250px; height:50px; border:#666666 solid 2px; background:#ddeedd">
		<table height="100%" width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
    		<td>
					<div align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:120%; vertical-align:middle; height:100%">
						Cargando...
					</div>
				</td>
  		</tr>
		</table>
	</div>
</div>

<div id="marcoPrincipal" style="margin:0; z-index:3; width:100%; text-align:center">
	<div>
		<div style="position:absolute; left:190px; top:120px; width:auto; height:300px;">
			<div style="margin:10px;">
		  	<div align="center" style="margin-top:20px">
					<img src="imagen/logologin.jpg" border="0" />
				</div>
			</div>
		</div>
		
		<div style="height:auto; width:auto; left:465px; top:185px; position:absolute; color:#666666">
			<form name="frmLogin" id="frmLogin" action="crearsesion.php" method="post">
	  		<div style="margin-top:30px; text-align:right">
					<img src="imagen/txtmultiagenda.jpg" border="0" />
				</div>
	  		<div style="margin-top:25px; margin-left:55px; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:85%; line-height:180%">
					<table border="0" cellspacing="0" cellpadding="0">
  					<tr>
    					<td>
								<div align="right" style="margin-right:5px; color:#FFFFFF">
									Usuario:
								</div>
							</td>
    					<td>
								<div align="left" style="margin-left:5px;">
									<input name="usuario" type="text" id="usuario" style="font-family:Calibri; font-size:90%; background:#000000; color:#FFFFFF; border:#FFFFFF solid 1px" size="20" maxlength="15" />
								</div>
							</td>
  					</tr>
  					<tr>
    					<td>
								<div align="right" style="margin-right:5px; color:#FFFFFF">
									Contraseña:
								</div>
							</td>
    					<td>
								<div align="left" style="margin-left:5px; margin-top:8px;">
									<input name="pass" type="password" id="pass" style="font-family:Calibri; font-size:90%; background:#000000; color:#FFFFFF; border:#FFFFFF solid 1px" size="20" maxlength="15" />
    						</div>
							</td>
  					</tr>
					</table>
				</div>
	  		<div style="margin-top:25px; margin-left:55px; text-align:right">
	    		<input name="Bot&oacute;n" type="button" id="enviar" value="Ingresar" style="width:100px; background:#FFFFFF; color:#000000" onclick="return f_ingresar_al_sistema();" />
	  		</div>
			</form>
		</div>
	</div>	
</div>

<div id="CuadroDialogo1" style="position:absolute; left:0; top:0; z-index:10"></div>
</body>
</html>
<script language="JavaScript1.5" type="text/javascript">
if(document.documentElement.clientWidth){ 
	var ancho = document.documentElement.clientWidth;
	var alto = document.documentElement.clientHeight;
//	$('marcoPrincipal').style.width=(ancho-5)+'px';
//	$('marcoPrincipal').style.height=(alto-50)+'px';
	$('usuario').focus();
}
</script>
