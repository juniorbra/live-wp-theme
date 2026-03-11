<?php
/**
 * Template para posts individuais (blog, noticias, estudos_de_caso, servicos).
 * Hierarquia: single-{post_type}-{slug}.php > single-{post_type}.php > single.php
 */

get_header();

$post_type = get_post_type();
?>

<main id="main-content" class="site-main" role="main">

    <?php if ( have_posts() ) : the_post(); ?>

    <!-- Cabecalho do post -->
    <div class="single-hero">
        <div class="container single-hero__inner">

            <!-- Breadcrumb simples -->
            <nav class="breadcrumb" aria-label="<?php esc_attr_e( 'Caminho de navegacao', 'alianca' ); ?>">
                <ol class="breadcrumb__list">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Inicio</a></li>
                    <?php if ( $post_type === 'noticias' ) : ?>
                        <li><a href="<?php echo esc_url( home_url( '/noticias' ) ); ?>">Noticias</a></li>
                    <?php elseif ( $post_type === 'estudos_de_caso' ) : ?>
                        <li><a href="<?php echo esc_url( home_url( '/estudos-de-caso' ) ); ?>">Estudos de Caso</a></li>
                    <?php elseif ( $post_type === 'servicos' ) : ?>
                        <li><a href="<?php echo esc_url( home_url( '/servicos' ) ); ?>">Servicos</a></li>
                    <?php else : ?>
                        <li><a href="<?php echo esc_url( home_url( '/artigos' ) ); ?>">Artigos</a></li>
                    <?php endif; ?>
                    <li aria-current="page"><?php the_title(); ?></li>
                </ol>
            </nav>

            <h1 class="single-hero__title"><?php the_title(); ?></h1>

            <?php if ( $post_type === 'post' || $post_type === 'noticias' ) : ?>
            <div class="single-meta">
                <time class="single-meta__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                    <?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?>
                </time>
                <?php if ( $post_type === 'post' ) : ?>
                    <span class="single-meta__sep" aria-hidden="true">·</span>
                    <span class="single-meta__author"><?php the_author(); ?></span>
                    <?php
                    $cats = get_the_category();
                    if ( $cats ) :
                    ?>
                    <span class="single-meta__sep" aria-hidden="true">·</span>
                    <span class="single-meta__cat"><?php echo esc_html( $cats[0]->name ); ?></span>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- Imagem destacada -->
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="single-featured-image">
        <div class="container">
            <?php the_post_thumbnail( 'alianca-hero', [
                'loading' => 'eager',
                'alt'     => get_the_title(),
                'class'   => 'single-featured-image__img',
            ] ); ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Corpo do conteudo -->
    <div class="container single-layout">

        <article class="single-content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php
            // Campos ACF para Estudos de Caso
            if ( $post_type === 'estudos_de_caso' && function_exists( 'get_field' ) ) :
                $conflito     = get_field( 'case_conflito' );
                $metodologia  = get_field( 'case_metodologia' );
                $resultado    = get_field( 'case_resultado' );
                $metrica      = get_field( 'case_metrica_destaque' );
                $setor        = get_field( 'case_setor' );
            ?>
            <div class="case-detail">
                <?php if ( $setor ) : ?>
                    <span class="case-card__tag"><?php echo esc_html( $setor ); ?></span>
                <?php endif; ?>

                <?php if ( $conflito ) : ?>
                <div class="case-step">
                    <h2 class="case-step__label">O Conflito</h2>
                    <p><?php echo wp_kses_post( $conflito ); ?></p>
                </div>
                <?php endif; ?>

                <?php if ( $metodologia ) : ?>
                <div class="case-step">
                    <h2 class="case-step__label">A Investigacao / Metodologia</h2>
                    <p><?php echo wp_kses_post( $metodologia ); ?></p>
                </div>
                <?php endif; ?>

                <?php if ( $resultado ) : ?>
                <div class="case-step">
                    <h2 class="case-step__label">O Desfecho</h2>
                    <p><?php echo wp_kses_post( $resultado ); ?></p>
                </div>
                <?php endif; ?>

                <?php if ( $metrica ) : ?>
                <div class="case-metric-highlight" aria-label="Metrica de destaque">
                    <?php echo esc_html( $metrica ); ?>
                </div>
                <?php endif; ?>
            </div>
            <?php
            endif;

            // Campos ACF para Servicos
            if ( $post_type === 'servicos' && function_exists( 'get_field' ) ) :
                $metodologia   = get_field( 'servico_metodologia' );
                $calendly_link = get_field( 'servico_link_calendly' );
            ?>
            <?php if ( $metodologia ) : ?>
            <div class="servico-metodologia">
                <h2>Metodologia</h2>
                <p><?php echo wp_kses_post( $metodologia ); ?></p>
            </div>
            <?php endif; ?>
            <?php endif; ?>

            <div class="entry-content prose">
                <?php the_content(); ?>
            </div>

            <?php
            wp_link_pages( [
                'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Paginas do artigo', 'alianca' ) . '">',
                'after'  => '</nav>',
            ] );

            // CTA Calendly para servicos
            if ( $post_type === 'servicos' ) :
                $calendly = function_exists( 'get_field' ) ? get_field( 'servico_link_calendly' ) : '';
                $href = $calendly ?: 'https://calendly.com/alianca-consultoria';
            ?>
            <div class="single-cta">
                <h3>Interessado neste servico?</h3>
                <p>Agende uma consulta tecnica diretamente com nossos especialistas.</p>
                <a href="<?php echo esc_url( $href ); ?>" class="btn btn--accent btn--lg" target="_blank" rel="noopener noreferrer">
                    Agendar Consulta Tecnica
                </a>
            </div>
            <?php endif; ?>

        </article>

        <!-- Sidebar / navegacao entre posts -->
        <aside class="single-sidebar" aria-label="<?php esc_attr_e( 'Navegacao entre posts', 'alianca' ); ?>">
            <nav class="post-navigation" aria-label="<?php esc_attr_e( 'Posts anterior e proximo', 'alianca' ); ?>">
                <?php
                $prev = get_previous_post();
                $next = get_next_post();
                if ( $prev ) :
                ?>
                <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="post-nav-link post-nav-link--prev" rel="prev">
                    <span class="post-nav-link__label">Anterior</span>
                    <span class="post-nav-link__title"><?php echo esc_html( get_the_title( $prev ) ); ?></span>
                </a>
                <?php endif; if ( $next ) : ?>
                <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="post-nav-link post-nav-link--next" rel="next">
                    <span class="post-nav-link__label">Proximo</span>
                    <span class="post-nav-link__title"><?php echo esc_html( get_the_title( $next ) ); ?></span>
                </a>
                <?php endif; ?>
            </nav>
        </aside>

    </div><!-- .single-layout -->

    <?php endif; // have_posts() ?>

</main>

<?php get_footer(); ?>
