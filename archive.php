<?php
/**
 * Template para arquivos (CPTs, categorias, tags, datas, autores).
 * Hierarquia: archive-{post_type}.php > archive.php
 */

get_header();

$post_type   = get_post_type();
$archive_obj = get_queried_object();

// Titulo e descricao do arquivo
if ( is_post_type_archive() ) {
    $archive_title = post_type_archive_title( '', false );
    $archive_desc  = get_the_post_type_description();
} elseif ( is_category() ) {
    $archive_title = single_cat_title( '', false );
    $archive_desc  = category_description();
} elseif ( is_tag() ) {
    $archive_title = single_tag_title( '', false );
    $archive_desc  = tag_description();
} elseif ( is_author() ) {
    $archive_title = get_the_author();
    $archive_desc  = get_the_author_meta( 'description' );
} elseif ( is_date() ) {
    $archive_title = get_the_date( 'F Y' );
    $archive_desc  = '';
} else {
    $archive_title = __( 'Arquivo', 'alianca' );
    $archive_desc  = '';
}

// Sobrescrever descricao com ACF se disponivel
if ( function_exists('get_field') ) {
    $front_id = get_option('page_on_front');
    if ( is_post_type_archive('servicos') ) {
        $custom_desc = get_field('desc_archive_servicos', $front_id);
        if ( $custom_desc ) $archive_desc = $custom_desc;
    } elseif ( is_post_type_archive('clientes') ) {
        $custom_desc = get_field('desc_archive_clientes', $front_id);
        if ( $custom_desc ) $archive_desc = $custom_desc;
    }
}
?>

<main id="main-content" class="site-main" role="main">

    <!-- Cabecalho do arquivo -->
    <div class="page-hero">
        <div class="container">
            <p class="section__eyebrow">
                <?php
                if ( is_post_type_archive( 'noticias' ) )        echo 'Noticias';
                elseif ( is_post_type_archive( 'servicos' ) )    echo 'Servicos';
                elseif ( is_post_type_archive( 'clientes' ) )    echo 'Clientes';
                elseif ( is_post_type_archive( 'estudos_de_caso' ) ) echo 'Artigos';
                elseif ( is_category() )                          echo 'Categoria';
                elseif ( is_tag() )                               echo 'Tag';
                elseif ( is_author() )                            echo 'Autor';
                else                                              echo 'Arquivo';
                ?>
            </p>
            <h1 class="page-hero__title"><?php echo esc_html( $archive_title ); ?></h1>
        </div>
    </div>

    <?php if ( $archive_desc ) : ?>
    <div class="archive-intro pb-0">
        <div class="container container--narrow">
            <div class="archive-description prose text-center">
                <?php echo wp_kses_post( $archive_desc ); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="container section pt-0">

        <?php if ( have_posts() ) : ?>

            <ul class="cards-grid" role="list">
                <?php while ( have_posts() ) : the_post(); ?>
                <li class="card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="card__image">
                        <?php the_post_thumbnail( 'alianca-card', [
                            'loading' => 'lazy',
                            'alt'     => get_the_title(),
                        ] ); ?>
                    </div>
                    <?php endif; ?>
                    <div class="card__body">
                        <?php if ( get_post_type() === 'post' ) : ?>
                            <div class="card__meta">
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
                        <?php elseif ( get_post_type() === 'noticias' ) : ?>
                            <time class="card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                <?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?>
                            </time>
                        <?php endif; ?>

                        <h2 class="card__title" id="post-title-<?php the_ID(); ?>">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>

                        <p class="card__excerpt"><?php the_excerpt(); ?></p>

                        <a
                            href="<?php the_permalink(); ?>"
                            class="btn btn--outline btn--sm"
                            aria-labelledby="post-title-<?php the_ID(); ?>"
                        >
                            Ler mais
                        </a>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul>

            <!-- Paginacao -->
            <nav class="archive-pagination" aria-label="<?php esc_attr_e( 'Navegacao de paginas', 'alianca' ); ?>">
                <?php
                the_posts_pagination( [
                    'mid_size'           => 2,
                    'prev_text'          => '&larr; Anterior',
                    'next_text'          => 'Proximo &rarr;',
                    'screen_reader_text' => __( 'Navegar entre paginas', 'alianca' ),
                ] );
                ?>
            </nav>

        <?php else : ?>

            <div class="no-results">
                <h2><?php esc_html_e( 'Nenhum resultado encontrado.', 'alianca' ); ?></h2>
                <p><?php esc_html_e( 'Nao encontramos publicacoes neste arquivo. Tente navegar pelo menu ou use a busca.', 'alianca' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--navy">
                    Voltar ao Inicio
                </a>
            </div>

        <?php endif; ?>

    </div>

</main>

<?php get_footer(); ?>
