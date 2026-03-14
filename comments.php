<?php
/**
 * O template para exibição de comentários.
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            $alianca_comment_count = get_comments_number();
            if ( '1' === $alianca_comment_count ) {
                printf(
                    /* translators: 1: title. */
                    esc_html__( '1 comentário em &ldquo;%1$s&rdquo;', 'alianca' ),
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count number, 2: title. */
                    esc_html( _nx( '%1$s comentário em &ldquo;%2$s&rdquo;', '%1$s comentários em &ldquo;%2$s&rdquo;', $alianca_comment_count, 'comments title', 'alianca' ) ),
                    number_format_i18n( $alianca_comment_count ),
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 64,
                )
            );
            ?>
        </ol>

        <?php
        the_comments_navigation(
            array(
                'prev_text' => 'Comentários mais antigos',
                'next_text' => 'Comentários mais recentes',
            )
        );
        ?>

        <?php if ( ! comments_open() ) : ?>
            <p class="no-comments"><?php esc_html_e( 'Os comentários estão encerrados.', 'alianca' ); ?></p>
        <?php endif; ?>

    <?php endif; // Check for have_comments(). ?>

    <?php
    $commenter = wp_get_current_commenter();
    $req       = get_option( 'require_name_email' );
    
    comment_form(
        array(
            'class_form'         => 'comment-form',
            'class_submit'       => 'btn btn--accent btn--lg submit-comment-btn',
            'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
            'title_reply_after'  => '</h2>',
            'comment_notes_before' => '<p class="comment-notes">O seu endereço de e-mail não será publicado. Os campos obrigatórios estão marcados com *</p>',
            
            'comment_field'      => '<div class="form-group comment-form-comment"><label for="comment">Comentário *</label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" placeholder="O que você achou disso?"></textarea></div>',
            
            'fields'             => array(
                'author' => '<div class="form-row"><div class="form-group comment-form-author"><label for="author">Nome' . ( $req ? ' *' : '' ) . '</label> <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245" ' . ( $req ? 'required="required"' : '' ) . ' placeholder="Ex: João da Silva"/></div>',
                
                'email'  => '<div class="form-group comment-form-email"><label for="email">E-mail' . ( $req ? ' *' : '' ) . '</label> <input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" ' . ( $req ? 'required="required"' : '' ) . ' placeholder="exemplo@email.com"/></div>',
                
                'url'    => '<div class="form-group comment-form-url"><label for="url">Site (opcional)</label> <input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" placeholder="https://seudominio.com.br"/></div></div>',
            ),
        )
    );
    ?>

</div><!-- #comments -->
