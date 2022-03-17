$("body").on("click", ".page-link", function (e) {
    e.preventDefault();

    let $this = $(this);
    let pagination = $this.closest("ul");
    let page = parseInt($(this).data("page"));
    let role = $this.closest("ul").attr("role");
    let data = [];

    console.log(pagination.data("filter"));

    if (pagination.data("filter"))
    {
        data = filterFilters($(`#${pagination.data("filter")}`));
    }

    $.get(
        $this.attr("href"),
        Object.assign({}, data),
        function (data, textStatus, jqXHR) {
            let paginationID = data.id
                ? `#pagination-${data.id}`
                : "#pagination";

            $("#" + pagination.data("container")).html(data.html);
            $(paginationID).html(data.pagination);
        },
        "json"
    );
});

let timer = null;

$(".filters").on("input", ".filter-text", function (e)
{
    let $this      = $(this);
    let parent     = $this.closest(".filters");
    let url        = parent.data("url");
    let container  = parent.data("container");
    let searchData = [];

    if (timer !== null) {
        clearTimeout(timer);
    }

    timer = setTimeout(function () {
        let search = $this.val().trim();

        searchData = filterFilters(parent);

        if (search.length === 0) {
            doSearch(url, searchData, container);
            return;
        }

        if (search.length < 3) {
            return;
        }

        $("#filter-reset").removeClass("active");

        doSearch(url, searchData, container);
    }, 500);
});

$(".filters").on("change", ".filter-select", function (e) {
    let $this = $(this);
    let parent = $this.closest(".filters");
    let url = parent.data("url");
    let container = parent.data("container");

    $("#filter-reset").removeClass("active");

    doSearch(url, filterFilters(parent), container);
});

$(".filters").on("change", ".filter-options", function (e) {
    let $this = $(this);
    let parent = $this.closest(".filters");
    let url = parent.data("url");
    let container = parent.data("container");

    $("#filter-reset").removeClass("active");

    doSearch(url, filterFilters(parent), container);
});

$(".filters").on("click", "#filter-reset", function (e) {
    let $this = $(this);

    if ($this.hasClass("active"))
    {
        return;
    }

    let parent = $this.closest(".filters");
    let url = parent.data("url");
    let container = parent.data("container");

    parent.find(".filter").each((index, element) => {


        if (element.type === "text")
        {
            element.value = "";
        }

        if (element.classList.contains("select-one"))
        {
            if (element.value !== 'all')
            {
                element.selectedIndex = 0;
            }
        }
    });

    $this.addClass("active");

    doSearch(url, [], container);
});

function doSearch(url, searchData, container) {

    $.get(
        url,
        Object.assign({}, searchData),
        function (data, textStatus, jqXHR) {
            let paginationID = data.id
                ? `#pagination-${data.id}`
                : "#pagination";

            $(`#${container}`).html(data.html);
            $(paginationID).html(data.pagination);
        },
        "json"
    );
}

function filterFilters(parent) {
    let data = [];

    parent.find(".filter").each((index, element) => {
        let text = element.value.trim();

        if (element.dataset.type === "text" && text.length > 2) {
            data.push({
                column: element.dataset.column,
                type: element.dataset.type,
                operator: element.dataset.operator,
                search: text,
            });
        }

        if ((element.dataset.type === "select" || element.dataset.type === 'other') && element.value !== "all") {
            data.push({
                column: element.dataset.column,
                type: element.dataset.type,
                operator: element.dataset.operator,
                search: text,
            });
        }

        if (
            element.dataset.type === "options" &&
            element.value !== "all"
        ) {
            data.push({
                column: element.dataset.column,
                type: element.dataset.type,
                option: text,
                option_category: element.dataset.categoryid,
                search: text,
            });
        }
    });

    return data;
}
