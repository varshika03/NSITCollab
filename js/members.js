$(document).ready(function() {
    $('.dropdown-trigger').dropdown();



// SORT BY NAMES

    function orderbyNAME() {
        $.ajax({
            url: 'php/sort-names.php',
            type: 'get',
            dataType: 'JSON',
            success: function (data) {
                var html = '';
                var tablearr= [];
                // Loop through JSON and put data into HTML tags
                $.each(data, function (i, item) {
                    html += "<div class=\'col s6 m4 l4\'>";
                    html += "<div class=\'card member\'>";
                    html += "<a href='profile.php?user=" + item.username + "'>";
                    html += "<div class='card-image' style='background-image:url(" + item.picture + ")'>";
                    html += "</div>";
                    html += "<div class='card-content'>";
                    html += "<span class='card-title'>" + item.name + "</span>";
                    html += "<p class='subtitle'>" + item.type + "</p>";
                    html += "</div></a></div></div>";

                });
                // insert sorted data inside the insert ID on the HTML page
                $("#insert").html(html);
                var remove = $(".table-row-titles").length - 1;
                $.each($(".table-row-titles"), function (i, obj){
                    if ($(".table-row-titles").length > 1) {
                        console.log($(this));
                        $(this).empty();
                    }
                })



            },

            error: function (xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        });
    }

    function orderbyTYPE() {
        $.ajax({
            url: 'php/sort-by-type.php',
            type: 'get',
            dataType: 'JSON',
            success: function (data) {
                var html = '';
                var tablearr= [];
                // Loop through JSON and put data into HTML tags
                $.each(data, function (i, item) {
                    html += "<div class=\'col s6 m4 l4\'>";
                    html += "<div class=\'card member\'>";
                    html += "<a href='profile.php?user=" + item.username + "'>";
                    html += "<div class='card-image' style='background-image:url(" + item.picture + ")'>";
                    html += "</div>";
                    html += "<div class='card-content'>";
                    html += "<span class='card-title'>" + item.name + "</span>";
                    html += "<p class='subtitle'>" + item.type + "</p>";
                    html += "</div></a></div></div>";
                });
                // insert sorted data inside the insert ID on the HTML page
                $("#insert").html(html);
                var remove = $(".table-row-titles").length - 1;
                $.each($(".table-row-titles"), function (i, obj){
                    if ($(".table-row-titles").length > 1) {
                        console.log($(this));
                        $(this).empty();
                    }
                })



            },

            error: function (xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        });
    }

    $('#filter-name').on('click', function (e) {
        // Empty current data
        $("#results").empty();
        // Run ajax for orderName()
        orderbyNAME();
    })

    $('#filter-recent').on('click', function (e) {
        // Empty current data
        $("#results").empty();
        // Run ajax for orderType()
        orderbyTYPE();
    })
});