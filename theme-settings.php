<?php
// Theme Settings Page Setup
function s14_theme_settings_menu() {
    add_menu_page(
        'Theme Settings',
        'Theme Settings',
        'manage_options',
        's14-theme-settings',
        's14_theme_settings_page',
        'dashicons-admin-generic',
        99
    );
}
add_action('admin_menu', 's14_theme_settings_menu');

function s14_register_theme_settings() {
    register_setting('s14_theme_settings_group', 's14_logo');
    register_setting('s14_theme_settings_group', 's14_phone');
    register_setting('s14_theme_settings_group', 's14_address');
    register_setting('s14_theme_settings_group', 's14_email');

    // Register structured social links
    foreach (['facebook', 'instagram', 'youtube'] as $platform) {
        register_setting('s14_theme_settings_group', "s14_{$platform}_link");
        register_setting('s14_theme_settings_group', "s14_{$platform}_icon");
    }
}
add_action('admin_init', 's14_register_theme_settings');

function s14_theme_settings_page() {
    ?>
    <div class="wrap">
        <h1>Theme Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('s14_theme_settings_group'); ?>
            <?php do_settings_sections('s14_theme_settings_group'); ?>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Logo Image</th>
                    <td>
                        <?php $logo = get_option('s14_logo'); ?>
                        <input type="text" name="s14_logo" id="s14_logo" value="<?php echo esc_attr($logo); ?>" />
                        <input type="button" class="button" value="Upload Logo" id="upload_logo_button">
                        <br>
                        <?php if ($logo): ?>
                            <img src="<?php echo esc_url($logo); ?>" style="max-height: 100px;" />
                        <?php endif; ?>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">Phone Number</th>
                    <td><input type="text" name="s14_phone" value="<?php echo esc_attr(get_option('s14_phone')); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Address</th>
                    <td><textarea name="s14_address"><?php echo esc_textarea(get_option('s14_address')); ?></textarea></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Email</th>
                    <td><input type="email" name="s14_email" value="<?php echo esc_attr(get_option('s14_email')); ?>" /></td>
                </tr>
            </table>

            <h2>Social Media Links & Icons</h2>
            <table class="form-table">
                <?php
                foreach (['facebook', 'instagram', 'youtube'] as $platform):
                    $link = get_option("s14_{$platform}_link");
                    $icon_id = get_option("s14_{$platform}_icon");
                    $icon_url = $icon_id ? wp_get_attachment_url($icon_id) : '';
                    ?>
                    <tr valign="top">
                        <th scope="row"><?php echo ucfirst($platform); ?> Link</th>
                        <td><input type="url" name="s14_<?php echo $platform; ?>_link" value="<?php echo esc_url($link); ?>" style="width: 300px;"></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php echo ucfirst($platform); ?> Icon</th>
                        <td>
                            <input type="hidden" name="s14_<?php echo $platform; ?>_icon" id="s14_<?php echo $platform; ?>_icon" value="<?php echo esc_attr($icon_id); ?>">
                            <button class="button upload_icon_button" data-target="s14_<?php echo $platform; ?>_icon">Upload <?php echo ucfirst($platform); ?> Icon</button>
                            <div class="icon-preview" id="preview_s14_<?php echo $platform; ?>_icon">
                                <?php if ($icon_url): ?>
                                    <img src="<?php echo esc_url($icon_url); ?>" style="max-width: 50px;">
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function s14_admin_scripts($hook) {
    if ($hook !== 'toplevel_page_s14-theme-settings') return;

    wp_enqueue_media();
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const singleUpload = (button, inputId) => {
            const input = document.getElementById(inputId);
            const preview = document.getElementById('preview_' + inputId);

            const mediaUploader = wp.media({
                title: 'Select Media',
                button: { text: 'Use this file' },
                multiple: false
            });

            mediaUploader.on('select', function () {
                const attachment = mediaUploader.state().get('selection').first().toJSON();
                input.value = attachment.id;
                if (preview) {
                    preview.innerHTML = '<img src="' + attachment.url + '" style="max-width: 50px;">';
                }
            });

            mediaUploader.open();
        };

        document.querySelectorAll('.upload_icon_button').forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                const inputId = btn.dataset.target;
                singleUpload(btn, inputId);
            });
        });

        const logoBtn = document.getElementById('upload_logo_button');
        const logoInput = document.getElementById('s14_logo');

        if (logoBtn && logoInput) {
            logoBtn.addEventListener('click', function (e) {
                e.preventDefault();

                const mediaUploader = wp.media({
                    title: 'Select Logo',
                    button: { text: 'Use this logo' },
                    multiple: false
                });

                mediaUploader.on('select', function () {
                    const attachment = mediaUploader.state().get('selection').first().toJSON();
                    logoInput.value = attachment.url;
                });

                mediaUploader.open();
            });
        }
    });
    </script>
    <?php
}
add_action('admin_enqueue_scripts', 's14_admin_scripts');
