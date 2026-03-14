<footer class="site-footer" role="contentinfo" id="colophon">
    <div class="container">

        <div class="footer-grid">

            <!-- Coluna 1: Marca e descricao -->
            <div class="footer-brand">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <p class="footer-site-name"><?php bloginfo( 'name' ); ?></p>
                <?php endif; ?>
                <p class="footer-tagline"><?php bloginfo( 'description' ); ?></p>
                <p class="footer-legal-text">
                    Empresa registrada no CREA/ABNT. Atuacao em todo o territorio nacional.
                </p>
            </div>

            <!-- Coluna 2: Servicos (links rapidos) -->
            <div class="footer-col">
                <h3 class="footer-col__title">Servicos</h3>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url( home_url( '/servicos/pareceres-economia-atuaria' ) ); ?>">Pareceres de Economia e Atuaria</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/servicos/pareceres-engenharia' ) ); ?>">Pareceres de Engenharia</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/servicos/assistencia-tecnica-judicial' ) ); ?>">Assistencia Tecnica Judicial</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/servicos/equilibrio-economico-financeiro' ) ); ?>">Analise de Equilibrio Economico-financeiro</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/servicos/gerenciamento-de-obras' ) ); ?>">Gerenciamento de Obras</a></li>
                </ul>
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
                            <li><a href="' . esc_url( home_url( '/noticias' ) ) . '">Noticias</a></li>
                            <li><a href="' . esc_url( home_url( '/artigos' ) ) . '">Artigos</a></li>
                        </ul>';
                    },
                ] );
                ?>
            </div>

            <!-- Coluna 4: Contato -->
            <div class="footer-col footer-contact">
                <h3 class="footer-col__title">Contato</h3>
                <address class="footer-address">
                    <p>
                        <span class="screen-reader-text">Endereco: </span>
                        <?php echo get_field('contato_endereco_1', 'page_on_front') ?: 'Av. Faria Lima, 3729 — Itaim Bibi<br>Sao Paulo — SP<br>CEP 04538-905'; ?>
                    </p>
                    <p>
                        <?php if($tel = get_field('contato_telefone_1', 'page_on_front')): ?>
                            <a href="tel:<?php echo preg_replace('/\D/', '', $tel); ?>" aria-label="Ligue para Alianca Consultoria">
                                <?php echo esc_html($tel); ?>
                            </a>
                        <?php else: ?>
                            <a href="tel:+551134436221" aria-label="Ligue para Alianca Consultoria">
                                +55 (11) 3443-6221
                            </a>
                        <?php endif; ?>
                    </p>
                    <p>
                        <a href="mailto:<?php echo get_field('contato_email', 'page_on_front') ?: 'comercial@aliancaengenharia.com.br'; ?>" aria-label="Envie um e-mail">
                            <?php echo get_field('contato_email', 'page_on_front') ?: 'comercial@aliancaengenharia.com.br'; ?>
                        </a>
                    </p>
                </address>
                <a
                    href="<?php echo esc_url( home_url( '/contato' ) ); ?>"
                    class="btn btn--outline footer-cta-btn"
                >
                    <?php esc_html_e( 'Agendar Consulta', 'alianca' ); ?>
                </a>
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
