$('body').on('click', '.page-link', function (e) {

    e.preventDefault();

    let $this      = $(this);
    let pagination = $this.closest('ul');
    let page       = parseInt($(this).data("page"));
    let role       = $this.closest("ul").attr("role");
    let data       = {}

    $.get(
        $this.attr("href"),
        data,
        function (data, textStatus, jqXHR) {

            let paginationID = data.id
                ? `#pagination-${data.id}`
                : "#pagination";

            $("#" + pagination.data("container")).html(data.html);
            $(paginationID).html(data.pagination);

        },
        "json"
    );
})
