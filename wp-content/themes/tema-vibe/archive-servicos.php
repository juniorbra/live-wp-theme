<?php
/**
 * Arquivo de listagem do CPT: Servicos
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <div class="page-hero">
        <div class="container">
            <span class="section__eyebrow">Areas de Atuacao</span>
            <h1 class="page-hero__title">Nossos Servicos</h1>
            <p class="page-hero__subtitle">
                Expertise multidisciplinar com rigor tecnico-cientifico para os casos de maior complexidade no Brasil.
            </p>
        </div>
    </div>

    <section class="section" aria-label="Lista de servicos">
        <div class="container">

            <?php if ( have_posts() ) : ?>

                <ul class="servicos-grid" role="list">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                        $icone     = function_exists( 'get_field' ) ? get_field( 'servico_icone' ) : '';
                        $calendly  = function_exists( 'get_field' ) ? get_field( 'servico_link_calendly' ) : '';
                    ?>
                    <li class="servico-card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="servico-card__icon" aria-hidden="true">
                            <?php if ( $icone ) : ?>
                                <span class="dashicons <?php echo esc_attr( $icone ); ?>"></span>
                            <?php else : ?>
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <rect x="4" y="4" width="10" height="10" rx="2" fill="currentColor" opacity=".2" stroke="currentColor" stroke-width="1.5"/>
                                    <rect x="18" y="4" width="10" height="10" rx="2" fill="currentColor" opacity=".2" stroke="currentColor" stroke-width="1.5"/>
                                    <rect x="4" y="18" width="10" height="10" rx="2" fill="currentColor" opacity=".2" stroke="currentColor" stroke-width="1.5"/>
                                    <rect x="18" y="18" width="10" height="10" rx="2" fill="currentColor" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            <?php endif; ?>
                        </div>

                        <div class="servico-card__body">
                            <h2 class="servico-card__title" id="servico-<?php the_ID(); ?>">
                                <?php the_title(); ?>
                            </h2>
                            <p class="servico-card__excerpt"><?php the_excerpt(); ?></p>

                            <div class="servico-card__actions">
                                <a
                                    href="<?php the_permalink(); ?>"
                                    class="btn btn--outline btn--sm"
                                    aria-labelledby="servico-<?php the_ID(); ?>"
                                >
                                    Saiba Mais
                                </a>
                                <?php if ( $calendly ) : ?>
                                <a
                                    href="<?php echo esc_url( $calendly ); ?>"
                                    class="btn btn--accent btn--sm"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="Agendar consulta sobre <?php the_title_attribute(); ?>"
                                >
                                    Agendar Consulta
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if ( has_post_thumbnail() ) : ?>
                        <div class="servico-card__image" aria-hidden="true">
                            <?php the_post_thumbnail( 'alianca-thumb', [ 'loading' => 'lazy', 'alt' => '' ] ); ?>
                        </div>
                        <?php endif; ?>
                    </li>
                    <?php endwhile; ?>
                </ul>

                <nav class="archive-pagination" aria-label="Navegacao de paginas">
                    <?php the_posts_pagination( [
                        'mid_size'  => 2,
                        'prev_text' => '&larr; Anterior',
                        'next_text' => 'Proximo &rarr;',
                    ] ); ?>
                </nav>

            <?php else : ?>
                <div class="no-results">
                    <h2>Nenhum servico publicado ainda.</h2>
                    <p>Em breve nossos servicos estarao disponiveis aqui.</p>
                    <a href="<?php echo esc_url( home_url( '/contato' ) ); ?>" class="btn btn--navy">Fale Conosco</a>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- CTA -->
    <section class="cta-band" aria-labelledby="cta-servicos-heading">
        <div class="container cta-band__inner">
            <div class="cta-band__text">
                <h2 class="cta-band__title" id="cta-servicos-heading">Precisa de um parecer tecnico?</h2>
                <p class="cta-band__subtitle">Agende uma consulta inicial sem compromisso com nossos especialistas.</p>
            </div>
            <div class="cta-band__actions">
                <a href="https://calendly.com/alianca-consultoria" class="btn btn--accent btn--lg" target="_blank" rel="noopener noreferrer">
                    Agendar Consulta Tecnica
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
