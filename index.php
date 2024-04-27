<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
    <?php
        if (!$this->auth_check) {
            redirect(lang_base_url());
            exit();
        }
    ?>
<!DOCTYPE html>
<html lang="<?= $this->selected_lang->short_form ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= xss_clean($title); ?></title>
        <meta name="description" content="<?= xss_clean($description); ?>"/>
        <meta name="keywords" content="<?= xss_clean($keywords); ?>"/>
        <meta name="author" content="<?= xss_clean($this->general_settings->application_name); ?>"/>
        <link rel="shortcut icon" type="image/png" href="<?= get_favicon($this->general_settings); ?>"/>
        <meta property="og:locale" content="en-US"/>
        <meta property="og:site_name" content="<?= xss_clean($this->general_settings->application_name); ?>"/>
        <?php if (isset($show_og_tags)): ?>
        <meta property="og:type" content="<?= !empty($og_type) ? $og_type : 'website'; ?>"/>
        <meta property="og:title" content="<?= !empty($og_title) ? $og_title : 'index'; ?>"/>
        <meta property="og:description" content="<?= $og_description; ?>"/>
        <meta property="og:url" content="<?= $og_url; ?>"/>
        <meta property="og:image" content="<?= $og_image; ?>"/>
        <meta property="og:image:width" content="<?= !empty($og_width) ? $og_width : 250; ?>"/>
        <meta property="og:image:height" content="<?= !empty($og_height) ? $og_height : 250; ?>"/>
        <meta property="article:author" content="<?= !empty($og_author) ? $og_author : ''; ?>"/>
        <meta property="fb:app_id" content="<?= $this->general_settings->facebook_app_id; ?>"/>
        <?php if (!empty($og_tags)):foreach ($og_tags as $tag): ?>
        <meta property="article:tag" content="<?= $tag->tag; ?>"/>
        <?php endforeach; endif; ?>
        <meta property="article:published_time" content="<?= !empty($og_published_time) ? $og_published_time : ''; ?>"/>
        <meta property="article:modified_time" content="<?= !empty($og_modified_time) ? $og_modified_time : ''; ?>"/>
        <meta name="twitter:card" content="summary_large_image"/>
        <meta name="twitter:site" content="@<?= xss_clean($this->general_settings->application_name); ?>"/>
        <meta name="twitter:title" content="<?= xss_clean($og_title); ?>"/>
        <meta name="twitter:description" content="<?= xss_clean($og_description); ?>"/>
        <meta name="twitter:image" content="<?= $og_image; ?>"/>
        <?php else: ?>
        <meta property="og:image" content="<?= get_logo($this->general_settings); ?>"/>
        <meta property="og:image:width" content="160"/>
        <meta property="og:image:height" content="60"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="<?= xss_clean($title); ?> - <?= xss_clean($this->settings->site_title); ?>"/>
        <meta property="og:description" content="<?= xss_clean($description); ?>"/>
        <meta property="og:url" content="<?= base_url(); ?>"/>
        <meta property="fb:app_id" content="<?= $this->general_settings->facebook_app_id; ?>"/>
        <meta name="twitter:card" content="summary_large_image"/>
        <meta name="twitter:site" content="@<?= xss_clean($this->general_settings->application_name); ?>"/>
        <meta name="twitter:title" content="<?= xss_clean($title); ?> - <?= xss_clean($this->settings->site_title); ?>"/>
        <meta name="twitter:description" content="<?= xss_clean($description); ?>"/>
        <?php endif; ?>
        <?php if ($this->general_settings->pwa_status == 1): ?>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="<?= xss_clean($this->general_settings->application_name); ?>">
        <meta name="msapplication-TileImage" content="<?= base_url(); ?>assets/img/pwa/144x144.png">
        <meta name="msapplication-TileColor" content="#2F3BA2">
        <link rel="manifest" href="<?= base_url(); ?>manifest.json">
        <link rel="apple-touch-icon" href="<?= base_url(); ?>assets/img/pwa/144x144.png">
        <?php endif; ?>
        <link rel="canonical" href="<?= current_full_url(); ?>"/>
        <?php if ($this->general_settings->multilingual_system == 1):
        foreach ($this->languages as $language): ?>
        <link rel="alternate" href="<?= convert_url_by_language($language); ?>" hreflang="<?= $language->language_code ?>"/>
        <?php endforeach; endif; ?>
        <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/font-icons/css/mds-icons.min.css"/>
        <?= !empty($this->fonts->site_font_url) ? $this->fonts->site_font_url : ''; ?>
        <link href="<?= base_url(); ?>assets/build/assets/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="<?= base_url(); ?>assets/build/assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?= base_url(); ?>themes/css/flaticon.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style-2.1.css"/>
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/plugins-2.1.css"/>
        <link rel="stylesheet" href="<?= base_url(); ?>assets/build/style.css" />
        <link rel="stylesheet" href="<?= base_url(); ?>assets/build/assets/css/dashforge.css">
		<link rel="stylesheet" href="<?= base_url(); ?>assets/build/assets/css/dashforge.dashboard.css">
        
        <link rel="stylesheet" href="<?= base_url(); ?>assets/build/viewer.css">

        <?php $clr =$this->general_settings->site_color;?>
        <style>
        :root{

            --title-family: "Ubuntu";
            --outline-text:'Montserrat', sans-serif;
            --common-family:'Open Sans', sans-serif;
        }

        body {<?php echo $this->fonts->site_font_family; ?>}
        <?php if(!empty($index_banners_array)):foreach ($index_banners_array as $banner_set):foreach ($banner_set as $banner):?>.index_bn_<?=$banner->id;?> {-ms-flex: 0 0 <?=$banner->banner_width;?>%;flex: 0 0 <?=$banner->banner_width;?>%;max-width: <?=$banner->banner_width;?>%;}  <?php endforeach; endforeach; endif; ?>
            a:active,a:focus,a:hover{color:<?= $clr; ?>}.btn-custom, .modal-newsletter .btn,.newsletter-button{background-color:<?= $clr; ?>;border-color:<?= $clr; ?>}.btn-block{background-color:<?= $clr; ?>}.btn-outline{border:1px solid <?= $clr; ?>;color:<?= $clr; ?>}.btn-outline:hover{background-color:<?= $clr; ?>!important}.btn-filter-products-mobile{border:1px solid <?= $clr; ?>;background-color:<?= $clr; ?>}.form-control:focus{border-color:<?= $clr; ?>}.link{color:<?= $clr; ?>!important}.link-color{color:<?= $clr; ?>}.top-search-bar .btn-search{background-color:<?= $clr; ?>}.nav-top .nav-top-right .nav li a:active,.nav-top .nav-top-right .nav li a:focus,.nav-top .nav-top-right .nav li a:hover{color:<?= $clr; ?>}.nav-top .nav-top-right .nav li .btn-sell-now{background-color:<?= $clr; ?>!important}.nav-main .navbar>.navbar-nav>.nav-item:hover .nav-link:before{background-color:<?= $clr; ?>}.li-favorites a i{color:<?= $clr; ?>}.product-share ul li a:hover{color:<?= $clr; ?>}.pricing-card:after{background-color:<?= $clr; ?>}.selected-card{-webkit-box-shadow:0 3px 0 0 <?= $clr; ?>;box-shadow:0 3px 0 0 <?= $clr; ?>}.selected-card .btn-pricing-button{background-color:<?= $clr; ?>}.profile-buttons .social ul li a:hover{background-color:<?= $clr; ?>;border-color:<?= $clr; ?>}.btn-product-promote{background-color:<?= $clr; ?>}.contact-social ul li a:hover{background-color:<?= $clr; ?>;border-color:<?= $clr; ?>}.price-slider .ui-slider-horizontal .ui-slider-handle{background:<?= $clr; ?>}.price-slider .ui-slider-range{background:<?= $clr; ?>}.p-social-media a:hover{color:<?= $clr; ?>}.blog-content .blog-categories .active a{background-color:<?= $clr; ?>}.nav-payout-accounts .active,.nav-payout-accounts .show>.nav-link{background-color:<?= $clr; ?>!important}.pagination .active a{border:1px solid <?= $clr; ?>!important;background-color:<?= $clr; ?>!important}.pagination li a:active,.pagination li a:focus,.pagination li a:hover{background-color:<?= $clr; ?>;border:1px solid <?= $clr; ?>}.spinner>div{background-color:<?= $clr; ?>}::selection{background:<?= $clr; ?>!important}::-moz-selection{background:<?= $clr; ?>!important}.cookies-warning a{color:<?= $clr; ?>}.custom-checkbox .custom-control-input:checked~.custom-control-label::before{background-color:<?= $clr; ?>}.custom-control-input:checked~.custom-control-label::before{border-color:<?= $clr; ?>;background-color:<?= $clr; ?>}.custom-control-variation .custom-control-input:checked~.custom-control-label{border-color:<?= $clr; ?>!important}.btn-wishlist .icon-heart{color:<?= $clr; ?>}.product-item-options .item-option .icon-heart{color:<?= $clr; ?>}.mobile-language-options li .selected,.mobile-language-options li a:hover{color:<?= $clr; ?>;border:1px solid <?= $clr; ?>}.mega-menu .link-view-all, .link-add-new-shipping-option{color:<?= $clr; ?>!important;}.mega-menu .menu-subcategories ul li .link-view-all:hover{border-color:<?= $clr; ?>!important}.custom-select:focus{border-color:<?= $clr; ?>}.all-help-topics a{color:<?= $clr; ?>}</style>
        <script>var dtx_config = {base_url: "<?= base_url(); ?>", fileTitleGet: "<?= xss_clean($og_title); ?>",  lang_base_url: "<?= lang_base_url(); ?>", sys_lang_id: "<?= $this->selected_lang->id; ?>", thousands_separator: "<?= $this->thousands_separator; ?>", csfr_token_name: "<?= $this->security->get_csrf_token_name(); ?>", csfr_cookie_name: "<?= $this->config->item('csrf_cookie_name'); ?>", txt_all: "<?= trans("all"); ?>", txt_no_results_found: "<?= trans("no_results_found"); ?>", sweetalert_ok: "<?= trans("ok"); ?>", sweetalert_cancel: "<?= trans("cancel"); ?>", msg_accept_terms: "<?= trans("msg_accept_terms"); ?>", cart_route: "<?= !empty($this->routes) && !empty($this->routes->cart) ? $this->routes->cart : ''; ?>", slider_fade_effect: "<?= ($this->general_settings->slider_effect == "fade") ? 1 : 0; ?>", is_recaptcha_enabled: "<?= !empty($recaptcha_status) && $recaptcha_status == true ? "true" : "false" ?>", files: "<?= $files; ?>", rtl: <?= $this->rtl == "true" ? true : "false" ?>, txt_add_to_cart: "<?= trans("add_to_cart"); ?>", txt_added_to_cart: "<?= trans("added_to_cart"); ?>", txt_add_to_wishlist: "<?= trans("add_to_wishlist"); ?>", txt_remove_from_wishlist: "<?= trans("remove_from_wishlist"); ?>"};if(dtx_config.rtl==1){dtx_config.rtl=true;}</script>
		

        <?php if ($this->rtl == true): ?>
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/rtl-2.1.min.css">
        <?php endif; ?>
        <?= $this->general_settings->custom_css_codes; ?>
        <?= $this->general_settings->google_adsense_code; ?>
        <link rel="resource" type="application/l10n" href="<?= base_url(); ?>assets/build/locale/locale.properties">
        <script src="<?= base_url(); ?>assets/build/pdf.js"></script>

        <script src="<?= base_url(); ?>assets/build/viewer.js"></script>
        
    </head>
	<body tabindex="1" class="page-profile">
		<div id="outerContainer">

			<div id="sidebarContainer">
				<div id="toolbarSidebar">
					<div id="toolbarSidebarLeft">
						<div id="sidebarViewButtons" class="splitToolbarButton toggled" role="radiogroup">
							<button id="viewThumbnail" class="toolbarButton toggled" title="Show Thumbnails" tabindex="2" data-l10n-id="thumbs" role="radio" aria-checked="false" aria-controls="thumbnailView">
								 <span data-l10n-id="thumbs_label">Thumbnails</span>
							</button>
							<button id="viewOutline" class="toolbarButton" title="Show Document Outline (double-click to expand/collapse all items)" tabindex="3" data-l10n-id="document_outline" role="radio" aria-checked="true" aria-controls="outlineView">
								 <span data-l10n-id="document_outline_label">Document Outline</span>
							</button>
							<button id="viewAttachments" class="toolbarButton" title="Show Attachments" tabindex="4" data-l10n-id="attachments" role="radio" aria-checked="false" aria-controls="attachmentsView">
								 <span data-l10n-id="attachments_label">Attachments</span>
							</button>
							<button id="viewLayers" class="toolbarButton" title="Show Layers (double-click to reset all layers to the default state)" tabindex="5" data-l10n-id="layers" role="radio" aria-checked="false" aria-controls="layersView">
								 <span data-l10n-id="layers_label">Layers</span>
							</button>
						</div>
					</div>

					<div id="toolbarSidebarRight">
						<div id="outlineOptionsContainer" class="hidden">
							<div class="verticalToolbarSeparator"></div>

							<button id="currentOutlineItem" class="toolbarButton" disabled="disabled" title="Find Current Outline Item" tabindex="6" data-l10n-id="current_outline_item">
								<span data-l10n-id="current_outline_item_label">Current Outline Item</span>
							</button>
						</div>
					</div>
				</div>
				<div id="sidebarContent">
					<div id="thumbnailView">
					</div>
					<div id="outlineView" class="hidden">
					</div>
					<div id="attachmentsView" class="hidden">
					</div>
					<div id="layersView" class="hidden">
					</div>
				</div>
				<div id="sidebarResizer"></div>
			</div> 

			<div id="mainContainer">
				<div class="findbar hidden doorHanger" id="findbar">
					<div id="findbarInputContainer">
						<input id="findInput" class="toolbarField" title="Find" placeholder="Find in document…" tabindex="91" data-l10n-id="find_input" aria-invalid="false">
						<div class="splitToolbarButton">
							<button id="findPrevious" class="toolbarButton" title="Find the previous occurrence of the phrase" tabindex="92" data-l10n-id="find_previous">
								<span data-l10n-id="find_previous_label">Previous</span>
							</button>
							<div class="splitToolbarButtonSeparator"></div>
							<button id="findNext" class="toolbarButton" title="Find the next occurrence of the phrase" tabindex="93" data-l10n-id="find_next">
								<span data-l10n-id="find_next_label">Next</span>
							</button>
						</div>
					</div>

					<div id="findbarOptionsOneContainer">
						<input type="checkbox" id="findHighlightAll" class="toolbarField" tabindex="94">
						<label for="findHighlightAll" class="toolbarLabel" data-l10n-id="find_highlight">Highlight All</label>
						<input type="checkbox" id="findMatchCase" class="toolbarField" tabindex="95">
						<label for="findMatchCase" class="toolbarLabel" data-l10n-id="find_match_case_label">Match Case</label>
					</div>
					<div id="findbarOptionsTwoContainer">
						<input type="checkbox" id="findMatchDiacritics" class="toolbarField" tabindex="96">
						<label for="findMatchDiacritics" class="toolbarLabel" data-l10n-id="find_match_diacritics_label">Match Diacritics</label>
						<input type="checkbox" id="findEntireWord" class="toolbarField" tabindex="97">
						<label for="findEntireWord" class="toolbarLabel" data-l10n-id="find_entire_word_label">Whole Words</label>
					</div>

					<div id="findbarMessageContainer" aria-live="polite">
						<span id="findResultsCount" class="toolbarLabel"></span>
						<span id="findMsg" class="toolbarLabel"></span>
					</div>
				</div>  <!-- findbar -->

				<div class="editorParamsToolbar hidden doorHangerRight" id="editorFreeTextParamsToolbar">
					<div class="editorParamsToolbarContainer">
						<div class="editorParamsSetter">
							<label for="editorFreeTextColor" class="editorParamsLabel" data-l10n-id="editor_free_text_color">Color</label>
							<input type="color" id="editorFreeTextColor" class="editorParamsColor" tabindex="100">
						</div>
						<div class="editorParamsSetter">
							<label for="editorFreeTextFontSize" class="editorParamsLabel" data-l10n-id="editor_free_text_size">Size</label>
							<input type="range" id="editorFreeTextFontSize" class="editorParamsSlider" value="10" min="5" max="100" step="1" tabindex="101">
						</div>
					</div>
				</div>

				<div class="editorParamsToolbar hidden doorHangerRight" id="editorInkParamsToolbar">
					<div class="editorParamsToolbarContainer">
						<div class="editorParamsSetter">
							<label for="editorInkColor" class="editorParamsLabel" data-l10n-id="editor_ink_color">Color</label>
							<input type="color" id="editorInkColor" class="editorParamsColor" tabindex="102">
						</div>
						<div class="editorParamsSetter">
							<label for="editorInkThickness" class="editorParamsLabel" data-l10n-id="editor_ink_thickness">Thickness</label>
							<input type="range" id="editorInkThickness" class="editorParamsSlider" value="1" min="1" max="20" step="1" tabindex="103">
						</div>
						<div class="editorParamsSetter">
							<label for="editorInkOpacity" class="editorParamsLabel" data-l10n-id="editor_ink_opacity">Opacity</label>
							<input type="range" id="editorInkOpacity" class="editorParamsSlider" value="100" min="1" max="100" step="1" tabindex="104">
						</div>
					</div>
				</div>

				<div id="secondaryToolbar" class="secondaryToolbar hidden doorHangerRight">
					<div id="secondaryToolbarButtonContainer">

						<button id="presentationMode" class="secondaryToolbarButton" title="Switch to Presentation Mode" tabindex="54" data-l10n-id="presentation_mode">
							<span data-l10n-id="presentation_mode_label">Presentation Mode</span>
						</button>

						<a href="#" id="viewBookmark" class="secondaryToolbarButton" title="Current Page (View URL from Current Page)" tabindex="55" data-l10n-id="bookmark1">
							<span data-l10n-id="bookmark1_label">Current Page</span>
						</a>

						<div id="viewBookmarkSeparator" class="horizontalToolbarSeparator"></div>

						<button id="firstPage" class="secondaryToolbarButton" title="Go to First Page" tabindex="56" data-l10n-id="first_page">
							<span data-l10n-id="first_page_label">Go to First Page</span>
						</button>
						<button id="lastPage" class="secondaryToolbarButton" title="Go to Last Page" tabindex="57" data-l10n-id="last_page">
							<span data-l10n-id="last_page_label">Go to Last Page</span>
						</button>

						<div class="horizontalToolbarSeparator"></div>

						<button id="pageRotateCw" class="secondaryToolbarButton" title="Rotate Clockwise" tabindex="58" data-l10n-id="page_rotate_cw">
							<span data-l10n-id="page_rotate_cw_label">Rotate Clockwise</span>
						</button>
						<button id="pageRotateCcw" class="secondaryToolbarButton" title="Rotate Counterclockwise" tabindex="59" data-l10n-id="page_rotate_ccw">
							<span data-l10n-id="page_rotate_ccw_label">Rotate Counterclockwise</span>
						</button>

						<div class="horizontalToolbarSeparator"></div>

						<div id="cursorToolButtons" role="radiogroup">
							<button id="cursorSelectTool" class="secondaryToolbarButton toggled" title="Enable Text Selection Tool" tabindex="60" data-l10n-id="cursor_text_select_tool" role="radio" aria-checked="true">
								<span data-l10n-id="cursor_text_select_tool_label">Text Selection Tool</span>
							</button>
							<button id="cursorHandTool" class="secondaryToolbarButton" title="Enable Hand Tool" tabindex="61" data-l10n-id="cursor_hand_tool" role="radio" aria-checked="false">
								<span data-l10n-id="cursor_hand_tool_label">Hand Tool</span>
							</button>
						</div>

						<div class="horizontalToolbarSeparator"></div>

						<div id="scrollModeButtons" role="radiogroup">
							<button id="scrollPage" class="secondaryToolbarButton" title="Use Page Scrolling" tabindex="62" data-l10n-id="scroll_page" role="radio" aria-checked="false">
								<span data-l10n-id="scroll_page_label">Page Scrolling</span>
							</button>
							<button id="scrollVertical" class="secondaryToolbarButton toggled" title="Use Vertical Scrolling" tabindex="63" data-l10n-id="scroll_vertical" role="radio" aria-checked="true">
								<span data-l10n-id="scroll_vertical_label" >Vertical Scrolling</span>
							</button>
							<button id="scrollHorizontal" class="secondaryToolbarButton" title="Use Horizontal Scrolling" tabindex="64" data-l10n-id="scroll_horizontal" role="radio" aria-checked="false">
								<span data-l10n-id="scroll_horizontal_label">Horizontal Scrolling</span>
							</button>
							<button id="scrollWrapped" class="secondaryToolbarButton" title="Use Wrapped Scrolling" tabindex="65" data-l10n-id="scroll_wrapped" role="radio" aria-checked="false">
								<span data-l10n-id="scroll_wrapped_label">Wrapped Scrolling</span>
							</button>
						</div>

						<div class="horizontalToolbarSeparator"></div>

						<div id="spreadModeButtons" role="radiogroup">
							<button id="spreadNone" class="secondaryToolbarButton toggled" title="Do not join page spreads" tabindex="66" data-l10n-id="spread_none" role="radio" aria-checked="true">
								<span data-l10n-id="spread_none_label">No Spreads</span>
							</button>
							<button id="spreadOdd" class="secondaryToolbarButton" title="Join page spreads starting with odd-numbered pages" tabindex="67" data-l10n-id="spread_odd" role="radio" aria-checked="false">
								<span data-l10n-id="spread_odd_label">Odd Spreads</span>
							</button>
							<button id="spreadEven" class="secondaryToolbarButton" title="Join page spreads starting with even-numbered pages" tabindex="68" data-l10n-id="spread_even" role="radio" aria-checked="false">
								<span data-l10n-id="spread_even_label">Even Spreads</span>
							</button>
						</div>

					</div>
				</div>  
				<!-- secondaryToolbar -->

				<div class="toolbar">
					<div id="toolbarContainer">
						<div id="toolbarViewer">
							<div id="toolbarViewerLeft">
								<button id="sidebarToggle" class="toolbarButton" title="Toggle Sidebar" tabindex="11" data-l10n-id="toggle_sidebar" aria-expanded="false" aria-controls="sidebarContainer">
									<span data-l10n-id="toggle_sidebar_label">Toggle Sidebar</span>
								</button>
								<div class="toolbarButtonSpacer"></div>
								<div class="hiddenSmallView">
									<a class="df-logo" href="<?= $og_url; ?>"><img style="height: 40px;" src="<?php echo get_logo($this->general_settings); ?>" alt="logo"></a>
								</div>
							</div>
							<div id="toolbarViewerRight">

								<div class="splitToolbarButton">
									<button id="zoomOut" class="toolbarButton" title="Zoom Out" tabindex="21" data-l10n-id="zoom_out">
										<span data-l10n-id="zoom_out_label">Zoom Out</span>
									</button>
									<div class="splitToolbarButtonSeparator"></div>
									<button id="zoomIn" class="toolbarButton" title="Zoom In" tabindex="22" data-l10n-id="zoom_in">
										<span data-l10n-id="zoom_in_label">Zoom In</span>
									 </button>
								</div>
								<span id="scaleSelectContainer" class="dropdownToolbarButton">
									<select id="scaleSelect" title="Zoom" tabindex="23" data-l10n-id="zoom">
										<option id="pageAutoOption" title="" value="auto"  data-l10n-id="page_scale_auto">Automatic Zoom</option>
										<option id="pageActualOption" title="" selected="selected" value="page-actual" data-l10n-id="page_scale_actual">Actual Size</option>
										<option id="pageFitOption" title="" value="page-fit" data-l10n-id="page_scale_fit">Page Fit</option>
										<option id="pageWidthOption" title="" value="page-width" data-l10n-id="page_scale_width">Page Width</option>
										<option id="customScaleOption" title="" value="custom" disabled="disabled" hidden="true"></option>
										<option title="" value="0.5" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 50 }'>50%</option>
										<option title="" value="0.75" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 75 }'>75%</option>
										<option title="" value="1" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 100 }'>100%</option>
										<option title="" value="1.25" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 125 }'>125%</option>
										<option title="" value="1.5" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 150 }'>150%</option>
										<option title="" value="2" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 200 }'>200%</option>
										<option title="" value="3" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 300 }'>300%</option>
										<option title="" value="4" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 400 }'>400%</option>
									</select>
								</span>

								<div class="verticalToolbarSeparator hiddenMediumView"></div>

								<div id="editorModeButtons" class="splitToolbarButton hiddenSmallView toggled" role="radiogroup">
									<button id="editorFreeText" class="toolbarButton" disabled="disabled" title="Text" role="radio" aria-checked="false" tabindex="34" data-l10n-id="editor_free_text2">
										<span data-l10n-id="editor_free_text2_label">Text</span>
									</button>
									<button id="editorInk" class="toolbarButton" disabled="disabled" title="Draw" role="radio" aria-checked="false" tabindex="35" data-l10n-id="editor_ink2">
										<span data-l10n-id="editor_ink2_label">Draw</span>
									</button>
								</div>

								<div id="editorModeSeparator" class="verticalToolbarSeparator"></div>

								<button id="secondaryToolbarToggle" class="toolbarButton" title="Tools" tabindex="48" data-l10n-id="tools" aria-expanded="false" aria-controls="secondaryToolbar">
									<span data-l10n-id="tools_label">Tools</span>
								</button>
							</div>
							<div id="toolbarViewerMiddle">
								<button id="viewFind" class="toolbarButton" title="Find in Document" tabindex="12" data-l10n-id="findbar" aria-expanded="false" aria-controls="findbar">
									<span data-l10n-id="findbar_label">Find</span>
								</button>
								<div class="splitToolbarButton ">
									<button class="toolbarButton" title="Previous Page" id="previous" tabindex="13" data-l10n-id="previous">
										<span data-l10n-id="previous_label">Previous</span>
									</button>
									<div class="splitToolbarButtonSeparator"></div>
									<button class="toolbarButton" title="Next Page" id="next" tabindex="14" data-l10n-id="next">
										<span data-l10n-id="next_label">Next</span>
									</button>
								</div>
								<input type="number" id="pageNumber" class="toolbarField" title="Page" value="1" min="1" tabindex="15" data-l10n-id="page" autocomplete="off">
								<span id="numPages" class="toolbarLabel"></span>
							</div>
						</div>
						<div id="loadingBar">
							<div class="progress">
								<div class="glimmer">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div id="viewerContainer" tabindex="0">
					<div id="viewer" class="pdfViewer"></div>
				</div>
			</div> <!-- mainContainer -->

			<div id="dialogContainer">
				<dialog id="passwordDialog">
					<div class="row">
						<label for="password" id="passwordText" data-l10n-id="password_label">Enter the password to open this PDF file:</label>
					</div>
					<div class="row">
						<input type="password" id="password" class="toolbarField">
					</div>
					<div class="buttonRow">
						<button id="passwordCancel" class="dialogButton"><span data-l10n-id="password_cancel">Cancel</span></button>
						<button id="passwordSubmit" class="dialogButton"><span data-l10n-id="password_ok">OK</span></button>
					</div>
				</dialog>

				<dialog id="printServiceDialog" style="min-width: 200px;">
					<div class="row">
						<span data-l10n-id="print_progress_message">Preparing document for printing…</span>
					</div>
					<div class="row">
						<progress value="0" max="100"></progress>
						<span data-l10n-id="print_progress_percent" data-l10n-args='{ "progress": 0 }' class="relative-progress">0%</span>
					</div>
					<div class="buttonRow">
						<button id="printCancel" class="dialogButton"><span data-l10n-id="print_progress_close">Cancel</span></button>
					</div>
				</dialog>
			</div>  <!-- dialogContainer -->

		</div> <!-- outerContainer -->
		<div id="printContainer"></div>

		<input type="file" id="fileInput" class="hidden">
    
    	<footer class="footer text-center">
			<div>
				<span>&copy; <?php echo date('Y')?> Holduix v1.0.0. </span>
				<span>Created by <a href="//holduix.dev/" target="_blank">Helhost</a></span>
			</div>
		</footer>   
        <script src="<?= base_url(); ?>themes/js/jquery-3.6.1.min.js"></script><!-- JQUERY.MIN JS -->
        <script src="<?= base_url(); ?>themes/js/popper.min.js"></script><!-- POPPER.MIN JS -->
        <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/plugins-2.1.js"></script>
        <script src="<?= base_url(); ?>assets/js/script-2.1.min.js"></script>
        <script>
            
            const pageNum = document.querySelector("#page_num");
            const pageCount = document.querySelector("#page_count");
            const currentPage = document.querySelector("#current_page");
            const previousPage = document.querySelector("#prev_page");
            const nextPage = document.querySelector("#next_page");
            const zoomIn = document.querySelector("#zoom_in");
            const zoomOut = document.querySelector("#zoom_out");
            const printButton = document.querySelector(".print-button");

        </script>
	</body>
</html>
