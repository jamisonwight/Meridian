<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JSHDL1QBSL"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-JSHDL1QBSL');
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta class="foundation-mq">
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=602eeb436d01a000119a08f6&product=sop' async='async'></script>
		<?php if (!function_exists('has_site_icon') || !has_site_icon()) { ?>
			<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
			<link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-icon-touch.png" rel="apple-touch-icon" />	
	    <?php 
	} ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.typekit.net/umo5jvq.css">
    <link href="http://fonts.cdnfonts.com/css/gotham" rel="stylesheet">
    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=#{property?._id}&product=custom-share-buttons"></script>
    <?php wp_head(); ?>
	  <script>(function(d){var s = d.createElement("script");s.setAttribute("data-account", "OQBfWXhU5x");s.setAttribute("src", "https://cdn.userway.org/widget.js");(d.body || d.head).appendChild(s);})(document)</script><noscript>Please ensure Javascript is enabled for purposes of <a href="https://userway.org">website accessibility</a></noscript>
      <!-- SET AGE GATE PROPERTIES -->
      <?php
        $age_gate = (object)array(
            'brand'						=> 		  'Set this is the brand name',
            'background_image'			=> 		  get_template_directory_uri().'/assets/images/age-gate.jpg',
            'brand_logo'				=>		  get_template_directory_uri().'/assets/images/logo-vert.svg',
            'age_heading'				=>		  "Are you of legal drinking age?",
            'terms_of_service'  		=>		  'terms-of-service.html',
            'privacy_policy'			=>		  'privacy-policy.html',
            'regret_text'				=>		  'You must be 21 years of age or older to enter this site. By clicking yes you affirm that you are at least 21 years old.',
        );
        ?>
        <script>
          jQuery(function($) {
                $(document).ready(function() {
                    /*!
                    * Simple Age Verification (https://github.com/Herudea/age-verification))
                    */
                    var modal_content, modal_screen;
                    $(document).ready(function() {
                        av_legality_check()
                    });
                    av_legality_check = function() {
                        if ($.cookie('is_legal') == "yes") {} else {
                            av_showmodal();
                            $(window).on('resize', av_positionPrompt);
                        }
                    };
                    av_showmodal = function() {
                        modal_screen = $('<div id="modal_screen" class="age_gate"></div>');
                        modal_content = $('<div id="modal_content" style="display:none" role="dialog" aria-modal="true"></div>');
                        var modal_content_wrapper = $('<div id="modal_content_wrapper" class="content_wrapper bubbles" style="background: linear-gradient(rgba(0,0,0,.3), rgba(0,0,0,.3)), url(<?php echo $age_gate->background_image; ?>);"><small class="agegate-copyright">&copy;<?php echo date('Y'); ?> Meridian Vineyards, All Rights Reserved</small></div>');
                        var modal_regret_wrapper = $('<div id="modal_regret_wrapper" class="content_wrapper" style="display:none;"></div>');
                        var content_agegate = $('<div class="content-container"><img class="agegate-logo" src="<?php echo $age_gate->brand_logo; ?>" alt="Meridian Wines logo" /><h1 class="heading-3"><?php echo $age_gate->age_heading; ?></h1><div class="agree paragraph"><label for="agree" class="show-for-sr">I agree to the Terms of Service and Privacy Policy</label><input type="checkbox" id="agree" required name="agree" role="tab" aria-selected="true" tabindex="1"></input></a>I agree to the <a data-fancybox data-type="iframe" data-src="<?php echo $age_gate->terms_of_service ?>" href="javascript:;" aria-disabled="true">Terms of Service</a> and <a data-fancybox data-type="iframe" data-src="<?php echo $age_gate->privacy_policy ?>" href="javascript:;" aria-disabled="true">Privacy Policy</a></div><nav><ul><li><a href="#" class="av_btn" rel="yes" id="yes" role="tab" tabindex="2"><button class="btn-default">Yes</button></a></li><li><a href="#" class="av_btn" rel="no" id="no" role="tab" tabindex="3"><button class="btn-default">No</button></a></li></nav><small class="regret-text"><?php echo $age_gate->regret_text; ?></small></div>');
                        var regret_text = $('');
                        modal_content_wrapper.append(content_agegate);
                        modal_regret_wrapper.append(regret_text);
                        modal_content.append(modal_content_wrapper, modal_regret_wrapper);
                        $('body').append(modal_screen, modal_content);
                        av_positionPrompt();
                        modal_content.find('a.av_btn').on('click', av_setCookie);
                    };
                    av_setCookie = function(e) {
                        e.preventDefault();
                        var is_legal = $(e.currentTarget).attr('rel');
                        $.cookie('is_legal', is_legal, {
                            expires: 30,
                            path: '/'
                        });
                        if($("#agree").is(':checked') && (is_legal == "yes" )) {
                            av_closeModal();
                            $(window).off('resize');
                        } else if (is_legal == "no") {
                            av_showRegret();
                        } else if (!$("#agree").is(':checked')) {
                            alert('You must agree to the terms of service.');
                        } else if (is_legal == "no") {
                            av_showRegret();
                        }
                    };
                    av_closeModal = function() {
                        modal_content.fadeOut();
                        modal_screen.fadeOut();
                    };
                    av_showRegret = function() {
                        modal_screen.addClass('nope');
                        modal_content.find('#modal_content_wrapper').hide();
                        modal_content.find('#modal_regret_wrapper').show();
                    };
                    av_positionPrompt = function() {
                        var top = ($(window).outerHeight() - $('#modal_content').outerHeight()) / 2;
                        var left = ($(window).outerWidth() - $('#modal_content').outerWidth()) / 2;
                        modal_content.css({
                            'top': top,
                            'left': left
                        });
                        if (modal_content.is(':hidden') && ($.cookie('is_legal') != "yes")) {
                            modal_content.fadeIn('slow');
                        }
                    };
                });
            });
            jQuery(function($) {
                $(document).ready(function() {
                    $('#modal_regret_wrapper').on('click', function() {
                        $(this).hide();
                        $('#modal_content_wrapper').show();
                    });
                });
            });
          </script>
</head>

<body <?php body_class(); ?>>

    <header class="header" role="banner">

        <div class="wrapper inner-grid-large">
            <!-- This navs will be applied to the topbar, above all content 
            To see additional nav styles, visit the /parts directory -->
            <?php get_template_part('parts/nav', 'title-bar') ?>
        </div>

    </header> <!-- end .header --> 