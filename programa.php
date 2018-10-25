<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8"/>
<title>Programa del I Encuentro en Español de Usuarios y Desarrolladores de NVDA</title>
<!-- Copyright (C) Iván Novegil <ivan.novegil@nvda.es>, con código de Derek Riemer(js)
https://github.com/ivnc/utilidades_jornadas -->
<script type="text/javascript" src="tzcon.js"></script>
</head>
<body>
<?php
	// Especifico todas las ponencias. La clave de cada día es texto que se mostrará sobre las ponencias de ese día, en una fila combinada de tres columnas; no se pone el mes porque se especifica abajo, en el foreach($ponencias ...). Importante: los horarios deben estár en uso UTC, de lo contrario la conversión a hora local no funcionará de manera adecuada.
	$ponencias = array(
		'Viernes, 19' => array(
			array(
				'horario' => '17:00',
				'titulo' => 'Conferencia Inaugural',
				'ponente' => 'Equipo NVDA.es',
			),
			array(
				'horario' => '19:00',
				'titulo' => 'Una ponencia muy interesante',
				'avance' => 'http://misjornadas.org/ponencias/ponencia_muy_interesante',
				'ponente' => 'Uno muy ameno, ya verás',
			),
// Más ponencias aquí
		),
		'Sábado, 20' => array(
		// Todas las ponencias del sábado (se puede copiar y pegar el array anterior).
		),
		'Domingo, 21' => array(
// Todas las ponencias del domingo (se puede copiar y pegar el array anterior).
		),
	);
	// Aquí se ponen las fechas (solo las fechas con un espacio al final) en formato del RFC para rellenar las celdas del horario y que TZCon haga la conversión correctamente. Las claves deben ser las mismas que las de los arrays para cada día de las jornadas.
	$tzcon=array(
		'Viernes, 19' => '19 oct 2018 ',
		'Sábado, 20' => '20 oct 2018 ',
		'Domingo, 21' => '21 oct 2018 ',
	);
	// A continuación, una advertencia para los que tengan JS desactivado.
?>
<p class="tzutcwarning"><strong>Atención</strong>: Hemos detectado que JavaScript está desactivado. Si no lo activas, no será posible realizar la conversión a hora local y verás los horarios en la zona UTC/GMT.</p>
<table>
<caption>Programa del I Encuentro de la comunidad</caption>
<tr>
<th>Horario</th>
<th>Título</th>
<th>Ponente</th>
</tr>
<?php
	foreach($ponencias as $dia => $ponenciasdia) {
		echo '<tr><td colspan="3"><h3>'.$dia." de octubre de 2018</h3></td></tr>\n";
		foreach($ponenciasdia as $ponencia) {
			echo "<tr>\n";
			echo '<td class="tzcon">'.$tzcon[$dia].$ponencia['horario']." -0000</td>\n";
			echo "<td>";
			if(isset($ponencia['avance'])) {
				echo '<a href="'.$ponencia['avance'].'" target="_top" title="Ver avance">'.$ponencia['titulo']."</a>";
			}
			else {
				echo $ponencia['titulo'];
			}
			echo "</td>\n";
						echo "<td>".$ponencia['ponente']."</td>\n";
						echo "</tr>\n";
		}
	}
?>
</table>
</body>
</html>