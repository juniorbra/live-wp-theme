<?php
/**
 * Template para o arquivo de posts (blog/artigos).
 * Usado quando em Configuracoes > Leitura uma pagina for definida como "Pagina de posts".
 * WordPress usa este arquivo automaticamente nesse caso.
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <div class="page-hero">
        <div class="container">
            <span class="section__eyebrow">Conhecimento em Acao</span>
            <h1 class="page-hero__title">Artigos</h1>
            <p class="page-hero__subtitle">
                Reflexoes tecnicas, analises de mercado e producao academica dos nossos especialistas.
            </p>
        </div>
    </div>

    <section class="section" aria-label="Lista de artigos">
        <div class="container">

            <?php if ( have_posts() ) : ?>

                <?php
                // Primeiro post em destaque
                the_post();
                ?>
                <article class="noticia-featured" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="noticia-featured__image">
                        <?php the_post_thumbnail( 'alianca-hero', [
                            'loading' => 'eager',
                            'alt'     => get_the_title(),
                        ] ); ?>
                    </div>
                    <?php endif; ?>
                    <div class="noticia-featured__body">
                        <div class="noticia-featured__meta">
                            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                <?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?>
                            </time>
                            <?php
                            $cats = get_the_category();
                            if ( $cats ) :
                            ?>
                            <span aria-hidden="true">·</span>
                            <a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>">
                                <?php echo esc_html( $cats[0]->name ); ?>
                            </a>
                            <?php endif; ?>
                        </div>
                        <h2 class="noticia-featured__title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <p class="noticia-featured__excerpt"><?php the_excerpt(); ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn btn--navy">
                            Ler Artigo Completo
                        </a>
                    </div>
                </article>

                <!-- Demais artigos em grid -->
                <?php if ( have_posts() ) : ?>
                <ul class="noticias-grid" role="list" style="margin-top: var(--space-10);">
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
                            <div class="noticia-card__meta">
                                <time class="noticia-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                    <?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?>
                                </time>
                                <?php
                                $cats = get_the_category();
                                if ( $cats ) :
                                ?>
                                <span class="noticia-card__cat">
                                    <?php echo esc_html( $cats[0]->name ); ?>
                                </span>
                                <?php endif; ?>
                            </div>
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

                <nav class="archive-pagination" aria-label="Navegacao de artigos">
                    <?php the_posts_pagination( [
                        'mid_size'  => 2,
                        'prev_text' => '&larr; Anterior',
                        'next_text' => 'Proximo &rarr;',
                    ] ); ?>
                </nav>

            <?php else : ?>
                <div class="no-results">
                    <h2>Nenhum artigo publicado ainda.</h2>
                    <p>Em breve publicaremos conteudo tecnico dos nossos especialistas.</p>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--navy">Voltar ao Inicio</a>
                </div>
            <?php endif; ?>

        </div>
    </section>

</main>

<?php get_footer(); ?>
