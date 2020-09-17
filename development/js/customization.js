import smoothscroll from 'smoothscroll-polyfill';
import Popup from './modules/popup-window.js';
import {debounce} from './modules/helpers.js';
import {tabsNavigation} from './modules/navi-tabs.js';
//import Swiper from '../node_modules/swiper/swiper-bundle.min.js';

;(function ($) {
$(document).ready(function () {

    const $HTML  = $('html');
    const BODY   = document.body;
    const HEADER = document.querySelector('#site-header');

    const IFRAME_BUILDERs    = document.querySelectorAll('.js-iframe-builder');
    const MENU_MOBILE        = document.querySelector('#menu_mobile');
    const MENU_BUTTON        = document.querySelector('#hamburger');
    const CLOSE_MENU_BUTTON  = document.querySelector('#close-mobile-menu');
    const PAGE_TABS_BOX      = document.querySelectorAll('.js-custom-scrollbar');
    const TABS_BOX_WRAPPER   = document.querySelectorAll('.js-tabs-box__wrapper');
    const PRODUCT_EXCERPT    = document.querySelectorAll('.js-product-item-excerpt-content');
    const EXCERPT_BUTTON     = document.querySelectorAll('.js-excerpt-switcher');
    //const TABS_BUTTONS       = document.querySelectorAll('.js-tabs-box-activator');
    //const CAROUSEL_NAV_TAB   = document.querySelectorAll('.js-nav-tab');
    const FADE_SLIDERs       = document.querySelectorAll('.js-fade-slider');


    /**
     * Get Element coordinates from document left-top corner
     * @param elem
     * @returns {{top: number, left: number}}
     */
    function getCoords(elem) { // crossbrowser version

        if ( !elem ) {
            return null;
        }

        let box = elem.getBoundingClientRect();

        let body = document.body;
        let docEl = document.documentElement;

        let scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
        let scrollLeft = window.pageXOffset || docEl.scrollLeft || body.scrollLeft;

        let clientTop = docEl.clientTop || body.clientTop || 0;
        let clientLeft = docEl.clientLeft || body.clientLeft || 0;

        let top  = box.top +  scrollTop - clientTop;
        let left = box.left + scrollLeft - clientLeft;

        return { top: Math.round(top), left: Math.round(left) };
    }



    /**
     * Menu buttons
     */
    function m_menu(event) {
        event.preventDefault();
    setInterval(
        (MENU_MOBILE) && MENU_MOBILE.classList.toggle('active'), 2000)
    }


    window.onload = function () {

        // kick off the polyfill!
        smoothscroll.polyfill();

        // Example
        const popup_instance = new Popup();
        popup_instance.init();


        $('a[href*=".jpg"], a[href*=".png"]').fancybox({
            // Options will go here
        });

        /**
         * Slick slider initialize
         */
        (FADE_SLIDERs)
        && FADE_SLIDERs.forEach( item => {

            const PARENT = item.closest('.js-fade-slider-wrapper');
            const SLIDEs_COUNT = (PARENT.classList.contains('cert')) ? 4 : 1 ;
            const SLIDEs_SETTINGS = [{
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: true
                    }
                }];

            const SLIDEs_RESPONSIVE = (PARENT.classList.contains('cert')) ? SLIDEs_SETTINGS : [];
            const SLIDEs_FADE       = (! PARENT.classList.contains('cert'));

            $(item).slick({
                dots: false,
                infinite: true,
                fade: SLIDEs_FADE,
                speed: 500,
                cssEase: 'linear',
                loop: true,
                slidesToShow: SLIDEs_COUNT,
                responsive: SLIDEs_RESPONSIVE,
                nextArrow: (PARENT) && PARENT.querySelector('.js-next'),
                prevArrow: (PARENT) && PARENT.querySelector('.js-prev')
            });
        });


        /**
         * Dynamic building iframe tag when user click on activation element
         */
        (IFRAME_BUILDERs) && [...IFRAME_BUILDERs].forEach(item => {
            item.addEventListener('click', event => {
                const IFRAME_ADDRESS = event.target.dataset.href;

                if (!IFRAME_ADDRESS) return;

                const new_iframe = document.createElement("iframe");
                new_iframe.src   = IFRAME_ADDRESS;

                item.appendChild(new_iframe);
                item.classList.add('added');
            });
        });


        /**
         * Close/open mobile menu
         */
        (MENU_BUTTON) && MENU_BUTTON.addEventListener('click', m_menu);
        (CLOSE_MENU_BUTTON) && CLOSE_MENU_BUTTON.addEventListener('click', m_menu);


        /**
         * Excerpt product item
         */
        if(EXCERPT_BUTTON) {
            EXCERPT_BUTTON.forEach(el => {
                el.addEventListener('click', (event) => {
                    event.preventDefault();
                    let container = event.target.closest('.product-item__content');
                    let content = container.querySelectorAll('.js-product-item-excerpt-content');
                    [...content].forEach( item => item.classList.toggle('active') );
                })
            })
        }


        /**
         * Scroll header behaviour
         */
        const MAIN_WRAPPER_COORDINATES = getCoords(document.querySelector('#main-wrapper'));

        window.addEventListener('scroll', debounce( (element) => {
            let last_known_scroll_position = window.scrollY;

            if ( last_known_scroll_position>=MAIN_WRAPPER_COORDINATES.top ) {
                HEADER.classList.add('scrolled');
            } else {
                HEADER.classList.remove('scrolled');
            }
        } , 30));


        /**
         * Custom Tab slider
         */
        ( TABS_BOX_WRAPPER )
        && TABS_BOX_WRAPPER.forEach( tab_parent => {

            const ACTIVATORS = tab_parent.querySelectorAll('.js-tabs-box-activator');
            const PANELs     = tab_parent.querySelectorAll('.js-tabs-box-panel');

            tabsNavigation( ACTIVATORS, PANELs );
        });


        /**
         * Custom Scrollbar
         */
        (PAGE_TABS_BOX)
        && $(PAGE_TABS_BOX).mCustomScrollbar({
            axis:"x",
            alwaysShowScrollbar: 0,
            advanced:{autoExpandHorizontalScroll:true}

        });


        // Prev/Next tabs slider box
        BODY.addEventListener('click', event => {

            if ( ![...event.target.classList].includes('js-nav-tab') ) { return; }
            event.stopPropagation();
            event.preventDefault();

            // console.log('event.target', event.target);

            const TABS_PARENT          = event.target.closest('.tabs-box__activator-wrapper');
            const TABS_LINE_PARENT     = event.target.closest('.js-tabs-box__wrapper');
            const TABS_LINE            = TABS_LINE_PARENT.querySelector('.js-custom-scrollbar');
            const TABS_BOX_ITEMs       = TABS_PARENT.querySelectorAll('.js-tabs-box-activator');
            const TABS_BOX_ITEM_ACTIVE = TABS_PARENT.querySelector('.js-tabs-box-activator.active');

            console.log('TABS_PARENT',TABS_PARENT);
            console.log('TABS_LINE_PARENT',TABS_LINE_PARENT);
            console.log('TABS_LINE ',TABS_LINE );
            console.log('TABS_BOX_ITEMs',TABS_BOX_ITEMs);
            console.log('TABS_BOX_ITEM_ACTIVE',TABS_BOX_ITEM_ACTIVE);



            const DIRECTION     = event.target.dataset.nav;
            const TABS_BOX_NEXT = ( DIRECTION && DIRECTION==='next' )
                                    ?  TABS_BOX_ITEM_ACTIVE.nextElementSibling
                                    :  TABS_BOX_ITEM_ACTIVE.previousElementSibling;

            console.log('TABS_BOX_NEXT',TABS_BOX_NEXT);

            let nextActive = null;

            (TABS_BOX_ITEMs) && [...TABS_BOX_ITEMs].forEach( item => item.classList.remove('active') );

            if ( TABS_BOX_NEXT ) {
                (TABS_BOX_NEXT) && TABS_BOX_NEXT.classList.add('active');
                (TABS_BOX_NEXT) && TABS_BOX_NEXT.dispatchEvent( new Event('click') );
            } else {
                nextActive = ( DIRECTION && DIRECTION==='next' )
                                    ? TABS_BOX_ITEMs[0]
                                    : [...TABS_BOX_ITEMs].slice(-1)[0];

                console.log('nextActive',nextActive);

                (nextActive) && nextActive.classList.add('active');
                (nextActive) && nextActive.dispatchEvent( new Event('click') );
            }

            setTimeout( () => {

                (nextActive) && $(TABS_LINE).mCustomScrollbar("scrollTo", `#${nextActive.getAttribute('id')}` );
                (TABS_BOX_NEXT) && $(TABS_LINE).mCustomScrollbar("scrollTo", `#${TABS_BOX_NEXT.getAttribute('id')}` );


                // force trigger resize event for the document
                if (document.createEvent) {
                    window.dispatchEvent( new Event('resize') );
                }else{
                    document.body.fireEvent('onresize');
                }

            }, 10 );
        });

        /*
         * Disable border on black color of select product
         */
        const PRODUCT_COLOR = document.querySelectorAll('.js-product-color');

        [...PRODUCT_COLOR].forEach( (item) => {
            let item_arr = item.getAttribute("style").split(': ');
            if(item_arr.includes('#000000') || item_arr.includes('#0a0a0a')) {
                item.setAttribute("style", `background-color: ${item_arr[1]}; border: none`);
            }
        });


        /**
         * Force close popup window after successful submit
         */
        document.addEventListener( 'wpcf7submit', function( event ) {

            const form_tag = event.target.querySelector('form');

            if ( 'ask-question-form' == form_tag.getAttribute('id') || 'callback-form' == form_tag.getAttribute('id') ) {

                setTimeout( () => {
                    popup_instance.forceCloseAllPopup();

                }, 3000);

            }
        }, false );



    }; // onload
})  // ready

})(jQuery);




