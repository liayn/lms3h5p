H5P.jQuery(document).ready(function () {
    H5PEditor.init(
        // $form
        H5P.jQuery('#h5p-content-form'),
        // $type
        H5P.jQuery('.h5p-actions'),
        // $upload
        H5P.jQuery('#h5p-upload'),
        // $create
        H5P.jQuery('#h5p-create'),
        // $editor
        H5P.jQuery('#h5p-editor'),
        // $library
        H5P.jQuery('#h5p-library'),
        // $params
        H5P.jQuery('#h5p-parameters')
    )
});