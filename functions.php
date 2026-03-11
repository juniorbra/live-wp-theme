<?php

defined( 'ABSPATH' ) || exit;

/* ============================================================
   THEME SETUP
   ============================================================ */
function alianca_setup() {
    load_theme_textdomain( 'alianca', get_template_directory() . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', [
        'height'               => 80,
        'width'                => 240,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => [ 'site-title', 'site-description' ],
        'unlink-homepage-logo' => false,
    ] );
    add_theme_support( 'html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ] );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'wp-block-styles' );

    register_nav_menus( [
        'primary' => __( 'Menu Principal', 'alianca' ),
        'footer'  => __( 'Menu Rodape', 'alianca' ),
    ] );

    // Tamanhos de imagem adicionais
    add_image_size( 'alianca-card',   600, 400, true );
    add_image_size( 'alianca-hero',  1440, 700, true );
    add_image_size( 'alianca-thumb',  400, 300, true );
}
add_action( 'after_setup_theme', 'alianca_setup' );

/* ============================================================
   ENQUEUE — assets/css/main.css + assets/js/navigation.js
   ============================================================ */
function alianca_enqueue_scripts() {
    $theme_v = wp_get_theme()->get( 'Version' );

    // Estilo principal (style.css como registro obrigatorio do WP)
    wp_enqueue_style(
        'alianca-style',
        get_stylesheet_uri(),
        [],
        $theme_v
    );

    // CSS de componentes (arquivo separado para melhor cache)
    wp_enqueue_style(
        'alianca-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [ 'alianca-style' ],
        filemtime( get_template_directory() . '/assets/css/main.css' )
    );

    // JS de navegacao mobile (defer automatico via wp_script_add_data)
    wp_enqueue_script(
        'alianca-navigation',
        get_template_directory_uri() . '/assets/js/navigation.js',
        [],
        filemtime( get_template_directory() . '/assets/js/navigation.js' ),
        true
    );
    wp_script_add_data( 'alianca-navigation', 'defer', true );
}
add_action( 'wp_enqueue_scripts', 'alianca_enqueue_scripts' );

/* ============================================================
   PERFORMANCE — remover bloat do WordPress
   ============================================================ */
function alianca_cleanup_head() {
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'alianca_cleanup_head' );

/* preconnect para fonte Inter via Google Fonts */
function alianca_preconnect_fonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">' . "\n";
}
add_action( 'wp_head', 'alianca_preconnect_fonts', 1 );

/* ============================================================
   CUSTOM POST TYPES
   ============================================================ */
function alianca_register_cpts() {

    // --- Servicos ---
    register_post_type( 'servicos', [
        'label'               => __( 'Servicos', 'alianca' ),
        'labels'              => [
            'name'               => __( 'Servicos', 'alianca' ),
            'singular_name'      => __( 'Servico', 'alianca' ),
            'add_new_item'       => __( 'Adicionar Servico', 'alianca' ),
            'edit_item'          => __( 'Editar Servico', 'alianca' ),
            'all_items'          => __( 'Todos os Servicos', 'alianca' ),
            'menu_name'          => __( 'Servicos', 'alianca' ),
        ],
        'public'              => true,
        'has_archive'         => true,
        'show_in_rest'        => true,
        'menu_icon'           => 'dashicons-hammer',
        'menu_position'       => 5,
        'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'custom-fields' ],
        'rewrite'             => [ 'slug' => 'servicos' ],
    ] );

    // --- Noticias ---
    register_post_type( 'noticias', [
        'label'               => __( 'Noticias', 'alianca' ),
        'labels'              => [
            'name'               => __( 'Noticias', 'alianca' ),
            'singular_name'      => __( 'Noticia', 'alianca' ),
            'add_new_item'       => __( 'Adicionar Noticia', 'alianca' ),
            'edit_item'          => __( 'Editar Noticia', 'alianca' ),
            'all_items'          => __( 'Todas as Noticias', 'alianca' ),
            'menu_name'          => __( 'Noticias', 'alianca' ),
        ],
        'public'              => true,
        'has_archive'         => true,
        'show_in_rest'        => true,
        'menu_icon'           => 'dashicons-megaphone',
        'menu_position'       => 6,
        'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'custom-fields' ],
        'rewrite'             => [ 'slug' => 'noticias' ],
    ] );

    // --- Estudos de Caso ---
    register_post_type( 'estudos_de_caso', [
        'label'               => __( 'Estudos de Caso', 'alianca' ),
        'labels'              => [
            'name'               => __( 'Estudos de Caso', 'alianca' ),
            'singular_name'      => __( 'Estudo de Caso', 'alianca' ),
            'add_new_item'       => __( 'Adicionar Estudo de Caso', 'alianca' ),
            'edit_item'          => __( 'Editar Estudo de Caso', 'alianca' ),
            'all_items'          => __( 'Todos os Estudos de Caso', 'alianca' ),
            'menu_name'          => __( 'Estudos de Caso', 'alianca' ),
        ],
        'public'              => true,
        'has_archive'         => true,
        'show_in_rest'        => true,
        'menu_icon'           => 'dashicons-portfolio',
        'menu_position'       => 7,
        'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'rewrite'             => [ 'slug' => 'estudos-de-caso' ],
    ] );
}
add_action( 'init', 'alianca_register_cpts' );

/* ============================================================
   REWRITE — /artigos aponta para o arquivo de posts padrao
   ============================================================ */
function alianca_artigos_rewrite() {
    add_rewrite_rule(
        '^artigos(/page/([0-9]+))?/?$',
        'index.php?paged=$matches[2]',
        'top'
    );
}
add_action( 'init', 'alianca_artigos_rewrite' );

/* Flush de rewrite rules apenas na ativacao/troca do tema */
function alianca_flush_rewrite_on_activate() {
    alianca_register_cpts();
    alianca_artigos_rewrite();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'alianca_flush_rewrite_on_activate' );

/* ============================================================
   LAZY LOADING em imagens do tema (alem das do WP core)
   ============================================================ */
function alianca_add_lazy_loading( $attr, $attachment, $size ) {
    $attr['loading'] = 'lazy';
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'alianca_add_lazy_loading', 10, 3 );

/* ============================================================
   EXCERPT length customizado
   ============================================================ */
function alianca_excerpt_length( $length ) {
    return is_admin() ? $length : 25;
}
add_filter( 'excerpt_length', 'alianca_excerpt_length' );

function alianca_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'alianca_excerpt_more' );

/* ============================================================
   CAMPOS PERSONALIZADOS (ACF) — estrutura de grupos
   Requer o plugin ACF ou ACF Pro instalado.
   ============================================================ */
function alianca_register_acf_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    // Grupo: Servicos
    acf_add_local_field_group( [
        'key'      => 'group_servicos',
        'title'    => 'Detalhes do Servico',
        'fields'   => [
            [
                'key'   => 'field_servico_icone',
                'label' => 'Icone (classe dashicons)',
                'name'  => 'servico_icone',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_servico_metodologia',
                'label' => 'Metodologia',
                'name'  => 'servico_metodologia',
                'type'  => 'textarea',
            ],
            [
                'key'   => 'field_servico_link_calendly',
                'label' => 'Link Calendly (agendamento)',
                'name'  => 'servico_link_calendly',
                'type'  => 'url',
            ],
        ],
        'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'servicos' ] ] ],
    ] );

    // Grupo: Estudos de Caso
    acf_add_local_field_group( [
        'key'      => 'group_estudos_de_caso',
        'title'    => 'Metricas do Case',
        'fields'   => [
            [
                'key'   => 'field_case_setor',
                'label' => 'Setor do Cliente (ex: Infraestrutura)',
                'name'  => 'case_setor',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_case_conflito',
                'label' => 'O Conflito',
                'name'  => 'case_conflito',
                'type'  => 'textarea',
            ],
            [
                'key'   => 'field_case_metodologia',
                'label' => 'A Investigacao / Metodologia',
                'name'  => 'case_metodologia',
                'type'  => 'textarea',
            ],
            [
                'key'   => 'field_case_resultado',
                'label' => 'O Desfecho (resultados e metricas)',
                'name'  => 'case_resultado',
                'type'  => 'textarea',
            ],
            [
                'key'   => 'field_case_metrica_destaque',
                'label' => 'Metrica de Destaque (ex: R$ 12M recuperados)',
                'name'  => 'case_metrica_destaque',
                'type'  => 'text',
            ],
        ],
        'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'estudos_de_caso' ] ] ],
    ] );

    // Grupo: Depoimentos (para posts e paginas)
    acf_add_local_field_group( [
        'key'      => 'group_depoimento',
        'title'    => 'Depoimento',
        'fields'   => [
            [
                'key'   => 'field_depoimento_texto',
                'label' => 'Texto do Depoimento',
                'name'  => 'depoimento_texto',
                'type'  => 'textarea',
            ],
            [
                'key'   => 'field_depoimento_cargo',
                'label' => 'Cargo / Setor (sem nome)',
                'name'  => 'depoimento_cargo',
                'type'  => 'text',
            ],
        ],
        'location' => [ [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'post' ] ] ],
    ] );
}
add_action( 'acf/init', 'alianca_register_acf_fields' );

/* ============================================================
   SUPORTE A LaTeX via MathJax (carregado somente quando necessario)
   ============================================================ */
function alianca_maybe_enqueue_mathjax() {
    global $post;
    if ( is_singular() && isset( $post->post_content ) && strpos( $post->post_content, '[latex]' ) !== false ) {
        wp_enqueue_script(
            'mathjax',
            'https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js',
            [],
            null,
            true
        );
        wp_script_add_data( 'mathjax', 'defer', true );
    }
}
add_action( 'wp_enqueue_scripts', 'alianca_maybe_enqueue_mathjax' );

/* Shortcode [latex]...[/latex] para renderizar formulas */
function alianca_latex_shortcode( $atts, $content = '' ) {
    return '<span class="math-tex">\(' . wp_kses_post( $content ) . '\)</span>';
}
add_shortcode( 'latex', 'alianca_latex_shortcode' );

/* ============================================================
   WALKER — menu com suporte a dropdown acessivel
   ============================================================ */
class Alianca_Nav_Walker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="sub-menu" role="menu" aria-hidden="true">';
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes   = empty( $item->classes ) ? [] : (array) $item->classes;
        $has_child = in_array( 'menu-item-has-children', $classes, true );
        $class_str = implode( ' ', array_filter( $classes ) );

        $output .= '<li class="' . esc_attr( $class_str ) . '" role="none">';

        $atts = [
            'href'  => ! empty( $item->url ) ? $item->url : '#',
            'class' => 'nav-link',
            'role'  => 'menuitem',
        ];

        if ( $has_child ) {
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
        }

        if ( $item->current ) {
            $atts['aria-current'] = 'page';
        }

        $atts_str = '';
        foreach ( $atts as $k => $v ) {
            $atts_str .= ' ' . $k . '="' . esc_attr( $v ) . '"';
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $arrow = $has_child ? ' <span class="nav-arrow" aria-hidden="true">&#9660;</span>' : '';

        $output .= '<a' . $atts_str . '>' . esc_html( $title ) . $arrow . '</a>';
    }
}
