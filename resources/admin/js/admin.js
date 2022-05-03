
// Global Delete event
(function() {

    var deleteEvent = {
        initialize: function() {
            $('body').on('click', 'a[data-method]', this.handleMethod);
        },
        handleMethod: function(e) {
            var link = $(this);
            var httpMethod = link.data('method').toUpperCase();
            var form;

            // If the data-method attribute is not PUT or DELETE,
            // then we don't know what to do. Just ignore.
            if ( $.inArray(httpMethod, ['DELETE']) === - 1 ) {
                return;
            }

            // Allow user to optionally provide data-confirm="Are you sure?"
            if ( link.data('confirm-text') ) {
                deleteEvent.verifyConfirm(link, function (t) {
                    if (! t) return false;

                    form = deleteEvent.createForm(link);
                    form.submit();
                })
            }

            e.preventDefault();
        },

        verifyConfirm: function(link, callback) {
            
            Swal.fire({
                                          title: link.data('confirm-title'),
                                          text: link.data('confirm-text'),
                                          icon: 'warning',
                                          showCancelButton: true,
                                          confirmButtonColor: '#3085d6',
                                          cancelButtonColor: '#d33',
                                          confirmButtonText: 'Yes, delete it!'
                                        }).then((result) => {
                                          if (result.isConfirmed) {
                                           callback(result)
                                          }
                                        })
        },

        getCsrfToken: function () {
            return $('meta[name="csrf-token"]').attr('content');
        },

        createForm: function(link) {
            var form =
                $('<form>', {
                    'method': 'POST',
                    'action': link.attr('href')
                });

            var token =
                $('<input>', {
                    'name': '_token',
                    'type': 'hidden',
                    'value': deleteEvent.getCsrfToken()
                });

            var hiddenInput =
                $('<input>', {
                    'name': '_method',
                    'type': 'hidden',
                    'value': link.data('method')
                });

            return form.append(token, hiddenInput)
                .appendTo('body');
        }
    };

    deleteEvent.initialize();

})();