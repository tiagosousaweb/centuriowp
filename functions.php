<?php
/**
 * Odin functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Odin
 * @since 2.2.0
 */

/**
 * Sets content width.
 */

require_once('wp-updates-theme.php');
new WPUpdatesThemeUpdater_1562( 'http://wp-updates.com/api/2/theme', basename( get_template_directory() ) );

if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Odin Classes.
 */
require_once get_template_directory() . '/core/classes/class-bootstrap-nav.php';
require_once get_template_directory() . '/core/classes/class-shortcodes.php';
require_once get_template_directory() . '/core/classes/class-thumbnail-resizer.php';
// require_once get_template_directory() . '/core/classes/class-theme-options.php';
// require_once get_template_directory() . '/core/classes/class-options-helper.php';
// require_once get_template_directory() . '/core/classes/class-post-type.php';
// require_once get_template_directory() . '/core/classes/class-taxonomy.php';
// require_once get_template_directory() . '/core/classes/class-metabox.php';
// require_once get_template_directory() . '/core/classes/abstracts/abstract-front-end-form.php';
// require_once get_template_directory() . '/core/classes/class-contact-form.php';
// require_once get_template_directory() . '/core/classes/class-post-form.php';
// require_once get_template_directory() . '/core/classes/class-user-meta.php';

/**
 * Odin Widgets.
 */
require_once get_template_directory() . '/core/classes/widgets/class-widget-like-box.php';
require_once get_template_directory() . '/core/classes/widgets/autor.php';
require_once get_template_directory() . '/core/classes/widgets/captura.php';
require_once get_template_directory() . '/core/classes/widgets/paginas.php';

if ( ! function_exists( 'odin_setup_features' ) ) {

	/**
	 * Setup theme features.
	 *
	 * @since  2.2.0
	 *
	 * @return void
	 */
	function odin_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( 'odin', get_template_directory() . '/languages' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'odin' )
			)
		);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Header.
		 */
		$default = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
		);

		add_theme_support( 'custom-header', $default );

		/**
		 * Support Custom Background.
		 */
		$defaults = array(
			'default-color' => '',
			'default-image' => '',
		);

		add_theme_support( 'custom-background', $defaults );

		/**
		 * Support Custom Editor Style.
		 */
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Add support for infinite scroll.
		 */
		add_theme_support(
			'infinite-scroll',
			array(
				'type'           => 'scroll',
				'footer_widgets' => false,
				'container'      => 'content',
				'wrapper'        => false,
				'render'         => false,
				'posts_per_page' => get_option( 'posts_per_page' )
			)
		);

		/**
		 * Add support for Post Formats.
		 */
		// add_theme_support( 'post-formats', array(
		//     'aside',
		//     'gallery',
		//     'link',
		//     'image',
		//     'quote',
		//     'status',
		//     'video',
		//     'audio',
		//     'chat'
		// ) );

		/**
		 * Support The Excerpt on pages.
		 */
		// add_post_type_support( 'page', 'excerpt' );

		/**
		 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
	}
}

add_action( 'after_setup_theme', 'odin_setup_features' );

/**
 * Register widget areas.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'odin' ),
			'id' => 'main-sidebar',
			'description' => __( 'Site Main Sidebar', 'odin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widgettitle widget-title">',
			'after_title' => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'odin_widgets_init' );

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_flush_rewrite() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'odin_flush_rewrite' );

/**
 * Load site scripts.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Loads Odin main stylesheet.
	wp_enqueue_style( 'odin-style', get_stylesheet_uri(), array(), null, 'all' );

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// Bootstrap.
	wp_enqueue_script( 'bootstrap', $template_url . '/assets/js/libs/bootstrap.min.js', array(), null, true );

	// General scripts.
	// FitVids.
	wp_enqueue_script( 'fitvids', $template_url . '/assets/js/libs/jquery.fitvids.js', array(), null, true );

	// Main jQuery.
	wp_enqueue_script( 'odin-main', $template_url . '/assets/js/main.js', array(), null, true );

	// Grunt main file with Bootstrap, FitVids and others libs.
	// wp_enqueue_script( 'odin-main-min', $template_url . '/assets/js/main.min.js', array(), null, true );

	// Grunt watch livereload in the browser.
	// wp_enqueue_script( 'odin-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'odin_enqueue_scripts', 1 );

/**
 * Odin custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function odin_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/css/style.css';
}

add_filter( 'stylesheet_uri', 'odin_stylesheet_uri', 10, 2 );

/**
 * Core Helpers.
 */
require_once get_template_directory() . '/core/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

/**
 * Comments loop.
 */
require_once get_template_directory() . '/inc/comments-loop.php';

/**
 * WP optimize functions.
 */
require_once get_template_directory() . '/inc/optimize.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/plugins-support.php';

/**
 * Custom template tags.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/* Tiago Sousa */
// https://github.com/wpbrasil/odin/wiki/Classe-Odin_Theme_Options

require_once get_template_directory() . '/core/classes/class-theme-options.php';

function odin_theme_settings_example() {

    $settings = new Odin_Theme_Options(
        'odin-settings', // Slug/ID of the Settings Page (Required)
        'Opções do Centurio', // Settings page name (Required)
        'manage_options' // Page capability (Optional) [default is manage_options]
    );

    $settings->set_tabs(
        array(
            array(
                'id' => 'geral', // Slug/ID of the Settings tab (Required)
                'title' => __( 'Configurações Gerais', 'odin' ), // Settings tab title (Required)
            ),

			array(
                'id' => 'cores', // Slug/ID of the Settings tab (Required)
                'title' => __( 'Cores', 'odin' ), // Settings tab title (Required)
            ),

			array(
                'id' => 'email_marketing', // Slug/ID of the Settings tab (Required)
                'title' => __( 'Email Marketing', 'odin' ), // Settings tab title (Required)
            ),

			array(
                'id' => 'aviso', // Slug/ID of the Settings tab (Required)
                'title' => __( 'Aviso', 'odin' ), // Settings tab title (Required)
            ),

            array(
                'id' => 'social', // Slug/ID of the Settings tab (Required)
                'title' => __( 'Redes Sociais', 'odin' ), // Settings tab title (Required)
            ),

			array(
                'id' => 'rodape', // Slug/ID of the Settings tab (Required)
                'title' => __( 'Rodapé', 'odin' ), // Settings tab title (Required)
            ),

            array(
                'id' => 'adsense', // Slug/ID of the Settings tab (Required)
                'title' => __( 'Adsense', 'odin' ), // Settings tab title (Required)
            ),
        )
    );

    $settings->set_fields(
        array(
		
			// Campos da aba Configuraçõs Gerais
		
            'odin_general_fields_section' => array( // Slug/ID of the section (Required)
                'tab'   => 'geral', // Tab ID/Slug (Required)
                'title' => __( 'Opções do Centurio', 'odin' ), // Section title (Required)
                'fields' => array( // Section fields (Required)

                    /**
                     * Default input examples.
                     */

     //                array(
					// 	'id'          => 'key', // Obrigatório
					// 	'label'       => __( 'Chave de Licença', 'odin' ), // Obrigatório
					// 	'type'        => 'text', // Obrigatório
					// 	'default'     => '', // Opcional (deve ser o id de uma imagem em mídias, separe os ids com virtula)
					// 	'description' => __( 'Cole aqui a chave de Licença do Centurio WP. (Obrigatório)', 'odin' ), // Opcional
					// ),                                       
					array(
						'id'          => 'logotipo', // Obrigatório
						'label'       => __( 'Logotipo', 'odin' ), // Obrigatório
						'type'        => 'image_plupload', // Obrigatório
						'default'     => '', // Opcional (deve ser o id de uma imagem em mídias, separe os ids com virtula)
						'description' => __( 'Escolha seu logotipo.', 'odin' ), // Opcional
					),
					array(
						'id'          => 'favicon', // Obrigatório
						'label'       => __( 'Favicon', 'odin' ), // Obrigatório
						'type'        => 'upload', // Obrigatório
						'default'     => '', // Opcional (deve ser o id de uma imagem em mídias, separe os ids com virtula)
						'description' => __( 'Escolha seu favicon. É aquele iconizinho que aparece no navegador.', 'odin' ), // Opcional
					),
					array(
                        'id'          => 'posicao_barra', // Required
                        'label'       => __( 'Posição da Barra Lateral', 'odin' ), // Required
                        'type'        => 'radio', // Required
                        // 'attributes' => array(), // Optional (html input elements)
                        // 'default'    => 'three', // Optional
                        'description' => __( 'Escolha a posição da barra lateral.', 'odin' ), // Optional
                        'options' => array( // Required (id => title)
                            'direita'   => 'Esquerda', // Invertido porque estou atacando o conteúdo e não a barra diretamente.
                            'esquerda'   => 'Direita',                            
                        ),
                    ),
					array(
						'id'          => 'meu_script', // Obrigatório
						'label'       => __( 'Javascript', 'odin' ), // Obrigatório
						'type'        => 'textarea', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Coloque o script aqui!' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Copie e cole aqui algum script que você tenha disponível. Ex: Pixel de Remarketing, Público Personalizado, Google Analytics, etc', 'odin' ), // Opcional
					),									
                )
            ),

			'odin_cores_fields_section' => array( // Slug/ID of the section (Required)
                'tab'   => 'cores', // Tab ID/Slug (Required)
                'title' => __( 'Configurações de Cores', 'odin' ), // Section title (Required)
                'fields' => array( // Section fields (Required)

                    /**
                     * Default input examples.
                     */ 
					 
                    array(
                        'id'          => 'fundo_blog', // Required
                        'label'       => __( 'Cor do Fundo do Blog', 'odin' ), // Required
                        'type'        => 'color', // Required
                        // 'attributes' => array(), // Optional (html input elements)
                        'default'     => '#f7f5ee', // Optional
                        'description' => __( 'Selecione a cor de fundo do seu blog.', 'odin' ), // Optional
                    ),	
					array(
                        'id'          => 'fundo_caixa', // Required
                        'label'       => __( 'Cor da Caixa de Captura', 'odin' ), // Required
                        'type'        => 'color', // Required
                        // 'attributes' => array(), // Optional (html input elements)
                        'default'     => '#686868', // Optional
                        'description' => __( 'Selecione a cor de fundo da caixa de captura.', 'odin' ), // Optional
                    ),
					array(
                        'id'          => 'cor_titulo_hover', // Required
                        'label'       => __( 'Cor dos títulos quando o mouse passar por cima', 'odin' ), // Required
                        'type'        => 'color', // Required
                        // 'attributes' => array(), // Optional (html input elements)
                        'default'     => '#7100e2', // Optional
                        'description' => __( 'Selecione a cor dos títulos quando o mouse passar por cima.', 'odin' ), // Optional
                    ),
					array(
                        'id'          => 'cor_menu', // Required
                        'label'       => __( 'Cor do Menu', 'odin' ), // Required
                        'type'        => 'color', // Required
                        // 'attributes' => array(), // Optional (html input elements)
                        'default'     => '#fff', // Optional
                        'description' => __( 'Selecione a cor do menu do seu blog.', 'odin' ), // Optional
                    ),
					array(
                        'id'          => 'cor_letra_menu', // Required
                        'label'       => __( 'Cor da letra do menu', 'odin' ), // Required
                        'type'        => 'color', // Required
                        // 'attributes' => array(), // Optional (html input elements)
                        'default'     => '#686868', // Optional
                        'description' => __( 'Selecione a cor da letra do menu.', 'odin' ), // Optional
                    ),
					array(
                        'id'          => 'cor_menu_hover', // Required
                        'label'       => __( 'Cor do menu quando o mouse passar por cima', 'odin' ), // Required
                        'type'        => 'color', // Required
                        // 'attributes' => array(), // Optional (html input elements)
                        'default'     => '#686868', // Optional
                        'description' => __( 'Selecione a cor do menu quando o mouse passar por cima.', 'odin' ), // Optional
                    ),
					array(
                        'id'          => 'cor_ler_mais', // Required
                        'label'       => __( 'Cor do Botão Ler Mais', 'odin' ), // Required
                        'type'        => 'color', // Required
                        // 'attributes' => array(), // Optional (html input elements)
                        'default'     => '#686868', // Optional
                        'description' => __( 'Selecione a cor do botão ler mais.', 'odin' ), // Optional
                    ),                    
					array(
                        'id'          => 'cor_titulo_widget', // Required
                        'label'       => __( 'Cor do fundo do Título da Barra Lateral', 'odin' ), // Required
                        'type'        => 'color', // Required
                        // 'attributes' => array(), // Optional (html input elements)
                        'default'     => '#686868', // Optional
                        'description' => __( 'Selecione a cor de fundo do cabeçalho da barra lateral.', 'odin' ), // Optional
                    ),
					array(
                        'id'          => 'cor_letra_titulo_widget', // Required
                        'label'       => __( 'Cor da letra da Barra Lateral', 'odin' ), // Required
                        'type'        => 'color', // Required
                        // 'attributes' => array(), // Optional (html input elements)
                        'default'     => '#ffffff', // Optional
                        'description' => __( 'Selecione a cor da letra do cabeçalho da barra lateral.', 'odin' ), // Optional
                    ),					
					array(
                        'id'          => 'fundo_rodape', // Required
                        'label'       => __( 'Cor de fundo do Rodapé', 'odin' ), // Required
                        'type'        => 'color', // Required
                        // 'attributes' => array(), // Optional (html input elements)
                        'default'     => '#344146', // Optional
                        'description' => __( 'Selecione a cor de fundo do Rodapé.', 'odin' ), // Optional
                    ),
                )
            ),
			
			
			// Campos da Aba Email Marketing 	
			
			'odin_email_fields_section' => array( // Slug/ID of the section (Required)
                'tab'   => 'email_marketing', // Tab ID/Slug (Required)
                'title' => __( 'Opções do Email Marketing', 'odin' ), // Section title (Required)
                'fields' => array( // Section fields (Required)

                    /**
                     * Default input examples.
                     */
                    
				   array(
                        'id'          => 'exibir_caixa', // Required
                        'label'       => __( 'Deseja exibir a caixa de captura de email?', 'odin' ), // Required
                        'type'        => 'radio', // Required
                        // 'attributes' => array(), // Optional (html input elements)
                        // 'default'    => 'three', // Optional
                        'options' => array( // Required (id => title)
                            'sim'   => 'Sim', 
                            'nao'   => 'Não',                            
                        ),
                    ),
					array(
						'id'          => 'icone_caixa', // Obrigatório
						'label'       => __( 'Icone da caixa de Captura:', 'odin' ), // Obrigatório
						'type'        => 'image_plupload', // Obrigatório
						'default'     => '', // Opcional (deve ser o id de uma imagem em mídias, separe os ids com virtula)
						'description' => __( 'Escolha o ícone da sua caixa de captura. Ex: Uma seta apontando para direita.', 'odin' ), // Opcional
					),
					array(
						'id'          => 'seta_caixa', // Obrigatório
						'label'       => __( 'ícone ou seta do formulário de email:', 'odin' ), // Obrigatório
						'type'        => 'image_plupload', // Obrigatório
						'default'     => '', // Opcional (deve ser o id de uma imagem em mídias, separe os ids com virtula)
						'description' => __( 'Escolha a seta que apontará para o formulário de email.', 'odin' ), // Opcional
					),
                   array(
						'id'          => 'chamada', // Obrigatório
						'label'       => __( 'Texto de chamada:', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite o texto aqui.' )
						),
						'default'     => 'Fique por dentro das atualizações do Blog.', // Opcional
						'description' => __( 'Insira o texto da chamada da caixa de captura.', 'odin' ), // Opcional
					),
					 array(
						'id'          => 'texto_email', // Obrigatório
						'label'       => __( 'Texto de chamada do email:', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite o texto aqui' )
						),
						'default'     => 'Digite seu email para receber:', // Opcional
						'description' => __( 'Insira o texto da chamada da email.', 'odin' ), // Opcional
					),
					array(
						'id'          => 'texto_campo_email', // Obrigatório
						'label'       => __( 'Campo de email:', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite o texto aqui' )
						),
						'default'     => 'Digite seu email aqui...', // Opcional
						'description' => __( 'Insira o texto de dentro do campo de email.', 'odin' ), // Opcional
					), 
					array(
						'id'          => 'texto_spam', // Obrigatório
						'label'       => __( 'Aviso contra SPAM:', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite o texto aqui' )
						),
						'default'     => 'Jamais enviaremos SPAM!', // Opcional
						'description' => __( 'Insira o texto do aviso antispam."', 'odin' ), // Opcional
					),
					array(
						'id'          => 'texto_botao', // Obrigatório
						'label'       => __( 'Texto de chamada do botão de CTA:', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite o texto aqui' )
						),
						'default'     => 'Receber Agora!', // Opcional
						'description' => __( 'Insira o texto da chamada do botão de chamada Cal-to-Action.', 'odin' ), // Opcional
					),
					array(
						'id'          => 'action', // Obrigatório
						'label'       => __( 'Action do Formulário:', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Insira a action do formulário aqui...' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Insira a action do seu formulário, se houver alguma dúvida contate o suporte', 'odin' ), // Opcional
					),
					array(
						'id'          => 'name_email', // Obrigatório
						'label'       => __( 'Nome do campo do email:', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Insira o nome do input email do formulário aqui...' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Insira a nome do campo email do seu formulário, se houver alguma dúvida contate o suporte', 'odin' ), // Opcional
					),
					array(
						'id'          => 'nome_input_extra_01', // Obrigatório
						'label'       => __( 'Nome do input extra 01:', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite ou cole o conteúdo aqui...' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Se tiver algum outro input name em seu formulário, insira o atributo name aqui.', 'odin' ), // Opcional
					),
					array(
						'id'          => 'valor_input_extra_01', // Obrigatório
						'label'       => __( 'Valor do input extra 01:', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite ou cole o conteúdo aqui...' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Se tiver algum outro input name em seu formulário, insira o atributo name aqui.', 'odin' ), // Opcional
					),
					array(
						'id'          => 'nome_input_extra_02', // Obrigatório
						'label'       => __( 'Nome do input extra 02:', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite ou cole o conteúdo aqui...' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Insira o valor do input extra.', 'odin' ), // Opcional
					),
					array(
						'id'          => 'valor_input_extra_02', // Obrigatório
						'label'       => __( 'Valor do input extra 02:', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite ou cole o conteúdo aqui...' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Insira o valor do input extra.', 'odin' ), // Opcional
					),
					array(
						'id'          => 'nome_input_extra_03', // Obrigatório
						'label'       => __( 'Nome do input extra 03:', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite ou cole o conteúdo aqui...' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Se tiver algum outro input name em seu formulário, insira o atributo name aqui.', 'odin' ), // Opcional
					),
					array(
						'id'          => 'valor_input_extra_03', // Obrigatório
						'label'       => __( 'Valor do input extra 03:', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite ou cole o conteúdo aqui...' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Insira o valor do input extra.', 'odin' ), // Opcional
					),
					array(
						'id'          => 'nome_input_extra_04', // Obrigatório
						'label'       => __( 'Nome do input extra 04:', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite ou cole o conteúdo aqui...' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Se tiver algum outro input name em seu formulário, insira o atributo name aqui.', 'odin' ), // Opcional
					),	
					array(
						'id'          => 'valor_input_extra_04', // Obrigatório
						'label'       => __( 'Valor do input extra 04:', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite ou cole o conteúdo aqui...' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Insira o valor do input extra.', 'odin' ), // Opcional
					),
	
                )
            ),
			
			// Campos da aba Configurações do Aviso do Topo
			
			'odin_barra_fields_section' => array( // Slug/ID of the section (Required)
                'tab'   => 'aviso', // Tab ID/Slug (Required)
                'title' => __( 'Opções da Barra de Aviso', 'odin' ), // Section title (Required)
                'fields' => array( // Section fields (Required)

                    /**
                     * Default input examples.
                     */
                    
				   	
					array(
                        'id'          => 'exibir_aviso', // Required
                        'label'       => __( 'Deseja exibir um aviso no Topo do seu Blog?', 'odin' ), // Required
                        'type'        => 'radio', // Required
                        // 'attributes' => array(), // Optional (html input elements)
                        // 'default'    => 'three', // Optional
                        'options' => array( // Required (id => title)
                            'sim'   => 'Sim',
                            'nao'   => 'Não',                            
                        ),
                    ),
                    array(
						'id'          => 'texto_aviso', // Obrigatório
						'label'       => __( 'Texto do Aviso', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite o texto aqui.' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Insira o texto do aviso do topo do seu Blog.', 'odin' ), // Opcional
					),
					array(
						'id'          => 'link_aviso', // Obrigatório
						'label'       => __( 'Link do Botão', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite ou cole o link do botão aqui.' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Insira o link do botão do aviso do topo do seu Blog.', 'odin' ), // Opcional
					),
	
                )
            ),

			// Campos da Aba Redes Sociais 	
			
			'odin_lateral_fields_section' => array( // Slug/ID of the section (Required)
                'tab'   => 'social', // Tab ID/Slug (Required)
                'title' => __( 'Redes Sociais', 'odin' ), // Section title (Required)
                'fields' => array( // Section fields (Required)

                    /**
                     * Default input examples.
                     */
					array(
                        'id'          => 'exibir_social', // Required
                        'label'       => __( 'Exibir Redes Sociais?', 'odin' ), // Required
                        'type'        => 'radio', // Required
                        // 'attributes' => array(), // Optional (html input elements)
                        // 'default'    => 'three', // Optional
                        'options' => array( // Required (id => title)
                            'sim'   => 'Sim', 
                            'nao'   => 'Não',                            
                        ),
                    ),
                    array(
						'id'          => 'titulo', // Obrigatório
						'label'       => __( 'Título', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite o texto aqui.' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Insira o título. Ex: Siga-nos, Redes Sociais.', 'odin' ), // Opcional
					),
					
					array(
						'id'          => 'link_facebook', // Obrigatório
						'label'       => __( 'Link Facebook', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite o link aqui.' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Insira o link do Facebook', 'odin' ), // Opcional
					),
					
					array(
						'id'          => 'link_twitter', // Obrigatório
						'label'       => __( 'Link Twitter', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite o link aqui.' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Insira o link do Twitter', 'odin' ), // Opcional
					),

					array(
						'id'          => 'link_plus', // Obrigatório
						'label'       => __( 'Link Google Plus', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite o link aqui.' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Insira o link do Google Plus', 'odin' ), // Opcional
					),

					array(
						'id'          => 'link_youtube', // Obrigatório
						'label'       => __( 'Link YouTube', 'odin' ), // Obrigatório
						'type'        => 'text', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Digite o link aqui.' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Insira o link do YouTube', 'odin' ), // Opcional
					),	
										
                )
            ),
			
			// Campos da aba Configurações do Rodapé
			
			'odin_rodape_fields_section' => array( // Slug/ID of the section (Required)
                'tab'   => 'rodape', // Tab ID/Slug (Required)
                'title' => __( 'Opções do Rodapé', 'odin' ), // Section title (Required)
                'fields' => array( // Section fields (Required)

                    /**
                     * Default input examples.
                     */                    
                    	
						array(
                        'id'          => 'conteudo_rodape', // Required
                        'label'       => __( 'Rodapé', 'odin' ), // Required
                        'type'        => 'editor', // Required
                        // 'default'     => 'Default text', // Optional
                        'description' => __( 'Insira o conteúdo do Rodapé do seu blog.', 'odin' ), // Optional
                        'options'     => array( // Optional
                            // Arguments of wp_editor().
                            // See more http://codex.wordpress.org/Function_Reference/wp_editor
                            'textarea_rows' => 10
                        ),
                    ),						
					
                )
            ),

			'odin_aviso_fields_section' => array( // Slug/ID of the section (Required)
                'tab'   => 'adsense', // Tab ID/Slug (Required)
                'title' => __( 'Adsense', 'odin' ), // Section title (Required)
                'fields' => array( // Section fields (Required)

                    /**
                     * Default input examples.
                     */ 
					array(
                        'id'          => 'exibir_adsense', // Required
                        'label'       => __( 'Exibir anúncio Adsense?', 'odin' ), // Required
                        'type'        => 'radio', // Required
                        // 'attributes' => array(), // Optional (html input elements)
                        // 'default'    => 'three', // Optional
                        'options' => array( // Required (id => title)
                            'sim'   => 'Sim', 
                            'nao'   => 'Não',                            
                        ),
                    ),
                    array(
						'id'          => 'codigo_adsense', // Obrigatório
						'label'       => __( 'Código Adsense', 'odin' ), // Obrigatório
						'type'        => 'textarea', // Obrigatório
						'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
							'placeholder' => __( 'Coloque o conteúdo aqui...' )
						),
						'default'     => '', // Opcional
						'description' => __( 'Cole aqui o código do anúncio Adsense para ser exibido no seu Blog <small>(978 x 90px recomendado).</small>', 'odin' ), // Opcional
					),					
                )
            ),
			
		
          
        )
    );
}

add_action( 'init', 'odin_theme_settings_example', 1 );


// Shortcodes Widgets
add_filter('widget_text', 'do_shortcode');

function formulario(){	
	include('captura.php');
}
add_shortcode('captura', 'formulario');

//Initialize the update checker.
require 'theme-updates/theme-update-checker.php';
$example_update_checker = new ThemeUpdateChecker(
	'centurio', //Theme folder name, AKA "slug". 
	'http://www.centurio.com.br/updates/info.json' //URL of the metadata file.
);