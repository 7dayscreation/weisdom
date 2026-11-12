<?php include __DIR__ . '/../config.php'; ?>
<!doctype html>
<html class="no-js" lang="en-US">
	<head>
    <!-- DEFAULT META TAGS -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- ensures IE uses latest rendering engine -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<!-- Connect Page TITLE -->
	<title><?php echo esc(seo('title', 'connect')); ?></title>
	
	<!-- SEO META TAGS -->
	<meta name="description" content="<?php echo esc(seo('description', 'connect')); ?>">
	<meta name="keywords" content="<?php echo esc(seo('keywords', 'connect')); ?>">
	<meta name="author" content="<?php echo esc(seo('author')); ?>">
	<meta name="robots" content="<?php echo esc(seo('robots', 'connect')); ?>">
	<link rel="canonical" href="<?php echo esc(canonical_url('connect')); ?>">

	<!-- Open Graph / Facebook -->
	<meta property="og:title" content="<?php echo esc(seo('title', 'connect')); ?>" />
	<meta property="og:description" content="<?php echo esc(seo('description', 'connect')); ?>" />
	<meta property="og:image" content="<?php echo esc(seo_image('connect')); ?>" />
	<meta property="og:url" content="<?php echo esc(canonical_url('connect')); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="<?php echo esc($site_name); ?>" />

	<!-- Twitter Card -->
	<meta name="twitter:title" content="<?php echo esc(seo('title', 'connect')); ?>" />
	<meta name="twitter:description" content="<?php echo esc(seo('description', 'connect')); ?>" />
	<meta name="twitter:image" content="<?php echo esc(seo_image('connect')); ?>" />
	<meta name="twitter:card" content="summary_large_image" />
	
	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo $assets; ?>css/weisdom.css?token=<?php echo SECURE_TOKEN; ?>">
	<link rel="stylesheet" href="<?php echo $assets; ?>css/lightcase.css">
		
	<!-- Adobe Fonts -->
	<link rel="stylesheet" href="https://use.typekit.net/oyq7qxo.css">

	<!-- FAVICON -->
	<link rel="shortcut icon" href="<?php echo $assets; ?>images/favicon.png" type="image/png">
	
	<!-- Search engine verification -->
	<meta name="google-site-verification" content="<?php echo esc($google_verification); ?>">
	<meta name="msvalidate.01" content="<?php echo esc($bing_verification); ?>">
	
	<!-- Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $google_analytics_id; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?php echo $google_analytics_id; ?>');
</script>

	<!-- Google Tag Manager -->
	<script async src="https://www.googletagmanager.com/gtm.js?id=<?php echo $google_tag_manager_id; ?>"></script>

	<!-- JSON-LD Schema -->
	<script type="application/ld+json">
		<?php echo json_encode($schema_organization, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>
	</script>
	
</head>
	<body>
		<!-- PAGE LOADER -->
		<div id="page-loader" class="text-light show-logo">
			<span class="loader-icon bullets-jump">
				<span></span>
				<span></span>
				<span></span>
			</span>
		</div>
		<!-- PAGE LOADER -->
		<!-- PAGE CONTENT -->
		<div id="page-content">
			<header id="header" class="header-right">
				<div class="header-inner clearfix">
					<!-- LOGO -->
					<div id="logo" class="logo-right text-light">
						<a href="<?php echo url(''); ?>">
							<img id="dark-logo" src="<?php echo $assets; ?>images/logo-dark.png" srcset="<?php echo $assets; ?>images/logo-dark.png 1x, <?php echo $assets; ?>images/logo-dark.png 2x" alt="Logo Dark">
							<img id="light-logo" src="<?php echo $assets; ?>images/logo-light.png" srcset="<?php echo $assets; ?>images/logo-light.png 1x, <?php echo $assets; ?>images/logo-light.png 2x" alt="Logo Light">
						</a>
					</div>
					<!-- Header Menu -->
					<?php include '../menu.php'; ?>
					<!-- - Header Menu -->
				</div>
				<span class="pseudo-close header-close"></span>
			</header>
			<!-- HERO & BODY -->
			<div id="hero-and-body">
				<!-- HERO  -->
				<section id="hero" class="hero-medium text-light videobg-section" data-phattype="html5" data-phatmp4="<?php echo $assets; ?>images/connect.mp4" data-phatwebm="<?php echo $assets; ?>images/connect.webm" data-phatogv="" data-phatratio="16/9" data-phatmute="true" data-phatposter="<?php echo $assets; ?>images/connect.jpg">
					<a href="#" id="scrolldown" class="center">
						<svg class="arrow arrow-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 35.35">
							<title>back-arrow</title>
							<path d="M0,16.88a3,3,0,0,0,.16.94,1.51,1.51,0,0,0,.63.78l15,15a2.14,2.14,0,0,0,3.52.08,2.14,2.14,0,0,0-.08-3.52L8.59,19.38H57.5a2.5,2.5,0,1,0,0-5H8.59L19.22,3.59A2.14,2.14,0,0,0,19.3.08a2.14,2.14,0,0,0-3.52.08l-15,15a1.51,1.51,0,0,0-.62.78A3,3,0,0,0,0,16.88Z"></path>
						</svg>
					</a>
					<!-- Inline script to stop video at last frame -->
					<script>
						document.addEventListener("DOMContentLoaded", function () {
							var checkVideo = setInterval(function () {
							var video = document.querySelector("#hero video");

							if (video) {
								clearInterval(checkVideo);

								video.removeAttribute("loop");

								video.addEventListener("ended", function () {
									video.pause();
									video.currentTime = video.duration;
								});
							}
						}, 500);
						});
					</script>
				</section>
				<!-- HERO -->
				<!-- PAGEBODY -->
				<section id="page-body">
		
				<div class="spacer-big"></div>
			
				<div class="wrapper">
					<h5 style="color: rgba(0,0,0,0.3);"><strong>Contact Us</strong></h5>
					<h2 class="title-alt">Weisdom Design Build.</h2>
					<div class="spacer-medium"></div>
					<div class="column-section clearfix">
						<div class="column one-third">
							<h4 class="title-alt">Address</h4>
							<p>Ample Living,<br>Beside Umarose Nursery,<br>Koba-Gandhinagar Highway,<br>Kudasan, Gandhinagar.</p>
						</div>
						<div class="column one-third">
							<h4 class="title-alt">Site Office</h4>
							<p>Phone: (91) 90190 03131<br>Email: info@weisdom.co.in</p>
						</div>
						<div class="column one-third last-col">
							<h4 class="title-alt">Sales Head</h4>
							<p>Hardik Gajera<br>Phone: (91) 90190 03131</p>
						</div>
					</div>
				</div>
				<div class="spacer-big"></div>
				<div class="wrapper">
					<div class="column-section clearfix">
						<div class="column one-full">

							<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
							<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
							<div id="map" style="height: 500px;"></div>
<script>
  // Initialize map
  var map = L.map('map').setView([23.164129, 72.633791], 15);

  // Add OpenStreetMap tiles
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
  }).addTo(map);

  // Custom icon
  var customIcon = L.icon({
    iconUrl: '<?php echo $assets; ?>images/pin.png', // or PHP path
    iconSize: [40, 40],
    iconAnchor: [20, 40]
  });

  // Marker
  var marker = L.marker([23.164129, 72.633791], {
    icon: customIcon
  }).addTo(map);

  // Click → open Google Maps link
  marker.on('click', function () {
    window.open('https://maps.app.goo.gl/Jv4DbKHLY1x8UxHGA', '_blank');
  });

  // Optional popup
  marker.bindPopup("Click to open in Google Maps");
</script>
						</div>
					</div>
				</div>
				<div class="spacer-big"></div>
				</section>
				<!-- PAGEBODY -->				
			</div>
			<!-- HERO & BODY -->
			<!-- FOOTER -->
			<?php include '../footer.php'; ?>
			<!-- FOOTER -->
		</div>
		<!-- END #page-content -->
		<!-- PAGE CONTENT -->
		<!-- SCRIPTS -->
		<script src="<?php echo $assets; ?>js/jquery-1.12.4.min.js"></script>
		<script src="<?php echo $assets; ?>js/plugins.js"></script>
		<script src="<?php echo $assets; ?>js/jquery.min.phatvideobg.js"></script>
		<script src="<?php echo $assets; ?>js/jquery.imagesloaded.min.js"></script>
		<script src="<?php echo $assets; ?>js/jquery.isotope.min.js"></script>
		<script src="<?php echo $assets; ?>js/jquery.lightcase.min.js"></script>
		<script src="<?php echo $assets; ?>js/script.js"></script>
		<script src="<?php echo $assets; ?>js/jquery.owl.carousel.min.js"></script>
		<script src="<?php echo $assets; ?>js/jquery.sticky-kit.min.js"></script>

	</body>
</html>
