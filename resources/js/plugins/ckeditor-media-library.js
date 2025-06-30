// import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
// import ButtonView from '@ckeditor/ckeditor5-ui/src/button/buttonview';
// import imageIcon from '@ckeditor/ckeditor5-core/theme/icons/image.svg';

export default class MediaLibrary extends Plugin {
    init() {
        const editor = this.editor;

        editor.ui.componentFactory.add('mediaLibrary', locale => {
            const view = new ButtonView(locale);

            view.set({
                label: 'Insert from Media Library',
                icon: imageIcon,
                tooltip: true
            });

            view.on('execute', () => {
                // Trigger media library modal
                editor.model.document.fire('openMediaLibrary');
            });

            return view;
        });
    }
}
