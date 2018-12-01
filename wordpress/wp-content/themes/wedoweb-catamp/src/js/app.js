/**
 * Created by Juan on 5/12/2018.
 */

/** import local dependencies */
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import collaborators from './routes/collaborators';
/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({
    /** All pages */
    common,

    home,

    collaborators,
    /**Example: About Us page, note the change from about-us to aboutUs. */
    // aboutUs,
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());

