<template>
    <div>
        <div class="page-content">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="
              page-title-box
              d-flex
              align-items-center
              justify-content-between
            ">
                        <h4 class="page-title mb-0 font-size-18">Media Files</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="/dashboard">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Media Files</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div data-repeater-list="group-a">
                <div data-repeater-item="" class="row pull-right">
                    <div class="col-lg-9"></div>

                    <div class="col-lg-3 align-self-center"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <div class="card card-default">
                                        <!--Where we are uploaing the images -->
                                        <div class="card-body">

                                            <div id="my-strictly-unique-vue-upload-multiple-image"
                                                style="display: flex; justify-content: center">
                                            </div>

                                            <div class="mt-3 text-center">
                                                <div class="uploader" @dragenter="OnDragEnter" @dragleave="OnDragLeave"
                                                    @dragover.prevent @drop="onDrop" :class="{ dragging: isDragging }">
                                                    <div class="upload-control" v-show="images.length">
                                                        <label for="file">Select a file</label>
                                                    </div>

                                                    <div v-show="!images.length">
                                                        <i class="fa fa-cloud-upload"></i>
                                                        <p>Drop images here</p>
                                                        <div>OR</div>
                                                        <div class="file-input">
                                                            <label for="file">Select a file</label>
                                                            <input type="file" id="file" @change="onInputChange"
                                                                multiple />
                                                        </div>
                                                    </div>

                                                    <div class="images-preview" v-show="images.length">
                                                        <div class="img-wrapper" v-for="(image, index) in images"
                                                            :key="index">
                                                            <img :src="image" :alt="`Image Uplaoder ${index}`" />
                                                            <div class="details">
                                                                <span class="size"
                                                                    v-text="getFileSize(files[index].size)"></span>
                                                                <span class="name" v-text="files[index].name"></span>
                                                                <!-- <h4 v-on:click="removeImage(index)" style="color: red">
                                                                    X
                                                                </h4> -->
                                                                <span style="color: red" class="fa fa-trash"
                                                                    v-on:click="removeImage(index)"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row text-center">
                                                <div class="col-lg-12">
                                                    <button v-show="!editmode" @click="saveRecord()" type="Submit"
                                                        class="btn btn-primary pl-10 pr-10" title="Submit">
                                                        Save Media Files
                                                    </button>
                                                    <!-- <button v-show="editmode" @click="updateRecord()" type="Submit"
                                                        class="btn btn-primary pl-10 pr-10" title="Submit">
                                                        update  Details
                                                    </button> -->
                                                </div>
                                            </div>
                                            <viewer class="row" :images="oldimages">
                                                <div class="col-lg-4 col-md-3" v-for="image in oldimages"
                                                    :key="image.id">
                                                    <img :src="image.path" class="previmg" />
                                                    <div class="details">
                                                        <p style="font-size: 12px;">{{ image.filename }} </p>
                                                    </div>
                                                    <span style="color: red" class="fa fa-trash"
                                                        v-on:click="showRemovePreviewImageModal(image)"></span>
                                                </div>
                                            </viewer>
                                        </div>
                                        <!--end of uploas -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>

            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">
                                Are you sure you want to remove this image?
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- <h4 class="modal-heading mb-4 mt-2">Are you sure you want to delete remove the image? We Use Electoral College, Not Popular Vote</h4> -->

                            <div>
                                <img v-bind:src="selected_image.path" width="100%" height="300px" alt />
                            </div>
                            <div class="modal-footer">
                                <button @click="RemovePreviewImage(selected_image.id)" type="button"
                                    class="btn btn-primary btn-rounded mb-3 mt-3">
                                    Delete
                                </button>
                                <button type="button" class="btn btn-dark btn-rounded mb-3 mt-3" data-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Form from "vform";
import { mixin } from "../mixin";
import "vue-select/dist/vue-select.css";
import vSelect from "vue-select";



export default {
    components: {
        vSelect,
    },
    mixins: [mixin],
    data() {
        return {
            selected_image: "",
            /**images keys */
            isDragging: false,
            dragCount: 0,
            images: [],
            files: [],
            oldimages: [],
            /*end of image keys */
            loading: true,

            editmode: false,
            records: [],

            form: new Form({
                images: [],
            }),
        };
    },
    mounted() {

        this.getRecord();

    },

    methods: {
        showRemovePreviewImageModal(image) {
            this.selected_image = image;
            $("#exampleModalCenter").modal("show");
        },
        RemovePreviewImage(id) {
            // return;
            var vm = this;

            axios
                .delete(
                    "/api/v1/admin/delete-image/" + this.selected_image.id,

                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                )
                .then(
                    (response) => {
                        if (response) {
                            const res = response.data;

                            if (res.code === 200) {
                                this.successToastReloadPage(res.message);
                            } else {
                            }
                        }
                    },
                    function (error) {
                        if (error.response) {
                            console.log(error.response.data.errors);
                            error.response.data.errors.forEach((element) => {
                                vm.$toasted.show(element);
                            });
                            // alert(error.response.status);
                        }
                    }
                );
        },
        getRecord() {
            axios
                .get("/api/v1/admin/media-files")
                .then(({ data }) => {

                    this.oldimages = data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });

            console.log(this.files);
        },
        saveRecord() {
            var vm = this;
            let formData = new FormData();
            this.files.forEach((file) => {
                formData.append("images[]", file, file.name);
            });
            axios
                .post("/api/v1/admin/media-files", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(
                    (response) => {
                        if (response) {
                            const res = response.data;

                            if (res.code === 200) {
                                this.successToastRedirect(
                                    res.message,
                                    "/dashboard/media-files"
                                );
                            } else {
                            }
                        }
                    },
                    function (error) {
                        if (error.response) {
                            console.log(error.response.data.errors);
                            error.response.data.errors.forEach((element) => {
                                vm.$toasted.show(element);
                            });
                            // alert(error.response.status);
                        }
                    }
                );
        },


        /* image upload methods*/
        removeImage(key) {
            this.images.splice(key, 1);
            this.files.splice(key, 1);
        },

        OnDragEnter(e) {
            e.preventDefault();

            this.dragCount++;
            this.isDragging = true;

            return false;
        },
        OnDragLeave(e) {
            e.preventDefault();
            this.dragCount--;

            if (this.dragCount <= 0) this.isDragging = false;
        },
        onInputChange(e) {
            const files = e.target.files;

            Array.from(files).forEach((file) => this.addImage(file));
        },
        onDrop(e) {
            e.preventDefault();
            e.stopPropagation();

            this.isDragging = false;

            const files = e.dataTransfer.files;

            Array.from(files).forEach((file) => this.addImage(file));
        },
        addImage(file) {
            if (!file.type.match("image.*")) {
                this.$toastr.e(`${file.name} is not an image`);
                return;
            }

            this.files.push(file);
            const img = new Image(),
                reader = new FileReader();
            reader.onload = (e) => this.images.push(e.target.result);
            reader.readAsDataURL(file);
        },

        getFileSize(size) {
            const fSExt = ["Bytes", "KB", "MB", "GB"];
            let i = 0;
            while (size > 900) {
                size /= 1024;
                i++;
            }
            return `${Math.round(size * 100) / 100} ${fSExt[i]}`;
        },
        /* end of images */
    },
};
</script>

<style lang="scss" scoped>
.media-thumbnail {
    height: 300px;
    width: 300px;
    border: 2px solid red;
    background: red;
}

.previmg {
    padding-right: 2px;
    width: 100%;
    height: 250px;
    margin-top: 5px;
}

// UPLOADER FORM

.uploader {
    width: 100%;
    background: #2196f3;
    color: #fff;
    padding: 40px 15px;
    text-align: center;
    border-radius: 10px;
    border: 3px dashed #fff;
    font-size: 20px;
    position: relative;

    &.dragging {
        background: #fff;
        color: #2196f3;
        border: 3px dashed #2196f3;

        .file-input label {
            background: #2196f3;
            color: #fff;
        }
    }

    i {
        font-size: 85px;
    }

    .file-input {
        width: 200px;
        margin: auto;
        height: 68px;
        position: relative;

        label,
        input {
            background: #fff;
            color: #2196f3;
            width: 100%;
            position: absolute;
            left: 0;
            top: 0;
            padding: 10px;
            border-radius: 4px;
            margin-top: 7px;
            cursor: pointer;
        }

        input {
            opacity: 0;
            z-index: -2;
        }
    }

    .images-preview {
        display: flex;
        flex-wrap: wrap;
        margin-top: 20px;

        .img-wrapper {
            width: 160px;
            display: flex;
            flex-direction: column;
            margin: 10px;
            height: 150px;
            justify-content: space-between;
            background: #fff;
            box-shadow: 5px 5px 20px #3e3737;

            img {
                max-height: 105px;
            }
        }

        .details {
            font-size: 12px;
            background: #fff;
            color: #000;
            display: flex;
            flex-direction: column;
            align-items: self-start;
            padding: 3px 6px;

            .name {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                height: auto;
            }
        }
    }

    .upload-control {
        position: absolute;
        width: 100%;
        background: #fff;
        top: 0;
        left: 0;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
        padding: 10px;
        padding-bottom: 4px;
        text-align: right;

        button,
        label {
            background: #2196f3;
            border: 2px solid #03a9f4;
            border-radius: 3px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
        }

        label {
            padding: 2px 5px;
            margin-right: 10px;
        }
    }
}

/**end of form */
</style>
