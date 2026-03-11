<?php
/**
 * Template Name: Quem Somos
 * Template para a pagina /quem-somos com layout estruturado.
 */

get_header();
?>

<main id="main-content" class="site-main" role="main">

    <!-- Hero -->
    <div class="page-hero">
        <div class="container">
            <p class="section__eyebrow">Nossa Identidade</p>
            <h1 class="page-hero__title">Quem Somos</h1>
            <p class="page-hero__subtitle">
                Referencia nacional em pericias complexas de engenharia e financas, com rigor tecnico-cientifico e credibilidade irrefutavel.
            </p>
        </div>
    </div>

    <!-- Missao / Visao / Valores -->
    <section class="section section--alt" aria-labelledby="mvv-heading">
        <div class="container">
            <h2 class="sr-only" id="mvv-heading">Missao, Visao e Valores</h2>
            <div class="pillars-grid">

                <div class="pillar">
                    <div class="pillar__icon" aria-hidden="true">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 4L36 14V26L20 36L4 26V14L20 4Z" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M20 12L28 17V23L20 28L12 23V17L20 12Z" fill="currentColor" opacity="0.2"/>
                        </svg>
                    </div>
                    <h3 class="pillar__title">Missao</h3>
                    <p class="pillar__text">
                        Prover solucoes tecnicas de excelencia em engenharia e financas, contribuindo para a resolucao justa de litigios complexos com integridade, precisao e responsabilidade etica.
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
                        Ser reconhecida como a consultoria de referencia nacional em pericias complexas de engenharia e financas, consolidando nossa reputacao de solidez tecnica e credibilidade irrefutavel.
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
                        <li>Competencia Tecnica</li>
                        <li>Honestidade e Etica</li>
                        <li>Agilidade e Comprometimento</li>
                        <li>Qualidade sem Concessoes</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- Conteudo da pagina (editor WP) -->
    <?php if ( have_posts() ) : the_post(); ?>
    <?php if ( has_post_thumbnail() || get_the_content() ) : ?>
    <section class="section">
        <div class="container qs-layout">

            <?php if ( has_post_thumbnail() ) : ?>
            <figure class="qs-image">
                <?php the_post_thumbnail( 'alianca-hero', [
                    'loading' => 'lazy',
                    'alt'     => get_the_title(),
                    'class'   => 'qs-image__img',
                ] ); ?>
            </figure>
            <?php endif; ?>

            <?php if ( get_the_content() ) : ?>
            <div class="entry-content prose qs-text">
                <?php the_content(); ?>
            </div>
            <?php endif; ?>

        </div>
    </section>
    <?php endif; ?>
    <?php endif; ?>

    <!-- Diferenciais -->
    <section class="section section--alt" aria-labelledby="diferenciais-heading">
        <div class="container">
            <header class="section__header">
                <span class="section__eyebrow">Por que nos escolher</span>
                <h2 class="section__title" id="diferenciais-heading">Nossos Diferenciais</h2>
            </header>
            <ul class="diferenciais-grid" role="list">
                <li class="diferencial">
                    <span class="diferencial__num" aria-hidden="true">01</span>
                    <div>
                        <h3 class="diferencial__title">Metodologia Academica</h3>
                        <p class="diferencial__text">Laudos fundamentados em literatura cientifica e normas tecnicas internacionais, com rigor metodologico exigido nos tribunais arbitrais de maior complexidade.</p>
                    </div>
                </li>
                <li class="diferencial">
                    <span class="diferencial__num" aria-hidden="true">02</span>
                    <div>
                        <h3 class="diferencial__title">Equipe Multidisciplinar</h3>
                        <p class="diferencial__text">Engenheiros, economistas, atuarios e advogados trabalhando de forma integrada para cobrir todas as dimensoes tecnicas e juridicas de cada caso.</p>
                    </div>
                </li>
                <li class="diferencial">
                    <span class="diferencial__num" aria-hidden="true">03</span>
                    <div>
                        <h3 class="diferencial__title">Experiencia em Litigios Complexos</h3>
                        <p class="diferencial__text">Atuamos em disputas de alta complexidade envolvendo infraestrutura, concessoes, PPPs, barragens, seguros e contratos de longo prazo.</p>
                    </div>
                </li>
                <li class="diferencial">
                    <span class="diferencial__num" aria-hidden="true">04</span>
                    <div>
                        <h3 class="diferencial__title">Sigilo e Confiabilidade</h3>
                        <p class="diferencial__text">Compromisso absoluto com a confidencialidade das informacoes dos clientes, respeitando os mais altos padroes de etica profissional e conformidade com a LGPD.</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <!-- Setores Atendidos -->
    <section class="section" aria-labelledby="setores-heading">
        <div class="container">
            <header class="section__header">
                <span class="section__eyebrow">Presenca Nacional</span>
                <h2 class="section__title" id="setores-heading">Setores de Atuacao</h2>
                <p class="section__subtitle">Experiencia comprovada nos segmentos de maior complexidade tecnica e juridica do pais.</p>
            </header>
            <ul class="setores-grid" role="list">
                <li class="setor-tag">Infraestrutura</li>
                <li class="setor-tag">Portos e Logistica</li>
                <li class="setor-tag">Barragens e Hidreletricas</li>
                <li class="setor-tag">Seguradoras</li>
                <li class="setor-tag">Fundos de Pensao</li>
                <li class="setor-tag">Concessoes Rodoviarias</li>
                <li class="setor-tag">PPPs</li>
                <li class="setor-tag">Saneamento Basico</li>
                <li class="setor-tag">Energia Eletrica</li>
                <li class="setor-tag">Mineracao</li>
            </ul>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-band" aria-labelledby="qs-cta-heading">
        <div class="container cta-band__inner">
            <div class="cta-band__text">
                <h2 class="cta-band__title" id="qs-cta-heading">Vamos trabalhar juntos?</h2>
                <p class="cta-band__subtitle">Fale com nossa equipe e descubra como podemos construir uma argumentacao tecnica solida para o seu litigio.</p>
            </div>
            <div class="cta-band__actions">
                <a href="<?php echo esc_url( home_url( '/contato' ) ); ?>" class="btn btn--accent btn--lg">
                    Entrar em Contato
                </a>
                <a href="<?php echo esc_url( home_url( '/servicos' ) ); ?>" class="btn btn--ghost btn--lg">
                    Ver Servicos
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
