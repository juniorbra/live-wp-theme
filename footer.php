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
                            <li><a href="' . esc_url( home_url( '/artigos-cases' ) ) . '">Artigos</a></li>
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
                        Av. Paulista, 1374 — Sala 1402<br>
                        Bela Vista, Sao Paulo — SP<br>
                        CEP 01310-100
                    </p>
                    <p>
                        <a href="tel:+5511999999999" aria-label="Ligue para Alianca Consultoria">
                            +55 (11) 9 9999-9999
                        </a>
                    </p>
                    <p>
                        <a href="mailto:contato@aliancaconsultoria.com.br" aria-label="Envie um e-mail">
                            contato@aliancaconsultoria.com.br
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
                <li><a href="<?php echo esc_url( home_url( '/politica-de-privacidade' ) ); ?>">Politica de Privacidade</a></li>
                <li><a href="<?php echo esc_url( home_url( '/lgpd' ) ); ?>">LGPD</a></li>
                <li><a href="<?php echo esc_url( home_url( '/termos-de-uso' ) ); ?>">Termos de Uso</a></li>
            </ul>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
