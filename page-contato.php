<?php
/**
 * Template Name: Contato
 * Template para a pagina /contato com layout estruturado.
 */

get_header();
?>

<main id="main-content" class="site-main" role="main">

    <!-- Hero -->
    <div class="page-hero">
        <div class="container">
            <p class="section__eyebrow">Fale Conosco</p>
            <h1 class="page-hero__title">Contato</h1>
            <p class="page-hero__subtitle">
                Entre em contato com nossa equipe. Respondemos em até 24 horas úteis.
            </p>
        </div>
    </div>

    <section class="section">
        <div class="container">

            <header class="section__header">
                <h2 class="section__title">Nossos Escritórios</h2>
                <p class="section__subtitle">Estamos presentes nas duas maiores cidades do Brasil.</p>
            </header>

            <!-- Escritórios lado a lado -->
            <div class="escritorios-grid">

                <div class="escritorio">
                    <h3 class="escritorio__cidade"><?php echo get_field('contato_cidade_1') ?: 'Rio de Janeiro'; ?></h3>
                    <address class="escritorio__address">
                        <p><?php echo get_field('contato_endereco_1') ?: 'Rua da Assembléia, 58, 6º andar<br>Centro — Rio de Janeiro — RJ<br>CEP 20011-000'; ?></p>
                        <p>
                            <?php if($tel1 = get_field('contato_telefone_1')): ?>
                                <a href="tel:<?php echo preg_replace('/\D/', '', $tel1); ?>" class="escritorio__tel"><?php echo esc_html($tel1); ?></a>
                            <?php else: ?>
                                <a href="tel:+552125447444" class="escritorio__tel">+55 (21) 2544-7444</a>
                            <?php endif; ?>
                            <?php if($tel2 = get_field('contato_telefone_2')): ?>
                                <span aria-hidden="true"> | </span>
                                <a href="tel:<?php echo preg_replace('/\D/', '', $tel2); ?>" class="escritorio__tel"><?php echo esc_html($tel2); ?></a>
                            <?php endif; ?>
                        </p>
                        <p>
                            <a href="mailto:<?php echo get_field('contato_email') ?: 'comercial@aliancaengenharia.com.br'; ?>" class="escritorio__email">
                                <?php echo get_field('contato_email') ?: 'comercial@aliancaengenharia.com.br'; ?>
                            </a>
                        </p>
                    </address>
                </div>

                <div class="escritorio">
                    <h3 class="escritorio__cidade"><?php echo get_field('contato_cidade_2') ?: 'São Paulo'; ?></h3>
                    <address class="escritorio__address">
                        <p><?php echo get_field('contato_endereco_2') ?: 'Av. Brg. Faria Lima, 3729, 5º andar<br>Itaim Bibi — São Paulo — SP<br>CEP 04538-905'; ?></p>
                        <p>
                            <?php if($tel3 = get_field('contato_telefone_3')): ?>
                                <a href="tel:<?php echo preg_replace('/\D/', '', $tel3); ?>" class="escritorio__tel"><?php echo esc_html($tel3); ?></a>
                            <?php else: ?>
                                <a href="tel:+551134436221" class="escritorio__tel">+55 (11) 3443-6221</a>
                            <?php endif; ?>
                        </p>
                        <p>
                            <a href="mailto:<?php echo get_field('contato_email') ?: 'comercial@aliancaengenharia.com.br'; ?>" class="escritorio__email">
                                <?php echo get_field('contato_email') ?: 'comercial@aliancaengenharia.com.br'; ?>
                            </a>
                        </p>
                    </address>
                </div>

            </div>

            <!-- Contact Form 7 -->
            <header class="section__header contato-form-heading">
                <h2 class="section__title">Entre em Contato</h2>
                <p class="section__subtitle">Preencha o formulário abaixo e retornaremos em breve.</p>
            </header>
            <div class="contato-form">
                <?php echo do_shortcode('[contact-form-7 id="a520c1f" title="Contact"]'); ?>
            </div>


        </div>
    </section>

</main>

<?php get_footer(); ?>
