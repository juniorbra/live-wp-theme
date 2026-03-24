<footer class="site-footer" role="contentinfo" id="colophon">
    <div class="container">

        <div class="footer-grid">

            <!-- Coluna 1: Marca e descricao -->
            <div class="footer-brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo-link">
                    <img
                        src="<?php echo esc_url( home_url( '/wp-content/uploads/2025/02/logo170-1.png' ) ); ?>"
                        alt="<?php bloginfo( 'name' ); ?>"
                        class="footer-logo"
                        loading="lazy"
                    >
                </a>
                <p class="footer-tagline"><?php bloginfo( 'description' ); ?></p>
                <p class="footer-legal-text">
                    Empresa registrada no CREA/ABNT. Atuação em todo o território nacional.
                </p>
            </div>


            <!-- Coluna 3: Institucional -->
            <div class="footer-col">
                <h3 class="footer-col__title">Institucional</h3>
                <?php
                wp_nav_menu( [
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => 'footer-links',
                    'fallback_cb'    => function() {
                        echo '<ul class="footer-links">
                            <li><a href="' . esc_url( home_url( '/quem-somos' ) ) . '">Quem Somos</a></li>
                            <li><a href="' . esc_url( home_url( '/clientes' ) ) . '">Clientes</a></li>
                            <li><a href="' . esc_url( home_url( '/noticias' ) ) . '">Notícias</a></li>
                            <li><a href="' . esc_url( home_url( '/artigos' ) ) . '">Artigos</a></li>
                        </ul>';
                    },
                ] );
                ?>
            </div>

            <!-- Coluna 4: São Paulo -->
            <div class="footer-col footer-contact">
                <h3 class="footer-col__title">São Paulo</h3>
                <address class="footer-address">
                    <p>Av. Brg. Faria Lima, 3729, 5º andar<br>Itaim Bibi — São Paulo — SP<br>CEP 04538-905</p>
                    <p><a href="tel:+551134436221">+55 (11) 3443-6221</a></p>
                    
                </address>
            </div>

            <!-- Coluna 5: Rio de Janeiro -->
            <div class="footer-col footer-contact">
                <h3 class="footer-col__title">Rio de Janeiro</h3>
                <address class="footer-address">
                    <p>Rua da Assembléia, 58, 6º andar<br>Centro — Rio de Janeiro — RJ<br>CEP 20011-000</p>
                    <p><a href="tel:+552125447444">+55 (21) 2544-7444</a></p>
                    
                </address>
            </div>

        </div><!-- .footer-grid -->

        <div class="footer-bottom">
            <p class="footer-copy">
                &copy; <?php echo esc_html( date( 'Y' ) ); ?>
                <?php bloginfo( 'name' ); ?>.
                <?php esc_html_e( 'Todos os direitos reservados.', 'alianca' ); ?>
            </p>
            <ul class="footer-legal-links">
                <li><a href="<?php echo esc_url( home_url( '/politica-de-privacidade' ) ); ?>">Política de Privacidade / LGPD</a></li>
            </ul>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
