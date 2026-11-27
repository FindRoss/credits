// Homepage "Choose your state" dropdown: go to the selected state's page.
document.addEventListener( 'change', function ( e ) {
	var select = e.target.closest( '[data-state-select]' );
	if ( select && select.value ) {
		window.location.href = select.value;
	}
} );
