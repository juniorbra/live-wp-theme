<?php
/**
 * Template para pagina 404 — nao encontrado.
 */

get_header();
?>

<main id="main-content" class="site-main" role="main">

    <section class="error-404 section" aria-labelledby="error-heading">
        <div class="container error-404__inner">

            <div class="error-404__code" aria-hidden="true">404</div>

            <h1 class="error-404__title" id="error-heading">
                Pagina nao encontrada
            </h1>
            <p class="error-404__text">
                O endereco que voce tentou acessar nao existe ou foi movido. Utilize a busca abaixo ou navegue pelos nossos servicos.
            </p>

            <div class="error-404__search">
                <?php get_search_form(); ?>
            </div>

            <div class="error-404__links">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--navy">
                    Voltar para o Inicio
                </a>
                <a href="<?php echo esc_url( home_url( '/servicos' ) ); ?>" class="btn btn--outline">
                    Ver Nossos Servicos
                </a>
                <a href="<?php echo esc_url( home_url( '/contato' ) ); ?>" class="btn btn--outline">
                    Fale Conosco
                </a>
            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>
