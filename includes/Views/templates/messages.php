<div class="zr-alert-box animate__animated d-none">
    <?php if (isset($_GET['zr_success_msg'])) { ?>
        <div class="alert alert-success alert-dismissible zr-alert" role="alert">
            <div><?php echo  esc_html($_GET['zr_success_msg']) ?></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
</div>
