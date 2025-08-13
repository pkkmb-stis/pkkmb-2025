<x-admin-layout menu="Berita Harian" title=" {{ $halaman  }} Berita">
    @livewire('admin.informasi.berita.form', ['id' => $id ?? null])

    @push('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .ql-editor {
            min-height: 300px;
        }
    </style>
    @endpush

    @push('script-bottom')
    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        const quillEditor = () => {
            return {
                instance: null,
                init() {
                    this.$nextTick(() => {
                        this.instance = new Quill(this.$refs.editor, {
                            modules: {
                                'toolbar': [
                                    [{ 'font': [] }, { 'size': [] }],
                                    [ 'bold', 'italic', 'underline', 'strike' ],
                                    [{ 'color': [] }, { 'background': [] }],
                                    [{ 'header': '1' }, { 'header': '2' }, 'blockquote' ],
                                    [{ 'list': 'ordered' }, { 'list': 'bullet'}, { 'indent': '-1' }, { 'indent': '+1' }],
                                    [ { 'align': [] }],
                                    [ 'link', 'image'],
                                ]
                            },
                            theme: 'snow'
                        });

                        this.instance.on('text-change', () => {
                            this.$refs.input.dispatchEvent(new CustomEvent('input', {
                                detail: this.instance.root.innerHTML
                            }));
                        })
                    })
                },
            }
        }
    </script>
    @endpush
</x-admin-layout>
