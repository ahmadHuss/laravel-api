<template>
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-12">
        <div class="mb-3">
          <form v-on:submit.prevent="submitForm">
            <label for="name" class="form-label">Name:</label>
            <input
              type="text"
              v-model="form.name"
              name="name"
              class="form-control"
              id="name"
              placeholder="Category Name"
              autocomplete="off"
            />
            <hr />
            <p class="form-label">Photo:</p>
            <div class="api">
              <div class="api__overlay">
                <div class="api-file">
                  <label class="api-file__label">
                    <input
                      type="file"
                      accept="image/*"
                      name="photo"
                      @change="onHandleUpload($event)"
                      class="api-file__input"
                    />
                    <span class="api-file__btn">
                      <span class="api-file__text">Upload</span>
                    </span>
                  </label>
                </div>
              </div>
            </div>

            <hr />

            <button
              class="btn btn-primary"
              type="button"
              :disabled="isSubmitted"
              @click="submitForm"
            >
              <span
                v-if="isSubmitted"
                class="spinner-border spinner-border-sm"
                role="status"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">{{
                isSubmitted ? 'Loading' : 'Submit'
              }}</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { onSingleFileUpload, uploadProgress } from '../utils';

export default {
  name: 'CategoriesCreate',
  data: function () {
    return {
      isSubmitted: false, // To check whether the form is in the submitted
      form: {
        name: '',
        photo: ''
      },
      selectedFile: null
    };
  },
  methods: {
    onHandleUpload: function (event) {
      const file = onSingleFileUpload(event);
      if (file) {
        this.selectedFile = file;
      }
    },
    submitForm: function () {
      const self = this;

      // Check if the string is not empty
      if (typeof self.form.name === 'string' && self.form.name.length > 0) {
        self.isSubmitted = true;

        const formData = new FormData();

        // Append formData fields
        formData.append('name', self.form.name);
        if (self.selectedFile) {
          formData.append('photo', self.selectedFile);
        }

        axios
          .post(`/api/categories`, formData, {
            headers: { 'Content-Type': 'multipart/form-data' },
            onUploadProgress: uploadProgress
          })
          .then(function (response) {
            console.log('response', response.data);
            self.isSubmitted = false;
            self.form.name = '';
            self.form.photo = '';
            alert('Data is successfully updated');
          })
          .catch(function (_) {
            self.isSubmitted = false;
            self.form.name = '';
            self.form.photo = '';
            alert('Oops! Something went wrong during posting the form. 🥺');
          });
      } else {
        alert(
          `Sorry We can't submit the form. The category 'name' is required. 🥺`
        );
      }
    }
  }
};
</script>
