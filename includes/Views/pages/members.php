<?php include_once(plugin_dir_path(__FILE__) . '../header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <?php require_once(plugin_dir_path(__FILE__) . '../templates/messages.php') ?>
        <div class="zr-members">
            <div class="d-flex justify-content-between flex-wrap">
                <div><h5><?php esc_html_e('All Members', 'zr-member') ?> (<?php echo esc_html($total_members); ?>)</h5></div>
                <div>
                    <a href="<?php esc_html_e(admin_url( 'admin.php?page=add-new-member' )); ?>" class="btn btn-primary btn-sm"><?php esc_html_e('Add New Member', 'zr-member') ?></a>
                </div>
            </div>
            <div class="mt-3 table-responsive">
                <table class="table border text-center striped">
                    <thead>
                    <tr>
                        <th scope="col"><?php esc_html_e('#'); ?></th>
                        <th scope="col"><?php esc_html_e('ID'); ?></th>
                        <th scope="col"><?php esc_html_e('Name'); ?></th>
                        <th scope="col"><?php esc_html_e('Email'); ?></th>
                        <th scope="col"><?php esc_html_e('Action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 0; ?>
                    <?php foreach ($members as $member) { ?>
                            <?php $counter++; ?>
                        <tr>
                            <th><?php esc_html_e($counter); ?></th>
                            <th><?php esc_html_e($member->id); ?></th>
                            <td><?php esc_html_e($member->name); ?></td>
                            <td><?php esc_html_e($member->email); ?></td>
                            <td>
                                <a href="<?php esc_html_e(admin_url( 'admin.php?page=zr-member&zr_member_edit=true&zr_member_id='.$member->id.' ' )); ?>" class="btn btn-success btn-sm"><?php esc_html_e('Edit', 'zr-member'); ?></a>
                                <button class="btn btn-danger btn-sm zr-delete-confirm" data-zrid="<?php esc_html_e($member->id); ?>"><?php esc_html_e('Delete', 'zr-member'); ?></button>
                                <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="d-none" id="zr-delete-form-<?php esc_html_e($member->id); ?>" method="post">
                                    <input type="hidden" name="action" value="zr_delete_member_action">
                                    <input type="hidden" name="id" value="<?php esc_html_e($member->id); ?>">
                                    <?php wp_nonce_field('zr_delete_member_action', 'zr_delete_member') ?>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Get the current URL
    var currentUrl = window.location.href;

    // Parse the URL
    var url = new URL(currentUrl);

    var successMsg = url.searchParams.get('zr_success_msg');

    if (successMsg !== null) {
        // Remove the 'zr_success_msg' parameter
        url.searchParams.delete('zr_success_msg');

        // Get the updated URL without the 'zr_success_msg' parameter
        var updatedUrl = url.toString();
        history.replaceState(null, null, updatedUrl);
    }

    let zrAlertBox = jQuery('.zr-alert-box');
    zrAlertBox.removeClass('d-none');
    zrAlertBox.addClass('animate__fadeInDown');
    setTimeout(function (){
        zrAlertBox.addClass('animate__fadeOutUp');
    }, 5000)

</script>

<?php include_once(plugin_dir_path(__FILE__) . '../footer.php'); ?>
