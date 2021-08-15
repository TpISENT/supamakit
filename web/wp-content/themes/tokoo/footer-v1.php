<?php
/**
 * Footer v1 for Tokoo
 */
?>
            </div><!-- /.site-content-inner -->
        </div><!-- /.site-content -->
    </div><!-- /.container -->
    
    <?php do_action( 'tokoo_before_footer_v1' ); ?>

    <footer class="site-footer footer-v1 ">
        <?php
            do_action( 'tokoo_footer_v1' ); ?>
    </footer>

    <?php do_action( 'tokoo_after_footer_v1' ); ?>

</div><!-- /#page -->
</div><!-- /#off-canvas-wrapper -->

<?php wp_footer(); ?>

</body>
</html>