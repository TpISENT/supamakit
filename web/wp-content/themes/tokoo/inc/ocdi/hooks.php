<?php

add_filter( 'pt-ocdi/import_files', 'tokoo_ocdi_import_files' );

add_action( 'pt-ocdi/after_import', 'tokoo_ocdi_after_import_setup' );

add_action( 'pt-ocdi/before_widgets_import', 'tokoo_ocdi_before_widgets_import' );

add_action( 'init', 'tokoo_kc_force_enable_static_block', 99 );