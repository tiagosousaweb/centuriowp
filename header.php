<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till #main div
 *
 * @package Odin
 * @since 2.2.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto' type='text/css'>
	
	<!-- Código para chamar meu css personalizado | Tiago Sousa -->
	<link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/assets/css/customizado.css' type='text/css'>
	
	<link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/assets/css/animate.css' type='text/css'>


	<?php $favicon = get_option( 'geral' ); ?>
	<link rel="icon" href="<?php echo $favicon['favicon']; ?>" />
	
</head>

<?php $aparencia = get_option( 'cores' ); ?>
<style>
	body{
		background: <?php echo $aparencia['fundo_blog']; ?>;
	}
	.navbar-nav li{
		background: <?php echo $aparencia['cor_menu']; ?>;
	}
	.navbar-default .navbar-nav>li>a{
		color: <?php echo $aparencia['cor_letra_menu']; ?>;
	}
	.navbar-default .navbar-nav>.active>a{
		color: <?php echo $aparencia['cor_letra_menu']; ?>;
	}
	.navbar-nav li:hover{
		background: <?php echo $aparencia['cor_menu_hover']; ?>;		
	}
	#header .dropdown-menu> li > a
		background: <?php echo $aparencia['cor_menu']; ?>;
	}	
	.resumo-artigo h2 a:hover{
		color: <?php echo $aparencia['cor_titulo_hover']; ?>;
	}
	a.more-link{
		background: <?php echo $aparencia['cor_ler_mais']; ?>;
	}
	.widgettitle{
		background: <?php echo $aparencia['cor_titulo_widget']; ?>;
		color: <?php echo $aparencia['cor_letra_titulo_widget']; ?>;
	}	
	aside.widget{	
		border-bottom: 5px solid <?php echo $aparencia['cor_titulo_widget']; ?>;
	}
	.resumo-artigo img:hover{
		box-shadow: 0 0 0 3px <?php echo $aparencia['cor_titulo']; ?>;
		transition: 0.1s;
	}	
	h1.entry-title a{
		color: <?php echo $aparencia['cor_titulo']; ?>;
	}
	.wpp-list li {
		background: <?php echo $aparencia['fundo_rodape']; ?>;
	}
</style>

<?php $aviso = get_option( 'aviso' ); ?>
<?php $confirma_aviso = $aviso['exibir_aviso']; ?>

<?php if ( $confirma_aviso == 'sim' ) { ?>
	<div id="aviso" class="alert alert-info animated zoomInDown">    
		<button type="button" class="close" data-dismiss="alert">×</button>
		<p align="center"><?php echo $aviso['texto_aviso']; ?></strong> <a href="<?php echo $aviso['link_aviso']; ?>" target="_blank"><span class="label label-default"> Saiba Mais → </span></a></p>
    </div>
<?php } ?>	

<body <?php body_class(); ?>>
	
		<header id="header" role="banner">
			<div class="container">
					<div id="logo" class="col-md-4">
					
						<?php $exibe_logotipo = get_option( 'geral' ); ?>
						<?php if ($exibe_logotipo['logotipo'] != null){ ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php $image = wp_get_attachment_image_src($exibe_logotipo['logotipo'], 'full'); echo $image[0]; ?>" height="<?php esc_attr_e( $header_image->height ); ?>" width="<?php esc_attr_e( $header_image->width ); ?>" title="<?php bloginfo ('name'); ?> - <?php bloginfo ('description'); ?>" /></a>						
						<?php } else { ?>
							<h1 id="titulo"> <a href="<?php echo bloginfo('home'); ?>"><?php echo bloginfo('title'); ?> </a></h1>
							<?php }?>
					</div>	

					<div id="menu" class="col-md-8 menu centered">
				
						<nav id="main-navigation" class="navbar navbar-default" role="navigation">
							<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'odin' ); ?>"><?php _e( 'Skip to content', 'odin' ); ?></a>
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-navigation">
								<span class="sr-only"><?php _e( 'Toggle navigation', 'odin' ); ?></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<?php /*

								<a class="navbar-brand" href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>

								*/ ?>
							</div>

							<div class="collapse navbar-collapse navbar-main-navigation">
								<?php
									wp_nav_menu(
										array(
											'theme_location' => 'main-menu',
											'depth'          => 2,
											'container'      => false,
											'menu_class'     => 'nav navbar-nav',
											'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
											'walker'         => new Odin_Bootstrap_Nav_Walker()
										)
									);
								?>

								
							</div><!-- .navbar-collapse -->
						</nav><!-- #main-menu -->
				

					</div> <!-- Menu -->
			</div> <!-- Container -->
			
		</header><!-- #header -->

				<?php $email_marketing = get_option( 'email_marketing' ); ?> <!-- Carrega a aba email_marketing -->
				<style>
					#email-marketing{
						background: <?php echo $aparencia['fundo_caixa']; ?>;
					}
				</style>
				
			<?php $confirma_caixa = $email_marketing['exibir_caixa']; ?>

			<?php if ( $confirma_caixa == 'sim' ) { ?>
			
			<div id="email-marketing">
				<div class="container">
					<div class="row">

						<div id="texto-chamada" class="col-md-5 animated bounceInLeft">
							<h2><?php echo $email_marketing['chamada']; ?></h2>
						</div>
						
						<?php $icone = $email_marketing['icone_caixa'] ?>
						<div id="icone-caixa" class="col-md-3 animated zoomIn">
							<?php if (!$icone) {?>
								<img src="<?php echo get_template_directory_uri() ?>/icones/hand-o-right.png">
							<?php } else{?>
								<img src="<?php $image = wp_get_attachment_image_src($email_marketing['icone_caixa'], 'full'); echo $image[0]; ?>" style="max-width: 100%;">
							<?php }?>
						</div>
						
						<?php $seta = $email_marketing['seta_caixa'] ?>
						<div id="texto-email" class="col-md-4 centro animated bounceInRight">
							<h3><?php echo $email_marketing['texto_email']; ?></h3>
							
							<?php if (!$seta) {?>
								<img src="<?php echo get_template_directory_uri() ?>/icones/long-arrow-down.png">
							<?php } else{?>
								<img src="<?php $image = wp_get_attachment_image_src($email_marketing['seta_caixa'], 'full'); echo $image[0]; ?>" style="max-width: 100%;">
							<?php }?>
						</div>				
					</div> <!-- row -->

						
					
						<div id="formulario" class="row">						
							<div class="col-md-4">						
							<p id="texto-spam"><?php echo $email_marketing['texto_spam']; ?></p>
							</div>

							<div class="col-md-8">
								<div id="campo-email">	
									<form method="POST" action="<?php echo $email_marketing['action']; ?>" target="new">					
									<input type="email" name="<?php echo $email_marketing['name_email']; ?>" placeholder="<?php echo $email_marketing['texto_campo_email']; ?>" class="form-control input-md" required>
									<input type="hidden" name="<?php echo $email_marketing['nome_input_extra_01']; ?>" value="<?php echo $email_marketing['valor_input_extra_01']; ?>">									
									<input type="hidden" name="<?php echo $email_marketing['nome_input_extra_02']; ?>" value="<?php echo $email_marketing['valor_input_extra_02']; ?>">									
									<input type="hidden" name="<?php echo $email_marketing['nome_input_extra_03']; ?>" value="<?php echo $email_marketing['valor_input_extra_03']; ?>">									
									<input type="hidden" name="<?php echo $email_marketing['nome_input_extra_04']; ?>" value="<?php echo $email_marketing['valor_input_extra_04']; ?>">									
								</div>

								<div id="inscrever">						
									<button type="submit" class="btn btn-danger" id="botao-enviar"><?php echo $email_marketing['texto_botao']; ?></button>				
									</form>
								</div>

						    </div>
						</div> <!-- Formulário -->
				</div>
			</div> <!-- email marketing --> <?php } ?>
				
			<?php $aba_adsense = get_option( 'adsense' ); ?> <!-- Carrega as opções aba adsense -->
			<?php $confirma_adsense = $aba_adsense['exibir_adsense']; ?>

			<?php if ( $confirma_adsense == 'sim' ) { ?>

				<div id="adsense_links" class="container">
					<?php echo $aba_adsense['codigo_adsense']; ?>
				</div>

			<?php } ?>	

<div class="container">

<div id="main" class="site-main row">