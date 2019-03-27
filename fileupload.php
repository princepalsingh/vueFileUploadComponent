<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container" id="app">
      <div class="row">
        <div class="col-md-6 offset-3">
            <input type="file" @change="onFileChanged" multiple="">
            <button @click="onUpload">Upload!</button>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3" v-for="( file,index ) in files">
            <img :src="file" alt="no image">
            <button @click="removeImage(index)">Delete</button>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                message: 'Hello Vue!',
                selectedFile : [],
                files : []
            },
            methods: {
                onFileChanged (event) {
                    
                    let reader;

                    for (var i=0; i < event.target.files.length; i++) {
                        this.selectedFile.push(event.target.files[i]);
                        reader = new FileReader();
                        reader.onload = (function(self,file) {
                          return function(e) {
                            self.files.push(e.target.result);
                          };
                        })(this,event.target.files[i]);
                        reader.readAsDataURL(event.target.files[i]);
                    }
                },
                onUpload() {
                    // upload file, get it from this.selectedFile

                    const formData = new FormData()
                    for (var i=0; i < this.selectedFile.length; i++) {
                        formData.append('myFile[]', this.selectedFile[i], this.selectedFile[i].name)
                    }
                    // axios.post('fileajax.php', formData)
                    $.ajax({
                        url: "fileajax.php",
                        data : formData,
                        method : 'post',
                        processData: false,
                        contentType: false,
                    }).done(function() {
                        alert('Uploaded');
                    });
                },
                removeImage ( index ) {
                    this.$delete(this.selectedFile,index);
                    this.$delete(this.files,index);
                }
            }
        })
    </script>
  </body>
</html>