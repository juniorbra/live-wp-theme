<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main-content">
    <?php esc_html_e( 'Ir para o conteudo principal', 'alianca' ); ?>
</a>

<header class="site-header" role="banner" id="masthead">
    <div class="container site-header__inner">

        <!-- Logo / Nome do site -->
        <div class="site-branding">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-name-link" rel="home">
                    <?php bloginfo( 'name' ); ?>
                </a>
            <?php endif; ?>
        </div>

        <!-- Navegacao principal -->
        <nav class="site-nav" id="site-navigation" aria-label="<?php esc_attr_e( 'Menu principal', 'alianca' ); ?>" role="navigation">
            <button
                class="nav-toggle"
                aria-controls="primary-menu"
                aria-expanded="false"
                aria-label="<?php esc_attr_e( 'Abrir menu de navegacao', 'alianca' ); ?>"
            >
                <span class="nav-toggle__bar"></span>
                <span class="nav-toggle__bar"></span>
                <span class="nav-toggle__bar"></span>
                <span class="screen-reader-text"><?php esc_html_e( 'Menu', 'alianca' ); ?></span>
            </button>

            <?php
            wp_nav_menu( [
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'container'      => false,
                'menu_class'     => 'nav-menu',
                'items_wrap'     => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
                'walker'         => new Alianca_Nav_Walker(),
                'fallback_cb'    => function() {
                    echo '<ul class="nav-menu"><li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">Configurar menu</a></li></ul>';
                },
            ] );
            ?>

            <a
                href="<?php echo esc_url( home_url( '/contato' ) ); ?>"
                class="btn btn--accent nav-cta"
                aria-label="<?php esc_attr_e( 'Fale com um Especialista', 'alianca' ); ?>"
            >
                <?php esc_html_e( 'Fale com um Especialista', 'alianca' ); ?>
            </a>
        </nav>

    </div>
</header>
