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
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.3/vue.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.min.js"></script> --}}

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

    </style>
</head>
<body>
    <div class="container">
        <div class="row col-md-12">
            <div id="root" class="" style="margin-top: 18px;">
                <div class="col-md-2">
                    <h4 class="pull-left" style="color: #2a2a2a;"> Multiple Row Calculation </h4>
                </div>
                <div class="col-md-12">
                    <hr>
                    <form id="multi-row-form" class="form">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Yarn Qty</th>
                                    <th>Accessory Qty</th>
                                    <th>Trims Qty</th>
                                    <th>Unit Rate</th>
                                    <th>Yarn * Unit Rate</th>
                                    <th>Total Qty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(input, index) in inputs">
                                    <td>@{{index+1}}</td>
                                    <td><input type="text" name="yarn_qty[]" class="form-control" v-model.number="input.yarn_qty"></td>
                                    <td><input type="text" name="acc_qty[]" class="form-control" v-model.number="input.acc_qty"></td>
                                    <td><input type="text" name="trims_qty[]" class="form-control" v-model.number="input.trims_qty" ></td>
                                    <td><input type="text" name="unit_rate[]" class="form-control" v-model.number="input.unit_rate"></td>
                                    <td><input type="text" name="yarn_unit_rate[]" class="form-control" v-model.number="yarn_unit_rate(index)" readonly></td>
                                    <td><input type="text" name="total_qty[]" class="form-control" v-model.number="total_qty(index)" readonly></td>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-danger" @click="deleteRow(index,input)"><span class="fa fa-trash"></span></button>&nbsp;
                                        <button type="button" class="btn btn-xs btn-success" @click="addRow"><span class="fa fa-plus"></span></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Totals:</td>
                                    <td>@{{totalYarnQty()}}</td>
                                    <td>@{{totalAccQty()}}</td>
                                    <td>@{{totalTrimsQty()}}</td>
                                    <td>@{{totalUnitPrice()}}</td>
                                    <td>@{{totalYarnUnitPrice()}}</td>
                                    <td>@{{totalPrice()}}</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                         {{-- <button type="button" class="btn btn-md btn-success">Save</button> --}}
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
    var app = new Vue({
        el: '#root',
        data: {
            errorMessage: "",
            successMessage: "",
            inputs: [{
                yarn_qty:'',
                acc_qty: '',
                trims_qty: '',
                unit_rate: ''
            }],
        },

        methods: {
            addRow: function() {
                this.inputs.push({
                    yarn_qty: '',
                    acc_qty: '',
                    trims_qty: '',
                    unit_rate: '',
                    yarn_unit_rate: '',
                    total_qty: ''
                })
            },
            deleteRow: function(index,input) {
                this.inputs.splice(index,2);
            },
            saveData: function () {
                var form = document.querySelector("#multi-row-form");
                var request = new XMLHttpRequest();
                var formData = new FormData(form);
                axios.post('add-multi-row-form-data', formData).then(
                    function (response) {
                        app.displayMessage(response);
                    }
                );
            },
            displayMessage : function(response){
                response.data.status===1 ? app.successMessage = response.data.message : app.errorMessage = response.data.message;
            },

            total_qty: function(index) {
                var total =  this.inputs[index].yarn_qty + this.inputs[index].acc_qty + this.inputs[index].trims_qty ;
                return total;
            },

            yarn_unit_rate: function(index) {
                return this.inputs[index].yarn_qty * this.inputs[index].unit_rate;
            },
            yarn_sum: function(index){
                total_yarn_qty = app.total_yarn_qty + this.inputs[index].yarn_qty;
                return this.total_yarn_qty;
            },

            totalPrice: function () {
                var total = 0;
                this.inputs.forEach(function (input) {
                    total += input.yarn_qty + input.acc_qty + input.trims_qty;
                });
                return total;
            },

            totalYarnQty: function () {
                var total = 0;
                this.inputs.forEach(function (input) {
                    total += input.yarn_qty;
                });
                return total;
            },

            totalAccQty: function () {
                var total = 0;
                this.inputs.forEach(function (input) {
                    total += input.acc_qty;
                });
                return total;
            },

            totalTrimsQty: function () {
                var total = 0;
                this.inputs.forEach(function (input) {
                    total += input.trims_qty;
                });
                return total;
            },

            totalUnitPrice: function () {
                var total = 0;
                this.inputs.forEach(function (input) {
                    total += input.unit_rate;
                });
                return total;
            },

            totalYarnUnitPrice: function () {
                var total = 0;
                this.inputs.forEach(function (input) {
                    total += input.yarn_qty * input.unit_rate;
                });
                return total;
            }

        }


    });

    </script>

    <!-- <script src="<?php // echo asset('vuejs/app.js'); ?>"></script> -->
</body>
</html>
