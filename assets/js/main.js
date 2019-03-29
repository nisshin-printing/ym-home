/**
 * Setup webpack public path
 * to enable lazy-including of
 * js chunks
 *
 */
import './vendor/webpack.publicPath';

/**
 * Your theme's js starts
 * Utility
 */
import './utils/_foundation';
import './utils/_page-scroll';
import './utils/_slider';
import './utils/_toc';

/**
 * Your theme's js starts
 * here...
 */
import './scripts/_sidenav';
import './scripts/_auto-calc';