<?php if(session('status') || session('success') || session('error')): ?>
    <?php
        $message = session('error') ?? session('status') ?? session('success');
        $type = session('error') ? 'danger' : 'success';
    ?>
    <div class="alert alert-<?php echo e($type); ?>" role="alert">
        <?php echo e($message); ?>

    </div>
<?php endif; ?>
<?php /**PATH /home/u420143207/domains/levelminds.in/public_html/resources/views/components/flash-message.blade.php ENDPATH**/ ?>