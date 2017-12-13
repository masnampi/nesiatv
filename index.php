<?php
	error_reporting(0);
	require_once 'library/system.php';
	$system = new System($_GET['url']);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title><?php echo $system->site->title;?></title>
		<meta content='<?php echo $system->site->description;?>' name='description'/>
		<meta content='<?php echo $system->site->keywords;?>' name='keywords'/>
		<link href='<?php echo $system->site->baseurl.'style.css';?>' rel='stylesheet' type='text/css'/>
		<link href='<?php echo $system->site->baseurl.'favicon.ico';?>' rel='icon' type='image/x-icon'/>
		<script src="library/video.js"></script>
		<script src="library/videojs-contrib-hls.js"></script>
		<link href="library/video-js.css" rel="stylesheet"/>
	</head>
	<body>
		<div id='outer'>
			<nav>
				<ul>
					<li><a href="<?php echo $system->site->baseurl; ?>">Home</a></li>
					<li><a>Channels</a>
						<ul>
							<?php
								$system->getChannels();
							?>
						</ul>
					</li>
					<li><a href="<?php echo $system->site->baseurl."advertise-here"; ?>">Advertise Here</a></li>
					<li><a href="<?php echo $system->site->baseurl."help"; ?>">Help</a></li>
				</ul>
			</nav>
			<?php
				echo $system->content;
			?>
			<div id='footer'>
				<ul>
					<?php
						$system->getPages();
					?>
			   	</ul>
			</div>
		</div>
	</body>
</html>