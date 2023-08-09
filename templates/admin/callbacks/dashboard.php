<?php

/**
 * Admin dashboard template callback.
 *
 * @package wp-plugin-starter
 */

use WPS\Helper;

?>

<section id="service_tabs">
    <ul class="nav nav-tabs gap-1">
        <li class="nav-item mb-0">
            <a class="nav-link active" data-toggle="tab" aria-current="page" href="#tab-1">Settings management</a>
        </li>
        <li class="nav-item mb-0">
            <a class="nav-link" data-toggle="tab" href="#tab-2">Updates</a>
        </li>
        <li class="nav-item mb-0">
            <a class="nav-link" data-toggle="tab" href="#tab-3">About</a>
        </li>
    </ul>

    <div class="tab-content bg-white p-3 border border-top-0">
        <div id="tab-1" class="tab-pane active">

			<?php Helper::make_settings_form( 'dashboard', 'Update' ); ?>

        </div>

        <div id="tab-2" class="tab-pane">
            <h3>Updates</h3>
        </div>

        <div id="tab-3" class="tab-pane">
            <h3>About</h3>
        </div>
    </div>
</section>
