<?php

/**
 * Admin services template view.
 *
 * @package wp-plugin-starter
 */

use WPS\Helper;

?>

<div class="wrap">
    <div class="wp-ui-primary wp-die-message ps-2 mb-3">
        <h1 class="wp-heading-inline">
            <i class="fas fa-toolbox fa-fw" aria-hidden="true"></i>

			<?php echo get_admin_page_title(); ?>

        </h1>
        <span>

			<?php echo PLUGIN_VERSION; ?>

		</span>
    </div>
    <hr class="wp-header-end">
    <div class="wp-ui-text-icon wp-die-message">

		<?php Helper::get_template( 'admin', 'sample-service', 'callback' ); ?>

    </div>
</div>
