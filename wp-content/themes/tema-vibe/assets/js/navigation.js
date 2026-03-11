/**
 * navigation.js
 * Menu mobile acessivel — sem jQuery, sem dependencias.
 * WCAG: aria-expanded, aria-hidden, focus trap, ESC para fechar.
 */

( function () {
    'use strict';

    const toggle   = document.querySelector( '.nav-toggle' );
    const menu     = document.querySelector( '.nav-menu' );
    const siteNav  = document.querySelector( '.site-nav' );

    if ( ! toggle || ! menu ) return;

    // --------------------------------------------------------
    // Abrir / fechar menu mobile
    // --------------------------------------------------------
    function openMenu() {
        toggle.setAttribute( 'aria-expanded', 'true' );
        menu.classList.add( 'is-open' );
        menu.setAttribute( 'aria-hidden', 'false' );
    }

    function closeMenu() {
        toggle.setAttribute( 'aria-expanded', 'false' );
        menu.classList.remove( 'is-open' );
        menu.setAttribute( 'aria-hidden', 'true' );
    }

    function isOpen() {
        return toggle.getAttribute( 'aria-expanded' ) === 'true';
    }

    toggle.addEventListener( 'click', function () {
        isOpen() ? closeMenu() : openMenu();
    } );

    // Fechar com ESC
    document.addEventListener( 'keydown', function ( e ) {
        if ( e.key === 'Escape' && isOpen() ) {
            closeMenu();
            toggle.focus();
        }
    } );

    // Fechar ao clicar fora
    document.addEventListener( 'click', function ( e ) {
        if ( isOpen() && ! siteNav.contains( e.target ) ) {
            closeMenu();
        }
    } );

    // --------------------------------------------------------
    // Submenus — toggle por clique (mobile) e teclado (desktop)
    // --------------------------------------------------------
    const parentItems = menu.querySelectorAll( '.menu-item-has-children > .nav-link' );

    parentItems.forEach( function ( link ) {
        link.addEventListener( 'click', function ( e ) {
            // No mobile: prevenir navegacao e abrir submenu
            if ( window.innerWidth < 1024 ) {
                e.preventDefault();
                const expanded = link.getAttribute( 'aria-expanded' ) === 'true';
                const subMenu  = link.nextElementSibling;

                // Fechar outros submenus abertos
                parentItems.forEach( function ( other ) {
                    if ( other !== link ) {
                        other.setAttribute( 'aria-expanded', 'false' );
                        const otherSub = other.nextElementSibling;
                        if ( otherSub ) {
                            otherSub.classList.remove( 'is-open' );
                            otherSub.setAttribute( 'aria-hidden', 'true' );
                        }
                        const arrow = other.querySelector( '.nav-arrow' );
                        if ( arrow ) arrow.style.transform = '';
                    }
                } );

                link.setAttribute( 'aria-expanded', String( ! expanded ) );

                if ( subMenu ) {
                    subMenu.classList.toggle( 'is-open', ! expanded );
                    subMenu.setAttribute( 'aria-hidden', String( expanded ) );
                }

                const arrow = link.querySelector( '.nav-arrow' );
                if ( arrow ) {
                    arrow.style.transform = expanded ? '' : 'rotate(180deg)';
                }
            }
        } );

        // Teclado: Enter e Space abrem submenu
        link.addEventListener( 'keydown', function ( e ) {
            if ( e.key === 'Enter' || e.key === ' ' ) {
                if ( window.innerWidth >= 1024 ) return;
                e.preventDefault();
                link.click();
            }

            // Seta para baixo abre e move foco para primeiro item
            if ( e.key === 'ArrowDown' ) {
                e.preventDefault();
                const subMenu = link.nextElementSibling;
                if ( subMenu ) {
                    link.setAttribute( 'aria-expanded', 'true' );
                    subMenu.classList.add( 'is-open' );
                    subMenu.setAttribute( 'aria-hidden', 'false' );
                    const firstLink = subMenu.querySelector( '.nav-link' );
                    if ( firstLink ) firstLink.focus();
                }
            }
        } );
    } );

    // Fechar submenu ao pressionar ESC dentro dele
    menu.addEventListener( 'keydown', function ( e ) {
        if ( e.key === 'Escape' ) {
            const openSub = menu.querySelector( '.sub-menu.is-open' );
            if ( openSub ) {
                openSub.classList.remove( 'is-open' );
                openSub.setAttribute( 'aria-hidden', 'true' );
                const parentLink = openSub.previousElementSibling;
                if ( parentLink ) {
                    parentLink.setAttribute( 'aria-expanded', 'false' );
                    parentLink.focus();
                }
            }
        }
    } );

    // --------------------------------------------------------
    // Resetar estado ao redimensionar para desktop
    // --------------------------------------------------------
    const mq = window.matchMedia( '(min-width: 64rem)' );

    function handleBreakpoint( e ) {
        if ( e.matches ) {
            // Desktop: garantir que o menu esteja visivel e aria correto
            closeMenu();
            menu.removeAttribute( 'aria-hidden' );
            parentItems.forEach( function ( link ) {
                link.setAttribute( 'aria-expanded', 'false' );
                const arrow = link.querySelector( '.nav-arrow' );
                if ( arrow ) arrow.style.transform = '';
            } );
        }
    }

    mq.addEventListener( 'change', handleBreakpoint );

} )();
