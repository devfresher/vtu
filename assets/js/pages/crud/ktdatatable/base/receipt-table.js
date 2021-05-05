'use strict';
// Class definition

var KTDatatableHtmlTableDemo = function() {
  // Private functions

  // demo initializer
  var demo = function() {
    $('#receipt_datatable').KTDatatable({
      // data: {
      //   saveState: {cookie: false},
      // },
      pagination: false,
      sortable: false,
      fontSize: '20px',
      layout: {
        scroll: 'true',
        class: 'datatable-bordered',
        pagination: false
      },
      columns: [
        {
          field: 'DESCRIPTION',
          autoHide: false,
          sortable: false,
        },
        {
          field: 'RECEIPIENT',
          autoHide: false,
          sortable: false,
        },
        {
          field: 'AMOUNT PAID',
          title: 'AMOUNT PAID',
          sortable: false,
          autoHide: false,
        }, 
        {
          field: 'STATUS',
          autoHide: false,
          sortable: false,
          // callback function support for column rendering
          template: function(row) {
            var status = {
              0: {
                'title': 'Declined',
                'class': ' label-light-danger',
              },
              1: {
                'title': 'Pending',
                'class': ' label-light-warning',
              },
              2: {
                'title': 'Awaiting Response',
                'class': ' label-light-warning',
              },
              3: {
                'title': 'Approved',
                'class': ' label-light-success',
              },
              4: {
                'title': 'Successful',
                'class': ' label-light-success',
              },
              5: {
                'title': 'Refunded',
                'class': ' label-light-info',
              },
            };
            return '<span class="label font-weight-bold label-lg' + status[row.STATUS].class + ' label-inline">' + status[row.STATUS].title + '</span>';
          },
        }, 
      ],
    });
  };

  return {
    // Public functions
    init: function() {
      // init dmeo
      demo();
    },
  };
}();

jQuery(document).ready(function() {
  KTDatatableHtmlTableDemo.init();
});
