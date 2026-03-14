<?php
/**
 * Template para paginas estaticas (Page).
 * Hierarquia: page-{slug}.php > page-{id}.php > page.php
 */

get_header();
?>

<main id="main-content" class="site-main" role="main">

    <div class="page-hero">
        <div class="container">
            <?php if ( have_posts() ) : the_post(); ?>
                <h1 class="page-hero__title"><?php the_title(); ?></h1>
            <?php endif; ?>
        </div>
    </div>

    <div class="container page-content">
        <?php if ( has_post_thumbnail() ) : ?>
            <figure class="page-featured-image">
                <?php the_post_thumbnail( 'alianca-hero', [
                    'loading' => 'lazy',
                    'alt'     => get_the_title(),
                ] ); ?>
            </figure>
        <?php endif; ?>

        <div class="entry-content prose">
            <?php the_content(); ?>
        </div>

        <?php
        wp_link_pages( [
            'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Páginas do artigo', 'alianca' ) . '">',
            'after'  => '</nav>',
        ] );
        ?>
    </div>

</main>

<?php get_footer(); ?>
