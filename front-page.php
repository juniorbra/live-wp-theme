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
            </div>
        </div><!-- fecha hero__content -->

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
    </section>

    <!-- ========================================================
         PROVA SOCIAL — faixa de logos de clientes
         ======================================================== -->
    <section class="social-proof" aria-label="Setores atendidos">
        <div class="container">
            <p class="social-proof__label">Confianca comprovada nos setores de maior complexidade:</p>
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

            <header class="section__header">
                <span class="section__eyebrow">Áreas de Atuação</span>
                <h2 class="section__title" id="servicos-heading">Nossos Serviços</h2>
                <p class="section__subtitle">
                    Expertise multidisciplinar com rigor técnico-científico para os casos mais complexos.
                </p>
            </header>

            <?php
            $servicos_query = new WP_Query( [
                'post_type'      => 'servicos',
                'posts_per_page' => 6,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
                'post_status'    => 'publish',
            ] );

            if ( $servicos_query->have_posts() ) :
            ?>
            <ul class="cards-grid cards-grid--servicos" role="list">
                <?php while ( $servicos_query->have_posts() ) : $servicos_query->the_post(); ?>
                <li class="card card--servico">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="card__image">
                        <?php the_post_thumbnail( 'alianca-card', [
                            'loading' => 'lazy',
                            'alt'     => get_the_title(),
                        ] ); ?>
                    </div>
                    <?php endif; ?>
                    <div class="card__body">
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
                </li>
                <?php endwhile; ?>
            </ul>
            <?php
            else :
                // Fallback estatico enquanto os CPTs nao foram preenchidos
            ?>
            <ul class="cards-grid cards-grid--servicos" role="list">
                <?php
                $servicos_default = [
                    [ 'titulo' => 'Pareceres de Economia e Atuária',           'desc' => 'Modelagem econômica, cálculo atuarial e fórmulas matemáticas aplicadas a litígios financeiros complexos.' ],
                    [ 'titulo' => 'Pareceres de Engenharia',                   'desc' => 'Laudos periciais técnicos com metodologia rigorosa para disputas em obras de infraestrutura.' ],
                    [ 'titulo' => 'Assistência Técnica Judicial',              'desc' => 'Suporte especializado a peritos judiciais e apoio técnico em todas as fases processuais.' ],
                    [ 'titulo' => 'Análise de Equilíbrio Econômico-financeiro','desc' => 'Avaliação de reequilíbrio contratual em concessões, PPPs e contratos de longo prazo.' ],
                    [ 'titulo' => 'Gerenciamento de Obras Complexas',          'desc' => 'Gestão técnica e financeira de empreendimentos de grande porte com foco em prazo e conformidade.' ],
                ];
                foreach ( $servicos_default as $s ) :
                ?>
                <li class="card card--servico">
                    <div class="card__body">
                        <h3 class="card__title"><?php echo esc_html( $s['titulo'] ); ?></h3>
                        <div class="card__footer mt-auto">
                        <a href="<?php echo esc_url( home_url( '/servicos' ) ); ?>" class="btn btn--outline btn--sm">Saiba Mais</a>
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
    <section class="section section--alt" id="sobre" aria-labelledby="sobre-heading">
        <div class="container">

            <header class="section__header">
                <span class="section__eyebrow">Nossa Identidade</span>
                <h2 class="section__title" id="sobre-heading">Quem Somos</h2>
            </header>

            <div class="about-intro grid grid--2-cols grid--align-center">
                <div class="about-intro__text prose">
                    <p>Com mais de 20 anos de experiência e atuação nacional, a Aliança Consultoria e Engenharia é referência em consultoria técnica especializada nas áreas de Engenharia, Economia, Finanças e Atuária.</p>
                    <p>Com escritórios nas duas maiores cidades do Brasil, Rio de Janeiro e São Paulo, entregamos soluções personalizadas para apoiar nossos clientes em processos judiciais, arbitragens, regulação de sinistros e desafios técnicos, sempre com precisão, agilidade e excelência profissional.</p>
                    <p>Nosso diferencial está em combinar uma equipe altamente qualificada com metodologias avançadas, garantindo resultados assertivos e alinhados às necessidades de nossos clientes.</p>
                </div>
                <div class="about-intro__image">
                    <img src="https://aliancaengenharia.com.br/wp-content/uploads/2025/02/placa-alianca-1170-2.jpg" alt="Logo Aliança Consultoria e Engenharia" class="img-responsive img-rounded shadow-lg">
                </div>
            </div>

            <header class="section__header" style="margin-top: var(--space-12);">
                <h2 class="section__title">Missão, Visão e Valores</h2>
            </header>

            <div class="pillars-grid">
                <!-- Pillars follow here... -->
                <div class="pillar">
                    <div class="pillar__icon" aria-hidden="true">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 4L36 14V26L20 36L4 26V14L20 4Z" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M20 12L28 17V23L20 28L12 23V17L20 12Z" fill="currentColor" opacity="0.2"/>
                        </svg>
                    </div>
                    <h3 class="pillar__title">Missao</h3>
                    <p class="pillar__text">
                        Prover solucoes técnicas de excelencia em engenharia e financas, contribuindo para a resolucao justa de litigios complexos com integridade, precisao e responsabilidade etica.
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
                    <h3 class="pillar__title">Visao</h3>
                    <p class="pillar__text">
                        Ser reconhecida como a consultoria de referencia nacional em pericias complexas de engenharia e financas, consolidando nossa reputacao de solidez técnica e credibilidade irrefutavel.
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
                        <li>Competencia Técnica</li>
                        <li>Honestidade e Etica</li>
                        <li>Agilidade e Comprometimento</li>
                        <li>Qualidade sem Concessoes</li>
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

            <header class="section__header">
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
            <ul class="insights-grid" role="list">
                <?php while ( $insights_query->have_posts() ) : $insights_query->the_post(); ?>
                <li class="insight-card">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="insight-card__image">
                        <?php the_post_thumbnail( 'alianca-card', [ 'loading' => 'lazy', 'alt' => get_the_title() ] ); ?>
                    </div>
                    <?php endif; ?>
                    <div class="insight-card__body">
                        <span class="insight-card__type">
                            <?php echo get_post_type() === 'noticias' ? 'Noticia' : 'Artigo'; ?>
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
    <section class="cta-band" aria-labelledby="cta-heading">
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
