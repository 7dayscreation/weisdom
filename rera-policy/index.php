<?php include __DIR__ . '/../config.php'; ?>
<!doctype html>
<html class="no-js" lang="en-US">
<head>
    <!-- DEFAULT META TAGS -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- ensures IE uses latest rendering engine -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    
	<!-- RERA Policy TITLE -->
	<title><?php echo esc(seo('title', 'rera-policy')); ?></title>
	
	<!-- SEO META TAGS -->
	<meta name="description" content="<?php echo esc(seo('description', 'rera-policy')); ?>">
	<meta name="keywords" content="<?php echo esc(seo('keywords', 'rera-policy')); ?>">
	<meta name="author" content="<?php echo esc(seo('author')); ?>">
	<meta name="robots" content="<?php echo esc(seo('robots', 'rera-policy')); ?>">
	<link rel="canonical" href="<?php echo esc(canonical_url('rera-policy')); ?>">

	<!-- Open Graph / Facebook -->
	<meta property="og:title" content="<?php echo esc(seo('title', 'rera-policy')); ?>" />
	<meta property="og:description" content="<?php echo esc(seo('description', 'rera-policy')); ?>" />
	<meta property="og:image" content="<?php echo esc(seo_image('rera-policy')); ?>" />
	<meta property="og:url" content="<?php echo esc(canonical_url('rera-policy')); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="<?php echo esc($site_name); ?>" />

	<!-- Twitter Card -->
	<meta name="twitter:title" content="<?php echo esc(seo('title', 'rera-policy')); ?>" />
	<meta name="twitter:description" content="<?php echo esc(seo('description', 'rera-policy')); ?>" />
	<meta name="twitter:image" content="<?php echo esc(seo_image('rera-policy')); ?>" />
	<meta name="twitter:card" content="summary_large_image" />
	
	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo $assets; ?>css/weisdom.css?token=<?php echo SECURE_TOKEN; ?>">
		
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
				<section id="hero" class="hero-medium" style="background: url(<?php echo $assets; ?>images/contact.jpg); background-size: cover; background-position: center center;">
					<div id="page-title" class="wrapper">
						<h1 class="h2 title-alt text-light">RERA Policy</h1>
					</div>
				</section>
				<!-- HERO -->
				<!-- PAGEBODY -->
				<section id="page-body">
					<div class="wrapper">
						<div class="spacer-big"></div>
						<div class="column one">
							<h3 class="title-alt">Weisdom RERA Policy</h3>
							<p><strong>Last Update : 20-02-2026</strong></p>
						</div>
						<div class="spacer-big"></div>
						<div class="column one">
							<p class="info" align="justify">We are currently in the process of revising our website in consonance with the Real Estate (Regulation and Development) Act, 2016 and the Rules made there under (“RERA”), which have been brought into effect from 1st May, 2017.<br><br>
Until our website is duly revised and updated, none of the images, material, stock photography, projections, details, descriptions and other information that are currently available and/or displayed on the website, should be deemed to be or constitute advertisements, solicitations, marketing, offer for sale, invitation to offer, invitation to acquire, including within the purview of the RERA.<br><br>
You are therefore requested to directly verify all details and aspects of any proposed booking/acquisition of units/premises, directly with our authorised representatives. Please do not rely on the information contained on this website, until our revision and updation is complete.<br><br>
Please note, that we will not be accepting any bookings or allotments based on the images, material, stock photography, projections, details, descriptions that are currently available and/or displayed on the website.<br><br>
<b>We thank you for your patience and understanding.”</b></p>
						</div>
						
					</div> <!-- END .column-section -->
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
		<!-- SCRIPTS -->
	</body>
</html>
