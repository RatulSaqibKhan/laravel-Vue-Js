<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Multiple Row</title>
    <!-- JQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Axios CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.17.1/axios.min.js"></script>
    <!-- VUE JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.3/vue.js"></script> --}}
    <script src="https://openexchangerates.github.io/accounting.js/accounting.min.js"></script>
    <script src="https://rubaxa.github.io/Sortable/Sortable.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.min.js"></script>

    <!-- Styles -->
    <style>
    html, body {
        background-color: #fff;
        color: #271f6f;
        font-family: 'Raleway', sans-serif;
        font-size: 14px;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }

    /*.modal{*/
    /*top: 0;*/
    /*left: 0;*/
    /*right: 0;*/
    /*bottom: 0;*/
    /*position: fixed;*/
    /*background: rgba(0,0,0,0.4);*/
    /*}*/

    /*.modalContainer{*/
    /*width: 555px;*/
    /*background: #ffffff;*/
    /*}*/

    /*.modalHeading{*/
    /*padding: 6px;*/
    /*background: #06307c;*/
    /*color: #ffffff;*/
    /*}*/

    /*.modalContent{*/
    /*min-height: 333px;*/
    /*}*/
    </style>
</head>
<body>
    <div class="container">
        <div class="row col-md-12">
            <div class="panel-body" id="app">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 20px;">No.</th>
                            <th>Description</th>
                            <th style="width: 80px;">Qty</th>
                            <th style="width: 130px;" class="text-right">Price</th>
                            <th style="width: 90px;">Tax</th>
                            <th style="width: 130px;">Total</th>
                            <th style="width: 130px;"></th>
                        </tr>
                    </thead>
                    <tbody v-sortable.tr="rows">
                        <tr v-for="row in rows" track-by="$index">
                            <td>
                                @{{ $index +1 }}
                            </td>
                            <td>
                                <input class="form-control" v-model="row.description"/>
                            </td>
                            <td>
                                <input class="form-control" v-model="row.qty" number/>
                            </td>
                            <td>
                                <input class="form-control text-right" v-model="row.price | currencyDisplay" number data-type="currency"/>
                            </td>
                            <td>
                                <select class="form-control" v-model="row.tax">
                                    <option value="0">0%</option>
                                    <option value="10">10%</option>
                                    <option value="20">20%</option>
                                </select>
                            </td>
                            <td>
                                <input class="form-control text-right" :value="row.qty * row.price | currencyDisplay" v-model="row.total | currencyDisplay" number readonly />
                                <input type="hidden" :value="row.qty * row.price * row.tax / 100" v-model="row.tax_amount | currencyDisplay" number/>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-xs" @click="addRow($index)">add row</button>
                                <button class="btn btn-danger btn-xs" @click="removeRow($index)">remove row</button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>

                        <tr>
                            <td colspan="5" class="text-right">TAX</td>
                            <td colspan="1" class="text-right">@{{ taxtotal | currencyDisplay }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right">TOTAL</td>
                            <td colspan="1" class="text-right">@{{ total | currencyDisplay }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right">DELIVERY</td>
                            <td colspan="1" class="text-right"><input class="form-control text-right" v-model="delivery | currencyDisplay" number/></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right"><strong>GRANDTOTAL</strong></td>
                            <td colspan="1" class="text-right"><strong>@{{ grandtotal = total + delivery | currencyDisplay }}</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
                <button @click="getData()">SUBMIT DATA</button>
                <pre>@{{ $data | json }}</pre>
            </div>
        </div>
    </div>

    <script>
    Vue.filter('currencyDisplay', {
        // model -> view
        read: function (val) {
            if (val > 0) {
                return accounting.formatMoney(val, "$", 2, ".", ",");
            }
        },
        // view -> model
        write: function (val, oldVal) {
            return accounting.unformat(val, ",");
        }
    });

    Vue.directive('sortable', {
        twoWay: true,
        deep: true,
        bind: function () {
            var that = this;

            var options = {
                draggable: Object.keys(this.modifiers)[0]
            };

            this.sortable = Sortable.create(this.el, options);
            console.log('sortable bound!')

            this.sortable.option("onUpdate", function (e) {
                that.value.splice(e.newIndex, 0, that.value.splice(e.oldIndex, 1)[0]);
            });

            this.onUpdate = function(value) {
                that.value = value;
            }
        },
        update: function (value) {
            this.onUpdate(value);
        }
    });

    var vm = new Vue({
        el: '#app',
        data: {
            rows: [
                //initial data
                {qty: 5, description: "Something", price: 55.20, tax: 10},
                {qty: 2, description: "Something else", price: 1255.20, tax: 20},
            ],
            total: 0,
            grandtotal: 0,
            taxtotal: 0,
            delivery: 40
        },
        computed: {
            total: function () {
                var t = 0;
                $.each(this.rows, function (i, e) {
                    t += accounting.unformat(e.total, ",");
                });
                return t;
            },
            taxtotal: function () {
                var tt = 0;
                $.each(this.rows, function (i, e) {
                    tt += accounting.unformat(e.tax_amount, ",");
                });
                return tt;
            }
        },
        methods: {
            addRow: function (index) {
                try {
                    this.rows.splice(index + 1, 0, {});
                } catch(e)
                {
                    console.log(e);
                }
            },
            removeRow: function (index) {
                this.rows.splice(index, 1);
            },
            getData: function () {
                $.ajax({
                    context: this,
                    type: "POST",
                    data: {
                        rows: this.rows,
                        total: this.total,
                        delivery: this.delivery,
                        taxtotal: this.taxtotal,
                        grandtotal: this.grandtotal,
                    },
                    url: "/api/data"
                });
            }
        }
    });

    </script>

    <!-- <script src="<?php // echo asset('vuejs/app.js'); ?>"></script> -->
</body>
</html>
