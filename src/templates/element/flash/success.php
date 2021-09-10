<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<script>
    swal({
        text: '<?= $message ?>',
        icon: 'success',
        confirm: true,
        timer: 3000,
    });
</script>
