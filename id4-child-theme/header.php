<?php require(get_template_directory() . "/inc/site.css-init.customizer.php"); ?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 10]>
<html id="ie10" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 11]>
<html id="ie11" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) | !(IE 9) | !(IE 10) | !(IE 11)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<meta name = "robots" content = "all, index, follow" />
<meta http-equiv = "CACHE-CONTROL" content = "CACHE" />
<meta http-equiv = "PRAGMA" content = "CACHE" />
    <title><?php bloginfo('name') . wp_title(' | '); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<?php if(is_front_page()){ ?>
<body id = "frontpage" <?php body_class(); ?>>
<?php if (class_exists('Alert_Banner')) : Alert_Banner::show_alerts_in_content(); endif; ?>
<?php }else{ ?>
<body id = "secondarypage" <?php body_class(); ?>>
<?php if (class_exists('Alert_Banner')) : Alert_Banner::show_alerts_in_content(); endif; ?>
<?php } ?>
<div id = "wrapper" class = "long-row">
<?php if($freedom_props['above_brand_show'] == "show"): ?>
	<div class = "long-row" id = "above-header">
		<?php if(is_active_sidebar('above-brand-bar')): ?>
		<?php dynamic_sidebar('above-brand-bar'); ?>
		<?php endif; ?>
	</div>
<?php endif; ?>
    <!-- header with brand standard -->
    <div class = "long-row" id = "header-bar"><!-- brand bar -->
        <div class = "row" id = "header-box">
            <div class = "large-8 column"><!-- brand box: uconn | university of connecticut  -->
                <ul id = "bannertop">
                    <li>
                        <div id = "uc-sig">
                            <span id = "uconn-signature"><a href = "http://www.uconn.edu/">UCONN</a></span>
                        </div>
                    </li>
                    <li>
                        <div id = "uc-sep">
                            <span id = "separator">|</span>
                        </div>
                    </li>
                    <li>
                        <div id = "uc-fn">
                            <span id = "uconn-fullname"><a href = "http://www.uconn.edu/">University of Connecticut</a></span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class = "large-4 column"  id = "search-index-box"><!-- search/index box -->
				<ul id = "iconsbox">
                    <li>
                        <div>
                            <a href = "http://www.uconn.edu/search/"><img src = "https://www.engr.uconn.edu/wp-content/themes/engineering/images/m-icons_0000_search-white.png" alt = "image icon" /></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <a href = "http://www.uconn.edu/az">A-Z</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php if($freedom_props['header_display'] == "display"): ?>
    <!-- site title area with brand standard -->
    <div class = "long-row" id = "title-bar">
        <div class = "row" id = "title-box">
<?php if(is_active_sidebar("righttitlearea")): ?>
            <div class = "large-8 left"><!-- site title and partnership -->
<?php else: ?>
            <div class = "large-12 left"><!-- site title and partnership -->
<?php endif; ?>
<?php if($freedom_props['primary_org_url'] && $freedom_props['primary_org_name'] && $freedom_props['secondary_org_url'] && $freedom_props['secondary_org_name']): ?>
                <h6>
                    <a class = "primary-org-name" href = "<?php print $freedom_props['primary_org_url'] ?>"><?php print $freedom_props['primary_org_name'] ?></a>
					<span class = "org-separator"> | </span>
					<a class = "secondary-org-name" href = "<?php print $freedom_props['secondary_org_url'] ?>"><?php print $freedom_props['secondary_org_name'] ?></a> 
                </h6>
<?php elseif($freedom_props['primary_org_url'] && $freedom_props['primary_org_name']): ?>
                <h6>
                    <a class = "primary-org-name" href = "<?php print $freedom_props['primary_org_url'] ?>"><?php print $freedom_props['primary_org_name'] ?></a>
                </h6>
<?php endif; ?>
                <h2>
					<span id = "site-name">
						<a href = "<?php bloginfo("url"); ?>"><?php bloginfo("name"); ?></a>
					</span>
                </h2>
            </div>
<?php if(is_active_sidebar("righttitlearea")):?>
            <div class = "large-4 right"><!-- site logo -->
                <?php // dynamic_sidebar("righttitlearea"); ?>
            </div>
<?php endif; ?>
        </div>
    </div>
<?php endif; ?>
    <!-- main menu area -->

<?php if($freedom_props['top_menu_display_toggle'] == "display" && $freedom_props['top_menu_position_toggle'] == "above"): ?>
<div class = "long-row" id = "top-menu-bar">
        <div class = "row">
                <div class = "large-12">
<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name"></li>
    <li class="toggle-topbar menu-icon right"><a href="#"><span>Menu</span></a></li>
  </ul>
  <section class="top-bar-section">
        <?php if(has_nav_menu('mainmenu')): ?>
        <?php wp_nav_menu(array('theme_location' => 'mainmenu', 'menu_id' => 'mainmenu', 'container' => 'false', 'walker' => new Top_Bar_Walker())); ?>
        <?php else: ?>
        <ul>
                <li><a href="http://www.engr.uconn.edu">School of Engineering</a></li>
                <li><a href="http://www.uconn.edu/az/">University A-Z Index</a></li>
                <li><a href="http://today.uconn.edu/">UConn Today</a></li>
                <li><a href="http://news.engr.uconn.edu/">Engineering News</a></li>
        </ul>
	<?php endif; ?>
 </section>
</nav>
                </div>
        </div>
</div>
<?php endif; ?>



<?php if(is_active_sidebar('bannerarea') && is_front_page()): ?>
<?php dynamic_sidebar('bannerarea'); ?>
<?php endif; ?>
<?php if($freedom_props['top_menu_display_toggle'] == "display" && $freedom_props['top_menu_position_toggle'] == "below"): ?>
<div class = "long-row" id = "top-menu-bar">
	<div class = "row">
		<div class = "large-12">
<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name"></li>
    <li class="toggle-topbar menu-icon right"><a href="#"><span>Menu</span></a></li>
  </ul>
  <section class="top-bar-section">
	<?php if(has_nav_menu('mainmenu')): ?>
	<?php wp_nav_menu(array('theme_location' => 'mainmenu', 'menu_id' => 'mainmenu', 'container' => 'false', 'walker' => new Top_Bar_Walker())); ?>
	<?php else: ?>
	<ul>
		<li><a href="http://www.engr.uconn.edu">School of Engineering</a></li>
		<li><a href="http://www.uconn.edu/az/">University A-Z Index</a></li>
		<li><a href="http://today.uconn.edu/">UConn Today</a></li>
		<li><a href="http://news.engr.uconn.edu/">Engineering News</a></li>
	</ul>
	<?php endif; ?>
 </section>
</nav>
		</div>
	</div>
</div> 
<?php endif; ?>
    <!-- content area -->
    <div class = "long-row" id = "body-box">
<?php if(is_single() || is_archive()) { ?>
<?php if(is_active_sidebar('about-section-bannerarea')){ ?>
<div id = "page-banner-bar" class = "long-row">
    <div class = "row">
        <div class = "large-12 custom-column">
    <?php dynamic_sidebar('about-section-bannerarea'); ?>
        </div>
    </div>
</div>
<div id = "page-title-bar" class = "long-row">
    <div class = "row">
        <div class = "large-12 column">
            <h2><?php // print is_tax(); ?>
            <?php if(is_post_type_archive('post')): ?>
            Archives
            <?php elseif(is_post_type_archive('organization-event')): ?>
            Calendar
            <?php elseif(is_post_type_archive('academy-profile')): ?>
            Academy Member Profile(s)
            <?php elseif(is_tax()): ?>
            Keyword: <?php print single_cat_title( '', false ) ?>
            <?php else: ?>
            <?php the_title(); ?>
            <?php endif; ?>
            </h2>    
        </div>
    </div>
</div>
<?php } ?>
<div class = "row" id = "contentsection">
    <div class = "large-12 column" id = "content-box">
<?php if(!is_front_page()): ?>
<?php custom_breadcrumbs() ?>
<?php endif; ?>
<?php } ?>
