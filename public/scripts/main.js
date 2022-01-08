
$(document).ready(function() {
    function ajaxCall(link, values) {
        return $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: link,
            type: "post",
            dataType: "json",
            data: values,
        });
    }

    ajaxCall('/categories').done(function (response){
        if (response !== undefined) {
            response.forEach(function(item){
                $("#categoryList").append(item);
            })
        }
    });
});