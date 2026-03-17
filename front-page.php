<?php
/**
 * Template para a pagina inicial (Front Page).
 * WordPress usa este arquivo automaticamente quando uma pagina estatica
 * esta definida em Configuracoes > Leitura.
 */

get_header();
?>

<main id="main-content" class="site-main" role="main">

    <!-- ========================================================
         HERO SECTION — above the fold
         ======================================================== -->
    <section
        class="hero"
        id="hero"
        aria-labelledby="hero-heading"
    >
        <video
            class="hero__video"
            autoplay
            muted
            loop
            playsinline
            aria-hidden="true"
        >
            <source src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/03/2325093-Hd-1920-1080-25Fps.mp4' ) ); ?>" type="video/mp4">
        </video>
        <div class="hero__overlay" aria-hidden="true"></div>
        <div class="container hero__content">
            <span class="hero__eyebrow">Alianca Consultoria e Engenharia</span>
            <h1 class="hero__title" id="hero-heading">
                Excelência e Precisão em Laudos de Engenharia e Finanças para Litígios Complexos
            </h1>
            <p class="hero__subtitle">
                Combinamos rigor científico, metodologia acadêmica e profunda experiência técnica para defender com solidez os interesses de nossos clientes em disputas judiciais e arbitragens de alta complexidade.
            </p>
            <div class="hero__actions">
                <a
                    href="<?php echo esc_url( ALIANCA_WHATSAPP_URL ); ?>"
                    class="btn btn--accent btn--lg"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Agendar Consulta Técnica com um especialista da Alianca"
                >
                    Agendar Consulta Técnica
                </a>
                <a href="#servicos" class="btn btn--ghost btn--lg">
                    Conhecer Serviços
                </a>
                <a
                    href="https://www.linkedin.com/company/alianca-consultoria-e-engenharia/"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Siga a Aliança no LinkedIn"
                    class="hero__linkedin"
                >
                    <img
                        src="<?php echo esc_url( home_url( '/wp-content/uploads/2025/03/botao-linkedin.png' ) ); ?>"
                        alt="Siga-nos no LinkedIn"
                        class="hero__linkedin-img"
                    >
                </a>
            </div>
        </div><!-- fecha hero__content -->
    </section>

    <!-- ========================================================
         PROVA SOCIAL — faixa de logos de clientes
         ======================================================== -->
    <section class="social-proof" aria-label="Setores atendidos">
        <div class="container">
            <p class="social-proof__label">Confiança comprovada nos setores de maior complexidade:</p>
            <ul class="social-proof__logos" role="list">
                <?php
                $clientes_query = new WP_Query([
                    'post_type'      => 'clientes',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC'
                ]);

                if ($clientes_query->have_posts()) :
                    while ($clientes_query->have_posts()) : $clientes_query->the_post(); ?>
                        <li class="social-proof__item"><?php the_title(); ?></li>
                    <?php endwhile;
                    wp_reset_postdata();
                else: 
                    // Fallback visual caso ainda não existam clientes cadastrados
                    $fallbacks = ['Logístico', 'Varejo', 'Financeiro', 'Escritórios de Advocacia', 'Seguros', 'Imobiliário', 'Óleo, Gás e Energia'];
                    foreach ($fallbacks as $fb) : ?>
                        <li class="social-proof__item"><?php echo esc_html($fb); ?></li>
                    <?php endforeach;
                endif; ?>
            </ul>
        </div>
    </section>

    <!-- ========================================================
         NOSSOS SERVICOS — CPT servicos em grid de cards
         ======================================================== -->
    <section class="section section--alt" id="servicos" aria-labelledby="servicos-heading">
        <div class="container container--wide">

            <header class="section__header" data-animate="fade-up">
                <span class="section__eyebrow">Áreas de Atuação</span>
                <h2 class="section__title" id="servicos-heading">Nossos Serviços</h2>
                <p class="section__subtitle">
                    Expertise multidisciplinar com rigor técnico-científico para os casos mais complexos.
                </p>
            </header>

            <?php
            // Ícones SVG por índice de ordem (menu_order 0–4)
            $servico_icones = [
                // Assistência Técnica Judicial
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6l9-4 9 4v6c0 5-4 9-9 10C7 21 3 17 3 12V6z"/><path d="M9 12l2 2 4-4"/></svg>',
                // Equilíbrio Econômico-Financeiro
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="3" x2="12" y2="21"/><path d="M5 8h4l3-5 3 5h4"/><path d="M5 16h4l3 5 3-5h4"/></svg>',
                // Laudos de Engenharia
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>',
                // Laudos de Economia e Atuária
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>',
                // Gerenciamento de Projetos e Obras
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"/><line x1="12" y1="22" x2="12" y2="15.5"/><polyline points="22 8.5 12 15.5 2 8.5"/></svg>',
            ];

            $servicos_query = new WP_Query( [
                'post_type'      => 'servicos',
                'posts_per_page' => 6,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
                'post_status'    => 'publish',
            ] );

            if ( $servicos_query->have_posts() ) :
                $i = 0;
            ?>
            <ul class="cards-grid cards-grid--servicos" role="list" data-animate-stagger>
                <?php while ( $servicos_query->have_posts() ) : $servicos_query->the_post();
                    $icone = $servico_icones[ $i % count( $servico_icones ) ];
                    $i++;
                ?>
                <li class="card card--servico">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="card__image">
                        <?php the_post_thumbnail( 'alianca-card', [ 'loading' => 'lazy', 'alt' => get_the_title() ] ); ?>
                        <div class="card__icon" aria-hidden="true"><?php echo $icone; ?></div>
                    </div>
                    <?php endif; ?>
                    <div class="card__body">
                        <?php if ( ! has_post_thumbnail() ) : ?>
                        <div class="card__icon" aria-hidden="true"><?php echo $icone; ?></div>
                        <?php endif; ?>
                        <h3 class="card__title card__title--servico" id="servico-<?php the_ID(); ?>">
                            <?php the_title(); ?>
                        </h3>
                        <div class="card__footer mt-auto">
                            <a
                                href="<?php the_permalink(); ?>"
                                class="btn btn--outline btn--sm"
                                aria-labelledby="servico-<?php the_ID(); ?>"
                            >
                                Saiba Mais
                            </a>
                        </div>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul>
            <?php
            else :
            ?>
            <ul class="cards-grid cards-grid--servicos" role="list">
                <?php
                $servicos_default = [
                    [ 'titulo' => 'Assistência Técnica Judicial',               'icone' => 0 ],
                    [ 'titulo' => 'Análise de Equilíbrio Econômico-Financeiro', 'icone' => 1 ],
                    [ 'titulo' => 'Pareceres de Engenharia',                    'icone' => 2 ],
                    [ 'titulo' => 'Pareceres de Economia e Atuária',            'icone' => 3 ],
                    [ 'titulo' => 'Gerenciamento de Projetos e Obras',          'icone' => 4 ],
                ];
                foreach ( $servicos_default as $s ) :
                ?>
                <li class="card card--servico">
                    <div class="card__body">
                        <div class="card__icon" aria-hidden="true"><?php echo $servico_icones[ $s['icone'] ]; ?></div>
                        <h3 class="card__title card__title--servico"><?php echo esc_html( $s['titulo'] ); ?></h3>
                        <div class="card__footer mt-auto">
                            <a href="<?php echo esc_url( home_url( '/servicos' ) ); ?>" class="btn btn--outline btn--sm">Saiba Mais</a>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php
            endif;
            wp_reset_postdata();
            ?>

        </div>
    </section>

    <!-- ========================================================
         QUEM SOMOS — Missao, Visao e Valores
         ======================================================== -->
    <section class="section" id="sobre" aria-labelledby="sobre-heading">
        <div class="container">

            <header class="section__header">
                <span class="section__eyebrow">Nossa Identidade</span>
                <h2 class="section__title" id="sobre-heading">Quem Somos</h2>
            </header>

            <div class="about-intro grid grid--2-cols grid--align-center" data-animate="fade-up">
                <div class="about-intro__text prose">
                    <p>Com mais de 20 anos de experiência e atuação nacional, a Aliança Consultoria e Engenharia é referência em consultoria técnica especializada nas áreas de Engenharia, Economia, Finanças e Atuária.</p>
                    <p>Com escritórios nas duas maiores cidades do Brasil, Rio de Janeiro e São Paulo, entregamos soluções personalizadas para apoiar nossos clientes em processos judiciais, arbitragens, regulação de sinistros e desafios técnicos, sempre com precisão, agilidade e excelência profissional.</p>
                    <p>Nosso diferencial está em combinar uma equipe altamente qualificada com metodologias avançadas, garantindo resultados assertivos e alinhados às necessidades de nossos clientes.</p>
                </div>
                <div class="about-intro__image">
                    <?php
                    $sobre_img_url = '';
                    $sobre_img_alt = 'Aliança Consultoria e Engenharia';

                    // 1. Campo ACF na página inicial (se ACF Pro estiver ativo)
                    if ( function_exists( 'get_field' ) ) {
                        $acf_img = get_field( 'sobre_imagem', get_option( 'page_on_front' ) );
                        if ( $acf_img ) {
                            $sobre_img_url = is_array( $acf_img ) ? $acf_img['url'] : $acf_img;
                            $sobre_img_alt = is_array( $acf_img ) ? $acf_img['alt'] : $sobre_img_alt;
                        }
                    }

                    // 2. Imagem destacada da página inicial
                    if ( ! $sobre_img_url ) {
                        $front_id = get_option( 'page_on_front' );
                        if ( $front_id && has_post_thumbnail( $front_id ) ) {
                            $sobre_img_url = get_the_post_thumbnail_url( $front_id, 'large' );
                            $sobre_img_alt = get_post_meta( get_post_thumbnail_id( $front_id ), '_wp_attachment_image_alt', true ) ?: $sobre_img_alt;
                        }
                    }

                    // 3. Fallback: imagem original
                    if ( ! $sobre_img_url ) {
                        $sobre_img_url = 'https://aliancaengenharia.com.br/wp-content/uploads/2025/02/placa-alianca-1170-2.jpg';
                    }
                    ?>
                    <img
                        src="<?php echo esc_url( $sobre_img_url ); ?>"
                        alt="<?php echo esc_attr( $sobre_img_alt ); ?>"
                        class="img-responsive img-rounded shadow-lg"
                        loading="lazy"
                    >
                </div>
            </div>

            <header class="section__header" style="margin-top: var(--space-12);">
                <h2 class="section__title">Missão, Visão e Valores</h2>
            </header>

            <div class="pillars-grid" data-animate-stagger>
                <!-- Pillars follow here... -->
                <div class="pillar">
                    <div class="pillar__icon" aria-hidden="true">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 4L36 14V26L20 36L4 26V14L20 4Z" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M20 12L28 17V23L20 28L12 23V17L20 12Z" fill="currentColor" opacity="0.2"/>
                        </svg>
                    </div>
                    <h3 class="pillar__title">Missão</h3>
                    <p class="pillar__text">
                        Prover soluções técnicas de excelência em engenharia e finanças, contribuindo para a resolução justa de litígios complexos com integridade, precisão e responsabilidade ética.
                    </p>
                </div>
                <div class="pillar">
                    <div class="pillar__icon" aria-hidden="true">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="20" cy="20" r="15" stroke="currentColor" stroke-width="2" fill="none"/>
                            <circle cx="20" cy="20" r="6" fill="currentColor" opacity="0.2"/>
                            <line x1="20" y1="5" x2="20" y2="11" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <h3 class="pillar__title">Visão</h3>
                    <p class="pillar__text">
                        Ser reconhecida como a consultoria de referência nacional em perícias complexas de engenharia e finanças, consolidando nossa reputação de solidez técnica e credibilidade irrefutável.
                    </p>
                </div>
                <div class="pillar">
                    <div class="pillar__icon" aria-hidden="true">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 6L24 14H32L26 20L28 30L20 25L12 30L14 20L8 14H16L20 6Z" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                    </div>
                    <h3 class="pillar__title">Valores</h3>
                    <ul class="pillar__values">
                        <li>Competência Técnica</li>
                        <li>Honestidade e Ética</li>
                        <li>Agilidade e Comprometimento</li>
                        <li>Qualidade sem Concessões</li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <!-- ========================================================
         LIDERANCA DE PENSAMENTO — Artigos e Noticias recentes
         ======================================================== -->
    <section class="section" id="insights" aria-labelledby="insights-heading">
        <div class="container">

            <header class="section__header" data-animate="fade-up">
                <span class="section__eyebrow">Fique por Dentro</span>
                <h2 class="section__title" id="insights-heading">Notícias e Eventos</h2>
                <p class="section__subtitle">
                    Acompanhe as novidades, ações sociais e eventos da Aliança Consultoria e Engenharia.
                </p>
            </header>

            <?php
            // Puxar posts recentes de 'post' (artigos) e 'noticias' mesclados
            $insights_query = new WP_Query( [
                'post_type'      => [ 'post', 'noticias' ],
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'post_status'    => 'publish',
            ] );

            if ( $insights_query->have_posts() ) :
            ?>
            <ul class="insights-grid" role="list" data-animate-stagger>
                <?php while ( $insights_query->have_posts() ) : $insights_query->the_post(); ?>
                <li class="insight-card">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="insight-card__image">
                        <?php the_post_thumbnail( 'alianca-card', [ 'loading' => 'lazy', 'alt' => get_the_title() ] ); ?>
                    </div>
                    <?php endif; ?>
                    <div class="insight-card__body">
                        <span class="insight-card__type">
                            <?php echo get_post_type() === 'noticias' ? 'Notícia' : 'Artigo'; ?>
                        </span>
                        <time class="insight-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                            <?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?>
                        </time>
                        <h3 class="insight-card__title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p class="insight-card__excerpt"><?php the_excerpt(); ?></p>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul>
            <div class="section__footer">
                <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="btn btn--outline">
                    Ver Todas as Notícias
                </a>
            </div>
            <?php
            endif;
            wp_reset_postdata();
            ?>

        </div>
    </section>

    <!-- ========================================================
         CTA FINAL — Agendar consulta
         ======================================================== -->
    <section class="cta-band" aria-labelledby="cta-heading" data-animate="fade-up">
        <div class="container cta-band__inner">
            <div class="cta-band__text">
                <h2 class="cta-band__title" id="cta-heading">
                    Precisa de um especialista para o seu caso?
                </h2>
                <p class="cta-band__subtitle">
                    Fale com nossa equipe e descubra como podemos construir uma argumentação técnica sólida para o seu litígio.
                </p>
            </div>
            <div class="cta-band__actions">
                <a
                    href="<?php echo esc_url( ALIANCA_WHATSAPP_URL ); ?>"
                    class="btn btn--accent btn--lg"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    Agendar Consulta Técnica
                </a>
                <a href="mailto:comercial@aliancaconsultoria.com.br" class="btn btn--ghost btn--lg">
                    Enviar E-mail
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
