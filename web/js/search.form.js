/**
 * Created by Mark
 */

var appMain = (function() {

    var SEARCH_BY_BOOK_NAME_URL = '/book/search';

    var app = {

        getPathName: function () {

            var pathName = document.location.pathname.split('/').slice(-1).toString().replace(new RegExp("-",'g'),'');

            //for index page
            if (pathName == '') {
                pathName = document.location.pathname.split('/').slice(-2).toString().replace(new RegExp("-",'g'),'').replace(new RegExp(",",'g'),'');
            }

            //for main/home page
            if (pathName == '') {
                pathName = 'index';
            }
            return pathName;
        },

        initialize : function () {

            Promise.resolve(
                app.getPathName()
            )
            .then(function (PathName) {

                if (!app['setUpListenersFor' + PathName]()) {
                    throw new Error('fail setup listeners for page ');
                }

                return 'listeners success sutUped';
            })
            .catch(function (err) {
                return err;
            });
        },

        // index page
        setUpListenersForindex: function () {

            $("#quick_search_btn").on("click", function(){

                var bookNameSearchValue = $("#adv-search").find('input').first().val();

                $.post(SEARCH_BY_BOOK_NAME_URL, {"name" :bookNameSearchValue}, function (response) {
                    if (response.data) {
                        $('#w0').html(getJsonToHtmlTableBooksSearch(response.data));
                    }
                });
            });
        },
    }

    //makes from JSON - HTML table
    function getJsonToHtmlTableBooksSearch(data){

        var html = '';

        for (var i in data) {
            var bookData = data[i];
            html += '<tr data-key="' + i + '">'+
                        '<td>' + bookData.id + '</td>'+
                        '<td>' + bookData.name + '</td>'+
                        '<td>' + bookData.description + '</td>'+
                        '<td>' + bookData.location_id + '</td>'+
                        '<td>' + bookData.book_status + '</td>'+
                        '<td>' + bookData.create_date + '</td>'+
                    '</tr>';
        }

        if (html == '') {
            return '<div class="text-warning text-center">Нет данных</div>';
        }

        return '<table class="table table-striped table-bordered">'+
            '<thead>'+
                '<tr>'+
                '<th>ID</th>'+
                '<th><a data-sort="name" href="/book/index?sort=name">Название книги</a></th>'+
                '<th>Описание книги</th>'+
                '<th><a data-sort="location_id" href="/book/index?sort=location_id">ID расположения</a></th>'+
                '<th><a data-sort="book_status" href="/book/index?sort=book_status">ID статуса кники</a></th>'+
                '<th><a data-sort="-create_date" href="/book/index?sort=-create_date" class="asc">дата создания</a></th>'+
                '</tr>'+
            '</thead>'+
            '<tbody>' +

            html +

            '</tbody>'+
          '</table>';
    }

    $(function() {
        app.initialize();
    });

    return app;
}());
