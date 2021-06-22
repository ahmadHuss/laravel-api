export const getFileExtension = function(fileName) {
    return fileName.split('.').pop();
};

/**
 * This function will take an Vue.js inner event.
 *
 * @param event
 * @returns {*}
 */
export const onSingleFileUpload = function(event) {
    const { target } = event;
    console.log('Target files', target.files);
    if (target.files.length > 0 && target.files.length < 2) {
        const extension = getFileExtension(target.files[0]?.name);

        // Check client-side if the upload file is image or not
        if (extension === 'jpg' || extension === 'png' || extension === 'jpeg') {
            return target.files[0];
        } else {
            alert('Please upload image file instead of this! 🥺');
        }
    } else {
        alert("Sorry currently, we're not supporting multiple files upload! 🥺");
    }
};


export const uploadProgress = function(uploadEvent) {
    const { loaded, total} = uploadEvent;
    console.log(`Uploading status : ${(loaded / total) * 100}%`);
}
