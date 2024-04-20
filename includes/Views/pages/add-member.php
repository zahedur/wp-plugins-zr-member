<?php include_once(plugin_dir_path(__FILE__) . '../header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="zr-members border">
            <div class="d-flex justify-content-between flex-wrap bg-light p-3">
                <div><h5><?php esc_html_e('Add New Member', 'zr-member') ?></h5></div>
                <div>
                    <a href="<?php esc_html_e(admin_url( 'admin.php?page=zr-member' )); ?>" class="btn btn-primary btn-sm"><?php esc_html_e('Members', 'zr-member') ?></a>
                </div>
            </div>
            <div class="mt-3 py-5 px-3">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                            <input type="hidden" name="action" value="zr_create_member_action">
                            <?php wp_nonce_field('zr_create_new_member', 'zr_create_member') ?>
                            <div class="form-group mb-3">
                                <label for="name"><?php esc_html_e('Name', 'zr-member'); ?></label>
                                <input type="text" id="name" name="name" class="form-control <?php echo (field_validation($_GET, 'name')) ? 'is-invalid' : ''; ?>" >
                                <?php echo field_validation($_GET, 'name') ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email"><?php esc_html_e('Email', 'zr-member'); ?></label>
                                <input type="text" id="email" name="email" class="form-control <?php echo (field_validation($_GET, 'email')) ? 'is-invalid' : ''; ?>" >
                                <?php echo field_validation($_GET, 'email') ?>
                            </div>
                            <div class="form-group mb-3 text-end">
                                <button type="submit" class="btn btn-primary"><?php esc_html_e('Add Member', 'zr-member'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once(plugin_dir_path(__FILE__) . '../footer.php'); ?>
