<?php
/**
 * Arquivo de listagem do CPT: Noticias
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <div class="page-hero">
        <div class="container">
            <span class="section__eyebrow">Notícias e Eventos</span>
            <h1 class="page-hero__title">Notícias</h1>
            <p class="page-hero__subtitle">
                Ações sociais, palestras, eventos corporativos e iniciativas da Aliança Consultoria.
            </p>
        </div>
    </div>

    <section class="section" aria-label="Lista de notícias">
        <div class="container">

            <?php if ( have_posts() ) : ?>

                <!-- Post em destaque (primeiro da lista) -->
                <?php
                the_post();
                $featured_id = get_the_ID();
                ?>
                <article class="noticia-featured" id="post-<?php echo $featured_id; ?>" <?php post_class(); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="noticia-featured__image">
                        <?php the_post_thumbnail( 'alianca-hero', [
                            'loading' => 'eager',
                            'alt'     => get_the_title(),
                        ] ); ?>
                    </div>
                    <?php endif; ?>
                    <div class="noticia-featured__body">
                        <time class="noticia-featured__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                            <?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?>
                        </time>
                        <h2 class="noticia-featured__title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <p class="noticia-featured__excerpt"><?php the_excerpt(); ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn btn--navy">
                            Ler Notícia Completa
                        </a>
                    </div>
                </article>

                <!-- Demais noticias em grid -->
                <?php if ( have_posts() ) : ?>
                <ul class="noticias-grid" role="list" aria-label="Demais notícias">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <li class="noticia-card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                        <div class="noticia-card__image">
                            <?php the_post_thumbnail( 'alianca-card', [
                                'loading' => 'lazy',
                                'alt'     => get_the_title(),
                            ] ); ?>
                        </div>
                        <?php endif; ?>
                        <div class="noticia-card__body">
                            <time class="noticia-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                <?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?>
                            </time>
                            <h2 class="noticia-card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="noticia-card__excerpt"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="noticia-card__link" aria-label="Ler: <?php the_title_attribute(); ?>">
                                Ler mais &rarr;
                            </a>
                        </div>
                    </li>
                    <?php endwhile; ?>
                </ul>
                <?php endif; ?>

                <nav class="archive-pagination" aria-label="Navegação de páginas">
                    <?php the_posts_pagination( [
                        'mid_size'  => 2,
                        'prev_text' => '&larr; Anterior',
                        'next_text' => 'Próximo &rarr;',
                    ] ); ?>
                </nav>

            <?php else : ?>
                <div class="no-results">
                    <h2>Nenhuma notícia publicada ainda.</h2>
                    <p>Acompanhe nossas redes sociais para novidades.</p>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--navy">Voltar ao Início</a>
                </div>
            <?php endif; ?>

        </div>
    </section>

</main>

<?php get_footer(); ?>
