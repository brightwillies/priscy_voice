<template>
    <div>
        <div class="page-content">
            <!-- start page title -->
            <div class="row">
                <div class="col-10">
                    <div class="
              page-title-box
              d-flex
              align-items-center
              justify-content-between
            ">
                        <h4 class="page-title mb-0 font-size-18">New Blog</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="/dashboard">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">New Blog</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <form @submit.prevent="editmode ? updateRecord() : saveRecord()">

                <div class="row card pt-5">
                    <div class="col-lg-8 offset-lg-2">

                        <div class="form-group">
                            <label for="name">Title</label>
                            <input required v-model="form.title" type="text" id="name" name="group-a[0][untyped-input]"
                                class="form-control" />
                        </div>


                        <div class="form-group">
                            <label for="name">Introduction</label> <br />
                            <textarea v-model="form.introduction" name="" id="" style="width: 100%" cols="5"
                                rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12 col-form-label">Select Category</label>
                            <div class="col-md-12">
                                <v-select id="sort_by_location" v-model="form.category_id" :options="categories"
                                    placeholder="Select Catgory" label="name" :reduce="(name) => name.id"></v-select>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-12">

                                <label for="example-text-input"
                                    class="col-md-3 col-form-label form-control-label">Featured Image</label>
                                <img :src="imageAvatar" id="profile-img-tag" height="250px" width="100%" />

                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFileLang" lang="en"
                                        @change="getFeaturedImage" ref="webfile" />
                                    <label class="custom-file-label" for="customFileLang">Select Image</label>
                                </div>




                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Date</label>
                            <input required v-model="form.date" type="date" id="name" name="group-a[0][untyped-input]"
                                class="form-control" />
                        </div>


                        <div class="form-group">
                            <label for="name">Blog</label> <br />
                            <vue-editor useCustomImageHandler @image-added="handleImageAdded" v-model="form.summary"
                                :editorToolbar="customToolbar"></vue-editor>
                        </div>
                        <button class="btn btn-primary btn-block mb-3" type="submit">
                            <span v-show="!editmode">Add Blog </span>
                            <span v-show="editmode">Update Blog</span>
                        </button>
                    </div>

                </div>
            </form>
        </div>



        <div id="deleteRecordModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="mySmallModalLabel">
                            Deleting a record
                        </h5>
                        <button @click="DeleteModalClose" type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Are you sure you want to remove
                            <strong> {{ selectedItem.title }}</strong> ?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            No
                        </button>
                        <button type="button" @click="deleteRecord" class="btn btn-primary">
                            Yes
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Form from "vform";
import { mixin } from "../mixin";

import "vue-select/dist/vue-select.css";
import { VueEditor } from "vue2-editor";
import vSelect from "vue-select";
export default {
    components: {
        vSelect,
        VueEditor,
    },
    mixins: [mixin],
    data() {
        return {


            /**images keys */
            isDragging: false,
            dragCount: 0,
            images: [],
            files: [],

            /*end of image keys */

            customToolbar: [
                ["bold", "italic", "underline", "strike"], // toggled buttons
                ["blockquote", "code-block"],

                [{ header: 1 }, { header: 2 }], // custom button values
                [{ list: "ordered" }, { list: "bullet" }],
                [{ script: "sub" }, { script: "super" }], // superscript/subscript
                [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
                [{ direction: "rtl" }], // text direction
                ["image", "code-block"],
                [{ size: ["small", false, "large", "huge"] }], // custom dropdown
                [{ header: [1, 2, 3, 4, 5, 6, false] }],

                [{ color: [] }, { background: [] }], // dropdown with defaults from theme
                // [{ color: [] }, { background: ["#FEEECE", "#FEF8D3", "#FEFCEF"] }], // dropdown with defaults from theme
                [{ font: [] }],
                [{ align: [] }],

                ["clean"], // remove formatting button
            ],

            selectedItem: "",
            imageAvatar: null,
            required: true,
            editmode: false,
            tableData: [],
            categories: [],

            form: new Form({
                title: "",
                date: "",
                introduction: "",
                summary: "",
                category_id:"",
                featured_image: "",
                mask: "",
                status: "",
            }),
        };
    },
    mounted() {

        this.getCategories();

        if (this.$route.params.id) {
            this.getRecord();
        }


    },

    methods: {

        getCategories() {
            axios
                .get("/api/v1/admin/category")
                .then(({ data }) => {
                    this.categories = data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        getRecord() {
            this.editmode = true;
            this.form.reset();
            let project_mask = this.$route.params.id;
            axios
                .get("/api/v1/admin/blog/" + project_mask)
                .then(({ data }) => {



                    this.form.fill(data);
                    this.imageAvatar = data.image;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        modalClose() {
            $("#newRecordModal").modal("hide");
        },
        DeleteModalClose() {
            $("#deleteRecordModal").modal("hide");
        },
        async getFeaturedImage(e) {
            this.form.featured_image = this.$refs.webfile.files[0];
            let image = e.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = (e) => {
                this.imageAvatar = e.target.result;
            };
        },
        initDatatable() {
            setTimeout(() => {
                $("#datatable-buttons").DataTable({
                    pagingType: "full_numbers",
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 100, "All"],
                    ],
                    order: [
                        [0, "asc"],
                        [3, "desc"],
                    ],
                    responsive: true,
                    destroy: true,
                    retrieve: true,
                    autoFill: true,
                    colReorder: true,
                });
            }, 300);
        },



        updateRecord() {
            var vm = this;
            let formData = new FormData();
            formData.append("title", this.form.title);
            formData.append("summary", this.form.summary);
            formData.append("category_id", this.form.category_id);
            formData.append("introduction", this.form.introduction);
            formData.append("date", this.form.date);
            formData.append("featured_image", this.form.featured_image);

            axios
                .post("/api/v1/admin/blog/" + this.form.mask, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
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
        showNewModal() {
            this.form.reset();
            this.editmode = false;
            this.imageAvatar = null;
            $("#newRecordModal").modal("show");
        },
        showDeleteModal(record) {
            this.selectedItem = record;
            $("#deleteRecordModal").modal("show");
        },

        launchEditModal(record) {
            this.form.reset();
            this.editmode = true;
            this.imageAvatar = record.image;
            this.form.fill(record);
            $("#newRecordModal").modal("show");
        },
        saveRecord() {
            var vm = this;
            let formData = new FormData();
            formData.append("introduction", this.form.introduction);
            formData.append("title", this.form.title);
            formData.append("summary", this.form.summary);
            formData.append("category_id", this.form.category_id);
            formData.append("date", this.form.date);
            formData.append("featured_image", this.form.featured_image);

            axios
                .post("/api/v1/admin/blog", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
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

        deleteRecord() {
            var vm = this;
            let formData = new FormData();

            axios
                .delete("/api/v1/admin/project/" + this.selectedItem.mask, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
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

        handleImageAdded: function (file, Editor, cursorLocation, resetUploader) {
            // An example of using FormData
            // NOTE: Your key could be different such as:
            // formData.append('file', file)

            var formData = new FormData();
            formData.append("image", file);

            axios
                .post("/api/v1/admin/uploadimage", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((result) => {
                    console.log(result.data.data.url);
                    let url = result.data.data.url; // Get url from response
                    Editor.insertEmbed(cursorLocation, "image", url);
                    resetUploader();
                })
                .catch((err) => {
                    console.log(err);
                });
        },


        ///

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
                height: 18px;
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
