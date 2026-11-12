<?php include __DIR__ . '/../config.php'; ?>
<!doctype html>
<html class="no-js" lang="en-US">
<head>
    <!-- DEFAULT META TAGS -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- ensures IE uses latest rendering engine -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    
	<!-- Privacy Policy TITLE -->
	<title><?php echo esc(seo('title', 'privacy-policy')); ?></title>
	
	<!-- SEO META TAGS -->
	<meta name="description" content="<?php echo esc(seo('description', 'privacy-policy')); ?>">
	<meta name="keywords" content="<?php echo esc(seo('keywords', 'privacy-policy')); ?>">
	<meta name="author" content="<?php echo esc(seo('author')); ?>">
	<meta name="robots" content="<?php echo esc(seo('robots', 'privacy-policy')); ?>">
	<link rel="canonical" href="<?php echo esc(canonical_url('privacy-policy')); ?>">

	<!-- Open Graph / Facebook -->
	<meta property="og:title" content="<?php echo esc(seo('title', 'privacy-policy')); ?>" />
	<meta property="og:description" content="<?php echo esc(seo('description', 'privacy-policy')); ?>" />
	<meta property="og:image" content="<?php echo esc(seo_image('privacy-policy')); ?>" />
	<meta property="og:url" content="<?php echo esc(canonical_url('privacy-policy')); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="<?php echo esc($site_name); ?>" />

	<!-- Twitter Card -->
	<meta name="twitter:title" content="<?php echo esc(seo('title', 'privacy-policy')); ?>" />
	<meta name="twitter:description" content="<?php echo esc(seo('description', 'privacy-policy')); ?>" />
	<meta name="twitter:image" content="<?php echo esc(seo_image('privacy-policy')); ?>" />
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
						<h1 class="h2 title-alt text-light">Privacy Policy</h1>
					</div>
				</section>
				<!-- HERO -->
				<!-- PAGEBODY -->
				<section id="page-body">
					<div class="wrapper">
						<div class="spacer-big"></div>
						<div class="column one">
							<h3 class="title-alt">Weisdom Privacy Policy</h3>
							<p><strong>Last Update : 20-02-2026</strong></p>
						</div>
						<div class="spacer-big"></div>
						<div class="column-section one">
							<div class="info" align="justify"><strong>1. Introduction</strong><br><br>
								Welcome to Weisdom Design Build.<br>We are committed to protecting your privacy and ensuring that your personal information is handled in a safe and responsible manner.<br>
								This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website https://weisdom.co.in and interact with our projects:
								<ul>
									<li>Ample Living (Residential Project)</li>
									<li>Ampleton (Commercial Project)</li>
								</ul><br>
								By accessing or using our Website, you agree to the terms of this Privacy Policy.</div>
						</div>
						<div class="column-section one">
							<div class="info" align="justify"><strong>2. Information We Collect</strong><br><br>
							We may collect the following types of information:<br>
							<strong>a) Personal Information</strong><br>
							When you:
								<ul>
									<li>Fill out inquiry/contact forms</li>
									<li>Request brochures</li>
									<li>Schedule site visits</li>
									<li>Subscribe to updates</li>
								</ul><br>
									We may collect:<br>
								<ul>	
									<li>Full name</li>
									<li>Email address</li>
									<li>Phone number</li>
									<li>Address</li>
									<li>Project preference</li>
									<li>Any other information voluntarily submitted</li>
								</ul><br>
								<strong>b) Non-Personal Information</strong><br>
								We may automatically collect:<br>
								<ul>
									<li>IP address</li>
									<li>Browser type</li>
									<li>Device information</li>
									<li>Pages visited</li>
									<li>Time spent on pages</li>
									<li>Referral source</li>
								</ul><br>	
									This helps us improve website performance and user experience.
							</div>
						</div>
						<div class="column-section one">
							<div class="info" align="justify"><strong>3. How We Use Your Information</strong><br><br>
							We use your information to:
							<ul>
								<li>Respond to inquiries and provide requested information</li>
								<li>Share details about our projects (Ample Living & Ampleton)</li>
								<li>Schedule consultations or site visits</li>
								<li>Improve our website and services</li>
								<li>Send promotional communication (only if consented)</li>
								<li>Comply with legal obligations</li>
							</ul>
							</div><br>
						</div>
						<div class="column-section one">
							<div class="info" align="justify"><strong>4. Sharing of Information</strong><br><br>
							We do not sell, trade, or rent your personal information.<br>
							We may share your data with:<br>
							<ul>
								<li>Internal team members</li>
								<li>Authorized sales and marketing partners</li>
								<li>Legal or regulatory authorities (if required by law)</li>
								<li>IT service providers hosting or maintaining our website</li>
							</ul><br>
							All such parties are obligated to keep your information secure and confidential.
							</div><br>
						</div>
						<div class="column-section one">
							<div class="info" align="justify"><strong>5. Cookies & Tracking Technologies</strong><br><br>
							Our Website may use cookies to:
							<ul>
								<li>Enhance user experience</li>
								<li>Analyze website traffic</li>
								<li>Remember user preferences</li>
							</ul><br>
								You can choose to disable cookies through your browser settings. However, some website features may not function properly.</div>
						</div>
						<div class="column-section one">
							<div class="info" align="justify"><strong>6. Data Security</strong><br><br>
							We implement appropriate technical and organizational measures to protect your personal data against:<br>
							<ul>
								<li>Unauthorized access</li>
								<li>Alteration</li>
								<li>Disclosure</li>
								<li>Destruction</li>
							</ul><br>
							However, no internet transmission is 100% secure, and we cannot guarantee absolute security.</div><br>
						</div>
						<div class="column-section one">
							<div class="info" align="justify"><strong>7. Data Retention</strong><br><br>
							We retain your personal information only as long as necessary to:
						<ul>
							<li>Fulfill the purposes outlined in this policy</li>
							<li>Comply with legal obligations</li>
							<li>Resolve disputes</li>
							<li>Enforce agreements</li>
						</ul>
							</div><br>
						</div>
						<div class="column-section one">
							<div class="info" align="justify"><strong>8. Your Rights</strong><br><br>
						Depending on applicable laws, you may have the right to:
						<ul>
							<li>Access your personal data</li>
							<li>Request correction of inaccurate data</li>
							<li>Request deletion of your data</li>
							<li>Withdraw consent at any time</li>
							<li>Opt out of marketing communications</li>
						</ul><br>
							To exercise these rights, please contact us at Email: info@weisdom.co.in
							</div><br>
						</div>
						<div class="column-section one">
							<div class="info" align="justify"><strong>9. Third-Party Links</strong><br><br>
							Our Website may contain links to third-party websites. We are not responsible for the privacy practices or content of those websites.</div><br>
						</div>
						<div class="column-section one">
							<div class="info" align="justify"><strong>10. Updates to This Privacy Policy</strong><br><br>
								We may update this Privacy Policy from time to time. Changes will be posted on this page with a revised “Effective Date”.<br>
								We encourage you to review this policy periodically.
							</div><br>
						</div>
						<div class="column-section one">
							<div class="info" align="justify"><strong>11. Marketing & Communication Policy</strong><br><br>
								<strong>a) WhatsApp Communication</strong><br>
								By submitting your contact details on our website https://weisdom.co.in, you expressly consent to receive communication from Weisdom Design Build via:<br>
								<ul>
									<li>WhatsApp messages</li>
									<li>Phone calls</li>
									<li>SMS</li>
									<li>Email</li>
								</ul><br>
								<strong>These communications may include:</strong>
								<ul>
									<li>Project details for Ample Living (Residential)</li>
									<li>Project updates for Ampleton (Commercial)</li>
									<li>Brochures and pricing</li>
									<li>Site visit coordination</li>
									<li>Promotional offers</li>
								</ul><br>
								<strong>You may opt out at any time by:</strong>
								<ul>
									<li>Replying “STOP” on WhatsApp</li>
									<li>Emailing us at info@weisdom.co.in</li>
								</ul><br>
									We do not send spam and only communicate with users who voluntarily submit their information.<br><br>
									<hr>
								<strong>b) Google Ads & Remarketing</strong><br>
								We use Google Ads and related remarketing services to advertise our projects.<br>
								This may involve:
								<ul>
									<li>Use of cookies</li>
									<li>Tracking pixels</li>
									<li>Google Analytics</li>
									<li>Remarketing tags</li>
								</ul><br>	
									Google may use cookies to serve ads based on a user's previous visits to our website.<br>
									Users can opt out of Google’s personalized advertising by visiting: https://adssettings.google.com<br><br>
									<hr>
									<strong>c) Meta (Facebook & Instagram) Advertising</strong><br>
									We may use Meta advertising tools including:
								<ul>
									<li>Facebook Pixel</li>
									<li>Conversion tracking</li>
									<li>Lead generation forms</li>
								</ul><br>	
									These tools help us:<br>
								<ul>
									<li>Measure ad performance</li>
									<li>Deliver relevant ads</li>
									<li>Improve marketing campaigns</li>
								</ul><br>
								Meta may collect or receive information from our website and use it in accordance with its own Data Policy.<br>
								Users can control ad preferences through their Facebook/Instagram account settings.<br><br>
									<hr>
									<strong>d) Consent for Lead Forms</strong><br>
									When you submit any inquiry form on our website or via Meta Lead Ads or Google Lead Forms, you:
								<ul>
									<li>Confirm that the information provided is accurate</li>
									<li>Provide explicit consent to be contacted</li>
									<li>Agree to receive marketing communication as described</li>
								</ul>
									<hr>
							</div>
						</div>
						<div class="column-section one">
							<div class="info" align="justify"><strong>12. Contact Us</strong><br><br>
								If you have any questions about this Privacy Policy or how your information is handled, please contact:<br>
								Weisdom Design Build<br>
								Website: https://weisdom.co.in<br>
								Email: info@weisdom.co.in
							</div>
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
