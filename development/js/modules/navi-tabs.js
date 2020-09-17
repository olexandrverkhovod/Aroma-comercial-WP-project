/**
 * Tabs Navigation functionality
 * @param tabSwitchSelectors  -  css selectors
 * @param tabPanelSelectors   -  css selectors
 */
export function tabsNavigation( tabSwitchSelectors, tabPanelSelectors ) {

    // Handler for case when we put "tabSwitchSelectors"
    // as Node list or css selector
    const SWITCHERs = ( typeof tabSwitchSelectors === 'string' )
                        ? [...document.querySelectorAll(tabSwitchSelectors)]
                        : tabSwitchSelectors;

    // Handler for case when we put "tabPanelSelectors"
    // as Node list or css selector
    const PANELs = ( typeof tabPanelSelectors === 'string' )
                        ? [...document.querySelectorAll(tabPanelSelectors)]
                        : tabPanelSelectors;

    SWITCHERs.forEach( (item) => {

		item.addEventListener('click', (event) => {

			const TAB_ID = ( event.target.nodeName === 'A' )
								? event.target.getAttribute('href')
								: event.target.dataset.href;

			// Remove active state from all switch elements
            SWITCHERs.forEach( el => el.classList.remove('active') );

			// Remove active state from all tabs panels
            PANELs.forEach( el => el.classList.remove('active') );

			// Set active state to current
			event.target.classList.add('active');

			const TAB_ID_NODE = document.querySelector(TAB_ID);

			(TAB_ID_NODE) && TAB_ID_NODE.classList.add('active');


			// force trigger resize event for the document
			if ( document.createEvent ) {
				window.dispatchEvent( new Event('resize') );
			} else {
				document.body.fireEvent('onresize');
			}

		});

	});


}