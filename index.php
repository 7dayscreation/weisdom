<?php include __DIR__ . '/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- DEFAULT META TAGS -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- ensures IE uses latest rendering engine -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<!-- Index TITLE -->
	<title><?php echo esc(seo('title')); ?></title>
	
	<!-- SEO META TAGS -->
	<meta name="description" content="<?php echo esc(seo('description')); ?>">
	<meta name="keywords" content="<?php echo esc(seo('keywords')); ?>">
	<meta name="author" content="<?php echo esc(seo('author')); ?>">
	<meta name="robots" content="<?php echo esc(seo('robots')); ?>">
	<link rel="canonical" href="<?php echo esc(canonical_url()); ?>">

	<!-- Open Graph / Facebook -->
	<meta property="og:title" content="<?php echo esc(seo('title')); ?>" />
	<meta property="og:description" content="<?php echo esc(seo('description')); ?>" />
	<meta property="og:image" content="<?php echo esc(seo_image()); ?>" />
	<meta property="og:url" content="<?php echo esc(canonical_url()); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="<?php echo esc($site_name); ?>" />

	<!-- Twitter Card -->
	<meta name="twitter:title" content="<?php echo esc(seo('title')); ?>" />
	<meta name="twitter:description" content="<?php echo esc(seo('description')); ?>" />
	<meta name="twitter:image" content="<?php echo esc(seo_image()); ?>" />
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
					<?php include 'menu.php'; ?>
					<!-- - Header Menu -->
				</div>
				<span class="pseudo-close header-close"></span>
			</header>
			<!-- HERO & BODY -->
			<div id="hero-and-body">
				<!-- Video  -->
				<section id="hero" class="hero-full text-light videobg-section" data-phattype="html5" data-phatmp4="<?php echo $assets; ?>ample/ample-home.mp4" data-phatwebm="<?php echo $assets; ?>ample/ample-home.webm" data-phatogv="" data-phatratio="16/9" data-phatmute="true" data-phatplaypause="true" data-phatposter="<?php echo $assets; ?>ample/home-video-bg.jpg">
					<a href="#" id="scrolldown" class="center">
						<svg class="arrow arrow-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 35.35">
							<title>back-arrow</title>
							<path d="M0,16.88a3,3,0,0,0,.16.94,1.51,1.51,0,0,0,.63.78l15,15a2.14,2.14,0,0,0,3.52.08,2.14,2.14,0,0,0-.08-3.52L8.59,19.38H57.5a2.5,2.5,0,1,0,0-5H8.59L19.22,3.59A2.14,2.14,0,0,0,19.3.08a2.14,2.14,0,0,0-3.52.08l-15,15a1.51,1.51,0,0,0-.62.78A3,3,0,0,0,0,16.88Z"></path>
						</svg>
					</a>
				</section>
				<!-- Video End -->
				<!-- PAGEBODY 1 -->
				<section id="page-body">
					<div class="wrapper">
						<div class="fullwidth-section" style="background:#fff;">
							<div class="fullwidth-content ">
								<div class="spacer-small"></div>
								<div class="column-section clearfix">
									<div class="column one-half">
										<div id="media-frame">
											<img id="randomMedia" src="" alt="Random Media">
											<video id="randomVideo" autoplay muted playsinline></video>
											<div id="loader">Loading...</div>
										</div>
									</div>
									<div class="column one-half last-col">
										<h2 class="title-alt colored">About</h2>
										<div class="spacer-small"></div>
										<p align="justify"><strong>WEISDOM</strong> derives its name from the fusion of “White,” symbolising purity, and “Wisdom,” representing depth of insight and discernment. Together, they define a brand founded on knowledge, experience, and informed judgment. The name reflects a philosophy of making thoughtful decisions with lasting value.</p>
										<div class="spacer-small"></div>
										<p>
											<a href="#part2" class="sr-button style-3 button-small icon-only">
												<svg class="arrow arrow-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 35.35">
												<path d="M0,16.88a3,3,0,0,0,.16.94,1.51,1.51,0,0,0,.63.78l15,15a2.14,2.14,0,0,0,3.52.08,2.14,2.14,0,0,0-.08-3.52L8.59,19.38H57.5a2.5,2.5,0,1,0,0-5H8.59L19.22,3.59A2.14,2.14,0,0,0,19.3.08a2.14,2.14,0,0,0-3.52.08l-15,15a1.51,1.51,0,0,0-.62.78A3,3,0,0,0,0,16.88Z"></path>
												</svg>
											</a>
										</p>
									</div>
								</div>
								<div class="spacer-big" id="part2"></div>
								<div class="column-section clearfix">
									<div class="column one-half">
										<img src="<?php echo $assets; ?>rendom/about-06.jpg" alt="Weisdom">
									</div>
									<div class="column one-half last-col">
										<h6 class="title-alt uppercase colored">
											<strong></strong>
										</h6>
										<div class="spacer-small"></div>
										<p align="justify">WEISDOM derives its name from the fusion of “White,” symbolising purity, and “Wisdom,” representing depth of insight and discernment. Together, they define a brand founded on knowledge, experience, and informed judgment. The name reflects a philosophy of making thoughtful decisions with lasting value.</p>
										<br>
										<p align="justify">Anchored in the principle of “walk the talk,” Weisdom is not merely a brand identity but a commitment—one that emphasizes integrity, accountability, and the consistent delivery of promises. Every action is aligned with intent, ensuring that performance speaks as strongly as words.</p>
										<br>
										<p align="justify">As a forward-thinking, knowledge-driven real estate venture, Weisdom brings together professionals with diverse and complementary expertise across construction, design, and land development. This convergence of capabilities creates a robust platform of collective wisdom, guided by clarity of vision, strategic thinking, and a foundation of uncompromising integrity.</p>
										<div class="spacer-small"></div>
										<p>
											<a href="#part3" class="sr-button style-3 button-small">
												<svg class="arrow arrow-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 35.35">
												<path d="M0,16.88a3,3,0,0,0,.16.94,1.51,1.51,0,0,0,.63.78l15,15a2.14,2.14,0,0,0,3.52.08,2.14,2.14,0,0,0-.08-3.52L8.59,19.38H57.5a2.5,2.5,0,1,0,0-5H8.59L19.22,3.59A2.14,2.14,0,0,0,19.3.08a2.14,2.14,0,0,0-3.52.08l-15,15a1.51,1.51,0,0,0-.62.78A3,3,0,0,0,0,16.88Z"></path>
												</svg>
											</a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="wrapper-big" id="part3">
						<div class="gallery-item-inner item-inner">
							<img src="<?php echo $assets; ?>ample/diagram-home.jpg" alt="SEO">
						</div>
					</div>
					<div class="spacer-big"></div>
					<div class="wrapper-big">
						<div id="gallery-grid" class="isotope-grid gallery-container isotope-spaced-big style-column-4 fitrows clearfix">
							<div class="isotope-item portfolio-item">
								<div class="portfolio-item-inner item-inner">
									<div class="portfolio-info">
										<h3 class="portfolio-name title-alt colored">Who we are?</h3>
										<p align="justify">WE ARE ARCHITECTS WHO BUILD - We design, develop, and manage projects from concept to completion. Our architectural experience guides every decision—balancing vision, cost, and constructability from the start. Nothing is an afterthought; every element, from strategy to detail, is carefully considered.</p>
									</div>
								</div>
							</div>
							<div class="isotope-item portfolio-item">
								<div class="portfolio-item-inner item-inner">
									<div class="portfolio-info">
										<h3 class="portfolio-name title-alt colored">ALDB</h3>
										<p align="justify">ALDB is an integrated process where architects lead both design and development. By combining feasibility, design, and construction under a single direction, projects move with greater clarity, faster decisions, and stronger coordination between design intent and execution.</p>
									</div>
								</div>
							</div>
							<div class="isotope-item portfolio-item">
								<div class="portfolio-item-inner item-inner">
									<div class="portfolio-info">
										<h3 class="portfolio-name title-alt colored">What we believe?</h3>
										<p align="justify">We believe architecture is strongest when intent, execution, and responsibility are one. When the same team guides a project from vision to construction, design thinking carries through every detail—resulting in buildings that are carefully made and built to endure.</p>
									</div>
								</div>
							</div>
							<div class="isotope-item portfolio-item">
								<div class="portfolio-item-inner item-inner">
									<div class="portfolio-info">
										<h3 class="portfolio-name title-alt colored">Why it matters?</h3>
										<p align="justify">An architect-led process protects design intent through development and construction, enabling decisions to be made with technical understanding and design sensitivity—resulting in architecture that is efficient, thoughtful, and built to last.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="spacer-big"></div>
				</section>
				<!-- PAGEBODY -->
				<!-- PAGEBODY 3 -->
				<section id="part4">
					<div class="wrapper-big">
						<div id="portfolio-grid" class="isotope-grid portfolio-container style-column-2 fitrows isotope-spaced clearfix">
							<div class="isotope-item portfolio-item">
								<div class="portfolio-item-inner item-inner">
									<p class="thumb-hover scale"><img src="<?php echo $assets; ?>images/team-members.png" alt="Weisdom Team"></p>
								</div>
							</div>
							<div class="isotope-item portfolio-item">
								<div class="portfolio-item-inner item-inner">
									<div class="portfolio-info">
										<p align="justify" class="team-intro-text">Our firm unites experts from architecture, real estate development, construction, and engineering, creating a multidisciplinary foundation that ensures every project is approached holistically. With principals actively leading each stage—from feasibility and concept development to construction and delivery—we align design, technical execution, cost, and schedule to deliver projects that are thoughtfully designed, efficiently executed, commercially viable, and built to last.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="spacer-medium"></div>
					<div class="wrapper-big">
						<div id="gallery-grid" class="isotope-grid gallery-container isotope-spaced-big style-column-4 fitrows clearfix">
							<div class="isotope-item portfolio-item">
								<div class="portfolio-item-inner item-inner">
									<p class="thumb-hover scale"><img src="<?php echo $assets; ?>images/bhikhu-gajera.png" alt="Bhiku Gajera"></p>
									<div class="portfolio-info">
										<p class="team-role">Co Founder</p>
										<h3 class="portfolio-name title-alt colored">Bhikhu Gajera</h3>
										<p align="justify">Bhikhu Gajera-With over 40 years in real estate, Bhikhu Bhai Gajera brings deep market insight and steady leadership. He has delivered 75+ lakh sq. ft. of development, oversees land acquisition, revenue, and administration, and ensures financial discipline. His grounded approach drives consistent growth and strengthens the organization’s long-term vision.</p>
									</div>
								</div>
							</div>
							<div class="isotope-item portfolio-item">
								<div class="portfolio-item-inner item-inner">
									<p class="thumb-hover scale"><img src="<?php echo $assets; ?>images/nilesh-mewada.png" alt="Nilesh Mewada"></p>
									<div class="portfolio-info">
										<p class="team-role">Founder</p>
										<h3 class="portfolio-name title-alt colored">Nilesh Mevada</h3>
										<p align="justify">Nilesh Mevada is a civil engineer with extensive international experience across the UK, Mumbai, and Goa. He has successfully delivered a diverse portfolio of projects, including mixed-use towers, luxury hotels, and large-scale commercial and residential complexes. With strong expertise in project management and known for efficient execution. He currently leads Allied Group Construction’s high-rise development projects with a focus on excellence and innovation.</p>
									</div>
								</div>
							</div>
							<div class="isotope-item portfolio-item">
								<div class="portfolio-item-inner item-inner">
									<p class="thumb-hover scale"><img src="<?php echo $assets; ?>images/nilesh-gajera.png" alt="Nilesh Gajera"></p>
									<div class="portfolio-info">
										<p class="team-role">Founder</p>
										<h3 class="portfolio-name title-alt colored">Nilesh Gajera</h3>
										<p align="justify">Nilesh Gajera- An architect with international experience at Sebastian Wagner Architects, Berlin, and Apurva Amin Architects, Ahmedabad. Skilled across residential, commercial, institutional, and industrial projects, he blends rigorous design thinking with technical precision to deliver thoughtful, context-driven spaces.</p>
									</div>
								</div>
							</div>
							<div class="isotope-item portfolio-item">
								<div class="portfolio-item-inner item-inner">
									<p class="thumb-hover scale"><img src="<?php echo $assets; ?>images/jitendra.png" alt="Jitendra Patel"></p>
									<div class="portfolio-info">
										<p class="team-role">Founder</p>
										<h3 class="portfolio-name title-alt colored">Jitendra Patel</h3>
										<p align="justify">Jitendra Patel – Façade Industry Expert and Founder of Shailja, Jitendra Patel specializes in high-end façade solutions for ultra-premium projects across India. With expertise in complex building envelopes, he ensures precision in design and execution, providing strategic leadership and guidance for the organization.</p>
									</div>
								</div>
							</div>
							<div class="isotope-item portfolio-item">
								<div class="portfolio-item-inner item-inner">
									<p class="thumb-hover scale"><img src="<?php echo $assets; ?>images/hardik-gajera.png" alt="Hardik Gajera"></p>
									<div class="portfolio-info">
										<p class="team-role">Co Founder</p>
										<h3 class="portfolio-name title-alt colored">Hardik Gajera</h3>
										<p align="justify">Hardik Gajera- A UK-postgraduate in business, Hardik brings commercial and market expertise, with experience at JLL in real estate leasing and transactions. He drives leasing strategies, project positioning, and long-term asset performance.</p>
									</div>
								</div>
							</div>
							<div class="isotope-item portfolio-item">
								<div class="portfolio-item-inner item-inner">
									<p class="thumb-hover scale"><img src="<?php echo $assets; ?>images/monarch.png" alt="Monarch Champaneri"></p>
									<div class="portfolio-info">
										<p class="team-role">Founder</p>
										<h3 class="portfolio-name title-alt colored">Monarch Champaneri</h3>
										<p align="justify">Monarch Champaneri- Architect and founder of OpenIdeas, Monarch holds a Master’s from the University of Illinois, Urbana-Champaign. With experience at Murphy/Jahn (Chicago), Sebastian Wagner (Berlin), and Burt Hill (Ahmedabad), he brings a design-led, solution-oriented approach to architecture and master planning, creating functional and enduring spaces.</p>
									</div>
								</div>
							</div>
							<div class="isotope-item portfolio-item">
								<div class="portfolio-item-inner item-inner">
									<p class="thumb-hover scale"><img src="<?php echo $assets; ?>images/ketan.png" alt="Ketan Patel"></p>
									<div class="portfolio-info">
										<p class="team-role">Project Executive</p>
										<h3 class="portfolio-name title-alt colored">Ketan Patel</h3>
										<p align="justify">Ketan Patel is a dedicated Project Executive responsible for managing project activities, coordinating operations, and ensuring smooth project execution. He focuses on efficient planning, team coordination, and timely project progress.</p>
									</div>
								</div>
							</div>
							<div class="isotope-item portfolio-item">
								<div class="portfolio-item-inner item-inner">
									<p class="thumb-hover scale"><img src="<?php echo $assets; ?>images/khushi-ahiri.png" alt="Khushi Ahiri"></p>
									<div class="portfolio-info">
										<p class="team-role">Sales</p>
										<h3 class="portfolio-name title-alt colored">Khushi Ahiri</h3>
										<p align="justify">Khushi Ahiri is a results-driven real estate sales professional focused on building strong client relationships, identifying the right opportunities, and driving successful business growth.</p>
									</div>
								</div>
							</div>
							<div class="isotope-item portfolio-item">
								<div class="portfolio-item-inner item-inner">
									<p class="thumb-hover scale"><img src="<?php echo $assets; ?>images/team-2.png" alt="Sweetu Patel"></p>
									<div class="portfolio-info">
										<p class="team-role">Office Executive</p>
										<h3 class="portfolio-name title-alt colored">Sweetu Patel</h3>
										<p align="justify">Sweetu Patel is a dedicated Office Executive responsible for managing daily office operations, handling administrative tasks, maintaining records, and ensuring smooth office coordination. She helps create an organized and welcoming environment for clients and team members.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="spacer-medium"></div>
				</section>
				<!-- PAGEBODY -->
			</div>
			<!-- HERO & BODY -->
			<!-- FOOTER -->
			<?php include 'footer.php'; ?>
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

<script>
document.addEventListener("DOMContentLoaded", function() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", function(e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        target.scrollIntoView({ behavior: "smooth", block: "start" });
      }
    });
  });
});
</script>

<script>
function getRandomItem(array) {
    return array[Math.floor(Math.random() * array.length)];
}

function isVideo(file) {
    return ['.mp4', '.webm', '.ogg'].some(ext => file.endsWith(ext));
}

function displayMedia(media) {
    const img = document.getElementById("randomMedia");
    const video = document.getElementById("randomVideo");
    const loader = document.getElementById("loader");

    loader.style.display = "block";
    img.style.display = "none";
    video.style.display = "none";

    if (isVideo(media)) {
        video.src = media;
        video.style.display = "block";

        video.onloadeddata = () => {
            loader.style.display = "none";
            const playPromise = video.play();
            if (playPromise && typeof playPromise.catch === "function") {
                playPromise.catch(() => {
                    loader.style.display = "none";
                });
            }
        };

        video.onended = loadMedia;
    } else {
        img.src = media;
        img.style.display = "block";
        img.style.opacity = 0;

        img.onload = () => {
            img.style.transition = "opacity 1s ease";
            img.style.opacity = 1;
            loader.style.display = "none";
        };

        img.onerror = loadMedia;

        setTimeout(() => {
            img.style.opacity = 0;
            setTimeout(loadMedia, 1000);
        }, 3000);
    }
}

function loadMedia() {
    fetch("rendom.php")
        .then(res => res.json())
        .then(files => {
            if (files.length) {
                displayMedia(getRandomItem(files));
            }
        })
        .catch(err => console.error(err));
}

document.addEventListener("DOMContentLoaded", () => {
    loadMedia();
});
</script>


		<!-- SCRIPTS -->
	</body>
</html>
