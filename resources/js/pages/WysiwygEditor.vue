<template>
  <div class="ckeditor-wrapper">
    <ckeditor
      :editor="editor"
      v-model="editorData"
      :config="editorConfig"
      @ready="onEditorReady"
    ></ckeditor>

    <!-- Media Library Modal -->
    <div v-if="showMediaLibrary" class="media-library-modal">
      <div class="modal-content">
        <div class="modal-header">
          <h3>Select Image</h3>
          <button @click="showMediaLibrary = false">&times;</button>
        </div>
        <div class="modal-body">
          <div class="media-grid">
            <div
              v-for="(item, index) in mediaItems"
              :key="index"
              class="media-item"
              @click="insertImage(item.url)"
            >
              <img :src="item.url" :alt="item.name" class="media-thumbnail">
              <div class="media-name">{{ item.name }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CKEditor from '@ckeditor/ckeditor5-vue2';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import MediaLibrary from '../plugins/ckeditor-media-library';
import axios from 'axios';

export default {
  name: 'CKEditorWithMedia',
  components: {
    ckeditor: CKEditor.component
  },
  props: {
    value: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      editor: ClassicEditor,
      editorData: this.value,
      editorInstance: null,
      showMediaLibrary: false,
      mediaItems: [],
      editorConfig: {
        extraPlugins: [MediaLibrary],
        toolbar: {
          items: [
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            '|',
            'mediaLibrary', // Our custom button
            'imageUpload',
            '|',
            'undo',
            'redo'
          ]
        },
        image: {
          toolbar: [
            'imageTextAlternative',
            'imageStyle:full',
            'imageStyle:side'
          ]
        }
      }
    };
  },
  watch: {
    value(newVal) {
      if (newVal !== this.editorData) {
        this.editorData = newVal;
      }
    },
    editorData(newVal) {
      this.$emit('input', newVal);
    }
  },
  mounted() {
    this.loadMediaItems();
  },
  methods: {
    onEditorReady(editor) {
      this.editorInstance = editor;

      // Listen for our custom event to open media library
      editor.model.document.on('openMediaLibrary', () => {
        this.showMediaLibrary = true;
      });
    },

    async loadMediaItems() {
      try {
        const response = await axios.get('/api/media');
        this.mediaItems = response.data;
      } catch (error) {
        console.error('Error loading media items:', error);
      }
    },

    insertImage(imageUrl) {
      if (this.editorInstance) {
        this.editorInstance.execute('imageInsert', { source: imageUrl });
        this.showMediaLibrary = false;
      }
    }
  }
};
</script>

<style scoped>
.ckeditor-wrapper {
  position: relative;
}

.media-library-modal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.modal-content {
  background: white;
  width: 80%;
  max-width: 900px;
  max-height: 80vh;
  border-radius: 5px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.modal-header {
  padding: 15px;
  border-bottom: 1px solid #eee;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.modal-header h3 {
  margin: 0;
}

.modal-body {
  padding: 15px;
  overflow-y: auto;
}

.media-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
  gap: 15px;
}

.media-item {
  cursor: pointer;
  border: 1px solid #eee;
  border-radius: 4px;
  overflow: hidden;
  transition: all 0.2s;
}

.media-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

.media-thumbnail {
  width: 100%;
  height: 120px;
  object-fit: cover;
}

.media-name {
  padding: 8px;
  font-size: 12px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
