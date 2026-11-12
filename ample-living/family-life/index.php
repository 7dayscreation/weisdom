<?php include __DIR__ . '/../../config.php'; ?>
<!doctype html>
<html class="no-js" lang="en-US">
<head>
    <!-- DEFAULT META TAGS -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- ensures IE uses latest rendering engine -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<!-- Ample Living Family Life TITLE -->
	<title><?php echo esc(seo('title', 'ample-living/family-life')); ?></title>
	
	<!-- SEO META TAGS -->
	<meta name="description" content="<?php echo esc(seo('description', 'ample-living/family-life')); ?>">
	<meta name="keywords" content="<?php echo esc(seo('keywords', 'ample-living/family-life')); ?>">
	<meta name="author" content="<?php echo esc(seo('author')); ?>">
	<meta name="robots" content="<?php echo esc(seo('robots', 'ample-living/family-life')); ?>">
	<link rel="canonical" href="<?php echo esc(canonical_url('ample-living/family-life')); ?>">

	<!-- Open Graph / Facebook -->
	<meta property="og:title" content="<?php echo esc(seo('title', 'ample-living/family-life')); ?>" />
	<meta property="og:description" content="<?php echo esc(seo('description', 'ample-living/family-life')); ?>" />
	<meta property="og:image" content="<?php echo esc(seo_image('ample-living/family-life')); ?>" />
	<meta property="og:url" content="<?php echo esc(canonical_url('ample-living/family-life')); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="<?php echo esc($site_name); ?>" />

	<!-- Twitter Card -->
	<meta name="twitter:title" content="<?php echo esc(seo('title', 'ample-living/family-life')); ?>" />
	<meta name="twitter:description" content="<?php echo esc(seo('description', 'ample-living/family-life')); ?>" />
	<meta name="twitter:image" content="<?php echo esc(seo_image('ample-living/family-life')); ?>" />
	<meta name="twitter:card" content="summary_large_image" />
	
	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo $assets; ?>css/weisdom.css?token=<?php echo SECURE_TOKEN; ?>">
	<link rel="stylesheet" href="<?php echo $assets; ?>css/lightcase.css?token=<?php echo SECURE_TOKEN; ?>">
		
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
					<div id="logo" class="logo-right text-dark">
						<a href="<?php echo url(''); ?>">
							<img id="dark-logo" src="<?php echo $assets; ?>images/logo-dark.png" srcset="<?php echo $assets; ?>images/logo-dark.png 1x, <?php echo $assets; ?>images/logo-dark.png 2x" alt="Logo Dark">
							<img id="light-logo" src="<?php echo $assets; ?>images/logo-light.png" srcset="<?php echo $assets; ?>images/logo-light.png 1x, <?php echo $assets; ?>images/logo-light.png 2x" alt="Logo Light">
						</a>
					</div>
					<div id="menu" class="clearfix">
						<div class="menu-actions">
							<div class="menu-toggle">
								<span class="hamburger"></span>
							</div>
						</div>
						<div id="menu-inner"><div class="spacer-small"></div>
							<nav id="main-nav">
								<ul>
									<li><a href="<?php echo url('connect/'); ?>">Connect</a></li>
									<li><a href="<?php echo url('ample-living/'); ?>">Ample Living</a></li>
									<li><p><a href="<?php echo url('ample-living/amenities/'); ?>">Amenities</a></p></li>
									<li><p><a href="<?php echo url('ample-living/family-life/'); ?>">Family Life</a></p></li>
									<li><a href="<?php echo url('ampleton/'); ?>">Ampleton</a></li>
									<li class="spacer-small menu-spacer"></li>
									<li><p><a href="<?php echo url('privacy-policy/'); ?>">Privacy Policy</a></p></li>
									<li><p><a href="<?php echo url('rera-policy/'); ?>">RERA Policy</a></p></li>
								</ul>
								<div class="widget align-social">	
								<ul class="socialmedia-widget">
									<li class="facebook"><a href="https://www.facebook.com/WeisdomOfficial/" target="_blank" rel="noopener noreferrer"></a></li>
									<li class="instagram"><a href="https://www.instagram.com/weisdomofficial/" target="_blank" rel="noopener noreferrer"></a></li>
									<li class="linkedin"><a href="https://www.linkedin.com/company/weisdom-official/" target="_blank" rel="noopener noreferrer"></a></li>
									<li class="youtube"><a href="https://youtube.com/@weisdomofficials/" target="_blank" rel="noopener noreferrer"></a></li>
								</ul>
								</div>
							</nav>
						</div>
					</div>
					<div id="header-actions">
						<div class="header-totop">
							<a class="totop" href="#">
								<svg class="arrow arrow-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 35.35">
									<path d="M0,16.88a3,3,0,0,0,.16.94,1.51,1.51,0,0,0,.63.78l15,15a2.14,2.14,0,0,0,3.52.08,2.14,2.14,0,0,0-.08-3.52L8.59,19.38H57.5a2.5,2.5,0,1,0,0-5H8.59L19.22,3.59A2.14,2.14,0,0,0,19.3.08a2.14,2.14,0,0,0-3.52.08l-15,15a1.51,1.51,0,0,0-.62.78A3,3,0,0,0,0,16.88Z"></path>
								</svg>
							</a>
						</div>
					</div>
				</div>
				<span class="pseudo-close header-close"></span>
			</header>
			<!-- HERO & BODY -->
			<div id="hero-and-body">
				<!-- PAGEBODY 1 -->
				<section id="page-body">
					<div class="spacer-big"></div>
					<div class="wrapper-big">
						<h2 class="align-center title-alt colored">Ample Living Family Life</h2>
					</div>
					<div class="spacer-big"></div>
					<div class="wrapper-small">
						<h4 class="align-center title-alt">An Inviting Entry Experience</h4>
						<p class="align-center">A grand and welcoming entrance that sets the tone with elegant design and refined detailing. A sophisticated first impression that reflects style, warmth, and prestige.</p>
					</div>
					<div class="spacer-mini"></div>
					<div class="wrapper">
						<div class="gallery-item-inner item-inner">
							<a href="<?php echo $assets; ?>ample/family-life/family-life-01.jpg" class="thumb-hover scale" data-rel="lightcase:gallery1">
								<img src="<?php echo $assets; ?>ample/family-life/family-life-01.jpg" alt="SEO">
							</a>
						</div>
					</div>
					<div class="spacer-big"></div>
					<div class="wrapper-small">
						<h4 class="align-center title-alt">Designed for Comfort and Style</h4>
						<p class="align-center">A spacious living area blending modern design, natural light, and inviting seating—perfect for everyday comfort and meaningful moments. Thoughtfully crafted to create a warm and welcoming space for family and guests.</p>
					</div>
					<div class="spacer-mini"></div>
					<div class="wrapper">
						<div class="gallery-item-inner item-inner">
							<a href="<?php echo $assets; ?>ample/family-life/family-life-02.jpg" class="thumb-hover scale" data-rel="lightcase:gallery1">
								<img src="<?php echo $assets; ?>ample/family-life/family-life-02.jpg" alt="SEO">
							</a>
						</div>
					</div>
					<div class="spacer-big"></div>
					<div class="wrapper-small">
						<h4 class="align-center title-alt">A Private Outdoor Escape</h4>
						<p class="align-center">A thoughtfully designed balcony offering a seamless extension of living spaces with open views and a calm, airy ambience. A perfect spot to relax, unwind, and enjoy moments in privacy.</p>
					</div>
					<div class="spacer-mini"></div>
					<div class="wrapper">
						<div class="gallery-item-inner item-inner">
							<a href="<?php echo $assets; ?>ample/family-life/family-life-03.jpg" class="thumb-hover scale" data-rel="lightcase:gallery1">
								<img src="<?php echo $assets; ?>ample/family-life/family-life-03.jpg" alt="SEO">
							</a>
						</div>
					</div>
					<div class="spacer-big"></div>
					<div class="wrapper-small">
						<h4 class="align-center title-alt">A Refined Dining Experience</h4>
						<p class="align-center">A refined setting that brings together thoughtful craftsmanship, comfort, and timeless style. Designed to elevate every meal with elegance and a warm, inviting ambience.</p>
					</div>
					<div class="spacer-mini"></div>
					<div class="wrapper">
						<div class="gallery-item-inner item-inner">
							<a href="<?php echo $assets; ?>ample/family-life/family-life-04.jpg" class="thumb-hover scale" data-rel="lightcase:gallery1">
								<img src="<?php echo $assets; ?>ample/family-life/family-life-04.jpg" alt="SEO">
							</a>
						</div>
					</div>
					<div class="spacer-big"></div>
					<div class="wrapper-small">
						<h4 class="align-center title-alt">A Contemporary Culinary Space</h4>
						<p class="align-center">A thoughtfully designed kitchen that blends refined finishes, smart functionality, and everyday ease. Crafted to make cooking and gathering both efficient and enjoyable.</p>
					</div>
					<div class="spacer-mini"></div>
					<div class="wrapper">
						<div class="gallery-item-inner item-inner">
							<a href="<?php echo $assets; ?>ample/family-life/family-life-05.jpg" class="thumb-hover scale" data-rel="lightcase:gallery1">
								<img src="<?php echo $assets; ?>ample/family-life/family-life-05.jpg" alt="SEO">
							</a>
						</div>
					</div>
					<div class="spacer-big"></div>
				</section>
				<!-- PAGEBODY -->
				
			</div>
			<!-- HERO & BODY -->
			<!-- FOOTER -->
			<?php include '../../footer.php'; ?>
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
