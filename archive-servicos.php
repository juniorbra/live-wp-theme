<?php
/**
 * Arquivo de listagem do CPT: Servicos
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <div class="page-hero">
        <div class="container">
            <span class="section__eyebrow">Áreas de Atuação</span>
            <h1 class="page-hero__title">Nossos Serviços</h1>
            <?php
            $hero_subtitle = '';
            if ( function_exists('get_field') ) {
                $front_id      = get_option('page_on_front');
                $hero_subtitle = get_field('hero_subtitle_servicos', $front_id);
            }
            if ( ! $hero_subtitle ) {
                $hero_subtitle = 'Expertise multidisciplinar com rigor técnico-cientifico para os casos de maior complexidade no Brasil.';
            }
            ?>
            <p class="page-hero__subtitle"><?php echo wp_kses_post( $hero_subtitle ); ?></p>
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

            <?php if ( have_posts() ) :
                $servico_icones = [
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6l9-4 9 4v6c0 5-4 9-9 10C7 21 3 17 3 12V6z"/><path d="M9 12l2 2 4-4"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="3" x2="12" y2="21"/><path d="M5 8h4l3-5 3 5h4"/><path d="M5 16h4l3 5 3-5h4"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"/><line x1="12" y1="22" x2="12" y2="15.5"/><polyline points="22 8.5 12 15.5 2 8.5"/></svg>',
                ];
                $i = 0;
            ?>
                <ul class="cards-grid" role="list">
                    <?php while ( have_posts() ) : the_post();
                        $icone_svg = $servico_icones[ $i % count( $servico_icones ) ];
                        $calendly  = function_exists( 'get_field' ) ? get_field( 'servico_link_calendly' ) : '';
                        $i++;
                    ?>
                    <li class="card card--servico" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <?php if ( has_post_thumbnail() ) : ?>
                        <div class="card__image">
                            <?php the_post_thumbnail( 'alianca-card', [ 'loading' => 'lazy', 'alt' => get_the_title() ] ); ?>
                            <div class="card__icon" aria-hidden="true"><?php echo $icone_svg; ?></div>
                        </div>
                        <?php endif; ?>

                        <div class="card__body">
                            <?php if ( ! has_post_thumbnail() ) : ?>
                            <div class="card__icon" aria-hidden="true"><?php echo $icone_svg; ?></div>
                            <?php endif; ?>

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
                    <h2>Nenhum serviço publicado ainda.</h2>
                    <p>Em breve nossos serviços estarao disponiveis aqui.</p>
                    <a href="<?php echo esc_url( home_url( '/contato' ) ); ?>" class="btn btn--navy">Fale Conosco</a>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- CTA -->
    <section class="cta-band" aria-labelledby="cta-servicos-heading">
        <div class="container cta-band__inner">
            <div class="cta-band__text">
                <h2 class="cta-band__title" id="cta-servicos-heading">Precisa de um parecer técnico?</h2>
                <p class="cta-band__subtitle">Agende uma consulta inicial sem compromisso com nossos especialistas.</p>
            </div>
            <div class="cta-band__actions">
                <a href="<?php echo esc_url( home_url( '/contato' ) ); ?>" class="btn btn--accent btn--lg">
                    Agendar Consulta Técnica
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
