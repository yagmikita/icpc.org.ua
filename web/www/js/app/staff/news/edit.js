function appStaffNewsEdit() {

    var self = this;
    self.init();

    /**
     * On window unload
     */
    window.onbeforeunload = function() {
        if ($('.btn.save-news', self.$form).is(':disabled')) {
            return null;
        } else {
            return _t('appjs', 'You have unsaved changes.');
        }
    };

    /**
     * Save news
     */
    $('.btn.save-news', self.$form).on('click', function() {
        var $selfElement = $(this);
        $selfElement.prop('disabled', true);
        $('.news-status-switcher .btn').prop('disabled', false);
        $.ajax({
            url: app.baseUrl + '/staff/news/edit',
            data: {
                id:      $('[name=id]', self.$form).val(),
                lang:    $('[name=lang]', self.$form).val(),
                title:   $('[name=title]', self.$form).val(),
                content: self.editor.getData()
            },
            success: function(response) {
                appShowErrors(response.errors, self.$form);
                if (response.errors) {
                    return;
                } else {
                    $('.news-status-switcher .btn').prop('disabled', false);
                    if (response.isNew) {
                        location.href = response.url;
                    }
                }
            }
        });
    });

}

appStaffNewsEdit.prototype = appStaffNewsManage.prototype;