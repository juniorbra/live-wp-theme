<?php
/**
 * Single para o CPT: Noticias
 */
get_header();
the_post();
?>

<main id="main-content" class="site-main" role="main">

    <!-- Hero -->
    <div class="single-hero">
        <div class="container">
            <nav class="breadcrumb" aria-label="Caminho de navegacao">
                <ol class="breadcrumb__list">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Inicio</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/noticias' ) ); ?>">Noticias</a></li>
                    <li aria-current="page"><?php the_title(); ?></li>
                </ol>
            </nav>
            <h1 class="single-hero__title"><?php the_title(); ?></h1>
            <div class="single-meta">
                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                    <?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?>
                </time>
                <span aria-hidden="true">·</span>
                <span><?php the_author(); ?></span>
            </div>
        </div>
    </div>

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="single-featured-image">
        <div class="container">
            <?php the_post_thumbnail( 'alianca-hero', [ 'loading' => 'eager', 'alt' => get_the_title(), 'class' => 'single-featured-image__img' ] ); ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="container single-layout">

        <article class="single-content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content prose">
                <?php the_content(); ?>
            </div>
            <?php wp_link_pages( [ 'before' => '<nav class="page-links">', 'after' => '</nav>' ] ); ?>
        </article>

        <!-- Sidebar: noticias recentes -->
        <aside class="single-sidebar" aria-label="Outras noticias">
            <div class="sidebar-widget">
                <h3 class="sidebar-widget__title">Noticias Recentes</h3>
                <?php
                $recentes = new WP_Query( [
                    'post_type'      => 'noticias',
                    'posts_per_page' => 4,
                    'post__not_in'   => [ get_the_ID() ],
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ] );
                if ( $recentes->have_posts() ) :
                ?>
                <ul class="sidebar-links">
                    <?php while ( $recentes->have_posts() ) : $recentes->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" class="sidebar-links__item">
                            <time class="sidebar-links__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                <?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?>
                            </time>
                            <span><?php the_title(); ?></span>
                        </a>
                    </li>
                    <?php endwhile; ?>
                </ul>
                <?php wp_reset_postdata(); endif; ?>
                <a href="<?php echo esc_url( home_url( '/noticias' ) ); ?>" class="sidebar-links__all">
                    Ver todas as noticias &rarr;
                </a>
            </div>
        </aside>

    </div>

    <!-- Navegacao anterior/proximo -->
    <div class="container">
        <nav class="single-post-nav" aria-label="Navegacao entre noticias">
            <?php
            $prev = get_previous_post( false, '', '' );
            $next = get_next_post( false, '', '' );
            // Restringir ao mesmo post type
            $prev = ( $prev && get_post_type( $prev ) === 'noticias' ) ? $prev : null;
            $next = ( $next && get_post_type( $next ) === 'noticias' ) ? $next : null;
            ?>
            <?php if ( $prev ) : ?>
            <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="post-nav-link post-nav-link--prev" rel="prev">
                <span class="post-nav-link__label">&larr; Anterior</span>
                <span class="post-nav-link__title"><?php echo esc_html( get_the_title( $prev ) ); ?></span>
            </a>
            <?php endif; ?>
            <?php if ( $next ) : ?>
            <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="post-nav-link post-nav-link--next" rel="next">
                <span class="post-nav-link__label">Proximo &rarr;</span>
                <span class="post-nav-link__title"><?php echo esc_html( get_the_title( $next ) ); ?></span>
            </a>
            <?php endif; ?>
        </nav>
    </div>

</main>

<?php get_footer(); ?>
