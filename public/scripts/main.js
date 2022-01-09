const currentLimit = 10;
var currentSearchId = null;
var currentOffset = 0;

function ajaxCall(link, values) {
    return $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: link,
        type: "get",
        dataType: "json",
        data: values,
    });
}

function processCategorySearch(category) {
    ajaxCall('/search/category/' + category).done(function (response) {
        if (response !== undefined) {
            setSearchId(response.searchId)
            $("#resultBox").empty();

            response.forEach(function(item) {
                printJSONResult(item)
            });
        }
    })
}

function processRandomSearch() {
    ajaxCall('/search/random').done(function (response) {
        if (response !== undefined) {
            setSearchId(response.searchId)
            $("#resultBox").empty();

            printJSONResult(response)
        }
    });
}

function processWordSearch() {
    let text = $("#searchBar").val();
    if (text !== undefined) {
        ajaxCall('/search/'+ text).done(function (response) {
            if (response !== undefined) {
                currentOffset = 0;
                setSearchId(response[0].searchId)
                $("#resultBox").empty();
                $("#paginationBox").empty();

                response.forEach(function(item){
                    printJSONResult(item)
                });

                printPagination()
            }
        });
    }
}

function printJSONResult(result) {
    $("#resultBox").append(
        "<div class='result' style='width: 1200px; margin-left:40px; margin-top: 20px; font-size: 20px'>" + result.value + "</div><hr>"
    )
}

function printPagination() {
    $("#paginationBox").append(
        "<button id='prevPage' style='margin-right: 200px'> <- </button><button id='nextPage'> -> </button>"
    )
}

function setSearchId(searchId) {
    currentSearchId = searchId
}

function processPagination(direction) {

        if (direction === 'previous') {
            if(currentOffset !== 0) {
                currentOffset -= currentLimit;
            }
        }

        if (direction === 'next') {
            currentOffset += currentLimit;
        }

        let values = {
            offset: currentOffset,
            limit: currentLimit,
            searchId: currentSearchId
        };
        console.log(currentSearchId)

        ajaxCall('/search', values).done(function (response) {
            if (response !== undefined) {
                $("#resultBox").empty();

                response.forEach(function(item){
                    printJSONResult(item)
                });
            }
        });
}

function changeLocale(language){

    ajaxCall('/'+ language).done(function (response) {});
}

ajaxCall('/categories').done(function (response) {
    if (response !== undefined) {
        response.forEach(function (item) {
            $("#categoryList").append(
                "<div class='cont' id='" + item + "' style='border: 1px solid black; margin: 0 0 -20px -10px; text-align: center; padding: 15px 10px 10px 10px; background: cadetblue; color: white'>" +
                "<div class='category'>" +
                item.charAt(0).toUpperCase() + item.slice(1) +
                "</div></div><br>"
            );

            $(document).on('click', '#' + item, function () {
                processCategorySearch(item);
            });
        })
    }
});

$(document).ready(function () {
    $(document).on('click', '#randomButton', function () {
        processRandomSearch()
    });

    $(document).on('click', '#searchButton', function () {
        processWordSearch()
    });

    $(document).on('click', '#prevPage', function () {
        processPagination('previous')
    });

    $(document).on('click', '#nextPage', function () {
        processPagination('next')
    });

    $(document).on('click', '#locale_es', function () {
        changeLocale('es')
    });

    $(document).on('click', '#locale_en', function () {
        changeLocale('en')
    });
});