<footer id="footer" class="login-footer">
    <div class="text-center text-muted padder">
        <p>
            <small>Powered by <a href="<?php echo e(config('system.saleurl')); ?>" target="_blank">Workice CRM</a> v<?php echo e(getCurrentVersion()['version']); ?>

            <br>&copy; <?php echo e(date('Y')); ?> <a href="<?php echo e(get_option('company_domain')); ?>"
            target="_blank"><?php echo e(get_option('company_name')); ?></a>
            </small>
        </p>
    </div>
</footer>