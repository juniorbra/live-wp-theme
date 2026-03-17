<?php


defined('ABSPATH') || exit;

define( 'ALIANCA_WHATSAPP_URL', 'https://wa.me/5521972823512?text=Ol%C3%A1%2C%20estou%20vindo%20do%20site%20da%20Alian%C3%A7a%20e%20quero%20mais%20informa%C3%A7%C3%B5es' );

/* ============================================================
   THEME SETUP
   ============================================================ */
function alianca_setup()
{
    load_theme_textdomain('alianca', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height' => 80,
        'width' => 240,
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => ['site-title', 'site-description'],
        'unlink-homepage-logo' => false,
    ]);
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');

    register_nav_menus([
        'primary' => __('Menu Principal', 'alianca'),
        'footer' => __('Menu Rodape', 'alianca'),
    ]);

    // Tamanhos de imagem adicionais
    add_image_size('alianca-card', 600, 400, true);
    add_image_size('alianca-hero', 1440, 700, true);
    add_image_size('alianca-thumb', 400, 300, true);
}
add_action('after_setup_theme', 'alianca_setup');

/* ============================================================
   WIDGETS — Registro de Sidebars e Rodapé
   ============================================================ */
function alianca_widgets_init() {
    // Sidebar Principal
    register_sidebar([
        'name'          => __('Sidebar Artigos', 'alianca'),
        'id'            => 'sidebar-1',
        'description'   => __('Adicione widgets aqui para aparecerem na barra lateral dos artigos.', 'alianca'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);

    // Rodapé
    register_sidebar([
        'name'          => __('Rodapé Coluna 1', 'alianca'),
        'id'            => 'footer-1',
        'description'   => __('Adicione widgets aqui para a primeira coluna do rodapé.', 'alianca'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);

    register_sidebar([
        'name'          => __('Rodapé Coluna 2', 'alianca'),
        'id'            => 'footer-2',
        'description'   => __('Adicione widgets aqui para a segunda coluna do rodapé.', 'alianca'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);
}
add_action('widgets_init', 'alianca_widgets_init');

/* ============================================================
   ENQUEUE — assets/css/main.css + assets/js/navigation.js
   ============================================================ */
function alianca_enqueue_scripts()
{
    $theme_v = wp_get_theme()->get('Version');

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
        ['alianca-style'],
        filemtime(get_template_directory() . '/assets/css/main.css')
    );

    // JS de navegacao mobile
    wp_enqueue_script(
        'alianca-navigation',
        get_template_directory_uri() . '/assets/js/navigation.js',
        [],
        filemtime(get_template_directory() . '/assets/js/navigation.js'),
        true
    );
    wp_script_add_data('alianca-navigation', 'defer', true);

    // JS de animações scroll-triggered
    wp_enqueue_script(
        'alianca-animations',
        get_template_directory_uri() . '/assets/js/animations.js',
        [],
        filemtime(get_template_directory() . '/assets/js/animations.js'),
        true
    );
    wp_script_add_data('alianca-animations', 'defer', true);
}
add_action('wp_enqueue_scripts', 'alianca_enqueue_scripts');

/* ============================================================
   PERFORMANCE — remover bloat do WordPress
   ============================================================ */
function alianca_cleanup_head()
{
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'alianca_cleanup_head');

/* ============================================================
   WHATSAPP — script de rastreamento UTM + botão flutuante
   ============================================================ */
function alianca_whatsapp_script() {
    ?>
    <script>
    function openWhatsApp() {
      var params = new URLSearchParams(window.location.search);
      var utms = {
        utm_source:   params.get('utm_source')   || null,
        utm_medium:   params.get('utm_medium')   || null,
        utm_campaign: params.get('utm_campaign') || null,
        utm_content:  params.get('utm_content')  || null,
        utm_term:     params.get('utm_term')     || null,
        gclid:        params.get('gclid')        || null,
        fbclid:       params.get('fbclid')       || null
      };

      var hasTracking = Object.keys(utms).some(function(k) { return utms[k] !== null; });
      var msg = 'Olá, gostaria de mais informações!';

      if (hasTracking) {
        var code = Math.random().toString(36).substring(2, 8).toUpperCase();

        fetch('https://webhooks.botvance.com.br/webhook/utm-receiver', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(Object.assign({ code: code }, utms))
        }).catch(function() {});

        msg = 'Olá, gostaria de mais informações! (Ref: ' + code + ')';
      }

      window.open(
        'https://wa.me/5521972823512?text=' + encodeURIComponent(msg),
        '_blank'
      );
    }
    </script>
    <?php
}
add_action('wp_head', 'alianca_whatsapp_script');

function alianca_whatsapp_float_button() {
    ?>
    <!-- Botão flutuante WhatsApp -->
    <button class="whatsapp-float" onclick="openWhatsApp()" aria-label="Falar no WhatsApp">
      <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill="#fff" d="M16 3C8.82 3 3 8.82 3 16c0 2.3.6 4.47 1.64 6.36L3 29l6.82-1.6A13 13 0 0 0 16 29c7.18 0 13-5.82 13-13S23.18 3 16 3zm0 23.6a10.56 10.56 0 0 1-5.38-1.47l-.38-.23-3.97.93.96-3.86-.25-.4A10.6 10.6 0 1 1 16 26.6zm5.82-7.94c-.32-.16-1.88-.93-2.17-1.03-.29-.1-.5-.16-.71.16-.21.32-.82 1.03-1.01 1.24-.18.21-.37.24-.69.08-.32-.16-1.35-.5-2.57-1.59-.95-.85-1.59-1.9-1.78-2.22-.18-.32-.02-.49.14-.65.14-.14.32-.37.48-.55.16-.18.21-.32.32-.53.1-.21.05-.4-.03-.56-.08-.16-.71-1.72-.97-2.35-.26-.62-.52-.53-.71-.54l-.6-.01c-.21 0-.55.08-.84.4-.29.32-1.1 1.08-1.1 2.63 0 1.55 1.13 3.05 1.29 3.26.16.21 2.22 3.39 5.38 4.75.75.32 1.34.52 1.8.66.75.24 1.44.21 1.98.13.6-.09 1.88-.77 2.14-1.51.27-.74.27-1.38.19-1.51-.08-.13-.29-.21-.6-.37z"/>
      </svg>
    </button>
    <?php
}
add_action('wp_body_open', 'alianca_whatsapp_float_button');

/* preconnect + Google Fonts: Cormorant Garamond (display/títulos) + Lato (corpo) */
function alianca_preconnect_fonts()
{
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">' . "\n";
}
add_action('wp_head', 'alianca_preconnect_fonts', 1);

/* ============================================================
   CUSTOM POST TYPES
   ============================================================ */
function alianca_register_cpts()
{

    // --- Servicos ---
    register_post_type('servicos', [
        'label' => __('Servicos', 'alianca'),
        'labels' => [
            'name' => __('Servicos', 'alianca'),
            'singular_name' => __('Servico', 'alianca'),
            'add_new_item' => __('Adicionar Servico', 'alianca'),
            'edit_item' => __('Editar Servico', 'alianca'),
            'all_items' => __('Todos os Servicos', 'alianca'),
            'menu_name' => __('Servicos', 'alianca'),
        ],
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-hammer',
        'menu_position' => 5,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'custom-fields'],
        'rewrite' => ['slug' => 'servicos'],
    ]);

    // --- Noticias ---
    register_post_type('noticias', [
        'label' => __('Noticias', 'alianca'),
        'labels' => [
            'name' => __('Noticias', 'alianca'),
            'singular_name' => __('Noticia', 'alianca'),
            'add_new_item' => __('Adicionar Noticia', 'alianca'),
            'edit_item' => __('Editar Noticia', 'alianca'),
            'all_items' => __('Todas as Noticias', 'alianca'),
            'menu_name' => __('Noticias', 'alianca'),
        ],
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-megaphone',
        'menu_position' => 6,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'author', 'custom-fields'],
        'rewrite' => ['slug' => 'noticias'],
    ]);

    // --- Clientes ---
    register_post_type('clientes', [
        'label' => __('Clientes', 'alianca'),
        'labels' => [
            'name' => __('Clientes', 'alianca'),
            'singular_name' => __('Cliente', 'alianca'),
            'add_new_item' => __('Adicionar Cliente', 'alianca'),
            'edit_item' => __('Editar Cliente', 'alianca'),
            'all_items' => __('Todos os Clientes', 'alianca'),
            'menu_name' => __('Clientes', 'alianca'),
        ],
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-groups',
        'menu_position' => 7,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'rewrite' => ['slug' => 'clientes'],
    ]);

    // --- Taxonomia: Setores (para Clientes) ---
    register_taxonomy('setor', 'clientes', [
        'label' => __('Setores', 'alianca'),
        'labels' => [
            'name' => __('Setores', 'alianca'),
            'singular_name' => __('Setor', 'alianca'),
            'all_items' => __('Todos os Setores', 'alianca'),
            'edit_item' => __('Editar Setor', 'alianca'),
            'view_item' => __('Ver Setor', 'alianca'),
            'update_item' => __('Atualizar Setor', 'alianca'),
            'add_new_item' => __('Adicionar Novo Setor', 'alianca'),
            'new_item_name' => __('Nome do Novo Setor', 'alianca'),
            'menu_name' => __('Setores', 'alianca'),
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'setor'],
    ]);

}
add_action('init', 'alianca_register_cpts');

/* ============================================================
   REWRITE — /artigos aponta para o arquivo de posts padrao
   ============================================================ */
function alianca_artigos_rewrite()
{
    add_rewrite_rule(
        '^artigos(/page/([0-9]+))?/?$',
        'index.php?paged=$matches[2]',
        'top'
    );
}
add_action('init', 'alianca_artigos_rewrite');

/* Flush de rewrite rules apenas na ativacao/troca do tema */
function alianca_flush_rewrite_on_activate()
{
    alianca_register_cpts();
    alianca_artigos_rewrite();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'alianca_flush_rewrite_on_activate');

/* ============================================================
   LAZY LOADING em imagens do tema (alem das do WP core)
   ============================================================ */
function alianca_add_lazy_loading($attr, $attachment, $size)
{
    $attr['loading'] = 'lazy';
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'alianca_add_lazy_loading', 10, 3);

/* ============================================================
   EXCERPT length customizado
   ============================================================ */
function alianca_excerpt_length($length)
{
    return is_admin() ? $length : 25;
}
add_filter('excerpt_length', 'alianca_excerpt_length');

function alianca_excerpt_more($more)
{
    return '&hellip;';
}
add_filter('excerpt_more', 'alianca_excerpt_more');

/* ============================================================
   ACF — PAGINA DE OPCOES E CAMPOS
   ============================================================ */
// 1. Criar a pagina de configurações no menu lateral (Requer ACF Pro, mas deixamos preparado)
if ( function_exists('acf_add_options_page') ) {
    acf_add_options_page([
        'page_title'    => 'Configuracoes do Tema',
        'menu_title'    => 'Configuracoes',
        'menu_slug'     => 'theme-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'icon_url'      => 'dashicons-admin-generic',
    ]);
}

function alianca_register_acf_fields()
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    // Grupo: Servicos
    acf_add_local_field_group([
        'key' => 'group_servicos',
        'title' => 'Detalhes do Servico',
        'fields' => [
            [
                'key' => 'field_servico_icone',
                'label' => 'Icone (classe dashicons)',
                'name' => 'servico_icone',
                'type' => 'text',
            ],
            [
                'key' => 'field_servico_metodologia',
                'label' => 'Metodologia',
                'name' => 'servico_metodologia',
                'type' => 'textarea',
            ],
        ],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'servicos']]],
    ]);

    // Grupo: Depoimentos (para posts e paginas)
    acf_add_local_field_group([
        'key' => 'group_depoimento',
        'title' => 'Depoimento',
        'fields' => [
            [
                'key' => 'field_depoimento_texto',
                'label' => 'Texto do Depoimento',
                'name' => 'depoimento_texto',
                'type' => 'textarea',
            ],
            [
                'key' => 'field_depoimento_cargo',
                'label' => 'Cargo / Setor (sem nome)',
                'name' => 'depoimento_cargo',
                'type' => 'text',
            ],
        ],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'post']]],
    ]);
    // Grupo: Configuracoes das Listagens (Archives)
    acf_add_local_field_group([
        'key' => 'group_archive_settings',
        'title' => 'Textos das Listagens (Páginas Gerais)',
        'fields' => [
            [
                'key' => 'field_hero_subtitle_servicos',
                'label' => 'Subtítulo do hero "Nossos Serviços"',
                'name' => 'hero_subtitle_servicos',
                'type' => 'textarea',
                'instructions' => 'Texto curto que aparece logo abaixo do título "Nossos Serviços" no banner azul.',
            ],
            [
                'key' => 'field_desc_archive_servicos',
                'label' => 'Descrição da página "Todos os Serviços"',
                'name' => 'desc_archive_servicos',
                'type' => 'textarea',
                'instructions' => 'Este texto aparece entre o título azul e a lista de serviços.',
            ],
            [
                'key' => 'field_hero_subtitle_clientes',
                'label' => 'Subtítulo do hero "Clientes"',
                'name' => 'hero_subtitle_clientes',
                'type' => 'textarea',
                'instructions' => 'Texto curto que aparece logo abaixo do título "Clientes" no banner azul.',
            ],
            [
                'key' => 'field_desc_archive_clientes',
                'label' => 'Descrição da página "Todos os Clientes"',
                'name' => 'desc_archive_clientes',
                'type' => 'textarea',
                'instructions' => 'Este texto aparece entre o título azul e a lista de clientes.',
            ],
        ],
        'location' => [
            [
                ['param' => 'post_type', 'operator' => '==', 'value' => 'page'],
            ],
        ],
    ]);

    // Grupo: Imagens da Página Inicial
    acf_add_local_field_group([
        'key'   => 'group_front_page_images',
        'title' => 'Imagens da Página Inicial',
        'fields' => [
            [
                'key'           => 'field_sobre_imagem',
                'label'         => 'Imagem — Seção Quem Somos',
                'name'          => 'sobre_imagem',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'instructions'  => 'Imagem exibida ao lado do texto "Quem Somos" na página inicial.',
            ],
        ],
        'location' => [
            [
                ['param' => 'page_type', 'operator' => '==', 'value' => 'front_page'],
            ],
        ],
    ]);
}
add_action('acf/init', 'alianca_register_acf_fields');

// Adicionar um aviso no topo do Admin para você saber onde achar
add_action('admin_notices', function() {
    $screen = get_current_screen();
    if ( $screen && $screen->base === 'edit' && ($screen->post_type === 'servicos' || $screen->post_type === 'clientes') ) {
        echo '<div class="notice notice-info is-dismissible"><p><strong>Dica:</strong> Para editar o texto de introdução desta página, vá em <a href="'.admin_url('edit.php?post_type=page').'">Páginas</a> e edite a sua <strong>Página Inicial</strong>.</p></div>';
    }
});


/* ============================================================
   WALKER — menu com suporte a dropdown acessivel
   ============================================================ */
class Alianca_Nav_Walker extends Walker_Nav_Menu
{

    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '<ul class="sub-menu" role="menu" aria-hidden="true">';
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $has_child = in_array('menu-item-has-children', $classes, true);
        $class_str = implode(' ', array_filter($classes));

        $output .= '<li class="' . esc_attr($class_str) . '" role="none">';

        $atts = [
            'href' => !empty($item->url) ? $item->url : '#',
            'class' => 'nav-link',
            'role' => 'menuitem',
        ];

        if ($has_child) {
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
        }

        if ($item->current) {
            $atts['aria-current'] = 'page';
        }

        $atts_str = '';
        foreach ($atts as $k => $v) {
            $atts_str .= ' ' . $k . '="' . esc_attr($v) . '"';
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $arrow = $has_child ? ' <span class="nav-arrow" aria-hidden="true">&#9660;</span>' : '';

        $output .= '<a' . $atts_str . '>' . esc_html($title) . $arrow . '</a>';
    }
}
