/**
 * Created by Mark on 17.05.2016.
 */

var appMain = (function(App) {

    var CLEAN_BANKNOTES_COUNTING_MACHINE_URL = '/evening/day-completion/clean-banknotes-counting-machine',
        SAVE_ORGANIZATION_COVER_URL = '/evening/day-completion/save-organization-cover',
        IS_RECOUNT_KASSA_URL = '/evening/recount/is-recount-kassa',
        INPUT_BALANCES_URL = '/evening/day-completion/input-balances',
        INPUT_BARCODES_URL = '/evening/recount/input-barcodes',
        API_GET_DATA_URL = '/api/get-data/index',
        INPUT_OVER_LIMITS_URL = '/evening/recount/input-over-limits',
        ZEROING_DIFFERENCES_AJAX_URL = '/evening/recount/zeroing-differences-ajax',
        EVENING_KASSA_RECOUNT_START_URL = '/evening/recount/is-recount-kassa',
        TOTAL_CASH_TURNOVER_URL = '/evening/day-completion/get-payments-total-cash-turnover',
        INPUTTED_NOMINALS_SELECTORS = ['roots_panel', 'nominals_panel', 'worn_panel', 'monets_panel'];


    function getInputtedNominalsSumm(htmlBlock){

        var summ = 0;
        $(htmlBlock).find('input').each(function(){

            var current_val = parseFloat( $(this).val().replace(' ','') ),        //текущее значение
                current_nominal = parseInt( $(this).attr('data-nominal') );

            if (isNaN(current_val)) {
                current_val = 0;
            }

            if (isNaN(current_nominal)) {
                current_nominal = 0;
            }

            summ += current_val * current_nominal;
        });

        return summ;
    }

    function getTotalInputtedNominalsSumm(){

        var summ = 0,
            tempVal;

        $(INPUTTED_NOMINALS_SELECTORS).each(function(index, selector){

            tempVal = parseFloat( $("#"+selector).find(".total").html() );
            if (!isNaN(tempVal)) {
                summ += tempVal;
            }
        });

        return summ;
    }

    function getJsonToHtmlTable(data){

        var html = '';
        //console.log(html);
        for (var i in data) {
            var account = data[i];
            html += '<h3 class="col-md-12 text-center">Валюта: ' + account.currency + '</h3>'+
                    '<div class="col-md-12">'+
                        '<div class="col-md-6">'+
                            '<div class="col-md-6">ПРИХОД</div>'+
                            '<div class="col-md-2">кол-во</div>'+
                            '<div class="col-md-4">сумма</div>'+
                         '</div>'+
                        '<div class="col-md-6">'+
                            '<div class="col-md-6">РАСХОД</div>'+
                            '<div class="col-md-2">кол-во</div>'+
                            '<div class="col-md-4">сумма</div>'+
                        '</div>'+
                    '</div>';

            html += '<div class="col-md-12">';

            var subObj = account.incoming;
            for (var j in subObj) {

                //перебираем вложенные значения в которых есть кол-во и сумма
                if (typeof subObj[j] === 'object') {
                    html += '<div class="col-md-6">'+
                                '<div class="col-md-6">' + subObj[j].name + '</div>'+
                                '<div class="col-md-2">' + subObj[j].cnt + '</div>'+
                                '<div class="col-md-4">' + subObj[j].sum + '</div>'+
                            '</div>';
                }
            }


            var subObj = account.outgoing;
            for (var j in subObj) {
                // console.log(typeof subObj[j]);
                if (typeof subObj[j] === 'object') {
                    html += '<div class="col-md-6">'+
                                '<div class="col-md-6">' + subObj[j].name + '</div>'+
                                '<div class="col-md-2">' + subObj[j].cnt + '</div>'+
                                '<div class="col-md-4">' + subObj[j].sum + '</div>'+
                            '</div>';
                }
            }

            html += '</div>';
        }

        return html;
    }

    var app = {

        getPathName: function () {

            var pathName = document.location.pathname.split('/').slice(-1).toString().replace(new RegExp("-",'g'),'');

            if (pathName == '') {
                pathName = document.location.pathname.split('/').slice(-2).toString().replace(new RegExp("-",'g'),'').replace(new RegExp(",",'g'),'');
            }
            return pathName;
        },

        setCurrencyInputmask: function (element) {

            $(element).inputmask({
                alias: "decimal",
                rightAlign: false,
                groupSeparator: " ",
                autoGroup: true,
                digits: 2,
                digitsOptional: true,
                allowPlus: false,
                allowMinus: false
            });
        },


        setBarcodeInputmask: function (element) {

            $(element).inputmask({
                mask: "**99999999999999",
                placeholder: ''
            });
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

            $("#index_continue").on("click", function(){
                document.location = INPUT_BALANCES_URL;
            });

        },

        //
        setUpListenersForinputbalances: function () {

           app.setCurrencyInputmask($('.currency'));

            $("#more_currency").on("click", function(){
                $("#more_currency").addClass('hide');
                $("#less_currency, .exotic_curr").removeClass('hide');
            });

            $("#less_currency").on("click", function(){
                $("#more_currency").removeClass('hide');
                $("#less_currency, .exotic_curr").addClass('hide');
            });

            $("#input_balances_continue").on("click", app.inputBalancesContinueSubmit);
        },


        inputBalancesContinueSubmit : function(){

            $("#input_balances_form").validate({
                submitHandler: function(form) {
                    form.submit();
                }
            });
        },

        //
        setUpListenersForrecountexcessbalances: function () {
            app.setCurrencyInputmask($('.currency'));
        },

        //
        setUpListenersForrecountshortagebalances: function () {
            app.setCurrencyInputmask($('.currency'));

            $("#show_summary_help_cashier").on("click", function(e){

                e.preventDefault();

                if ($('#summary_help_cashier').hasClass('hide')) {

                    $.post(TOTAL_CASH_TURNOVER_URL, [], function (response) {
                        if (response.data.message) {
                            $('#summary_help_cashier')
                                .html(getJsonToHtmlTable(response.data.message))
                                .removeClass('hide');
                        }
                    });
                } else {
                    $('#summary_help_cashier').addClass('hide')
                }

                return false;
            });
        },

        //
        setUpListenersForexpectoverlimitamounts: function () {

            var timerId = setTimeout(function tick() {

                $.post( API_GET_DATA_URL, {"ref": $("#ref").val()},function(response){

                    if (response.data.message) {
                        try{
                            var jsonObj = JSON.parse(response.data.message);
                            if (jsonObj.needDropCash) {
                                document.location.href = INPUT_OVER_LIMITS_URL;

                            } else if (jsonObj.needDropCash == false) {
                                alert('Перелимитов нет');
                                document.location.href = INPUT_BARCODES_URL;
                            }
                        } catch (error) {
                            console.log(error);
                           // alert('Ошибка ответа сервера!');
                        }
                    }
                    timerId = setTimeout(tick, 2000);
                })
                .fail(function(){
                    alert('Сервис получения лимитов временно недоступен!');
                });
            }, 2000);
        },

        //формирование конверта
        setUpListenersFororganizationcover: function () {

            $('#barcode').inputmask({
                mask: "9",
                repeat: "16",
                groupSeparator: " "
            });

            $("#save_btn").on("click", function(){

                moduleAjaxHelper.Post({
                    url: SAVE_ORGANIZATION_COVER_URL,
                    data: {
                        'barcode': $('#barcode').val().replace(new RegExp("_",'g'),''),
                    },
                    callback: app.organizationCoverResult,
                });
            });

            //пропустить отправку штрих-кода конверта
            $("#skip_btn").on("click", function(){
                document.location.href = IS_RECOUNT_KASSA_URL;
            });
        },

        //кассиры не обнулили свои персональные счета
        setUpListenersForzeroingdifferences: function () {
            $("#expect_zeroing_continue").on("click", app.zeroingDifferencesContinue);
        },

        setUpListenersForinputnominals: function () {
            //ограничение ввода - только цифры
            app.setCurrencyInputmask($('.currency'));

            $(INPUTTED_NOMINALS_SELECTORS).each(function(index, selector){

                //корректирующий коэффициент
                var coefficient = 1,
                    summ;

                //если текущий блок подсчётов по корешкам
                if(selector == 'roots_panel'){
                    coefficient = 100;
                }

                //"вешаем" событие на поля для ввода и пересчёт сумм "Итого"
                $('#'+selector).find('input').on('change', function(){

                    //сумма введённых номиналов
                    summ = getInputtedNominalsSumm($('#'+selector));

                    //изменяем значение "Итого" в блоке
                    $('#'+selector+' .total').html( summ * coefficient );

                    //Изменяем общую сумму
                    $("#total").html( getTotalInputtedNominalsSumm() );
                });
            });
        },

        setUpListenersForinputoverlimits: function () {
            //ограничение ввода - только цифры
            app.setCurrencyInputmask($('.currency'));

            $(".nominals-panel").each(function(index, element){

                //"вешаем" событие на поля для ввода и пересчёт сумм "Итого"
                $(element).find('input').on('change', function(){

                    //сумма введённых номиналов
                    summ = getInputtedNominalsSumm($(element));

                    //изменяем значение "Итого" в блоке
                    $(element).find('.total').html( summ );
                });
            });
        },

        setUpListenersForinputnominalsexotic: function () {

            //список выбора валюты
            $("#currency_list").on('change',function(){

                var selectedCurrency = $(this).val();

                if ($(this).val() != '') {
                    //скрытие блока с выбором валюты
                    $('.currency-widget').hide();

                    //отображение блока покупюрки выбранной валюты
                    $('.currency-block-'+selectedCurrency).removeClass('hide');

                    //удаление лишних элементов
                    $('.hide').remove();

                    //активируем кнопку сохранения
                    $('.btn.disabled').attr('type','submit').removeClass('disabled');


                    //ограничение ввода - только цифры
                    app.setCurrencyInputmask($('.currency'));

                    //"вешаем" событие на поля для ввода и пересчёт сумм "Итого"
                    $('#nominals_panel').find('input').on('change', function(){

                        //сумма введённых номиналов
                        var summ = getInputtedNominalsSumm($('#nominals_panel'));

                        //изменяем значение "Итого" в блоке
                        $('#nominals_panel .total').html( summ );
                    });

                }
            });
        },

        setUpListenersForinputbarcodes: function () {
            //ограничение ввода для штрих кодов
            app.setBarcodeInputmask($('.barcode, #rests_barcode'));
        },

        organizationCoverResult: function (data) {

            if (data.message) {
                App.modules.alert(data.message);

            } else {
                try{
                    var jsonObj = JSON.parse(data);

                    if (jsonObj.data.message)
                        App.modules.alert(jsonObj.data.message);
                    else if (jsonObj.message)
                        App.modules.alert(jsonObj.message);

                } catch (error) {
                    App.modules.alert('Ошибка получения ответа сервера. ' + error + ' Попробуйте сохранить ещё раз.');
                }
            }
        },

        //обработка результата по обнулению счетов
        zeroingDifferencesResult : function(result){

            if(result){
                document.location = EVENING_KASSA_RECOUNT_START_URL;
            }
        },



    }

    $(function() {
        app.initialize();
    });

    return app;
}(App ? App : []));
