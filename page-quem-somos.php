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
                Referência nacional em consultoria técnica especializada com mais de 20 anos de experiência e atuação em todo o Brasil.
            </p>
        </div>
    </div>

    <!-- Missao / Visao / Valores -->
    <section class="section section--alt" aria-labelledby="mvv-heading">
        <div class="container">
            <header class="section__header">
                <h2 class="section__title" id="mvv-heading">Missão, Visão e Valores</h2>
            </header>
            <div class="pillars-grid">

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

    <section class="section">
        <div class="container">
            <div class="grid grid--2-cols grid--align-center">
                <div class="about-intro__text prose">
                    <p>Com mais de 20 anos de experiência e atuação nacional, a Aliança Consultoria e Engenharia é referência em consultoria técnica especializada nas áreas de Engenharia, Economia, Finanças e Atuária.</p>
                    <p>Com escritórios nas duas maiores cidades do Brasil, Rio de Janeiro e São Paulo, entregamos soluções personalizadas para apoiar nossos clientes em processos judiciais, arbitragens, regulação de sinistros e desafios técnicos, sempre com precisão, agilidade e excelência profissional.</p>
                    <p>Nosso diferencial está em combinar uma equipe altamente qualificada com metodologias avançadas, garantindo resultados assertivos e alinhados às necessidades de nossos clientes.</p>
                </div>
                <div class="about-intro__image">
                    <img src="https://aliancaengenharia.com.br/wp-content/uploads/2025/02/placa-alianca-1170-2.jpg" alt="Placa Aliança Consultoria e Engenharia" class="img-responsive img-rounded shadow-lg">
                </div>
            </div>
            
            <?php if ( get_the_content() ) : ?>
            <div class="entry-content prose qs-text">
                <?php the_content(); ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

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
                        <h3 class="diferencial__title">Metodologia Acadêmica</h3>
                        <p class="diferencial__text">Laudos fundamentados em literatura científica e normas técnicas internacionais, com rigor metodológico exigido nos tribunais arbitrais de maior complexidade.</p>
                    </div>
                </li>
                <li class="diferencial">
                    <span class="diferencial__num" aria-hidden="true">02</span>
                    <div>
                        <h3 class="diferencial__title">Equipe Multidisciplinar</h3>
                        <p class="diferencial__text">Engenheiros, economistas, atuários e advogados trabalhando de forma integrada para cobrir todas as dimensões técnicas e jurídicas de cada caso.</p>
                    </div>
                </li>
                <li class="diferencial">
                    <span class="diferencial__num" aria-hidden="true">03</span>
                    <div>
                        <h3 class="diferencial__title">Experiência em Litígios Complexos</h3>
                        <p class="diferencial__text">Atuamos em disputas de alta complexidade envolvendo infraestrutura, concessões, PPPs, barragens, seguros e contratos de longo prazo.</p>
                    </div>
                </li>
                <li class="diferencial">
                    <span class="diferencial__num" aria-hidden="true">04</span>
                    <div>
                        <h3 class="diferencial__title">Sigilo e Confiabilidade</h3>
                        <p class="diferencial__text">Compromisso absoluto com a confidencialidade das informações dos clientes, respeitando os mais altos padrões de ética profissional e conformidade com a LGPD.</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <!-- Setores Atendidos -->
    <section class="section pt-0" aria-labelledby="setores-heading">
        <div class="container">
            <header class="section__header">
                <span class="section__eyebrow">Presença Nacional</span>
                <h2 class="section__title" id="setores-heading">Setores de Atuação</h2>
                <p class="section__subtitle">Experiência comprovada nos segmentos de maior complexidade técnica e jurídica do país.</p>
            </header>
            <ul class="setores-grid" role="list">
                <li class="setor-tag">Infraestrutura</li>
                <li class="setor-tag">Portos e Logística</li>
                <li class="setor-tag">Barragens e Hidrelétricas</li>
                <li class="setor-tag">Seguradoras</li>
                <li class="setor-tag">Fundos de Pensão</li>
                <li class="setor-tag">Concessões Rodoviárias</li>
                <li class="setor-tag">PPPs</li>
                <li class="setor-tag">Saneamento Básico</li>
                <li class="setor-tag">Energia Elétrica</li>
                <li class="setor-tag">Mineração</li>
            </ul>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-band" aria-labelledby="qs-cta-heading">
        <div class="container cta-band__inner">
            <div class="cta-band__text">
                <h2 class="cta-band__title" id="qs-cta-heading">Vamos trabalhar juntos?</h2>
                <p class="cta-band__subtitle">Fale com nossa equipe e descubra como podemos construir uma argumentação técnica sólida para o seu litígio.</p>
            </div>
            <div class="cta-band__actions">
                <a href="<?php echo esc_url( home_url( '/contato' ) ); ?>" class="btn btn--accent btn--lg">
                    Entrar em Contato
                </a>
                <a href="<?php echo esc_url( home_url( '/servicos' ) ); ?>" class="btn btn--ghost btn--lg">
                    Ver Serviços
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
