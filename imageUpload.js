var template = `<div class="col-sm-2 pl-0">
                    <!-- image-preview-filename input [CUT FROM HERE]-->
                    <div class="imgUp">
                        <!-- <div class="imagePreview"></div>-->
                        <div class="imagePreview"> 
                            <img :src="sourceImage" />
                        </div>
                        <label class="btn btn-primary btn-primary-custom">
                            Upload<input type="file" class="uploadFile img" value="Upload Photo" ref="fileupload" @change="onFileChanged" style="width: 0px;height: 0px;overflow: hidden;">
                        </label>
                        <i class="fa fa-times del" v-if="deleteButton" @click="deleteAction()"></i>
                    </div><!-- col-2 -->
                    <!--<input type="file" name="myFile" @change="onFileChanged"> 
                    <img :src="file.base64" placeholder="No Image" v-if="">-->
                </div>`;

Vue.component('image-selector', {
    props: ['value', 'file_index', 'type' , 'callback'],
    data: function () {
        return {
            file : this.value,
            index : this.file_index,
            fileName : '',
            blankImageUrl: '//cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg',
            actionType : this.type,
            callback : this.callback
        }
    },
    template: template,
    methods:{
        onFileChanged(){
            // console.log(this.file);
            // console.log(this.index);
            let reader;
            reader = new FileReader();
            reader.onload = (function (self, file) {
                return function (e) {
                    self.file.base64 = e.target.result;
                };
            })(this, event.target.files[0]);
            reader.readAsDataURL(event.target.files[0]);
            this.fileName = event.target.files[0].name;
            // for (var i=0; i < event.target.files.length; i++) {
            //     reader = new FileReader();
            //     reader.onload = (function(self,file) {
            //         return function(e) {
            //             self.file.base64 = e.target.result;
            //         };
            //     })(this,event.target.files[i]);
            //     reader.readAsDataURL(event.target.files[i]);
            //     // console.log(event.target.files[i].name)
            //     this.fileName = event.target.files[i].name;
            // }
        },
        deleteAction : function(){
            var self = this;
            // console.log(this.index);
            if (this.callback == undefined) {
                this.file.base64 = '';
                event.target.files = {}
                const input = this.$refs.fileupload;
                input.type = 'text';
                input.type = 'file';
            } else {
                this.callback(this.index, function () {
                    // self.file.base64 = '';
                    // event.target.files = {}
                    // const input = self.$refs.fileupload;
                    // input.type = 'text';
                    // input.type = 'file';
                });
            }
        }
    },
    computed : {
        sourceImage : function(){
            console.log('hi');
            // console.log(this.file.imageUrl);
            if (this.file.imageUrl == '' && this.file.base64 == '') {
                // console.log('first');
                return this.blankImageUrl;
            }else if ( this.file.imageUrl != '' ){
                // console.log('second');
                return this.file.imageUrl;
            }else{
                // console.log('third');
                return this.file.base64;
            }
        },
        deleteButton : function(){
            if (this.actionType == 'single') {
                if (this.file.imageUrl == '' && this.file.base64 == '') {
                    return false;
                }else{
                    return true;
                }
                
            }else{
                return true;
            }
        }
    },
    watch : {
        file: {
            handler: function (newValue) {
                this.file = newValue
                // console.log(newValue.base64)
                // console.log("New age: " + newValue.age)
            },
            deep: true
        },
        file_index : function(value){
            this.index = value;
        }
    },
    mounted(){
        this.actionType = this.type == undefined ? 'single' : this.type;
        this.file.order = Math.floor((Math.random() * 100) + 1);
        // console.log(this.file_index);
        // console.log(this.file);
        // console.log(this.index);
        // console.log(this.allFiles);
        // console.log(this.type);
        // console.log(this.callback);
    }
})