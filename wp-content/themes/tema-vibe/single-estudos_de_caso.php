<?php
/**
 * Single para o CPT: Estudos de Caso
 * Layout: O Conflito -> A Investigacao/Metodologia -> O Desfecho
 */
get_header();
the_post();

$setor       = function_exists( 'get_field' ) ? get_field( 'case_setor' )            : '';
$conflito    = function_exists( 'get_field' ) ? get_field( 'case_conflito' )          : '';
$metodologia = function_exists( 'get_field' ) ? get_field( 'case_metodologia' )       : '';
$resultado   = function_exists( 'get_field' ) ? get_field( 'case_resultado' )          : '';
$metrica     = function_exists( 'get_field' ) ? get_field( 'case_metrica_destaque' )  : '';
?>

<main id="main-content" class="site-main" role="main">

    <!-- Hero -->
    <div class="single-hero">
        <div class="container">
            <nav class="breadcrumb" aria-label="Caminho de navegacao">
                <ol class="breadcrumb__list">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Inicio</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/estudos-de-caso' ) ); ?>">Estudos de Caso</a></li>
                    <li aria-current="page"><?php the_title(); ?></li>
                </ol>
            </nav>

            <?php if ( $setor ) : ?>
            <span class="case-hero-tag"><?php echo esc_html( $setor ); ?></span>
            <?php endif; ?>

            <h1 class="single-hero__title"><?php the_title(); ?></h1>

            <p class="single-hero__disclaimer">
                Este caso e apresentado de forma anonima. Identidades, razoes sociais e dados de identificacao sao preservados integralmente.
            </p>
        </div>
    </div>

    <!-- Metrica em destaque (above the fold) -->
    <?php if ( $metrica ) : ?>
    <div class="case-metric-banner" aria-label="Resultado principal do caso">
        <div class="container case-metric-banner__inner">
            <p class="case-metric-banner__label">Resultado do Caso</p>
            <p class="case-metric-banner__value"><?php echo esc_html( $metrica ); ?></p>
        </div>
    </div>
    <?php endif; ?>

    <div class="container case-single-layout">

        <!-- Conteudo principal: tres etapas -->
        <article class="case-single-content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <!-- Etapa 1: O Conflito -->
            <?php if ( $conflito ) : ?>
            <div class="case-stage" id="o-conflito">
                <div class="case-stage__number" aria-hidden="true">01</div>
                <div class="case-stage__body">
                    <h2 class="case-stage__title">O Conflito</h2>
                    <div class="case-stage__text prose">
                        <?php echo wp_kses_post( wpautop( $conflito ) ); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Etapa 2: Investigacao / Metodologia -->
            <?php if ( $metodologia ) : ?>
            <div class="case-stage case-stage--alt" id="a-metodologia">
                <div class="case-stage__number" aria-hidden="true">02</div>
                <div class="case-stage__body">
                    <h2 class="case-stage__title">A Investigacao / Metodologia</h2>
                    <div class="case-stage__text prose">
                        <?php echo wp_kses_post( wpautop( $metodologia ) ); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Etapa 3: O Desfecho -->
            <?php if ( $resultado ) : ?>
            <div class="case-stage case-stage--desfecho" id="o-desfecho">
                <div class="case-stage__number" aria-hidden="true">03</div>
                <div class="case-stage__body">
                    <h2 class="case-stage__title">O Desfecho</h2>
                    <div class="case-stage__text prose">
                        <?php echo wp_kses_post( wpautop( $resultado ) ); ?>
                    </div>
                    <?php if ( $metrica ) : ?>
                    <div class="case-metric-inline">
                        <span class="case-metric-inline__label">Resultado comprovado:</span>
                        <span class="case-metric-inline__value"><?php echo esc_html( $metrica ); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Conteudo adicional do editor -->
            <?php if ( get_the_content() ) : ?>
            <div class="entry-content prose" style="margin-top: var(--space-12);">
                <?php the_content(); ?>
            </div>
            <?php endif; ?>

            <!-- CTA final -->
            <div class="single-cta">
                <h3>Tem um caso semelhante?</h3>
                <p>Nossa equipe pode construir a argumentacao tecnica necessaria para o seu litigio.</p>
                <a href="https://calendly.com/alianca-consultoria" class="btn btn--accent btn--lg" target="_blank" rel="noopener noreferrer">
                    Agendar Consulta Tecnica
                </a>
            </div>

        </article>

        <!-- Sidebar: indice e outros cases -->
        <aside class="single-sidebar" aria-label="Indice do caso e outros casos">

            <!-- Indice de etapas -->
            <div class="sidebar-widget">
                <h3 class="sidebar-widget__title">Neste Caso</h3>
                <nav aria-label="Secoes do caso">
                    <ul class="case-index">
                        <?php if ( $conflito ) : ?>
                        <li><a href="#o-conflito" class="case-index__link">01 — O Conflito</a></li>
                        <?php endif; ?>
                        <?php if ( $metodologia ) : ?>
                        <li><a href="#a-metodologia" class="case-index__link">02 — A Metodologia</a></li>
                        <?php endif; ?>
                        <?php if ( $resultado ) : ?>
                        <li><a href="#o-desfecho" class="case-index__link">03 — O Desfecho</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>

            <!-- Outros cases -->
            <div class="sidebar-widget">
                <h3 class="sidebar-widget__title">Outros Casos</h3>
                <?php
                $outros = new WP_Query( [
                    'post_type'      => 'estudos_de_caso',
                    'posts_per_page' => 3,
                    'post__not_in'   => [ get_the_ID() ],
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ] );
                if ( $outros->have_posts() ) :
                ?>
                <ul class="sidebar-links">
                    <?php while ( $outros->have_posts() ) : $outros->the_post();
                        $s = function_exists( 'get_field' ) ? get_field( 'case_setor' ) : '';
                    ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" class="sidebar-links__item">
                            <?php if ( $s ) : ?>
                            <span class="sidebar-links__tag"><?php echo esc_html( $s ); ?></span>
                            <?php endif; ?>
                            <span><?php the_title(); ?></span>
                        </a>
                    </li>
                    <?php endwhile; ?>
                </ul>
                <?php wp_reset_postdata(); endif; ?>
                <a href="<?php echo esc_url( home_url( '/estudos-de-caso' ) ); ?>" class="sidebar-links__all">
                    Ver todos os casos &rarr;
                </a>
            </div>

            <!-- Caixa de sigilo -->
            <div class="sidebar-widget sidebar-widget--confidential">
                <p class="sidebar-confidential__text">
                    Todos os nossos cases sao anonimizados. Seu caso tambem sera tratado com total confidencialidade.
                </p>
            </div>

        </aside>

    </div>

</main>

<?php get_footer(); ?>
