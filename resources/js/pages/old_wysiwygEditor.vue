<template>
  <div class="tiptap-editor">
    <editor-menu-bar :editor="editor" v-slot="{ commands, isActive }">
      <div class="menubar">
        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.bold() }"
          @click="commands.bold"
        >
          <i class="fas fa-bold"></i>
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.italic() }"
          @click="commands.italic"
        >
          <i class="fas fa-italic"></i>
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.heading({ level: 1 }) }"
          @click="commands.heading({ level: 1 })"
        >
          H1
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.heading({ level: 2 }) }"
          @click="commands.heading({ level: 2 })"
        >
          H2
        </button>

        <button
          class="menubar__button"
          @click="showMediaLibrary = true"
        >
          <i class="fas fa-image"></i>
        </button>

        <!-- Add more buttons as needed -->
      </div>
    </editor-menu-bar>

    <editor-content class="editor__content" :editor="editor" />

    <!-- Media Library Modal -->
    <div v-if="showMediaLibrary" class="media-library-modal">
      <div class="modal-content">
        <div class="modal-header">
          <h3>Media Library</h3>
          <button @click="showMediaLibrary = false">&times;</button>
        </div>
        <div class="modal-body">
          <div class="media-grid">
            <div
              v-for="(media, index) in mediaLibrary"
              :key="index"
              class="media-item"
              @click="insertImage(media.url)"
            >
              <img :src="media.url" :alt="media.name" class="media-thumbnail">
              <div class="media-name">{{ media.name }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Editor, EditorContent, EditorMenuBar } from 'tiptap'
import {
  Heading,
  Bold,
  Italic,
  Link,
  Image,
  Placeholder,
  OrderedList,
  BulletList,
  ListItem,
} from 'tiptap-extensions'

export default {
  components: {
    EditorContent,
    EditorMenuBar,
  },
  props: {
    value: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      editor: null,
      showMediaLibrary: false,
      mediaLibrary: [
        // This would come from your API in a real app
        { url: 'https://picsum.photos/200/300', name: 'Sample 1' },
        { url: 'https://picsum.photos/300/200', name: 'Sample 2' },
        { url: 'https://picsum.photos/400/300', name: 'Sample 3' },
      ],
    }
  },
  mounted() {
    
    this.editor = new Editor({
      extensions: [
        new Bold(),
        new Italic(),
        new Heading({ levels: [1, 2, 3] }),
        new Link(),
        new Image(),
        new Placeholder({
          emptyEditorClass: 'is-empty',
          emptyNodeText: 'Write something beautiful...',
        }),
        new OrderedList(),
        new BulletList(),
        new ListItem(),
      ],
      content: this.value,
      onUpdate: ({ getHTML }) => {
        this.$emit('input', getHTML())
      },
    })
  },
  methods: {

          getMediaFiles() {
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

    insertImage(url) {
      this.editor.commands.image({ src: url })
      this.showMediaLibrary = false
    },
    loadMediaLibrary() {
      // Call your API to load media items
      axios.get('/api/v1/admin/media')
        .then(response => {
          this.mediaLibrary = response.data
        })
        .catch(error => {
          console.error('Error loading media library:', error)
        })
    },
  },
  beforeDestroy() {
    this.editor.destroy()
  },
  watch: {
    value(newValue) {
      // Handle external changes to the value
      const isSame = this.editor.getHTML() === newValue
      if (!isSame) {
        this.editor.setContent(newValue)
      }
    },
  },
}
</script>

<style scoped>
.tiptap-editor {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 10px;
}

.menubar {
  margin-bottom: 10px;
}

.menubar__button {
  background: white;
  border: 1px solid #ddd;
  border-radius: 3px;
  padding: 5px 10px;
  margin-right: 5px;
  cursor: pointer;
}

.menubar__button.is-active {
  background: #ddd;
}

.editor__content {
  min-height: 200px;
  padding: 10px;
  border: 1px solid #eee;
  border-radius: 4px;
}

/* Media Library Modal Styles */
.media-library-modal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
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
