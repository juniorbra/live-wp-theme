<?php
/**
 * Template para resultados de busca interna.
 */

get_header();

$search_query = get_search_query();
$found_posts  = $GLOBALS['wp_query']->found_posts;
?>

<main id="main-content" class="site-main" role="main">

    <!-- Cabecalho da busca -->
    <div class="page-hero">
        <div class="container">
            <p class="section__eyebrow">Busca</p>
            <h1 class="page-hero__title">
                <?php if ( $search_query ) : ?>
                    Resultados para: <em>"<?php echo esc_html( $search_query ); ?>"</em>
                <?php else : ?>
                    O que voce procura?
                <?php endif; ?>
            </h1>
            <?php if ( $search_query ) : ?>
                <p class="page-hero__subtitle">
                    <?php
                    printf(
                        esc_html( _n( '%d resultado encontrado.', '%d resultados encontrados.', $found_posts, 'alianca' ) ),
                        $found_posts
                    );
                    ?>
                </p>
            <?php endif; ?>
        </div>
    </div>

    <div class="container section">

        <!-- Campo de busca refinada -->
        <div class="search-refine">
            <label for="search-input-refine" class="search-refine__label">
                Refinar busca:
            </label>
            <?php get_search_form(); ?>
        </div>

        <?php if ( have_posts() ) : ?>

            <ul class="search-results" role="list" aria-label="Resultados da busca">
                <?php while ( have_posts() ) : the_post(); ?>
                <li class="search-result" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <div class="search-result__type">
                        <?php
                        $type_labels = [
                            'post'            => 'Artigo',
                            'page'            => 'Pagina',
                            'noticias'        => 'Noticia',
                            'servicos'        => 'Servico',
                            'estudos_de_caso' => 'Estudo de Caso',
                        ];
                        $pt = get_post_type();
                        echo esc_html( $type_labels[ $pt ] ?? ucfirst( $pt ) );
                        ?>
                    </div>

                    <h2 class="search-result__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>

                    <p class="search-result__excerpt"><?php the_excerpt(); ?></p>

                    <div class="search-result__meta">
                        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                            <?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?>
                        </time>
                        <a href="<?php the_permalink(); ?>" class="search-result__link" aria-label="Ler: <?php the_title_attribute(); ?>">
                            Ler &rarr;
                        </a>
                    </div>

                </li>
                <?php endwhile; ?>
            </ul>

            <!-- Paginacao -->
            <nav class="archive-pagination" aria-label="<?php esc_attr_e( 'Navegacao de resultados', 'alianca' ); ?>">
                <?php
                the_posts_pagination( [
                    'mid_size'           => 2,
                    'prev_text'          => '&larr; Anterior',
                    'next_text'          => 'Proximo &rarr;',
                    'screen_reader_text' => __( 'Navegar entre paginas de resultados', 'alianca' ),
                ] );
                ?>
            </nav>

        <?php else : ?>

            <div class="no-results">
                <h2>Nenhum resultado para "<?php echo esc_html( $search_query ); ?>"</h2>
                <p>Verifique a ortografia ou tente termos mais gerais. Voce tambem pode explorar nossas areas de atuacao:</p>
                <ul class="no-results__suggestions">
                    <li><a href="<?php echo esc_url( home_url( '/servicos' ) ); ?>">Servicos</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/estudos-de-caso' ) ); ?>">Estudos de Caso</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/noticias' ) ); ?>">Noticias</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/artigos' ) ); ?>">Artigos</a></li>
                </ul>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--navy">
                    Voltar ao Inicio
                </a>
            </div>

        <?php endif; ?>

    </div>

</main>

<?php get_footer(); ?>
