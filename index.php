<?php 

?>
<!DOCTYPE html>
<html>
<head>
	<title>CFPlayer</title>
	<meta name="robots" content="noindex">
	<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
	<script type="text/javascript" src="https://ssl.p.jwpcdn.com/player/v/8.8.6/jwplayer.js"></script>
	<script type="text/javascript">jwplayer.key="64HPbvSQorQcd52B8XFuhMtEoitbvY/EXJmMBfKcXZQU2Rnn";</script>
	<style type="text/css" media="screen">html,body{padding:0;margin:0;height:100%}#cf-player{width:100%!important;height:100%!important;overflow:hidden;background-color:#000}</style>
</head>
<body>

<?php 
error_reporting(0);

$data = (isset($_GET['data'])) ? $_GET['data'] : '';

if ($data != '') {
	
	include_once 'config.php';

	$data = json_decode(decode($data));

	$link = (isset($data->link)) ? $data->link : '';

	$sub = (isset($data->sub)) ? $data->sub : '';

	$poster = (isset($data->poster)) ? $data->poster : '';

	$tracks = '';
	
	foreach ($sub as $key => $value) {
		$tracks .= '{ 
						file: "'.$value.'", 
						label: "'.$key.'",
						kind: "captions"
					   },';
	}

	include_once 'curl.php';

	$curl = new cURL();

	$sources = '[{"label":"HD","type":"video\/mp4","file":"'.$link.'"}]';

	$result = '<div id="cf-player"></div>';

	$data = 'var player = jwplayer("cf-player");
				player.setup({
					sources: '.$sources.',
					aspectratio: "16:9",
					startparam: "start",
					primary: "html5",
					autostart: false,
					preload: "auto",
					aboutlink: "https://fb.com/delta.web.id",
					abouttext: "CFPlayer",
					image: "'.$poster.'",
					captions: {
						color: "#f3f368",
						fontSize: 16,
						backgroundOpacity: 0,
						fontfamily: "Helvetica",
						edgeStyle: "raised"
					},
					tracks: ['.$tracks.']
				});
				player.on("setupError", function() {
				  swal("Server Error!", "Please PM Me to fix it. Thank you!", "error");
				});
				player.on("error" , function(){
					swal("Player Error!", "Please PM Me to fix it. Thank you!", "error");
				});';
	
	$packer = new Packer($data, 'Normal', true, false, true);

	$packed = $packer->pack();

	$result .= '<script type="text/javascript">' . $packed . '</script>';

	echo $result;

} else echo 'Empty link!';

$script .= "(function(){'use strict';const devtools={isOpen:false,orientation:undefined};const threshold=160;const emitEvent=(isOpen,orientation)=>{window.dispatchEvent(new CustomEvent('devtoolschange',{detail:{isOpen,orientation}}));};const main=({emitEvents=true}={})=>{const widthThreshold=window.outerWidth-window.innerWidth>threshold;const heightThreshold=window.outerHeight-window.innerHeight>threshold;const orientation=widthThreshold?'vertical':'horizontal';if(!(heightThreshold&&widthThreshold)&&((window.Firebug&&window.Firebug.chrome&&window.Firebug.chrome.isInitialized)||widthThreshold||heightThreshold)){if((!devtools.isOpen||devtools.orientation!==orientation)&&emitEvents){emitEvent(true,orientation);}
devtools.isOpen=true;devtools.orientation=orientation;}else{if(devtools.isOpen&&emitEvents){emitEvent(false,undefined);}
devtools.isOpen=false;devtools.orientation=undefined;}};main({emitEvents:false});setInterval(main,500);if(typeof module!=='undefined'&&module.exports){module.exports=devtools;}else{window.devtools=devtools;}})();
";
	
$script .= "const redirect = 'https://cdn.jsdelivr.net/gh/kiprox/cf-gdplay@master/assets/img/93656b62-2a01-4649-b2f3-84e9d0dde40a.jpg';if(window.devtools.isOpen){
  window.location.href  = redirect;}window.addEventListener('devtoolschange', event => {if(event.detail.isOpen){window.location.href  = redirect;}});";

?>

</body>
</html>
