(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.opignoLearningPathMemberOverview = {
    attach: function (context, settings) {
      var gid = drupalSettings.opigno_learning_path.gid;
      var baseUrl = drupalSettings.path.baseUrl ? drupalSettings.path.baseUrl : '/';

      $('#learning-path-members-form').submit(function (e) {
        e.preventDefault();
        return false;
      });

      const $pager = $('.show_pager', context).length;

      if (!$pager) {
        $('.class_hide', context).hide();
        $('.class_members_row', context).hide();
      }
      else {
        $('.class_hide', context).show();
        $('.class_show', context).hide();
      }

      function showClass($el) {
        var $parent = $el.closest('.class');

        if (!$parent.length) {
          return;
        }

        $parent.find('.class_hide').show();
        $parent.find('.class_show').hide();
        $parent.find('.class_members_row:not(.deleted)').show();
      }

      function hideClass($el) {
        var $parent = $el.closest('.class');

        if (!$parent.length) {
          return;
        }

        $parent.find('.class_hide').hide();
        $parent.find('.class_show').show();
        $parent.find('.class_members_row').hide();
      }

      function hideClasses() {
        var $class = $('.class');

        $class.find('.class_hide').hide();
        $class.find('.class_show').show();
        $class.find('.class_members_row').hide();
      }

      $(once('click', '.class_hide', context)).click(function () {
        hideClass($(this));
      });

      $(once('click', '.class_show', context)).click(function () {
        showClass($(this));
      });

      $(once('click', '.class_delete', context)).click(function (e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
          url: baseUrl + 'group/' + gid + '/learning-path/members/delete-class',
          data: {
            class_id: this.id.match(/(\d+)$/)[1],
          },
        })
            .done(function (data) {
              $this.parent().hide();
            });

        return false;
      });

      $(once('click', '.class_member_since_pending', context)).click(function (e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
          url: baseUrl + 'group/' + gid + '/learning-path/members/validate',
          data: {
            user_id: this.id.match(/(\d+)$/)[1],
          },
        }).done(function (e) {
          this.classList.remove('class_member_since_pending');

          var date = new Date();
          var day = date.getDate();
          var month = date.getMonth() + 1;
          var year = date.getFullYear();
          this.textContent =
              (day < 10 ? '0' : '') + day + '/'
              + (month < 10 ? '0' : '') + month + '/'
              + year;
        }.bind(this));

        return false;
      });

      $(once('click', '.class_member_toggle_sm', context)).click(function (e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
          url: baseUrl + 'group/' + gid + '/learning-path/members/toggle-role',
          data: {
            uid: this.id.match(/(\d+)$/)[1],
            role: drupalSettings.opigno_learning_path.student_manager_role,
          },
        })
            .done(function (data) {
              $this.toggleClass('class_member_toggle_sm_active');
            });

        return false;
      });

      $(once('click', '.class_member_toggle_cm', context)).click(function (e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
          url: baseUrl + 'group/' + gid + '/learning-path/members/toggle-role',
          data: {
            uid: this.id.match(/(\d+)$/)[1],
            role: drupalSettings.opigno_learning_path.content_manager_role,
          },
        })
            .done(function (data) {
              $this.toggleClass('class_member_toggle_cm_active');
            });

        return false;
      });

      $(once('click', '.class_member_toggle_class_manager', context)).click(function (e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
          url: baseUrl + 'group/' + gid + '/learning-path/members/toggle-role',
          data: {
            uid: this.id.match(/(\d+)$/)[1],
            role: drupalSettings.opigno_learning_path.class_manager_role,
          },
        })
          .done(function (data) {
            $this.toggleClass('class_member_toggle_class_manager_active');
          });

        return false;
      });

      $('.class_members_search').bind('keypress', function (e) {
        var code = e.keyCode || e.which;
        if (code === 13) {
          e.preventDefault();
          return false;
        }
      });

      $(once('autocompleteselect', '#class_members_search', context)).on('autocompleteselect', function (e, ui) {
        e.preventDefault();

        if (ui.item) {
          var id = 'student_' + ui.item.id;
          var $row = $('#' + id);
          var uid = ui.item.id;
          var $parentID = $row.closest('.class_members').data('class');

          if ($parentID === undefined) {
            $parentID = 0;
          }

          var url = baseUrl + 'group/' + gid + '/' + $parentID + '/member/' + uid + '/find-group-user';
          Drupal.ajax({url: url}).execute()
            .done(function () {

              var id = 'student_' + ui.item.id;
              var $row = $('#' + id);

              if ($row.length) {
                hideClasses();
                showClass($row);

                window.location.hash = '';
                window.location.hash = id;
                window.scrollBy(0, -100);
              }
              else {
                var id = 'individual_' + ui.item.id;
                var $row = $('#' + id);

                if ($row.length) {
                  showClass($row);

                  window.location.hash = '';
                  window.location.hash = id;
                  window.scrollBy(0, -100);
                }
              }
            });
        }

        return false;
      });

      $(once('autocompleteselect', '#individual_members_search', context)).on('autocompleteselect', function (e, ui) {
        e.preventDefault();

        if (ui.item) {
          var id = 'individual_' + ui.item.id;
          var $row = $('#' + id);

          if ($row.length) {
            showClass($row);

            window.location.hash = id;
            window.scrollBy(0, -100);
          }
        }

        return false;
      });

      $(once('click', '.class_member_delete', context)).click(function (e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
          url: baseUrl + 'group/' + gid + '/learning-path/members/delete-user',
          data: {
            user_id: this.id.match(/(\d+)$/)[1],
          },
        })
            .done(function (data) {
              $this.parents('.class_members_row').addClass('deleted').hide();
            });

        return false;
      });
    },
  };
}(jQuery, Drupal, drupalSettings));
