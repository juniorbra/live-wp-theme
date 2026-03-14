<?php
/**
 * Single para o CPT: Servicos
 */
get_header();
the_post();

$metodologia  = function_exists( 'get_field' ) ? get_field( 'servico_metodologia' )   : '';
$calendly     = function_exists( 'get_field' ) ? get_field( 'servico_link_calendly' ) : '';
$cta_href     = $calendly ?: ALIANCA_WHATSAPP_URL;
?>

<main id="main-content" class="site-main" role="main">

    <!-- Hero -->
    <div class="single-hero">
        <div class="container">
            <nav class="breadcrumb" aria-label="Caminho de navegacao">
                <ol class="breadcrumb__list">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Inicio</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/servicos' ) ); ?>">Servicos</a></li>
                    <li aria-current="page"><?php the_title(); ?></li>
                </ol>
            </nav>
            <h1 class="single-hero__title"><?php the_title(); ?></h1>

        </div>
    </div>

    <?php if ( has_excerpt() ) : ?>
    <div class="archive-intro">
        <div class="container container--narrow">
            <div class="archive-description prose text-center">
                <?php the_excerpt(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="container single-layout">

        <article class="single-content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php if ( has_post_thumbnail() ) : ?>
            <div class="single-featured-image single-featured-image--inline">
                <?php the_post_thumbnail( 'alianca-hero', [ 'loading' => 'eager', 'alt' => get_the_title(), 'class' => 'single-featured-image__img' ] ); ?>
            </div>
            <?php endif; ?>

            <?php if ( $metodologia ) : ?>
            <div class="servico-metodologia">
                <h2 class="servico-metodologia__title">Metodologia</h2>
                <p><?php echo wp_kses_post( $metodologia ); ?></p>
            </div>
            <?php endif; ?>

            <div class="entry-content prose">
                <?php the_content(); ?>
            </div>

            <?php wp_link_pages( [ 'before' => '<nav class="page-links">', 'after' => '</nav>' ] ); ?>

            <!-- CTA Calendly -->
            <div class="single-cta">
                <h3>Precisa deste servico?</h3>
                <p>Agende uma conversa inicial sem compromisso com nosso time.</p>
                <a href="<?php echo esc_url( $cta_href ); ?>" class="btn btn--accent btn--lg" target="_blank" rel="noopener noreferrer">
                    Agendar Consulta Tecnica
                </a>
            </div>

        </article>

        <!-- Sidebar: outros servicos -->
        <aside class="single-sidebar" aria-label="Outros servicos">
            <div class="sidebar-widget">
                <h3 class="sidebar-widget__title">Outros Servicos</h3>
                <?php
                $outros = new WP_Query( [
                    'post_type'      => 'servicos',
                    'posts_per_page' => 7,
                    'post__not_in'   => [ get_the_ID() ],
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                ] );
                if ( $outros->have_posts() ) :
                ?>
                <ul class="sidebar-services-grid">
                    <?php while ( $outros->have_posts() ) : $outros->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" class="sidebar-links__item">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <div class="sidebar-services-grid__img">
                                <?php the_post_thumbnail( 'alianca-thumb' ); ?>
                            </div>
                            <?php endif; ?>
                            <span class="sidebar-services-grid__title"><?php the_title(); ?></span>
                        </a>
                    </li>
                    <?php endwhile; ?>
                </ul>
                <?php wp_reset_postdata(); endif; ?>
            </div>

            <div class="sidebar-widget sidebar-widget--cta">
                <p>Nao sabe qual servico se encaixa no seu caso?</p>
                <a href="<?php echo esc_url( ALIANCA_WHATSAPP_URL ); ?>" class="btn btn--navy" style="width:100%; justify-content: center;" target="_blank" rel="noopener noreferrer">
                    Fale com um Especialista
                </a>
            </div>
        </aside>

    </div>

</main>

<?php get_footer(); ?>
