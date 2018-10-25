<?php
// Función para ordenar aleatoriamente arrays asociativos manteniendo las claves. Fuente: http://php.net/manual/en/function.shuffle.php#94697
	function shuffle_assoc(&$array) {
		$keys = array_keys($array);
		shuffle($keys);
		$new=array();
		foreach($keys as $key) {
			$new[$key] = $array[$key];
		}
		$array = $new;
		return true;
	}
		?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Reproductor del Encuentro de la comunidad de NVDA en Español</title>
<!-- Copyright (C) 2018 Iván Novegil Cancelas <ivan.novegil@nvda.es>
https://github.com/ivnc/utilidades_jornadas -->
</head>
<body>
<?php
	// Buscamos si pide un reproductor X, si no vamos al 0 por defecto.
	if(isset($_GET['player'])) {
		$alt = $_GET['player'];
	}
	else {
		$alt = "0";
	}
	// Se definen los datos de reproducciones y para interacción
	$alts = array(
		array(
		'name' => 'Mi Radio por defecto',
			'srcurl' => 'http://servidor.miradio.com:8000/mp',
			'links' => array(
				'Página web' => 'http://miradio.com',
				'Twitter' => 'https://twitter.com/miradio_com',
				'Facebook' => 'https://facebook.com/miradio.com',
				'Mastodon' => 'https://mimastodon.social/@miradio_com',
				'Escuchar en TuneIn Radio' => 'https://tunein.com/radio/miradio-s123456',
				'Escuchar en nueva ventana' => 'http://miradio.com/reproductor.html',
			),
		),
		// Incluir más elementos para añadir más radios. La 0 está siempre por defecto, de ahí el establecimiento de la función shuffle_assoc arriba (ver enlace). Si no se quiere así, basta con eliminar shuffle_assoc y llamar a shuffle() y aparecerá una radio diferente en cada ejecución.
	);
	shuffle_assoc($alts);
?>
<section role="region" aria-label="Botones del reproductor"><audio src="<?php echo $alts[$alt]['srcurl']; ?>" data-title="<?php echo $alts[$alt]['name']; ?>" data-showdownloadlink="false" controls=""></audio>
<script type="text/javascript" src="player/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="player/icu_es.js"></script>
	<script type="text/javascript" src="player/translate.js"></script>
	<script type="text/javascript" src="player/html5-accessible-audio-player.js"></script>
<script type="text/javascript">
html5AcAudio.configure(html5AcAudio.configVisibility.audioHideScreenReaders | html5AcAudio.configVisibility.audioHideVisually);
</script>
<p>Reproductor programado por Juanjo Montiel Pérez (<a href="https://github.com/kastwey/html5-accessible-audio-player">código</a>, <a href="player/LICENSE">licencia</a>).</p>
</section>
<section role="region" aria-label="Emisora en reproducción">
<?php
	// Se imprime el nombre del streaming en reproducción.
	echo "<h3>Estás escuchando</h3>\n<h4>" . $alts[$alt]['name'] . "</h4>\n\n<ul>\n";
	// Se incluyen enlaces de interacción para el streaming en reproducción (de $alts['X']['links'] donde clave=nombre-texto a mostrar y valor=url).
	foreach($alts[$alt]['links'] as $name => $url) {
		echo '<li><a href="' . $url . '" target="_blank" title="Enlace externo, abre en nueva ventana">' . $name . "</a></li>\n";
	}
?>
</ul>
</section><section role="region" aria-label="emisoras disponibles">
<h3>Transmisiones disponibles</h3>
<?php
	// Incluimos el resto de transmisiones habilitadas en $alts con sus enlaces de interacción y un enlace para cambiar a ellas.
	foreach($alts as $key => $data) {
		if($key != $alt) {
			echo "<h4>" . $data['name'] . "</h4>\n";
			echo '<ul><li><a href="?player=' . $key . '">Cambiar a la emisión de ' . $data['name'] . "</a></li>\n";
			foreach($data['links'] as $name => $url) {
				echo '<li><a href="' . $url . '" target="_blank" title="Enlace externo, abre en nueva ventana">' . $name . "</a></li>\n";
			}
				echo "</ul>\n";
		}
	}
?>
</section>
<section role="region" aria-label="Información adicional">
<p>La información aquí publicada sobre estaciones de radio ha sido proporcionada por sus respectivos propietarios o promotores. Es por tanto responsabilidad de los mismos mantenerla actualizada, así como el cumplimiento de las obligaciones legales exigibles en lo referente al audio no emitido directamente desde la sala de conferencias del evento. El listado de transmisiones se ordena aleatoriamente por un sistema automático en cada carga del reproductor para evitar cualquier intervención humana en su ordenación.</p>
<p>Si necesitas soporte técnico con este reproductor, <a href="http://misjornadas.org/soporte" target="_top">contacta con nosotros</a>.</p>
</section>
</body>
</html>