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
            <nav class="breadcrumb" aria-label="<?php esc_attr_e( 'Caminho de navegação', 'alianca' ); ?>">
                <ol class="breadcrumb__list">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a></li>
                    <?php if ( $post_type === 'noticias' ) : ?>
                        <li><a href="<?php echo esc_url( home_url( '/noticias' ) ); ?>">Notícias</a></li>
                    <?php elseif ( $post_type === 'servicos' ) : ?>
                        <li><a href="<?php echo esc_url( home_url( '/servicos' ) ); ?>">Serviços</a></li>
                    <?php else : ?>
                        <li><a href="<?php echo esc_url( home_url( '/artigos' ) ); ?>">Artigos</a></li>
                        <?php 
                        $cats = get_the_category();
                        if ( $cats ) :
                        ?>
                        <li><a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>"><?php echo esc_html( $cats[0]->name ); ?></a></li>
                        <?php endif; ?>
                    <?php endif; ?>
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

    <!-- Corpo do conteudo -->
    <div class="container single-layout">

        <article class="single-content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php if ( has_post_thumbnail() ) : ?>
            <div class="single-featured-image single-featured-image--inline">
                <?php the_post_thumbnail( 'alianca-hero', [
                    'loading' => 'eager',
                    'class'   => 'single-featured-image__img',
                ] ); ?>
            </div>
            <?php endif; ?>

            <?php
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
                'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Páginas do artigo', 'alianca' ) . '">',
                'after'  => '</nav>',
            ] );

            // CTA Calendly para servicos
            if ( $post_type === 'servicos' ) :
                $calendly = function_exists( 'get_field' ) ? get_field( 'servico_link_calendly' ) : '';
                $href = $calendly ?: ALIANCA_WHATSAPP_URL;
            ?>
            <div class="single-cta">
                <h3>Interessado neste serviço?</h3>
                <p>Agende uma consulta técnica diretamente com nossos especialistas.</p>
                <a href="<?php echo esc_url( $href ); ?>" class="btn btn--accent btn--lg" target="_blank" rel="noopener noreferrer">
                    Agendar Consulta Técnica
                </a>
            </div>
            <?php endif; ?>

            <?php
            // Se os comentarios estiverem abertos ou houver pelo menos um comentario, carrega o template
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>

        </article>

        <!-- Navegacao entre posts -->
        <!-- Sidebar / Área Lateral -->
        <aside class="single-sidebar">

            <?php
            // Se não for Cliente, mostra os Artigos Relacionados normais
            if ( $post_type !== 'clientes' ) :
                // Busca de Artigos Relacionados
                $related_args = [
                    'post_type'      => $post_type,
                    'posts_per_page' => 3, // Quantidade ideal de artigos no sidebar visualmente
                    'post__not_in'   => [ get_the_ID() ],
                    'orderby'        => 'rand'
                ];

                // Prioriza artigos da mesma categoria, se disponível
                $categories = get_the_category();
                if ( ! empty( $categories ) ) {
                    $related_args['category__in'] = wp_list_pluck( $categories, 'term_id' );
                }

                $related_query = new WP_Query( $related_args );

                if ( $related_query->have_posts() ) :
                ?>
                <section class="widget related-posts-widget">
                    <h3 class="widget-title">Leia também</h3>
                    <div class="related-posts-list">
                        <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="related-post-card">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <div class="related-post-card__img">
                                <?php the_post_thumbnail( 'alianca-thumb' ); ?>
                            </div>
                            <?php endif; ?>
                            <h4 class="related-post-card__title"><?php echo esc_html( get_the_title() ); ?></h4>
                        </a>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </section>
                <?php 
                endif; 
            endif; // Fim verificacao !== clientes
            ?>

            <?php
            // Se for Cliente, exibe um widget com outros clientes
            if ( $post_type === 'clientes' ) :
                $clientes_args = [
                    'post_type'      => 'clientes',
                    'posts_per_page' => 7,
                    'post__not_in'   => [ get_the_ID() ],
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                ];
                $clientes_query = new WP_Query( $clientes_args );
                if ( $clientes_query->have_posts() ) :
            ?>
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget__title">Outros Clientes</h3>
                    <ul class="sidebar-services-grid">
                        <?php while ( $clientes_query->have_posts() ) : $clientes_query->the_post(); ?>
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
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>
            <?php 
                endif;
            endif; 
            ?>

            <?php 
            // Mostra os Widgets cadastrados pelo Painel, caso existam
            if ( is_active_sidebar( 'sidebar-1' ) ) : 
                dynamic_sidebar( 'sidebar-1' );
            endif; 
            ?>

            <nav class="post-navigation" aria-label="<?php esc_attr_e( 'Posts anterior e próximo', 'alianca' ); ?>">
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
                    <span class="post-nav-link__label">Próximo</span>
                    <span class="post-nav-link__title"><?php echo esc_html( get_the_title( $next ) ); ?></span>
                </a>
                <?php endif; ?>
            </nav>
        </aside>

    </div><!-- .single-layout -->

    <?php endif; // have_posts() ?>

</main>

<?php get_footer(); ?>
