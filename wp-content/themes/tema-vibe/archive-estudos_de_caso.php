<?php
/**
 * Arquivo de listagem do CPT: Estudos de Caso
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <div class="page-hero">
        <div class="container">
            <span class="section__eyebrow">Resultados Comprovados</span>
            <h1 class="page-hero__title">Estudos de Caso</h1>
            <p class="page-hero__subtitle">
                Cases reais com absoluto sigilo sobre identidades. O que importa sao os metodos e os resultados.
            </p>
        </div>
    </div>

    <!-- Aviso de confidencialidade -->
    <div class="case-confidentiality-banner">
        <div class="container case-confidentiality-banner__inner">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <path d="M10 2a8 8 0 1 0 0 16A8 8 0 0 0 10 2zm0 4a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0 4a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1z" fill="currentColor"/>
            </svg>
            <p>
                Todos os casos sao apresentados de forma anonima em respeito aos nossos clientes.
                Nomes, razoes sociais e dados de identificacao sao preservados integralmente.
            </p>
        </div>
    </div>

    <section class="section" aria-label="Lista de estudos de caso">
        <div class="container">

            <?php if ( have_posts() ) : ?>

                <ul class="cases-archive-grid" role="list">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                        $setor   = function_exists( 'get_field' ) ? get_field( 'case_setor' )              : '';
                        $metrica = function_exists( 'get_field' ) ? get_field( 'case_metrica_destaque' )   : '';
                        $conf    = function_exists( 'get_field' ) ? get_field( 'case_conflito' )            : '';
                    ?>
                    <li class="case-archive-card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="case-archive-card__header">
                            <?php if ( $setor ) : ?>
                            <span class="case-card__tag"><?php echo esc_html( $setor ); ?></span>
                            <?php endif; ?>
                            <?php if ( $metrica ) : ?>
                            <span class="case-archive-card__metric"><?php echo esc_html( $metrica ); ?></span>
                            <?php endif; ?>
                        </div>

                        <h2 class="case-archive-card__title" id="case-<?php the_ID(); ?>">
                            <?php the_title(); ?>
                        </h2>

                        <?php if ( $conf ) : ?>
                        <p class="case-archive-card__excerpt">
                            <?php echo esc_html( wp_trim_words( $conf, 25, '...' ) ); ?>
                        </p>
                        <?php else : ?>
                        <p class="case-archive-card__excerpt"><?php the_excerpt(); ?></p>
                        <?php endif; ?>

                        <div class="case-archive-card__steps">
                            <span class="case-archive-card__step">O Conflito</span>
                            <span class="case-archive-card__arrow" aria-hidden="true">&rarr;</span>
                            <span class="case-archive-card__step">Metodologia</span>
                            <span class="case-archive-card__arrow" aria-hidden="true">&rarr;</span>
                            <span class="case-archive-card__step">O Desfecho</span>
                        </div>

                        <a
                            href="<?php the_permalink(); ?>"
                            class="btn btn--outline btn--sm"
                            aria-labelledby="case-<?php the_ID(); ?>"
                        >
                            Ver o Caso Completo
                        </a>
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
                    <h2>Nenhum estudo de caso publicado ainda.</h2>
                    <p>Entre em contato para conhecer nosso portfolio de resultados de forma confidencial.</p>
                    <a href="<?php echo esc_url( home_url( '/contato' ) ); ?>" class="btn btn--navy">
                        Solicitar Portfolio Confidencial
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </section>

</main>

<?php get_footer(); ?>
