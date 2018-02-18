<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Exam Test</title>
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
            <div id="root" class="" style="margin-top: 18px;">
                <p class="alert alert-danger" v-if="errorMessage">@{{errorMessage}}</p>
                <p class="alert alert-success" v-if="successMessage">@{{successMessage}}</p>
                <div class="col-md-2">
                    <h4 class="pull-left" style="color: #2a2a2a;"> Multiple Row ADD </h4>
                </div>
                <div class="col-md-12">
                    <hr>
                    <form id="multi-row-form" class="form">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Student Roll</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(input, index) in inputs">
                                    <td><input type="text" name="std_name[]" class="form-control" v-model="input.std_name"></td>
                                    <td><input type="text" name="std_roll[]" class="form-control" v-model="input.std_roll"></td>
                                    {{-- <td><input type="text" name="std_roll[]" class="form-control" v-model="input.std_name + input.std_roll" readonly></td> --}}
                                    <td>
                                        <button type="button" class="btn btn-xs btn-danger" @click="deleteRow(index,input)"><span class="fa fa-trash"></span></button>&nbsp;
                                        <button type="button" class="btn btn-xs btn-success" @click="addRow"><span class="fa fa-plus"></span></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-md btn-success" @click="saveData">Save</button>
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
            inputs: [
                {std_name: '', std_roll: ''}
            ]
        },

        methods: {
            addRow: function() {
                this.inputs.push({
                    std_name: '',
                    std_roll: ''
                })
            },
            deleteRow: function(index,input) {
                console.log(input);
                console.log(index);
                console.log(index.std_name);
                console.log(index.std_roll);
                this.inputs.splice(index,1);
            },

            saveData: function () {
                var form = document.querySelector("#multi-row-form");
                var request = new XMLHttpRequest();
                var formData = new FormData(form);
                axios.post('exam-test-data-save', formData).then(
                    function (response) {
                        app.displayMessage(response);
                    }
                );
            },

            displayMessage : function(response){
                response.data.status===1 ? app.successMessage = response.data.message : app.errorMessage = response.data.message;
            }
        }

    });

    </script>

    <!-- <script src="<?php // echo asset('vuejs/app.js'); ?>"></script> -->
</body>
</html>
