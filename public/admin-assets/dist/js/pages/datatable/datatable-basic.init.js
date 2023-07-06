/****************************************
 *       Basic Table                   *
 ****************************************/
$('#zero_config').DataTable({
    "aaSorting": [],
    "language": {
        url: $datatable_language_url
    },
    "drawCallback": function () {
        let elems = Array.prototype.slice.call($('.js-switch'));
        elems.forEach(function (html) {
            if (typeof $(html).data('switchery') == "undefined") {
                new Switchery(html, {
                    size: 'small'
                });
            }
        });
    },
});

$('#datatable_without_search').DataTable({
    searching: false,
    "aaSorting": [],
    "language": {
        url: $datatable_language_url
    },
    "drawCallback": function () {
        let elems = Array.prototype.slice.call($('.js-switch'));
        elems.forEach(function (html) {
            if (typeof $(html).data('switchery') == "undefined") {
                new Switchery(html, {
                    size: 'small'
                });
            }
        });
    },
});
