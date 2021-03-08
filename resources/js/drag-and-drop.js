$(document).ready(function() {
    Dropzone.options.myAwesomeDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        dictDefaultMessage: 'Drag and drop to loading',
        acceptedFiles: '.jpg, .jpeg, .png',
    };
});