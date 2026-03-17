/**
 * animations.js
 * Scroll-triggered reveal usando Intersection Observer.
 * Sem dependências externas.
 */

( function () {
    'use strict';

    // Respeita preferência do usuário por movimento reduzido
    if ( window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) return;

    const observer = new IntersectionObserver(
        function ( entries ) {
            entries.forEach( function ( entry ) {
                if ( entry.isIntersecting ) {
                    entry.target.classList.add( 'is-visible' );
                    observer.unobserve( entry.target );
                }
            } );
        },
        { threshold: 0.12 }
    );

    // Observar elementos com data-animate e data-animate-stagger
    document.querySelectorAll( '[data-animate], [data-animate-stagger]' ).forEach( function ( el ) {
        observer.observe( el );
    } );

} )();
