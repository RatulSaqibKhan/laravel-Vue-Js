<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>File Upload Using VUE JS</title>

    <!-- JQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Axios CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.17.1/axios.min.js"></script>
    <!-- VUE JS -->
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <!-- Styles -->
    <style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
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
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="file-upload" class="panel panel-default" style="margin-top: 18px;">

                    <div class="panel-heading">Upload your favorite image!</div>
                    <div class="panel-body">
                        <form @submit.prevent = "submit" enctype="multipart/form-data">
                            <input type="text" name="_token" value="{{ csrf_token() }}">
                            <!-- <div v-if="!image"> -->
                                <h2>Select an image</h2>
                                 <input type="file" name="image" @change="onFileChange">
                            <!-- </div> -->
                            <div v-if="image">
                                <img style="width: 200px;height: auto;" :src="image" />
                                <button @click="removeImage">Remove image</button>
                            </div>
                            <input type="submit" class="btn btn-md btn-primary">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        new Vue({
            el: '#file-upload',
            data: {
                message: 'working....',
                image: ''
            },

            methods:{
                onFileChange(e) {
                  var files = e.target.files || e.dataTransfer.files;
                  if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
              var image = new Image();
              var reader = new FileReader();
              var vm = this;
              reader.onload = (e) => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function (e) {
          this.image = '';
      },
      submit: function(){
        var form = document.querySelector("form");
        var request = new XMLHttpRequest();
        var formData = new FormData(form);
        request.open('post','{{route('submit')}}');
        request.send(formData);
    }
}
})
</script>
</body>
</html>
