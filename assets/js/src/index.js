const menuButton = document.getElementsByClassName( 'js-menu-toggle' )[ 0 ]
	.firstChild;
const menu = document.getElementsByClassName( 'js-menu-open' )[ 0 ];
const header = document.getElementById( 'masthead' );
const logo = document.getElementsByClassName( 'custom-logo-link' )[ 0 ];

window.onscroll = () => {
	if ( window.pageYOffset > 10 ) {
		header.classList.add( 'scrolled' );
		logo.style.paddingRight = '0px';
	} else {
		header.classList.remove( 'scrolled' );
		logo.style.removeProperty( 'padding' );
	}
};

window.onclick = ( e ) => {
	if ( e.target !== menu && e.target !== menuButton && menu.classList
		.contains( 'is-open' ) ) {
		menu.classList.remove( 'is-open' );
	}
};

menuButton.onclick = () => {
	menu.classList.toggle( 'is-open' );
};
