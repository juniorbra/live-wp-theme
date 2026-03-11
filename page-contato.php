<?php
/**
 * Template Name: Contato
 * Template para a pagina /contato com layout estruturado.
 */

get_header();
?>

<main id="main-content" class="site-main" role="main">

    <!-- Hero -->
    <div class="page-hero">
        <div class="container">
            <p class="section__eyebrow">Fale Conosco</p>
            <h1 class="page-hero__title">Contato</h1>
            <p class="page-hero__subtitle">
                Entre em contato com nossa equipe. Respondemos em ate 24 horas uteis.
            </p>
        </div>
    </div>

    <!-- Grid principal: escritorios + formulario -->
    <section class="section">
        <div class="container contato-layout">

            <!-- Coluna esquerda: escritorios -->
            <div class="contato-info">

                <h2 class="contato-info__title">Nossos Escritorios</h2>

                <div class="escritorio">
                    <h3 class="escritorio__cidade">Rio de Janeiro</h3>
                    <address class="escritorio__address">
                        <p>Rua da Assembléia, 58, 6º andar<br>
                        Centro — Rio de Janeiro — RJ<br>
                        CEP 20011-000</p>
                        <p>
                            <a href="tel:+552125447444" class="escritorio__tel">+55 (21) 2544-7444</a>
                            <span aria-hidden="true"> | </span>
                            <a href="tel:+552135297484" class="escritorio__tel">3529-7484</a>
                        </p>
                        <p>
                            <a href="mailto:comercial@aliancapericias.com.br" class="escritorio__email">
                                comercial@aliancapericias.com.br
                            </a>
                        </p>
                    </address>
                </div>

                <div class="escritorio">
                    <h3 class="escritorio__cidade">São Paulo</h3>
                    <address class="escritorio__address">
                        <p>Av. Brg. Faria Lima, 3729, 5º andar<br>
                        Itaim Bibi — São Paulo — SP<br>
                        CEP 04538-905</p>
                        <p>
                            <a href="tel:+551134436221" class="escritorio__tel">+55 (11) 3443-6221</a>
                        </p>
                        <p>
                            <a href="mailto:comercial@aliancapericias.com.br" class="escritorio__email">
                                comercial@aliancapericias.com.br
                            </a>
                        </p>
                    </address>
                </div>

                <!-- CTA Calendly -->
                <div class="contato-calendly">
                    <p class="contato-calendly__label">Prefere agendar diretamente?</p>
                    <a
                        href="https://calendly.com/alianca-consultoria"
                        class="btn btn--accent"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        Agendar Consulta Tecnica
                    </a>
                </div>

            </div>

            <!-- Coluna direita: formulario ou conteudo do editor -->
            <div class="contato-form-wrap">
                <?php if ( have_posts() ) : the_post(); ?>
                    <?php if ( get_the_content() ) : ?>
                        <div class="entry-content prose">
                            <?php the_content(); ?>
                        </div>
                    <?php else : ?>
                        <?php get_search_form(); // fallback ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>
