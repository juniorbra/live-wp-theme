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

    <?php 
    $desc = '';
    if ( function_exists('get_field') ) {
        $front_id = get_option('page_on_front');
        $desc = get_field('desc_archive_servicos', $front_id);
    }
    if ( ! $desc ) {
        $desc = get_the_archive_description();
    }
    
    if ( $desc ) : 
    ?>
    <div class="archive-intro pb-0">
        <div class="container container--narrow">
            <div class="archive-description prose text-center">
                <?php echo $desc; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <section class="section pt-0" aria-label="Lista de servicos">
        <div class="container">

            <?php if ( have_posts() ) : ?>

                <ul class="cards-grid" role="list">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                        $icone     = function_exists( 'get_field' ) ? get_field( 'servico_icone' ) : '';
                        $calendly  = function_exists( 'get_field' ) ? get_field( 'servico_link_calendly' ) : '';
                    ?>
                    <li class="card card--servico" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        
                        <?php if ( has_post_thumbnail() ) : ?>
                        <div class="card__image">
                            <?php the_post_thumbnail( 'alianca-card', [ 'loading' => 'lazy', 'alt' => get_the_title() ] ); ?>
                        </div>
                        <?php endif; ?>

                        <div class="card__body">
                            <div class="servico-card__icon-header">
                                <?php if ( $icone ) : ?>
                                    <span class="dashicons <?php echo esc_attr( $icone ); ?>"></span>
                                <?php endif; ?>
                            </div>

                            <h2 class="card__title" id="servico-title-<?php the_ID(); ?>">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <p class="card__excerpt"><?php the_excerpt(); ?></p>

                            <div class="card__actions">
                                <a
                                    href="<?php the_permalink(); ?>"
                                    class="btn btn--outline btn--sm"
                                    aria-labelledby="servico-title-<?php the_ID(); ?>"
                                >
                                    Saiba Mais
                                </a>
                                <?php if ( $calendly ) : ?>
                                <a
                                    href="<?php echo esc_url( $calendly ); ?>"
                                    class="btn btn--accent btn--sm"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    Agendar
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
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
