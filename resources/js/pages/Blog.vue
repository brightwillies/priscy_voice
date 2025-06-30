<template>
    <div>
        <div class="page-content">
            <!-- start page title -->
            <div class="row">
                <div class="col-10">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
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
                                    placeholder="Select Category" label="name" :reduce="(name) => name.id"></v-select>
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
                            <label for="name">Blooog</label> <br />
                            <!-- <vue-editor   useCustomImageHandler v-model="form.summary" :editorToolbar="customToolbar"
                                @image-click="openMediaLibrary"></vue-editor> -->

                                <vue-editor v-model="form.summary" :editorToolbar="customToolbar" ref="editor"></vue-editor>
                        </div>
                        <button class="btn btn-primary btn-block mb-3" type="submit">
                            <span v-show="!editmode">Add Blog</span>
                            <span v-show="editmode">Update Blog</span>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Delete Record Modal -->
            <div id="deleteRecordModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
                aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="mySmallModalLabel">Deleting a record</h5>
                            <button @click="DeleteModalClose" type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to remove <strong>{{ selectedItem.title }}</strong>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="button" @click="deleteRecord" class="btn btn-primary">Yes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Library Modal -->
            <div id="mediaLibraryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Media Library</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div v-for="(image, index) in mediaLibrary" :key="index" class="col-md-4 mb-10">
                                    <div class="media-thumbnail" @click="selectMedia(image.path)">
                                        <img :src="image.path" class="img-fluid media-item" :alt="image.name">
                                        <span>{{image.filename}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            mediaLibrary: [], // Holds media library items
            editorInstance: null, // Store the editor instance
            currentCursorLocation: null, // Store the cursor location
            isDragging: false,
            dragCount: 0,
            images: [],
            files: [],
            customToolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                ["bold", "italic", "underline", "strike"],
                ["blockquote", "code-block"],
                  ['link', 'video', 'formula'],
                [{ list: "ordered" }, { list: "bullet" }],
                [{ script: "sub" }, { script: "super" }],
                [{ indent: "-1" }, { indent: "+1" }],
                [{ direction: "rtl" }],
                [{ size: ["small", false, "large", "huge"] }],
                [{ color: [] }, { background: [] }],
                [{ font: [] }],
                [{ align: [] }],
                ["image"]

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
                category_id: "",
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
        this.getImages();

        // Bind custom image handler to Quill's image button
        this.$nextTick(() => {
            const quill = this.$refs.editor.quill;
            if (quill) {
                const toolbar = quill.getModule('toolbar');
                toolbar.addHandler('image', this.openMediaLibrary);
            }
        });
    },
    methods: {
        getImages() {
            axios
                .get("/api/v1/admin/media-files")
                .then(({ data }) => {
                    this.mediaLibrary = data.data;
                })
                .catch((error) => {
                    console.error("Error fetching media files:", error);
                });
        },
        getCategories() {
            axios
                .get("/api/v1/admin/category")
                .then(({ data }) => {
                    this.categories = data.data;
                })
                .catch((error) => {
                    console.error("Error fetching categories:", error);
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
                .catch((error) => {
                    console.error("Error fetching record:", error);
                });
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
        updateRecord() {
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
                .then((response) => {
                    if (response.data.code === 200) {
                        this.successToastReloadPage(response.data.message);
                    }
                })
                .catch((error) => {
                    if (error.response) {
                        error.response.data.errors.forEach((element) => {
                            this.$toasted.show(element);
                        });
                    }
                });
        },
        saveRecord() {
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
                .then((response) => {
                    if (response.data.code === 200) {
                        this.successToastReloadPage(response.data.message);
                    }
                })
                .catch((error) => {
                    if (error.response) {
                        error.response.data.errors.forEach((element) => {
                            this.$toasted.show(element);
                        });
                    }
                });
        },
        deleteRecord() {
            axios
                .delete("/api/v1/admin/blog/" + this.selectedItem.mask)
                .then((response) => {
                    if (response.data.code === 200) {
                        this.successToastReloadPage(response.data.message);
                    }
                })
                .catch((error) => {
                    if (error.response) {
                        error.response.data.errors.forEach((element) => {
                            this.$toasted.show(element);
                        });
                    }
                });
        },
        showMedialModal() {
            $("#mediaLibraryModal").modal("show");
        },
       openMediaLibrary() {
            // Store the editor instance and cursor location
            const quill = this.$refs.editor.quill;
            this.editorInstance = quill;
            this.currentCursorLocation = quill.getSelection() || { index: quill.getLength() };
            this.showMedialModal();
        },

        selectMedia(imageUrl) {
            if (this.editorInstance && this.currentCursorLocation) {
                // Insert the selected image at the stored cursor location
                this.editorInstance.insertEmbed(this.currentCursorLocation.index, "image", imageUrl);
                // Move cursor after the inserted image
                this.editorInstance.setSelection(this.currentCursorLocation.index + 1);
            }
            // Close the modal
            $("#mediaLibraryModal").modal("hide");
            // Reset stored values
            this.editorInstance = null;
            this.currentCursorLocation = null;
        },

        DeleteModalClose() {
            $("#deleteRecordModal").modal("hide");
        },

    },
};
</script>


<style lang="scss" scoped>
.media-item {
  cursor: pointer;
  border: 1px solid #eee;
  border-radius: 2px;
  overflow: hidden;
  transition: all 0.2s;
  padding : 10px;
}

.media-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}



</style>
