<?php

/**
	ReduxFramework Sample Config File
	For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
**/

if ( !class_exists( "ReduxFramework" ) ) {
	return;
} 

if ( !class_exists( "Redux_Framework_sample_config" ) ) {
	class Redux_Framework_sample_config {

		public $args = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;

		public function __construct( ) {

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();
			
			// Set a few help tabs so you can see how it's done
			$this->setHelpTabs();

			// Create the sections and fields
			$this->setSections();
			
			if ( !isset( $this->args['opt_name'] ) ) { // No errors please
				return;
			}
			
			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
			

			// If Redux is running as a plugin, this will remove the demo notice and links
			//add_action( 'redux/plugin/hooks', array( $this, 'remove_demo' ) );
			
			// Function to test the compiler hook and demo CSS output.
			//add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2); 
			// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.

			// Change the arguments after they've been declared, but before the panel is created
			//add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
			
			// Change the default value of a field after it's been set, but before it's been used
			//add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

			// Dynamically add a section. Can be also used to modify sections/fields
			add_filter('redux/options/'.$this->args['opt_name'].'/sections', array( $this, 'dynamic_section' ) );

		}


		/**

			This is a test function that will let you see when the compiler hook occurs. 
			It only runs if a field	set with compiler=>true is changed.

		**/

		function compiler_action($options, $css) {
			echo "<h1>The compiler hook has run!";
			//print_r($options); //Option values
			
			// print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
			/*
			// Demo of how to use the dynamic CSS and write your own static CSS file
		    $filename = dirname(__FILE__) . '/style' . '.css';
		    global $wp_filesystem;
		    if( empty( $wp_filesystem ) ) {
		        require_once( ABSPATH .'/wp-admin/includes/file.php' );
		        WP_Filesystem();
		    }

		    if( $wp_filesystem ) {
		        $wp_filesystem->put_contents(
		            $filename,
		            $css,
		            FS_CHMOD_FILE // predefined mode settings for WP files
		        );
		    }
			*/
		}



		/**
		 
		 	Custom function for filtering the sections array. Good for child themes to override or add to the sections.
		 	Simply include this function in the child themes functions.php file.
		 
		 	NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
		 	so you must use get_template_directory_uri() if you want to use any of the built in icons
		 
		 **/

		function dynamic_section($sections){
		    //$sections = array();
		    $sections[] = array(
		        'title' => __('Section via hook', 'redux-framework-demo'),
		        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
				'icon' => 'el-icon-paper-clip',
				    // Leave this as a blank section, no options just some intro text set above.
		        'fields' => array()
		    );

		    return $sections;
		}
		
		
		/**

			Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

		**/
		
		function change_arguments($args){
		    //$args['dev_mode'] = true;
		    
		    return $args;
		}
			
		
		/**

			Filter hook for filtering the default value of any given field. Very useful in development mode.

		**/

		function change_defaults($defaults){
		    $defaults['str_replace'] = "Testing filter hook!";
		    
		    return $defaults;
		}


		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		function remove_demo() {
			
			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if ( class_exists('ReduxFrameworkPlugin') ) {
				remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2 );
			}

			// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
			remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );	

		}


		public function setSections() {

			/**
			 	Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
			 **/


			// Background Patterns Reader
			$sample_patterns_path = ReduxFramework::$_dir . '../curated/patterns/';
			$sample_patterns_url  = ReduxFramework::$_url . '../curated/patterns/';
			$sample_patterns      = array();

			if ( is_dir( $sample_patterns_path ) ) :
				
			  if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
			  	$sample_patterns = array();

			    while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

			      if( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
			      	$name = explode(".", $sample_patterns_file);
			      	$name = str_replace('.'.end($name), '', $sample_patterns_file);
			      	$sample_patterns[] = array( 'alt'=>$name,'img' => $sample_patterns_url . $sample_patterns_file );
			      }
			    }
			  endif;
			endif;

			ob_start();

			$ct = wp_get_theme();
			$this->theme = $ct;
			$item_name = $this->theme->get('Name'); 
			$tags = $this->theme->Tags;
			$screenshot = $this->theme->get_screenshot();
			$class = $screenshot ? 'has-screenshot' : '';

			$customize_title = sprintf( __( 'Customize &#8220;%s&#8221;','redux-framework-demo' ), $this->theme->display('Name') );

			?>
			<div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
				<?php if ( $screenshot ) : ?>
					<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
					<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr( $customize_title ); ?>">
						<img src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
					</a>
					<?php endif; ?>
					<img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
				<?php endif; ?>

				<h4>
					<?php echo $this->theme->display('Name'); ?>
				</h4>

				<div>
					<ul class="theme-info">
						<li><?php printf( __('By %s','redux-framework-demo'), $this->theme->display('Author') ); ?></li>
						<li><?php printf( __('Version %s','redux-framework-demo'), $this->theme->display('Version') ); ?></li>
						<li><?php echo '<strong>'.__('Tags', 'redux-framework-demo').':</strong> '; ?><?php printf( $this->theme->display('Tags') ); ?></li>
					</ul>
					<p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
					<?php if ( $this->theme->parent() ) {
						printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.' ) . '</p>',
							__( 'http://codex.wordpress.org/Child_Themes','redux-framework-demo' ),
							$this->theme->parent()->display( 'Name' ) );
					} ?>
					
				</div>

			</div>

			<?php
			$item_info = ob_get_contents();
			    
			ob_end_clean();

			$sampleHTML = '';
			if( file_exists( dirname(__FILE__).'/info-html.html' )) {
				/** @global WP_Filesystem_Direct $wp_filesystem  */
				global $wp_filesystem;
				if (empty($wp_filesystem)) {
					require_once(ABSPATH .'/wp-admin/includes/file.php');
					WP_Filesystem();
				}  		
				$sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__).'/info-html.html');
			}




			// ACTUAL DECLARATION OF SECTIONS

			/**
			
			General Settings ++++++++++++++++++++++++++++++++

			**/

			$maha_options = get_option('curated');
			if($maha_options['google_fonts_on']==1) {
				$opt_fonts=true;
			}else{
				$opt_fonts=false;
			}
			$this->sections[] = array(
				'icon' => 'el-icon-cog',
				'title' => __('General Settings', 'redux-framework-demo'),
				'fields' => array(
					array(
						'id'=>'thefavicon',
						'type' => 'media', 
						'url'=> true,
						'title' => __('Favicon', 'redux-framework-demo'),
						'subtitle' => __('Please upload your favicon here.', 'redux-framework-demo'),
						'desc'=> __('Recommended size is (16px -Width) and (16px -Height).', 'redux-framework-demo'),
						'default'=>array('url'=>get_template_directory_uri().'/images/tm-icon.ico'),
					),
					array(
						'id'=>'thefavicon_ios_76',
						'type' => 'media', 
						'url'=> true,
						'title' => __('IOS Bookmarklet 76x76', 'redux-framework-demo'),
						'subtitle' => __('Please upload your favicon here.', 'redux-framework-demo'),
						'desc'=> __('Recommended size is (76px -Width) and (76px -Height).', 'redux-framework-demo'),
						'default'=>array('url'=>get_template_directory_uri().'/images/tm-icon-76.png'),
					),
					array(
						'id'=>'thefavicon_ios_114',
						'type' => 'media', 
						'url'=> true,
						'title' => __('IOS Bookmarklet 114x114', 'redux-framework-demo'),
						'subtitle' => __('Please upload your favicon here.', 'redux-framework-demo'),
						'desc'=> __('Recommended size is (114px -Width) and (114px -Height).', 'redux-framework-demo'),
						'default'=>array('url'=>get_template_directory_uri().'/images/tm-icon-114.png'),
					),
					array(
						'id'=>'thefavicon_ios_144',
						'type' => 'media', 
						'url'=> true,
						'title' => __('IOS Bookmarklet 144x144', 'redux-framework-demo'),
						'subtitle' => __('Please upload your favicon here.', 'redux-framework-demo'),
						'desc'=> __('Recommended size is (144px -Width) and (144px -Height).', 'redux-framework-demo'),
						'default'=>array('url'=>get_template_directory_uri().'/images/tm-icon-144.png'),
					),
					array(
						'id'=>'font_1',
						'type' => 'typography',
						'title' => __('Heading Font', 'redux-framework-demo'),
						'subtitle' => __('Select the Heading font type.', 'redux-framework-demo'),
						'google'=>$opt_fonts,
						'color'=>false,
						'custom_fonts' => true,
						'font-backup' => false,
						'font-size'=>false,
						'line-height' => false,
						'text-align' => false,
						'default' => array(
							'color'=>'#333333',
							'font-size'=>'32px',
							'font-family'=>'Oswald',
							'line-height' => '1.2em',
							'font-weight' => 400,
							'subsets' => 'latin',
							'font-options' => '{"variants":[{"id":"300","name":"Book+300"},{"id":"400","name":"Normal+400"},{"id":"700","name":"Bold+700"}],"subsets":[{"id":"latin-ext","name":"Latin+Extended"},{"id":"latin","name":"Latin"}]}'
							),
						),
					array(
						'id'=>'font_2',
						'type' => 'typography',
						'title' => __('Content Font', 'redux-framework-demo'),
						'subtitle' => __('Select the Content font type.', 'redux-framework-demo'),
						'google'=>$opt_fonts,
						'custom_fonts' => true,
						'color'=>false,
						'font-backup' => false,
						'font-size'=>true,
						'line-height' => false,
						'text-align' => false,
						'default' => array(
							'color'=>'#595858',
							'font-size'=>'15px',
							'line-height' => '1.4em',
							'font-family'=>'Lato',
							'font-weight' => 400,
							'subsets' => 'latin',
							'font-options' => '{"variants":[{"id":"100","name":"Ultra-Light+100"},{"id":"300","name":"Book+300"},{"id":"400","name":"Normal+400"},{"id":"700","name":"Bold+700"},{"id":"900","name":"Ultra-Bold+900"},{"id":"100italic","name":"Ultra-Light+100+Italic"},{"id":"300italic","name":"Book+300+Italic"},{"id":"400italic","name":"Normal+400+Italic"},{"id":"700italic","name":"Bold+700+Italic"},{"id":"900italic","name":"Ultra-Bold+900+Italic"}],"subsets":[{"id":"latin","name":"Latin"}]}'
							),
						),
					array(
						'id'=>'accent_1',
						'type' => 'color',
						'title' => __('Primary Color', 'redux-framework-demo'), 
						'subtitle' => __('Pick a Global primary color, it\'s for: text #hover, url, button.', 'redux-framework-demo'),
						'default' => '#db2e1c',
						'transparent' => false,
						'validate' => 'color',
						),
					array(
						'id'=>'accent_2',
						'type' => 'color',
						'title' => __('Secondary Color', 'redux-framework-demo'), 
						'subtitle' => __('Pick a Global secondary color, it\'s for: text #hover, url, button.', 'redux-framework-demo'),
						'default' => '#4dace6',
						'transparent' => false,
						'validate' => 'color',
						),
					array(
						'id'=>'animati_on',
						'type' => 'switch', 
						'title' => __('Enable/Disable Animation', 'redux-framework-demo'),
						'subtitle'=> __('Enable/Disable some elements transition when it\'s appear', 'redux-framework-demo'),
						"default" => 1,
						),
					array(
						'id'=>'responsive_on',
						'type' => 'switch', 
						'title' => __('Enable/Disable Responsive', 'redux-framework-demo'),
						'subtitle'=> __('Enable/Disable Responsive layout on small devices', 'redux-framework-demo'),
						"default" => 1,
						),
					array(
						'id'=>'top_bar_on',
						'type' => 'switch', 
						'title' => __('Enable/Disable Top Bar', 'redux-framework-demo'),
						'subtitle'=> __('Enable/Disable Top Bar on dekstop', 'redux-framework-demo'),
						"default" => 1,
						),
					array(
						'id'=> 'boxed_on',
						'type' => 'switch',
						'title' => __('Enable/Disable Boxed Layout', 'redux-framework-demo'), 
						'subtitle' => __('When it enabled, layout will show in boxed style.', 'redux-framework-demo'),
						'default' => 0 // 1 = on | 0 = off
						),
					array(
						'id'       => 'body_background',
					    'type'     => 'background',
					    'title'    => __('Body Background', 'redux-framework-demo'),
					    'subtitle' => __('Body background with image, color, etc.', 'redux-framework-demo'),
					    'preview' => true,
					    // 'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
					    'default'  => array(
					        'background-color' => '#fff',
					    )
					),					
					array(
						'id'=>'google_fonts_on',
						'type' => 'switch', 
						'title' => __('Enable/Disable Google Fonts', 'redux-framework-demo'),
						'subtitle'=> __('Enable/Disable Google Fonts', 'redux-framework-demo'),
						"default" => 1,
						),
					)
				);

			
			/**
			
			Header Options ++++++++++++++++++++++++++++++++

			**/
			$this->sections[] = array(
				'icon' => 'el-icon-asterisk',
				'title' => __('Header Options', 'redux-framework-demo'),
				'desc' => __('All Header related options are listed here.', 'redux-framework-demo'),
				'fields' => array(
					//Search Section
					array(
						'id'=>'section-media-start',
						'type' => 'section', 
						'title' => __('Search Options', 'redux-framework-demo'),
						'indent' => true
						),
						array(
							'id'=>'search_on',
							'type' => 'switch', 
							'title' => __('Enable/Disable Search', 'redux-framework-demo'),
							'subtitle'=> __('When in disabled search will not show', 'redux-framework-demo'),
							"default" => 1,
							),						
						array(
							'id'       => 'search_option',
							'type'     => 'select',
							'title'    => __('Search Result Option', 'redux-framework-demo'), 
							'subtitle' => __('Please check option for search result.', 'redux-framework-demo'),
							'options' => array(
								'post' => 'Post',
								'page' => 'Page',
								'all' => 'Post & Page'
								),
							'default' => 'post'
							),
						array(
							'id'=>'ajax_search_on',
							'type' => 'switch', 
							'title' => __('Enable/Disable Ajax Search', 'redux-framework-demo'),
							'subtitle'=> __('When in disabled ajax search will not show', 'redux-framework-demo'),
							"default" => 1,
							),
						array(
							'id'=>'ajax_search_number_post',
							'type' => 'text', 
							'title' => __('Ajax Search Number of Post', 'redux-framework-demo'),
							'subtitle'=> __('Please select number of ajax search post.', 'redux-framework-demo'),
							"default" => 4,
							"validate" => 'numeric',
							),
					array(
						'id'=>'section-media-end',
						'type' => 'section', 
						'indent' => false
						),
					// Neeeew Setion 
					array(
						'id'=>'section-media-start',
						'type' => 'section', 
						'title' => __('Top Navigation - Header', 'redux-framework-demo'),
						'indent' => true
						),                                    
						array(
							'id'=>'th_bg_color',
							'type' => 'color',
							'title' => __('Background color', 'redux-framework-demo'), 
							'subtitle' => __('Pick Top navigation background color.', 'redux-framework-demo'),
							'default' => '#212121',
							'transparent' => false,
							'validate' => 'color',
							),
						array(
							'id'=>'th_bg_mob_color',
							'type' => 'color',
							'title' => __('Mobile Background #active color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a background color for Mobile active menu.', 'redux-framework-demo'),
							'default' => '#181818',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'th_txt_color',
							'type' => 'color',
							'title' => __('Text Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a color for Top navigation text.', 'redux-framework-demo'),
							'default' => '#EAEAEA',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'th_divider_alt_1',
							'type' => 'color',
							'title' => __('Menu Divider Alt 1 Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a color for Top menu divider left (Alt 1).', 'redux-framework-demo'),
							'default' => '#111111',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'th_divider_alt_2',
							'type' => 'color',
							'title' => __('menu Divider Alt 2 Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a color for Top menu divider Right (Alt 2).', 'redux-framework-demo'),
							'default' => '#323232',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'th_social_network',
							'type' => 'text',
							'title' => __('Social Network', 'redux-framework-demo'),
							'subtitle' => __('Enter your Social Netowork URL. Leave blank if you don\'t wanna show', 'redux-framework-demo'),
							'options' => array(
								'facebook_f'=>'<i class="icon-facebook"></i> Facebook ',
								'facebook_sign'=>'<i class="icon-facebook-squared"></i> Fb Square',
								'twitter'=>'<i class="icon-twitter"></i> Twitter',
								'instagram'=>'<i class="icon-instagrem"></i> Instagram',
								'pinterest'=>'<i class="icon-pinterest"></i> Pinterest',
								'youtube'=>'<i class="icon-play"></i> Youtube',
								'gplus'=>'<i class="icon-gplus"></i> Google+',
								'linkedin'=>'<i class="icon-linkedin"></i> LinkedIn',
								'flickr'=>'<i class="icon-flickr"></i> Flickr',
								'tumblr'=>'<i class="icon-tumblr"></i> Tumblr',
								'vimeo'=>'<i class="icon-vimeo"></i> Vimeo',
								'behance'=>'<i class="icon-behance"></i> Behance',
								'dribbble'=>'<i class="icon-dribbble"></i> Dribbble',
								'github'=>'<i class="icon-github"></i> Github',
								'stumble'=>'<i class="icon-stumbleupon"></i> StumbleUpon',
								'vkontakte'=>'<i class="icon-vkontakte"></i> Vkonkakte',
								'scloud'=>'<i class="icon-soundcloud"></i> Soundcloud',
								'skype'=>'<i class="icon-skype"></i> Skype',
								'spotify'=>'<i class="icon-spotify"></i> Spotify',
								'lastfm'=>'<i class="icon-lastfm"></i> Lastfm',
								),
							'default' => array(
								'facebook_f'=>'#',
								'facebook_sign'=>'',
								'twitter'=>'#',
								'instagram'=>'#',
								'pinterest'=>'',
								'youtube'=>'',
								'gplus'=>'',
								'linkedin'=>'',
								'flickr'=>'',
								'tumblr'=>'',
								'vimeo'=>'',
								'behance'=>'',
								'dribbble'=>'',
								'github'=>'',
								'stumble'=>'',
								'vkontakte'=>'',
								'scloud'=>'',
								'skype'=>'',
								'spotify'=>'',
								'lastfm'=>''
								),
							),
					array(
						'id'=>'section-media-end',
						'type' => 'section', 
						'indent' => false
						),

					// Neeeew Setion 
					array(
						'id'=>'section-media-start',
						'type' => 'section', 
						'title' => __('Main Menu - Header', 'redux-framework-demo'),
						'indent' => true
						),
                                    array(
						    'id'       => 'header_alignment',
						    'type'     => 'select',
						    'title'    => __('Header Alignment', 'redux-framework-demo'), 
						    'subtitle' => __('Please select header alignment', 'redux-framework-demo'),
						    'options' => array(
						    	'normal' => 'Normal',
						    	'center' => 'Center'						    	
						    ),
						    'default' => 'normal'
                                        ),
						array(
							'id'=>'thelogo',
							'type' => 'media', 
							'url'=> true,
							'title' => __('Logo', 'redux-framework-demo'),
							'subtitle' => __('Please upload your logo here.', 'redux-framework-demo'),
							'desc'=> __('Recommended size is less than (270px Width) and (90px Height).', 'redux-framework-demo'),
							'default'=>array('url'=>get_template_directory_uri().'/images/logo.png'),
						),
						array(
							'id'=>'thelogoretina',
							'type' => 'media', 
							'url'=> true,
							'title' => __('Logo Retina', 'redux-framework-demo'),
							'subtitle' => __('Please upload your logo (retina) here.', 'redux-framework-demo'),
							'desc'=> __('Recommended size is less than (540px Width) and (180px Height).', 'redux-framework-demo'),
							'default'=>array('url'=>get_template_directory_uri().'/images/logo-retina.png'),
						),
						array(
							'id'=>'logomainnav',
							'type' => 'media', 
							'url'=> true,
							'title' => __('Small Logo', 'redux-framework-demo'),
							'subtitle' => __('Please upload your logo for small navigation here.', 'redux-framework-demo'),
							'desc'=> __('Recommended size is less than (50px Height).', 'redux-framework-demo'),
							'default'=>array('url'=>get_template_directory_uri().'/images/small-logo.png'),
						),
						array(
							'id'=>'logomainnavretina',
							'type' => 'media', 
							'url'=> true,
							'title' => __('Small Logo Retina', 'redux-framework-demo'),
							'subtitle' => __('Please upload your logo (retina) for small navigation here.', 'redux-framework-demo'),
							'desc'=> __('Recommended size is less than (100px Height).', 'redux-framework-demo'),
							'default'=>array('url'=>get_template_directory_uri().'/images/logo-retina-small.png'),
						),
						array(
						'id'=>'font_3',
						'type' => 'typography',
						'title' => __('Navigation Typography', 'redux-framework-demo'),
						'subtitle' => __('Select the Navigation Typography.', 'redux-framework-demo'),
						'google'=>$opt_fonts,
						'color'=>false,
						'custom_fonts' => true,
						'font-backup' => false,
						'font-size'=>false,
						'line-height' => false,
						'text-align' => false,
						'default' => array(
							'color'=>'#333333',
							'font-size'=>'32px',
							'font-family'=>'Oswald',
							'line-height' => '1.2em',
							'font-weight' => 400,
							'subsets' => 'latin',
							'font-options' => '{"variants":[{"id":"300","name":"Book+300"},{"id":"400","name":"Normal+400"},{"id":"700","name":"Bold+700"}],"subsets":[{"id":"latin-ext","name":"Latin+Extended"},{"id":"latin","name":"Latin"}]}'
							),
						),
						array(
						'id'=>'accent_3',
						'type' => 'color',
						'title' => __('Main Menu Background Color', 'redux-framework-demo'), 
						'subtitle' => __('Pick a main menu background color.', 'redux-framework-demo'),
						'default' => '#ffffff',
						'transparent' => false,
						'validate' => 'color',
						),
						array(
							'id'=>'mh_home_color',
							'type' => 'color',
							'title' => __('Home Indicator Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a color for Home Indicaator Menu color, when not in hompage the menu will show different color as defined.', 'redux-framework-demo'),
							'default' => '#DADADA',
							'transparent' => false,
							'validate' => 'color',
							),
						array(
							'id'=>'mh_txt_color',
							'type' => 'color',
							'title' => __('Primary Menu Text color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a color for Primary Menu text color.', 'redux-framework-demo'),
							'default' => '#333333',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'mh_sub_bg_color',
							'type' => 'color',
							'title' => __('Sub Menu Background Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a background color for Sub menus.', 'redux-framework-demo'),
							'default' => '#ffffff',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'mh_sub_txt_color',
							'type' => 'color',
							'title' => __('Sub Menu Text Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a color for Sub menus text color.', 'redux-framework-demo'),
							'default' => '#333333',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'mh_sub_txt_color_vague',
							'type' => 'color',
							'title' => __('Sub Menu Content Text Vague Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a Vague color for Sub menus content text color.', 'redux-framework-demo'),
							'default' => '#333333',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'mh_sub_txt_hover_color',
							'type' => 'color',
							'title' => __('Sub Menu Hover Text Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a color for Sub menus #hover text color.', 'redux-framework-demo'),
							'default' => '#333333',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'mh_sub_bg_hover_color',
							'type' => 'color',
							'title' => __('Sub Menu Background Hover Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a color for Sub menus background #hover color.', 'redux-framework-demo'),
							'default' => '#ebebeb',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'mh_sub_divider_color',
							'type' => 'color',
							'title' => __('Sub Menu Divider Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a color for Sub menus Divider color.', 'redux-framework-demo'),
							'default' => '#DADADA',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'mh_search_background_color',
							'type' => 'color',
							'title' => __('Search Background Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a color for Search background color.', 'redux-framework-demo'),
							'default' => '#ffffff',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'mh_search_text_color',
							'type' => 'color',
							'title' => __('Search Text Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a color for Search text color.', 'redux-framework-demo'),
							'default' => '#DADADA',
							'validate' => 'color',
							'transparent' => false,
							),
					array(
						'id'=>'section-media-end',
						'type' => 'section', 
						'indent' => false
						),

					// Neeeew Setion 
					array(
						'id'=>'section-media-start',
						'type' => 'section', 
						'title' => __('Ads - Header', 'redux-framework-demo'),
						'indent' => true
						),
						array(
							'id'=>'ah_ads_768',
							'type' => 'ace_editor',
							'title' => __('Ads Code for 768x90', 'redux-framework-demo'), 
							'subtitle' => __('Paste your Ads 768x90 pixel code here.', 'redux-framework-demo'),
							'mode' => 'html',
				            'theme' => 'chrome',
							'desc' => __('Possible use < html >, < img >, < script > here.', 'redux-framework-demo'),
				            'default' => ""
						),
						array(
							'id'=>'ah_ads_468',
							'type' => 'ace_editor',
							'title' => __('Ads Code for 468x60', 'redux-framework-demo'), 
							'subtitle' => __('Paste your Ads 468x60 pixel code here.', 'redux-framework-demo'),
							'mode' => 'html',
				            'theme' => 'chrome',
							'desc' => __('Plase Use < script > tag to add Javascript code, and it\'s possible to use < html >, < img >, < style > here.', 'redux-framework-demo'),
				            'default' => ""
						),
						array(
							'id'=>'ah_ads_320',
							'type' => 'ace_editor',
							'title' => __('Ads Code for 320x50', 'redux-framework-demo'), 
							'subtitle' => __('Paste your Ads 320x50 pixel code here.', 'redux-framework-demo'),
							'mode' => 'html',
				            'theme' => 'chrome',
							'desc' => __('Plase Use < script > tag to add Javascript code, and it\'s possible to use < html >, < img >, < style > here.', 'redux-framework-demo'),
				            'default' => ""
						),
					array(
						'id'=>'section-media-end',
						'type' => 'section', 
						'indent' => false
						),
					)
				);


			/**
			
			----------------------------------------------

			**/
			$this->sections[] = array(
				'type' => 'divide',
			);

			$tags = get_tags();
			$tag = array();
			foreach ($tags as $key => $value) {
				$tag[$value->term_id] = $value->name;
			}

			$categories = get_categories();
			$cat = array();
			foreach ($categories as $key => $value) {
				$cat[$value->term_id] = $value->name;
			}
			/**
			
			Content Options ++++++++++++++++++++++++++++++++

			**/
			$this->sections[] = array(
				'icon' => 'el-icon-file',
				'title' => __('Content Options', 'redux-framework-demo'),
				'desc' => __('All Content related options are listed here.', 'redux-framework-demo'),
				'fields' => array(
					//	Neeeew Setion 
					array(
						'id'=>'section-media-start',
						'type' => 'section', 
						'title' => __('Modules and Blocked layout options', 'redux-framework-demo'),
						'indent' => true
						),
						array(
							'id'=>'module_3_on',
							'type' => 'switch', 
							'title' => __('Enable/Disable \'Read more\' on Module 3 / Blocked 3', 'redux-framework-demo'),
							'subtitle'=> __('When in disabled read more will now show', 'redux-framework-demo'),
							"default" => 0,
							),
					array(
						'id'=>'section-media-end',
						'type' => 'section', 
						'indent' => false
						),
				//	Neeeew Setion 
                                   array(
						'id'=>'section-media-start',
						'type' => 'section', 
						'title' => __('Running Text options', 'redux-framework-demo'),
						'indent' => true
						),
                                       array(
						'id'=>'running_text_on',
						'type' => 'switch', 
						'title' => __('Enable/Disable Running Text', 'redux-framework-demo'),
						'subtitle'=> __('When in disabled running text will not show', 'redux-framework-demo'),
						"default" => 0,
						),
                                       array(
							'id'	=> 'running_text_number_post',
							'type'	=> 'slider',
							'title'	=> __('Running Text Number of Post', 'redux-framework-demo'),
							'subtitle' => __('Please select number of running text post.', 'redux-framework-demo'),
							'default'   => 6,
						    'min'       => 5,
						    'step'      => 1,
						    'max'       => 20,
						),
						array(
						    'id'       => 'running_text_tag_filter',
						    'type'     => 'select',
						    'multi'		=> true,
						    'title'    => __('Running Text Tag Filter', 'redux-framework-demo'), 
						    'subtitle' => __('Please check tag for running text filter.', 'redux-framework-demo'),
						    'options' => $tag,
						    'default' => array( 'alltags' => 'alltags' )
						),
						array(
						    'id'       => 'running_text_cat_filter',
						    'type'     => 'checkbox',
						    'title'    => __('Running Text Category Filter', 'redux-framework-demo'), 
						    'subtitle' => __('Please check category for running text filter.', 'redux-framework-demo'),
						    'options' => $cat,
						    'default' => array( 'allcats' => '1' )
						),
						array(
						    'id'       => 'running_text_filter',
						    'type'     => 'select',
						    'title'    => __('Running Text Filter', 'redux-framework-demo'), 
						    'subtitle' => __('Please select the running text filter.', 'redux-framework-demo'),
						    'options' => array(
						    	'latest' => 'Latest',
						    	'featured' => 'Featured',
						    	'random' => 'Random',
						    	'popular_all' => 'Popular All-time',
						    	'popular_month' => 'Popular This Month',
						    	'popular_week' => 'Popular This Week',
						    	'top_all' => 'Top All-time',
						    	'top_month' => 'Top This Month',
						    	'top_week' => 'Top This Week'
						    ),
						    'default' => 'latest'
						),
                                   array(
						'id'=>'section-media-end',
						'type' => 'section', 
						'indent' => false
						),

					// Neeeew Setion 
					array(
						'id'=>'section-media-start',
						'type' => 'section', 
						'title' => __('Breadcrumb options', 'redux-framework-demo'),
						'indent' => true
						),
						array(
							'id'=>'breadcrumb',
							'type' => 'checkbox',
							'title' => __('Enable Breadcrumb', 'redux-framework-demo'), 
							'subtitle' => __('When it disabled, breadcrumb will not show.', 'redux-framework-demo'),
							'default' => '1'// 1 = on | 0 = off
							),
					array(
						'id'=>'section-media-end',
						'type' => 'section', 
						'indent' => false
						),

					// Neeeew Setion 
					array(
						'id'=>'section-media-start',
						'type' => 'section', 
						'title' => __('User Photo Style (Author and comment)', 'redux-framework-demo'),
						'indent' => true
						),
						array(
							'id'=>'photo_style',
							'type' => 'select',
							'title' => __('Photo Style', 'redux-framework-demo'), 
							'subtitle' => __('Please select the Author and Comment avatar photo style', 'redux-framework-demo'),
							'options' => array(
								'square' => 'Square',
								'circle' => 'Circle',
								),
							'default' => 'square'
							),
						array(
							'id'=>'profile_style',
							'type' => 'select',
							'title' => __('Author Profile style', 'redux-framework-demo'), 
							'subtitle' => __('Please select the Author and Comment avatar photo style', 'redux-framework-demo'),
							'options' => array(
								'left' => 'Left',
								'center' => 'Center',
								),
							'default' => 'left'
							),
					array(
						'id'=>'section-media-end',
						'type' => 'section', 
						'indent' => false
						),

					// Neeeew Setion 
					array(
						'id'=>'section-media-start',
						'type' => 'section', 
						'title' => __('Single Options', 'redux-framework-demo'),
						'indent' => true
						),
						array(
							'id'=>'single_viewer',
							'type' => 'checkbox',
							'title' => __('Enable Viewer on Single Post', 'redux-framework-demo'), 
							'subtitle' => __('When it disabled, viewer counter still work, but will not show on the single post.', 'redux-framework-demo'),
							'default' => '1'// 1 = on | 0 = off
							),
						array(
							'id'=>'single_commentr',
							'type' => 'checkbox',
							'title' => __('Enable Comment count on Single Post', 'redux-framework-demo'), 
							'subtitle' => __('When it disabled, comment counter still work, but will not show on the single post.', 'redux-framework-demo'),
							'default' => '1'// 1 = on | 0 = off
							),
						array(
							'id'=>'single_playr',
							'type' => 'checkbox',
							'title' => __('Enable Play button text on Single Post', 'redux-framework-demo'), 
							'subtitle' => __('When it disabled, Text on the bottom button will not show', 'redux-framework-demo'),
							'default' => '0'// 1 = on | 0 = off
							),
						array(
							'id'=>'play_button_text',
							'type' => 'text',
							'title' => __('Play Button Text', 'redux-framework-demo'), 
							'subtitle' => __('Please enter the play button text.', 'redux-framework-demo'),
							'desc' => __(' ', 'redux-framework-demo'),
							'validate' => 'no_html',
							'default' => 'Play'
						),
						array(
							'id'=>'single_regular_feat_image',
							'type' => 'select',
							'title' => __('Global - Featured image on Regular Cover style', 'redux-framework-demo'), 
							'subtitle' => __('When it disabled, featured image on Regular Cover will disappear even the single post setting is enable ', 'redux-framework-demo'),
							'options' => array(
								'enable' => 'Enable',
								'disable' => 'Disable',
								'custom' => 'Custom',
								),
							'default' => 'custom'
							),
						array(
							'id'=>'related_place',
							'type' => 'select',
							'title' => __('Related Posts Position', 'redux-framework-demo'), 
							'subtitle' => __('Please select the Related Posts position', 'redux-framework-demo'),
							'options' => array(
								'tags' => 'Below Post Tags',
								'author' => 'Below Post Author',
								),
							'default' => 'author'
							),
						array(
							'id'	=> 'top_sticky_number_post',
							'type'	=> 'slider',
							'title'	=> __('Top Sticky Number of Post', 'redux-framework-demo'),
							'subtitle' => __('Please select number of top sticky post.', 'redux-framework-demo'),
							'default'   => 6,
						    'min'       => 4,
						    'step'      => 1,
						    'max'       => 10,
						),
						array(
						    'id'       => 'top_sticky_tag_filter',
						    'type'     => 'select',
						    'multi'		=> true,
						    'title'    => __('Top Sticky Tag Filter', 'redux-framework-demo'), 
						    'subtitle' => __('Please check tag for top sticky filter.', 'redux-framework-demo'),
						    'options' => $tag,
						    'default' => array( 'alltags' => 'alltags' )
						),
						array(
						    'id'       => 'top_sticky_cat_filter',
						    'type'     => 'checkbox',
						    'title'    => __('Top Sticky Category Filter', 'redux-framework-demo'), 
						    'subtitle' => __('Please check category for top sticky filter.', 'redux-framework-demo'),
						    'options' => $cat,
						    'default' => array( 'allcats' => '1' )
						),
						array(
						    'id'       => 'top_sticky_filter',
						    'type'     => 'select',
						    'title'    => __('Top Sticky Filter', 'redux-framework-demo'), 
						    'subtitle' => __('Please select the top sticky filter.', 'redux-framework-demo'),
						    'options' => array(
						    	'latest' => 'Latest',
						    	'featured' => 'Featured',
						    	'random' => 'Random',
						    	'popular_all' => 'Popular All-time',
						    	'popular_month' => 'Popular This Month',
						    	'popular_week' => 'Popular This Week',
						    	'top_all' => 'Top All-time',
						    	'top_month' => 'Top This Month',
						    	'top_week' => 'Top This Week'
						    ),
						    'default' => 'latest'
						),
					array(
						'id'=>'section-media-end',
						'type' => 'section', 
						'indent' => false
						),

					// Neeeew Setion 
					array(
						'id'=>'section-media-start',
						'type' => 'section', 
						'title' => __('Content Primary Color', 'redux-framework-demo'),
						'indent' => true
						),
						array(
							'id'=>'co_txt_color_1',
							'type' => 'color',
							'title' => __('Content Heading Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a Heading color, it\'s for: Title, Metas, Name.', 'redux-framework-demo'),
							'default' => '#333333',
							'transparent' => false,
							'validate' => 'color',
							),
						array(
							'id'=>'co_txt_color_2',
							'type' => 'color',
							'title' => __('Content Text Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a Content text color, it\'s for: text content.', 'redux-framework-demo'),
							'default' => '#595858',
							'transparent' => false,
							'validate' => 'color',
							),
						array(
							'id'=>'co_txt_color_vague',
							'type' => 'color',
							'title' => __('Content Vague Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a vague color, it\'s for: Additional information post that not very important.', 'redux-framework-demo'),
							'default' => '#9a9a9a',
							'transparent' => false,
							'validate' => 'color',
							),
					array(
						'id'=>'section-media-end',
						'type' => 'section', 
						'indent' => false
						),

					// Neeeew Setion 
					array(
						'id'=>'section-media-start',
						'type' => 'section', 
						'title' => __('Content Alt/Reverse Color', 'redux-framework-demo'),
						'subtitle' => __('Alt/Reverse, it\'s mean elements that using the dark background like on Moz-Slider or Regular-Slider that needs to be brighter color.', 'redux-framework-demo'),
						'indent' => true
						),
						array(
							'id'=>'coa_txt_color_1',
							'type' => 'color',
							'title' => __('Content Heading Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a Heading color for: Title, Metas, Name.', 'redux-framework-demo'),
							'desc' => __('Recommended using brighter color.', 'redux-framework-demo'),
							'default' => '#ffffff',
							'transparent' => false,
							'validate' => 'color',
							),
						array(
							'id'=>'coa_txt_color_2',
							'type' => 'color',
							'title' => __('Content Text Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a Content text color, it\'s for: text content.', 'redux-framework-demo'),
							'desc' => __('Recommended using brighter color.', 'redux-framework-demo'),
							'default' => '#eeeeee',
							'transparent' => false,
							'validate' => 'color',
							),
						// array(
						// 	'id'=>'coa_txt_color_vague',
						// 	'type' => 'color',
						// 	'title' => __('Content Vague Color', 'redux-framework-demo'), 
						// 	'subtitle' => __('Pick a vague color, it\'s for: Additional information post that not very important.', 'redux-framework-demo'),
						// 	'desc' => __('Recommended using brighter color.', 'redux-framework-demo'),
						// 	'default' => '#595858',
						// 	'transparent' => false,
						// 	'validate' => 'color',
						// 	),
					array(
						'id'=>'section-media-end',
						'type' => 'section', 
						'indent' => false
						),

					// Neeeew Setion 
					array(
						'id'=>'section-media-start',
						'type' => 'section', 
						'title' => __('Elements Color', 'redux-framework-demo'),
						'indent' => true
						),
						array(
							'id'=>'coe_button_bg_color',
							'type' => 'color',
							'title' => __('Button Background Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a button background color.', 'redux-framework-demo'),
							'default' => '#333333',
							'transparent' => false,
							'validate' => 'color',
							),
						array(
							'id'=>'coe_button_text_color',
							'type' => 'color',
							'title' => __('Button Text Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a button text color.', 'redux-framework-demo'),
							'default' => '#ffffff',
							'transparent' => false,
							'validate' => 'color',
							),
						array(
							'id'=>'coe_bold_divider_color',
							'type' => 'color',
							'title' => __('Bold Divider Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a Divider color.', 'redux-framework-demo'),
							'default' => '#333333',
							'transparent' => false,
							'validate' => 'color',
							),
						array(
							'id'=>'coe_one_divider_color',
							'type' => 'color',
							'title' => __('Thin Divider Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a Divider color.', 'redux-framework-demo'),
							'default' => '#cacaca',
							'transparent' => false,
							'validate' => 'color',
							),
						array(
							'id'=>'coe_input_border_color',
							'type' => 'color',
							'title' => __('Input Border Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a Input border color.', 'redux-framework-demo'),
							'default' => '#dadada',
							'transparent' => false,
							'validate' => 'color',
							),
						array(
							'id'=>'coe_link_color',
							'type' => 'select',
							'title' => __('Widget Content Link Color', 'redux-framework-demo'), 
							'subtitle' => __('Please select an options for Content link #hover', 'redux-framework-demo'),
							'desc' => __('It\'s mean when the mouse #hover a link, the color will change as defined this option.', 'redux-framework-demo'),
							'options' => array(
								'accent-1' => 'Primary Accent Color',
								'accent-2' => 'Secondary Accent Color',
								'default' => 'Default - Content Text Color',
								),
							'default' => 'default'
							),
						array(
							'id'=>'coe_bg_color_vague',
							'type' => 'color',
							'title' => __('Content Background Vague Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a footer background vague color, it\'s for Calendar widget.', 'redux-framework-demo'),
							'default' => '#F5F5F5',
							'transparent' => false,
							'validate' => 'color',
							),
					array(
						'id'=>'section-media-end',
						'type' => 'section', 
						'indent' => false
						),
					),
				);



			/**
			
			Homepage Setting ++++++++++++++++++++++++++++++++

			**/
			$this->sections[] = array(
				'icon' => ' el-icon-home',
				'title' => __('Homepage Options', 'redux-framework-demo'),
				'desc' => __('<p class="description"> All Homepage related options are listed here.</p>', 'redux-framework-demo'),
				'fields' => array(
					array(
						'id'=>'homepage_module',
						'type' => 'image_select',
						'title' => __('Latest Post Layout', 'redux-framework-demo'), 
						'subtitle' => __('Please select the Latest Post layout when open the posts by Tag & Date', 'redux-framework-demo'),
						'desc' => __('', 'redux-framework-demo'),
						'options' => array(
									'module-1' => array('alt' => 'Module 1', 'img' => get_template_directory_uri().'/images/partial/module-1.png'),
									'module-2' => array('alt' => 'Module 2', 'img' => get_template_directory_uri().'/images/partial/module-2.png'),
									'module-3' => array('alt' => 'Module 3', 'img' => get_template_directory_uri().'/images/partial/module-3.png'),
									'module-4' => array('alt' => 'Module 4', 'img' => get_template_directory_uri().'/images/partial/module-4.png')
								),
						'default' => 'module-3'
						)					
					)
				);


			/**
			
			Author Setting ++++++++++++++++++++++++++++++++

			**/
			$this->sections[] = array(
				'icon' => 'el-icon-user',
				'title' => __('Author Options', 'redux-framework-demo'),
				'desc' => __('<p class="description"> All Author related options are listed here.</p>', 'redux-framework-demo'),
				'fields' => array(
					array(
						'id'=>'author_module',
						'type' => 'image_select',
						'title' => __('Posts by Author Layout', 'redux-framework-demo'), 
						'subtitle' => __('Please select the Module layout when open the posts by an Author', 'redux-framework-demo'),
						'desc' => __('', 'redux-framework-demo'),
						'options' => array(
									'module-1' => array('alt' => 'Module 1', 'img' => get_template_directory_uri().'/images/partial/module-1.png'),
									'module-2' => array('alt' => 'Module 2', 'img' => get_template_directory_uri().'/images/partial/module-2.png'),
									'module-3' => array('alt' => 'Module 3', 'img' => get_template_directory_uri().'/images/partial/module-3.png'),
									'module-4' => array('alt' => 'Module 4', 'img' => get_template_directory_uri().'/images/partial/module-4.png')
								),
						'default' => 'module-2'
						),
					array(
						'id'=>'author_summary_on',
						'type' => 'switch', 
						'title' => __('Enable/Disable Author Post Summary', 'redux-framework-demo'),
						'subtitle'=> __('When it disabled, author post summary will not show.', 'redux-framework-demo'),
						"default" => 1,
						),      																						
					)
				);


			/**
			
			Category Setting ++++++++++++++++++++++++++++++++

			**/
			// $this->sections[] = array(
				// 'icon' => 'el-icon-braille',
				// 'title' => __('Category Options', 'redux-framework-demo'),
				// 'desc' => __('<p class="description"> All Category related options are listed here.</p>', 'redux-framework-demo'),
				// 'fields' => array(
				// 	array(
				// 		'id'=>'category_limit',
				// 		'type' => 'text',
				// 		'title' => __('Number of Posts on Category Loop', 'redux-framework-demo'),
				// 		'subtitle' => __('This must be numeric.', 'redux-framework-demo'),
				// 		'desc' => __('', 'redux-framework-demo'),
				// 		'validate' => 'numeric',
				// 		'default' => '4',
				// 		'class' => 'small-text'
				// 		)
				// 	)
				// );


			/**
			
			Archive Setting ++++++++++++++++++++++++++++++++

			**/
			$this->sections[] = array(
				'icon' => ' el-icon-book',
				'title' => __('Archive Options', 'redux-framework-demo'),
				'desc' => __('<p class="description"> All Archive related options are listed here.</p>', 'redux-framework-demo'),
				'fields' => array(
					array(
						'id'=>'archive_module',
						'type' => 'image_select',
						'title' => __('Posts by Tag & Date Layout', 'redux-framework-demo'), 
						'subtitle' => __('Please select the Module layout when open the posts by Tag & Date', 'redux-framework-demo'),
						'desc' => __('', 'redux-framework-demo'),
						'options' => array(
									'module-1' => array('alt' => 'Module 1', 'img' => get_template_directory_uri().'/images/partial/module-1.png'),
									'module-2' => array('alt' => 'Module 2', 'img' => get_template_directory_uri().'/images/partial/module-2.png'),
									'module-3' => array('alt' => 'Module 3', 'img' => get_template_directory_uri().'/images/partial/module-3.png'),
									'module-4' => array('alt' => 'Module 4', 'img' => get_template_directory_uri().'/images/partial/module-4.png')
								),
						'default' => 'module-2'
						),
					array(
						'id'=>'archive_summary_on',
						'type' => 'switch', 
						'title' => __('Enable/Disable Archive Post Summary', 'redux-framework-demo'),
						'subtitle'=> __('When it disabled, archive post summary will not show.', 'redux-framework-demo'),
						"default" => 1,
						),
					array(
						'id'=>'category_summary_on',
						'type' => 'switch', 
						'title' => __('Enable/Disable Category Post Summary', 'redux-framework-demo'),
						'subtitle'=> __('When it disabled, category post summary will not show.', 'redux-framework-demo'),
						"default" => 1,
						),
					array(
						'id'=>'section-media-start',
						'type' => 'section', 
						'title' => __('Category Sidebar Options', 'redux-framework-demo'),
						'indent' => true
						),
						array(
							'id'=>'category_sidebar_on',
							'type' => 'switch', 
							'title' => __('Enable/Disable Category Sidebar', 'redux-framework-demo'),
							'subtitle'=> __('Enable/Disable Category Sidebar', 'redux-framework-demo'),
							'default' => 1,
							),
						array(
						    'id'       => 'category_sidebar_select',
						    'type'     => 'select',
						    'data'		=> 'sidebar',
						    'title'    => __('Select Category Page Sidebar', 'redux-framework-demo'), 
						    'subtitle' => __('Select Sidebar for Category Page', 'redux-framework-demo'),
						    ),
					array(
						'id'=>'section-media-end',
						'type' => 'section', 
						'indent' => false
						),
					)
				);

			
			/**
			
			404 Options ++++++++++++++++++++++++++++++++

			**/
			$this->sections[] = array(
				'icon' => ' el-icon-compass',
				'title' => __('404 Page Options', 'redux-framework-demo'),
				'desc' => __('<p class="description"> All 404 Page related options are listed here.</p>', 'redux-framework-demo'),
				'fields' => array(
					array(
						'id'=>'nf404_title',
						'type' => 'text',
						'title' => __('404 Page Title', 'redux-framework-demo'), 
						'subtitle' => __('Please enter the 404 Page title to give information to your audience.', 'redux-framework-demo'),
						'desc' => __(' ', 'redux-framework-demo'),
						'validate' => 'no_html',
						'default' => 'Oouchh, Bad News !'
						),
					array(
						'id'=>'nf404_desc',
						'type' => 'textarea',
						'title' => __('404 Page Information', 'redux-framework-demo'), 
						'subtitle' => __('Please enter the 404 Page description that useful information for your audience.', 'redux-framework-demo'),
						'desc' => __(' ', 'redux-framework-demo'),
						'default' => 'We couldn\'t find the page you were looking for.',
						'validate' => 'html'
						),
					array(
						'id'=>'nf404_button',
						'type' => 'text',
						'title' => __('Button Back to Home', 'redux-framework-demo'), 
						'subtitle' => __('Please enter the Text Button that will return to Homepage.', 'redux-framework-demo'),
						'desc' => __(' ', 'redux-framework-demo'),
						'default' => 'Please, Take me back to home!',
						'validate' => 'no_html'
						),
					)
				);
	
			
			/**
			
			Footer Options ++++++++++++++++++++++++++++++++

			**/
			$this->sections[] = array(
				'icon' => ' el-icon-info-sign',
				'title' => __('Footer Options', 'redux-framework-demo'),
				'desc' => __('<p class="description"> All Footer related options are listed here.</p>', 'redux-framework-demo'),
				'fields' => array(
					// Neeeew Setion 
					array(
						'id'=>'section-media-start',
						'type' => 'section', 
						'title' => __('Footer Widgets Area Options', 'redux-framework-demo'),
						'indent' => true
						),
						array(
							'id'=>'fwa_bg_color',
							'type' => 'color',
							'title' => __('Wigets Area Background Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a background color for the footer widgets area.', 'redux-framework-demo'),
							'default' => '#151515',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'fwa_bg_color_vague',
							'type' => 'color',
							'title' => __('Widgets Area Background Vague Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a footer background vague color, it\'s for Calendar widget.', 'redux-framework-demo'),
							'default' => '#272727',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'fwa_txt_color_1',
							'type' => 'color',
							'title' => __('Widgets Text Primary Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a footer text primary color for the footer widgets area.', 'redux-framework-demo'),
							'default' => '#dcdcdc',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'fwa_txt_color_2',
							'type' => 'color',
							'title' => __('Widgets Text Secondary Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a footer text secondary color for the footer widgets area.', 'redux-framework-demo'),
							'default' => '#7d7d7d',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'fwa_txt_color_vague',
							'type' => 'color',
							'title' => __('Widgets Text Vague Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a footer text vague color for the footer widgets area.', 'redux-framework-demo'),
							'default' => '#4f4f4f',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'fwa_link_color',
							'type' => 'select',
							'title' => __('Widget Link Color', 'redux-framework-demo'), 
							'subtitle' => __('Please select an options for Footer Widget link #hover', 'redux-framework-demo'),
							'desc' => __('It\'s mean when the #hover a link, the color will change as defined on this option.', 'redux-framework-demo'),
							'options' => array(
								'accent-1' => 'Primary Accent Color',
								'accent-2' => 'Secondary Accent Color',
								'default' => 'Default - Footer Widget Text Color',
								),
							'default' => 'default'
							),
						array(
							'id'=>'fwa_divider_color',
							'type' => 'color',
							'title' => __('Wigets Divider Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a footer divider color for each widgets.', 'redux-framework-demo'),
							'default' => '#2c2c2c',
							'validate' => 'color',
							'transparent' => false,
							),
					array(
						'id'=>'section-media-end',
						'type' => 'section', 
						'indent' => false
						),
					// Neeeew Setion 
					array(
						'id'=>'section-media-start',
						'type' => 'section', 
						'title' => __('Footer Copyright & Menus', 'redux-framework-demo'),
						'indent' => true
						),
						array(
							'id'=>'fc_divider_color',
							'type' => 'color',
							'title' => __('Footer Copyright Top Divider', 'redux-framework-demo'), 
							'subtitle' => __('Pick a footer copyright top divider color.', 'redux-framework-demo'),
							'default' => '#2c2c2c',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'fc_bg_color',
							'type' => 'color',
							'title' => __('Footer Copyright Background', 'redux-framework-demo'), 
							'subtitle' => __('Pick a background color for Footer copyright background.', 'redux-framework-demo'),
							'default' => '#000000',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'fc_txt_color_1',
							'type' => 'color',
							'title' => __('Text Color', 'redux-framework-demo'), 
							'subtitle' => __('Pick a footer text color for the footer copyright area.', 'redux-framework-demo'),
							'default' => '#595858',
							'validate' => 'color',
							'transparent' => false,
							),
						array(
							'id'=>'fc_copyright',
							'type' => 'editor',
							'title' => __('Copyright', 'redux-framework-demo'), 
							'subtitle' => __('Enter your copyright text, it\'s possible for shortcode too.', 'redux-framework-demo'),
							'default' => '&copy; Copyright 2014. Curated - by ThemeMaha.',
							),
						array(
							'id'=>'fc_menu',
							'type' => 'select',
							'data' => 'menus',
							'title' => __('Additional menu', 'redux-framework-demo'), 
							'subtitle' => __('Please select one of the menu if you want to show a menu on the footer', 'redux-framework-demo'),
							'desc' => __('It\'s just support for 1st level menu, so the 2nd level of menu will not appear.', 'redux-framework-demo'),
							),
						array(
							'id'=>'fc_link_color',
							'type' => 'select',
							'title' => __('Menus Link Color', 'redux-framework-demo'), 
							'subtitle' => __('Please select an options for Menu link #hover', 'redux-framework-demo'),
							'desc' => __('It\'s mean when the #hover a link, the color will change as defined this option.', 'redux-framework-demo'),
							'options' => array(
								'accent-1' => 'Primary Accent Color',
								'accent-2' => 'Secondary Accent Color',
								'default' => 'Default - Footer Copyright Text Color',
								),
							'default' => 'default'
							),
					array(
						'id'=>'section-media-end',
						'type' => 'section', 
						'indent' => false
						),
					)
				);


			/**
			
			Social ++++++++++++++++++++++++++++++++

			**/
			$this->sections[] = array(
				'icon' => 'el-icon-twitter',
				'title' => __('Social Options', 'redux-framework-demo'),
				'fields' => array(
					array(
						'id'=>'social-facebook',
						'type' => 'text',
						'title' => __('Facebook Token', 'redux-framework-demo'),						
						'default' => '906750036058241|bf2f43b495afef7a064d8d48a8cd8e8f',
						'desc' => __('If you do not have a Facebook App, you can follow this video (<a target="_blank" href="http://youtu.be/oyjh40d_zbY">http://youtu.be/oyjh40d_zbY</a>) to create a Facebook App via <a target="_blank" href="https://developers.facebook.com">https://developers.facebook.com</a> </br></br>
							There is 2 way to get your Facebook token :</br>
							<strong>1. Merge your "App ID" + "|" + "App Secret"</strong></br>
							<span>&nbsp;&nbsp;&nbsp;</span> by adding "|" character between your "App ID" and "App Secret"</br></br>
							
							<strong>2. Generate via Facebook Graph API Explorer</strong></br>
							<span>&nbsp;&nbsp;&nbsp;</span> On Facebook Developers Page, Go to menu "Tools & Support > Graph API Explorer" </br></br>

							You can see both of them via this video <a target="_blank" href="http://youtu.be/oyjh40d_zbY">http://youtu.be/oyjh40d_zbY</a></br>', 'redux-framework-demo'),
					),
					array(
						'id'=>'social-google',
						'type' => 'text',
						'title' => __('Google API Key (Google+ & Youtube)', 'redux-framework-demo'),						
						'default' => 'AIzaSyAqL8iRM2QFCum2pkcpyhY3ORe0Ye9hXms',
						'desc' => __('If you do not have a Google Project, you can follow this video (<a target="_blank" href="https://www.youtube.com/watch?v=NENb_klOR3w">https://www.youtube.com/watch?v=NENb_klOR3w</a>) to create a Google project and get the Google+ API Key via <a target="_blank" href="https://console.developers.google.com/">https://console.developers.google.com/</a> </br></br>', 'redux-framework-demo'),
					),
					array(
						'id'=>'social-twitter-key',
						'type' => 'text',
						'title' => __('Twitter - Consumer Key', 'redux-framework-demo'),						
						'default' => 'd587cQyByWbGtukMDdqSRn4jT',
						'desc' => __('If you do not have a Twitter App, you can follow this video (<a target="_blank" href="https://youtu.be/dnad-jfJXaw">https://youtu.be/dnad-jfJXaw</a>) to create a Twitter App to get the Twitter Consumer Key and Consumer Secret via <a target="_blank" href="https://apps.twitter.com/">https://apps.twitter.com/</a> </br></br>', 'redux-framework-demo'),
					),
					array(
						'id'=>'social-twitter-secret',
						'type' => 'text',
						'title' => __('Twitter - Consumer Secret', 'redux-framework-demo'),						
						'default' => 'EpmYu2VU365swi5Emsj85MJ2gtvsI0HmKLevLGZg3uQovHe6xa',
					),
					array(
						'id'=>'social-instagram',
						'type' => 'text',
						'title' => __('Instagram Token', 'redux-framework-demo'),						
						'default' => '1316998486.94c7f68.2005c19e4e0a4d839a541610226e4f69',
						'desc' => __('If you do not have an Instagram Client, you can get your Instagram Token code by login to our "Instagram Token Generator". Get your Instagram token via this link <a target="_blank" href="http://thememaha.com/instagram/">http://thememaha.com/instagram/</a> </br></br>

							(We never collect your data, It is Safe)', 'redux-framework-demo'),
					),
					array(
						'id'=>'social-pinterest',
						'type' => 'text',
						'title' => __('Pinterest Token', 'redux-framework-demo'),						
						'default' => 'AWhvA7mQVr9nGHPB913F9md1blZZFBWbNoSLC19CoEt7z0A3qAAAAAA',
						'desc' => __('Get your Pinterest token via this link <a target="_blank" href="https://developers.pinterest.com/tools/access_token/">https://developers.pinterest.com/tools/access_token/</a> </br></br>
							Note: Check read_public only for security reason.', 'redux-framework-demo'),
					),
					array(
						'id'=>'social-tumblr-key',
						'type' => 'text',
						'title' => __('Tumblr - Token', 'redux-framework-demo'),						
						'default' => '',
						'desc' => __('If you do not have a Tumblr Token get the Tumblr Token and Token Secret via <a target="_blank" href="http://thememaha.com/tumblr/">http://thememaha.com/tumblr/</a> </br></br>(We never collect your data, It is Safe)', 'redux-framework-demo'),
					),
					array(
						'id'=>'social-tumblr-secret',
						'type' => 'text',
						'title' => __('Tumblr - Token Secret', 'redux-framework-demo'),						
						'default' => '',
					),
				),
			);


			/** ---------------------------------------------- **/
			$this->sections[] = array( 'type' => 'divide', );


			/**
			
			Woocommerce ++++++++++++++++++++++++++++++++

			**/
			$this->sections[] = array(
				'icon' => 'el-icon-shopping-cart',
				'title' => __('Woocommerce', 'redux-framework-demo'),
				'fields' => array(
					array(
						'id'=>'woo_number_products',
						'type' => 'text',
						'title' => __('Number of products per page', 'redux-framework-demo'),
						'subtitle' => __('Enter number of products', 'redux-framework-demo'),
						'default' => '8',
						),
				),
			);



			/** ---------------------------------------------- **/
			//$this->sections[] = array( 'type' => 'divide', );


			/**
			
			BBPress ++++++++++++++++++++++++++++++++

			**/

			$this->sections[] = array(
				'icon' => 'el-icon-group',
				'title' => __('BBPress', 'redux-framework-demo'),
				'fields' => array(
					array(
						'id'=>'bbpress_sidebar_on',
						'type' => 'switch', 
						'title' => __('Enable/Disable BBPress Sidebar', 'redux-framework-demo'),
						'subtitle'=> __('Enable/Disable BBPress sidebar', 'redux-framework-demo'),
						'default' => 0,
						),
					array(
					    'id'       => 'bbpress_sidebar_select',
					    'type'     => 'select',
					    'data'		=> 'sidebar',
					    'title'    => __('Select BBPress Sidebar', 'redux-framework-demo'), 
					    'subtitle' => __('Select sidebar for BBPress', 'redux-framework-demo'),
					    ),
				),
			);

			/**
			
			BuddyPress ++++++++++++++++++++++++++++++++

			**/

			$this->sections[] = array(
				'icon' => 'el-icon-group-alt',
				'title' => __('BuddyPress', 'redux-framework-demo'),
				'fields' => array(
					array(
						'id'=>'buddypress_sidebar_on',
						'type' => 'switch', 
						'title' => __('Enable/Disable BuddyPress Sidebar', 'redux-framework-demo'),
						'subtitle'=> __('Enable/Disable BuddyPress Sidebar', 'redux-framework-demo'),
						'default' => 0,
						),
					array(
					    'id'       => 'buddypress_sidebar_select',
					    'type'     => 'select',
					    'data'		=> 'sidebar',
					    'title'    => __('Select BuddyPress Sidebar', 'redux-framework-demo'), 
					    'subtitle' => __('Select Sidebar for BuddyPress', 'redux-framework-demo'),
					    ),
				),
			);



			/** ---------------------------------------------- **/
			$this->sections[] = array( 'type' => 'divide', );



			/**
			
			Editable Text ++++++++++++++++++++++++++++++++

			**/
			$this->sections[] = array(
				'icon' => 'el-icon-pencil',
				'title' => __('Editable Text', 'redux-framework-demo'),
				'fields' => array(
					// Neeeew Setion 
					array(
						'id'=>'section-media-start',
						'type' => 'section', 
						'title' => __('Single Post', 'redux-framework-demo'),
						'indent' => true
						),
						array(
							'id'=>'s_editor_review',
							'type' => 'text',
							'title' => __('Editor Review', 'redux-framework-demo'),
							'subtitle' => __('Change this text', 'redux-framework-demo'),
							'default' => 'Editor\'s Review',
							),
						array(
							'id'=>'s_related',
							'type' => 'text',
							'title' => __('Related Articles', 'redux-framework-demo'),
							'subtitle' => __('Change this text', 'redux-framework-demo'),
							'default' => 'Related Articles',
							),
						array(
							'id'=>'s_next_article',
							'type' => 'text',
							'title' => __('Next Article', 'redux-framework-demo'),
							'subtitle' => __('Change this text', 'redux-framework-demo'),
							'default' => 'Next Article',
							),
						array(
							'id'=>'s_prev_article',
							'type' => 'text',
							'title' => __('Previous Article', 'redux-framework-demo'),
							'subtitle' => __('Change this text', 'redux-framework-demo'),
							'default' => 'Previous Article',
							),
						array(
							'id'=>'s_about_author',
							'type' => 'text',
							'title' => __('About Auhtor', 'redux-framework-demo'),
							'subtitle' => __('Change this text', 'redux-framework-demo'),
							'default' => 'Author',
							),
						array(
							'id'=>'s_leave_reply',
							'type' => 'text',
							'title' => __('Leave A Reply', 'redux-framework-demo'),
							'subtitle' => __('Change this text', 'redux-framework-demo'),
							'default' => 'Leave A Reply',
							),
						array(
							'id'=>'s_cancel_reply',
							'type' => 'text',
							'title' => __('Cancel Reply', 'redux-framework-demo'),
							'subtitle' => __('Change this text', 'redux-framework-demo'),
							'default' => 'Cancel Reply',
							),
						array(
							'id'=>'s_submit_reply',
							'type' => 'text',
							'title' => __('Submit Comment', 'redux-framework-demo'),
							'subtitle' => __('Change this text', 'redux-framework-demo'),
							'default' => 'Submit Comment',
							),
					array(
						'id'=>'section-media-end',
						'type' => 'section', 
						'indent' => false
						),
				),
			);



			/**
			
			Sidebar Settings ++++++++++++++++++++++++++++++++

			**/
			$this->sections[] = array(
				'icon' => 'el-icon-th-list',
				'title' => __('Sidebar Settings', 'redux-framework-demo'),
				'fields' => array(
					array(
						'id'=>'theme_sidebar',
						'type' => 'multi_text',
						'title' => __('Theme Sidebars', 'redux-framework-demo'),
						'subtitle' => __('Click \'Add More\' to create new sidebar, click \'Remove\' to delete the sidebar', 'redux-framework-demo'),
						'desc' => __('Enter new Sidebar Name or edit the Sidebar Name', 'redux-framework-demo'),
						'default' => array(
							'1' => 'Curated Sidebar',
						),
					),
				)
			);



			/**
			
			Additonal Settings ++++++++++++++++++++++++++++++++

			**/
			$this->sections[] = array(
				'icon' => 'el-icon-cogs',
				'title' => __('Additional Settings', 'redux-framework-demo'),
				'fields' => array(
					array(
						'id'=>'custom_css',
						'type' => 'ace_editor',
						'title' => __('Custom CSS', 'redux-framework-demo'), 
						'subtitle' => __('Paste your custom CSS code', 'redux-framework-demo'),
						'mode' => 'css',
			            'theme' => 'chrome',
						'desc' => __('Don\'t use < style > tag , just put the CSS code.', 'redux-framework-demo'),
			            'default' => ""
						),
			        array(
						'id'=>'custom_js',
						'type' => 'ace_editor',
						'title' => __('Tracking Code / Additional JS Code', 'redux-framework-demo'), 
						'subtitle' => __('Paste your Google Analytics (or other) tracking code here or another additonal Javascript code.', 'redux-framework-demo'),
						'mode' => 'html',
			            'theme' => 'chrome',
						'desc' => __('Please use < script > tag before write the javascript code.', 'redux-framework-demo'),
			            'default' => "",
						),
					)
				);


		}	

		public function setHelpTabs() {

			// Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
			$this->args['help_tabs'][] = array(
			    'id' => 'redux-opts-1',
			    'title' => __('Thank you', 'redux-framework-demo'),
			    'content' => __('<p>Thank you for purchasing our theme.</p>', 'redux-framework-demo')
			);

			// Set the help sidebar
			$this->args['help_sidebar'] = __('<p>Thank you</p>', 'redux-framework-demo');

		}


		/**
			
			All the possible arguments for Redux.
			For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

		 **/
		public function setArguments() {
			
			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$theme_menu_icon = MAHA_URL . '/images/maha.svg';

			$this->args = array(
	            
	            // TYPICAL -> Change these values as you need/desire
				'opt_name'          	=> 'curated', // This is where your data is stored in the database and also becomes your global variable name.
				'display_name'			=> $theme->get('Name'), // Name that appears at the top of your panel
				'display_version'		=> $theme->get('Version'), // Version that appears at the top of your panel
				'menu_type'          	=> 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'     	=> true, // Show the sections below the admin menu item or not
				'menu_title'			=> $theme->get('Name'),
	            'page'		 	 		=> $theme->get('Name'),
	            'google_api_key'   	 	=> '', // Must be defined to add google fonts to the typography module
	            'global_variable'    	=> '', // Set a different name for your global variable other than the opt_name
	            'dev_mode'           	=> false, // Show the time the page took to load, etc
	            'customizer'         	=> false, // Enable basic customizer support
	            'admin_bar'         	=> false,

	            // OPTIONAL -> Give you extra features
	            'page_priority'      	=> 30, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	            'page_parent'        	=> 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	            'page_permissions'   	=> 'manage_options', // Permissions needed to access the options panel.
	            'menu_icon'          	=> $theme_menu_icon, // Specify a custom URL to an icon
	            'last_tab'           	=> '', // Force your panel to always open to a specific tab (by id)
	            'page_icon'          	=> 'icon-themes', // Icon displayed in the admin panel next to your menu_title
	            'page_slug'          	=> 'maha_options', // Page slug used to denote the panel
	            'save_defaults'      	=> true, // On load save the defaults to DB before user clicks save or not
	            'default_show'       	=> false, // If true, shows the default value next to each field that is not the default value.
	            'default_mark'       	=> '', // What to print by the field's title if the value shown is default. Suggested: *


	            // CAREFUL -> These options are for advanced use only
	            'transient_time' 	 	=> 60 * MINUTE_IN_SECONDS,
	            'output'            	=> true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	            'output_tag'            => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	            //'domain'             	=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
	            'footer_credit'      	=> 'ThemeMaha Mark 1.1 ', // Disable the footer credit of Redux. Please leave if you can help it.
	            

	            // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	            'database'           	=> '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	            
	        
	            'show_import_export' 	=> true, // REMOVE
	            'system_info'        	=> false, // REMOVE
	            
	            'help_tabs'          	=> array(),
	            'help_sidebar'       	=> '', // __( '', $this->args['domain'] );            
				);


			// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.		
			// $this->args['share_icons'][] = array(
			//     'url' => 'https://github.com/ReduxFramework/ReduxFramework',
			//     'title' => 'Visit us on GitHub', 
			//     'icon' => 'el-icon-github'
			// );		
			// $this->args['share_icons'][] = array(
			//     'url' => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
			//     'title' => 'Like us on Facebook', 
			//     'icon' => 'el-icon-facebook'
			// );
			// $this->args['share_icons'][] = array(
			//     'url' => 'http://twitter.com/reduxframework',
			//     'title' => 'Follow us on Twitter', 
			//     'icon' => 'el-icon-twitter'
			// );
			// $this->args['share_icons'][] = array(
			//     'url' => 'http://www.linkedin.com/company/redux-framework',
			//     'title' => 'Find us on LinkedIn', 
			//     'icon' => 'el-icon-linkedin'
			// );


			// Add content after the form.
			// $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo');

		}
	}
	new Redux_Framework_sample_config();

}


/** 

	Custom function for the callback referenced above

 */
if ( !function_exists( 'redux_my_custom_field' ) ):
	function redux_my_custom_field($field, $value) {
	    print_r($field);
	    print_r($value);
	}
endif;

/**
 
	Custom function for the callback validation referenced above

**/
if ( !function_exists( 'redux_validate_callback_function' ) ):
	function redux_validate_callback_function($field, $value, $existing_value) {
	    $error = false;
	    $value =  'just testing';
	    /*
	    do your validation
	    
	    if(something) {
	        $value = $value;
	    } elseif(something else) {
	        $error = true;
	        $value = $existing_value;
	        $field['msg'] = 'your custom error message';
	    }
	    */
	    
	    $return['value'] = $value;
	    if($error == true) {
	        $return['error'] = $field;
	    }
	    return $return;
	}
endif;
